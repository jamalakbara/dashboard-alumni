<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table      = 'pekerjaan';
    protected $primaryKey = 'KEY';
    protected $allowedFields = [
        'ID',
        'TLP',
        'EMAIL',
        'KARIR',
        'INSTITUSI',
        'DMS_KERJA',
        'BDG_PERUSAHAAN',
        'JENIS',
        'KATEGORI',
        'SEKTOR_KERJA',
        'NEGARA',
        'TGL_UPDATED'
    ];

    public function getJumKerjaProdi()
    {
        return $this->select("PRODI, COUNT(KARIR) JUMLAH")
            ->join('alumni', 'alumni.ID = pekerjaan.ID')
            ->where('LOWER(pekerjaan.KARIR) != "belum kerja"')
            ->groupBy('alumni.PRODI')->get();
    }

    public function getJumBelumKerjaProdi()
    {
        return $this->select("PRODI, COUNT(KARIR) JUMLAH")
            ->join('alumni', 'alumni.ID = pekerjaan.ID')
            ->where('LOWER(pekerjaan.KARIR) = "belum kerja"')
            ->groupBy('alumni.PRODI')->get();
    }

    public function getJumJenisPekerjaan($filter = '')
    {
        if ($filter != '') {
            return $this->select("JENIS, COUNT(JENIS) JUMLAH")
                ->where("JENIS != NULL OR JENIS != '' AND TGL_KELUAR LIKE '%-{$filter}'")
                ->join('alumni', 'alumni.ID = pekerjaan.ID')
                ->groupBy('JENIS')
                ->orderBy('JUMLAH', "DESC")->get();
        }
        return $this->select("JENIS, COUNT(JENIS) JUMLAH")
            ->where('JENIS != NULL OR JENIS != ""')
            ->groupBy('JENIS')
            ->orderBy('JUMLAH', "DESC")->get();
    }

    public function getJumKategoriPekerjaan($filter = '')
    {
        if ($filter != '') {
            return $this->select("KATEGORI, COUNT(KATEGORI) JUMLAH")
                ->where("KATEGORI != NULL OR KATEGORI != '' AND TGL_KELUAR LIKE '%-{$filter}'")
                ->join('alumni', 'alumni.ID = pekerjaan.ID')
                ->groupBy('KATEGORI')->get();
        }
        return $this->select("KATEGORI, COUNT(KATEGORI) JUMLAH")
            ->where('KATEGORI != NULL OR KATEGORI != ""')
            ->groupBy('KATEGORI')->get();
    }

    public function getJumBidangPekerjaan($filter = '')
    {
        if ($filter == '') {
            return $this->select("pekerjaan.BDG_PERUSAHAAN, COUNT(pekerjaan.BDG_PERUSAHAAN) JUMLAH")
                ->join('alumni a', 'a.ID = pekerjaan.ID')
                ->where('BDG_PERUSAHAAN != NULL OR BDG_PERUSAHAAN != ""')
                ->groupBy('BDG_PERUSAHAAN')->get();
        }
        return $this->select("pekerjaan.BDG_PERUSAHAAN, COUNT(pekerjaan.BDG_PERUSAHAAN) JUMLAH")
            ->join('alumni a', 'a.ID = pekerjaan.ID')
            ->where("BDG_PERUSAHAAN != NULL OR BDG_PERUSAHAAN != '' AND a.TGL_KELUAR LIKE '%-$filter'")
            ->groupBy('BDG_PERUSAHAAN')->get();
    }

    public function getInfoPekerjaan($showPerPage, $skip, $filter = '')
    {
        if ($filter != '') {
            $result['data'] = $this->select("pekerjaan.ID, a.NAMA, a.PRODI, pekerjaan.TLP")
                ->join('(SELECT MAX( p.KEY ) AS MaxKey FROM pekerjaan p GROUP BY p.ID) AS JoinQuery', 'JoinQuery.MaxKey = pekerjaan.KEY')
                ->join('alumni AS a', 'a.ID = pekerjaan.ID')
                ->like('a.NAMA', $filter, 'both')
                ->orLike('a.PRODI', $filter, 'both')
                ->orderBy("a.NAMA")
                ->limit($showPerPage, $skip)->get();

            $result['count'] = $this->select("pekerjaan.ID, a.NAMA, a.PRODI, pekerjaan.TLP")
                ->join('(SELECT MAX( p.KEY ) AS MaxKey FROM pekerjaan p GROUP BY p.ID) AS JoinQuery', 'JoinQuery.MaxKey = pekerjaan.KEY')
                ->join('alumni AS a', 'a.ID = pekerjaan.ID')
                ->like('a.NAMA', $filter, 'both')
                ->orLike('a.PRODI', $filter, 'both')
                ->countAllResults();
        } else {
            $result['data'] = $this->select("pekerjaan.ID, a.NAMA, a.PRODI, pekerjaan.TLP")
                ->join('(SELECT MAX( p.KEY ) AS MaxKey FROM pekerjaan p GROUP BY p.ID) AS JoinQuery', 'JoinQuery.MaxKey = pekerjaan.KEY')
                ->join('alumni AS a', 'a.ID = pekerjaan.ID')
                ->orderBy("a.NAMA")
                ->limit($showPerPage, $skip)->get();

            $result['count'] = $this->select("pekerjaan.ID, a.NAMA, a.PRODI, pekerjaan.TLP")
                ->join('(SELECT MAX( p.KEY ) AS MaxKey FROM pekerjaan p GROUP BY p.ID) AS JoinQuery', 'JoinQuery.MaxKey = pekerjaan.KEY')
                ->join('alumni AS a', 'a.ID = pekerjaan.ID')
                ->countAllResults();
        }
        return $result;
    }

    public function getDetailInfoPekerjaan($id)
    {
        return $this->select("pekerjaan.ID, a.NAMA, a.PRODI, pekerjaan.TLP, pekerjaan.EMAIL, pekerjaan.INSTITUSI")
            ->join('alumni AS a', 'a.ID = pekerjaan.ID')
            ->where("pekerjaan.ID = '$id'")->get();
    }

    public function filterPekerjaan($showPerPage, $skip, $query)
    {
        $queryLimit = $query . " LIMIT $showPerPage OFFSET $skip";
        $result['data'] =  $this->query($queryLimit);
        $result['count'] = count($this->query($query)->getResultArray());
        return $result;
    }

    public function getPerusahaan()
    {
        return $this->select("INSTITUSI")
            ->where("INSTITUSI != NULL OR INSTITUSI != ''")
            ->groupBy("INSTITUSI")->get();
    }

    public function getJenis()
    {
        return $this->select("JENIS")
            ->where("JENIS != NULL OR JENIS != ''")
            ->groupBy("JENIS")->get();
    }

    public function getKategori()
    {
        return $this->select("KATEGORI")
            ->where("KATEGORI != NULL OR KATEGORI != ''")
            ->groupBy("KATEGORI")->get();
    }
}
