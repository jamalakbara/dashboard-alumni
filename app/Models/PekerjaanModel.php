<?php

namespace App\Models;

use CodeIgniter\Model;

class PekerjaanModel extends Model
{
    protected $table      = 'pekerjaan';
    protected $primaryKey = 'ID';

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

    public function getJumJenisPekerjaan()
    {
        return $this->select("JENIS, COUNT(JENIS) JUMLAH")
            ->where('JENIS != NULL OR JENIS != ""')
            ->groupBy('JENIS')
            ->orderBy('JUMLAH', "DESC")->get();
    }

    public function getJumJenisPekerjaanFIlter($filter)
    {
        return $this->select("JENIS, COUNT(JENIS) JUMLAH")
            ->where("JENIS != NULL OR JENIS != '' AND TGL_KELUAR LIKE '%-{$filter}'")
            ->join('alumni', 'alumni.ID = pekerjaan.ID')
            ->groupBy('JENIS')
            ->orderBy('JUMLAH', "DESC")->get();
    }

    public function getJumKategoriPekerjaan()
    {
        return $this->select("KATEGORI, COUNT(KATEGORI) JUMLAH")
            ->where('KATEGORI != NULL OR KATEGORI != ""')
            ->groupBy('KATEGORI')->get();
    }

    public function getJumKategoriPekerjaanFilter($filter)
    {
        return $this->select("KATEGORI, COUNT(KATEGORI) JUMLAH")
            ->where("KATEGORI != NULL OR KATEGORI != '' AND TGL_KELUAR LIKE '%-{$filter}'")
            ->join('alumni', 'alumni.ID = pekerjaan.ID')
            ->groupBy('KATEGORI')->get();
    }

    public function getJumBidangPekerjaan()
    {
        return $this->select("BDG_PERUSAHAAN, COUNT(BDG_PERUSAHAAN) JUMLAH")
            ->where('BDG_PERUSAHAAN != NULL OR BDG_PERUSAHAAN != ""')
            ->groupBy('BDG_PERUSAHAAN')->get();
    }

    public function getInfoPekerjaan()
    {
        return $this->select("NAMA, PRODI, EMAIL, TLP, INSTITUSI")
            ->join('alumni', 'alumni.ID = pekerjaan.ID')->get();
    }

    public function filterPekerjaan($query)
    {
        return $this->query($query);
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
