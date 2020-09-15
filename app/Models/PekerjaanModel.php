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
            ->join('alumni', 'alumni.NIM = pekerjaan.NIM')
            ->where('LOWER(pekerjaan.KARIR) != "belum kerja"')
            ->groupBy('alumni.PRODI')->get();
    }

    public function getJumBelumKerjaProdi()
    {
        return $this->select("PRODI, COUNT(KARIR) JUMLAH")
            ->join('alumni', 'alumni.NIM = pekerjaan.NIM')
            ->where('LOWER(pekerjaan.KARIR) = "belum kerja"')
            ->groupBy('alumni.PRODI')->get();
    }

    public function getJumJenisPekerjaan()
    {
        return $this->select("JENIS, COUNT(*) JUMLAH")
            ->where('LOWER(KARIR) != "belum kerja"')
            ->groupBy('JENIS')->get();
    }

    public function getJumKategoriPekerjaan()
    {
        return $this->select("KATEGORI, COUNT(*) JUMLAH")
            ->where('LOWER(KARIR) != "belum kerja"')
            ->groupBy('KATEGORI')->get();
    }

    public function getJumBidangPekerjaan()
    {
        return $this->select("BDG_PERUSAHAAN, COUNT(*) JUMLAH")
            ->where('LOWER(KARIR) != "belum kerja"')
            ->groupBy('BDG_PERUSAHAAN')->get();
    }

    public function getInfoPekerjaan()
    {
        return $this->select("NAMA, PRODI, EMAIL, TLP, INSTITUSI")
            ->join('alumni', 'alumni.NIM = pekerjaan.NIM')->get();
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
