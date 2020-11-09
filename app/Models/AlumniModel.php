<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table      = 'alumni';
    protected $primaryKey = 'NIM';

    protected $allowedFields = [
        'ID',
        'NIM',
        'NAMA',
        'ANGKATAN',
        'K_DOSEN',
        'PRODI',
        'IPK',
        'TGL_KELUAR',
        'KWN',
        'PROVINSI',
        'TAK',
        'JK',
        'J_SELEKSI',
        'TGL_LAHIR',
        'THN_STUDI',
        'DMS_TINGGAL',
        'WKT_TUNGGU',
        'PENDAPATAN',
        'POS_AWAL',
        'POS_SKRG',
        'CONTACT_UPDATED',
        'CAREER_UPDATED',
        'KAT_ANGKATAN',
        'FAKULTAS',
        'TGL_UPDATED'
    ];

    public function checkNim($nim)
    {
        return $this->select('ID, NIM')->where("NIM = $nim")->first();
    }

    public function checkNamaTgl($nama, $tgl_lahir)
    {
        return $this->select('ID, NIM, NAMA, TGL_LAHIR')->where("NAMA = '$nama' AND TGL_LAHIR = '$tgl_lahir'")->first();
    }

    public function getTotalLulus($filter = '')
    {
        if ($filter != '') {
            return $this->selectCount("ID")->where("TGL_KELUAR LIKE '%-{$filter}'")->first();
        }
        return $this->selectCount('ID')->first();
    }

    public function getTahunKeluar()
    {
        $getKeluar = $this->select("TGL_KELUAR")->get();
        $array = array();
        foreach ($getKeluar->getResultArray() as $key => $value) {
            $seplit = explode("-", $value["TGL_KELUAR"]);
            try {
                if (!in_array($seplit[2], $array, true)) {
                    array_push($array, $seplit[2]);
                }
            } catch (\Throwable $th) {
                continue;
            }
        }
        sort($array);
        return $array;
    }



    public function getProdi()
    {
        return $this->select("PRODI")
            ->where("PRODI != NULL OR PRODI != ''")
            ->groupBy("PRODI")->get();
    }

    public function getAngkatan()
    {
        return $this->select("ANGKATAN")
            ->where("ANGKATAN != NULL OR ANGKATAN != ''")
            ->groupBy("ANGKATAN")->get();
    }

    public function getCluster()
    {
        $data =  $this->select("ANGKATAN, TGL_KELUAR")->get();

        $cluster = [
            'fresh graduate' => 0,
            'junior' => 0,
            'senior' => 0,
            'notable' => 0,
        ];
        foreach ($data->getResultArray() as $value) {
            $tgl_keluar = $value['TGL_KELUAR'] != "" || $value['TGL_KELUAR'] != null ? strtotime($value['TGL_KELUAR']) : null;
            $thn_keluar = $tgl_keluar != null ? (int)date("Y", $tgl_keluar) : 0;

            $angkatan = $value['ANGKATAN'] != "" || $value['ANGKATAN'] != null ? (int)($value['ANGKATAN']) : 0;

            if ($thn_keluar != 0 && $angkatan != 0) {
                if ($thn_keluar > $angkatan) {
                    $hasil_pengurangan = $thn_keluar - $angkatan;
                    if ($hasil_pengurangan >= 1 && $hasil_pengurangan < 3) {
                        $cluster['fresh graduate'] += 1;
                    } elseif ($hasil_pengurangan >= 3 && $hasil_pengurangan < 5) {
                        $cluster['junior'] += 1;
                    } elseif ($hasil_pengurangan >= 5 && $hasil_pengurangan < 15) {
                        $cluster['senior'] += 1;
                    } elseif ($hasil_pengurangan >= 15) {
                        $cluster['notable'] += 1;
                    }
                }
            }
        }

        return $cluster;
    }
}
