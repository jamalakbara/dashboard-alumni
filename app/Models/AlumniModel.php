<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumniModel extends Model
{
    protected $table      = 'alumni';
    protected $primaryKey = 'NIM';

    public function cek()
    {
        return $this->select("PRODI, COUNT(*) JUMLAH")
            ->where('TGL_KELUAR != NULL OR TGL_KELUAR != ""')
            ->groupBy('PRODI')->get();
    }

    public function getTotalLulus()
    {
        return $this->selectCount('NIM')->first();
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
