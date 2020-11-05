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
}
