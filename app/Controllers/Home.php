<?php

namespace App\Controllers;

use App\Models\AlumniModel;
use App\Models\PekerjaanModel;

class Home extends BaseController
{
	protected $alumniModel;

	public function __construct()
	{
		$this->alumniModel = new AlumniModel();
		$this->pekerjaanModel = new PekerjaanModel();
	}

	public function index()
	{
		$data = [
			'title' => 'Menu 1',
			'totalLulus' => $this->alumniModel->getTotalLulus()['NIM'],
			'jenis' => $this->pekerjaanModel->getJumJenisPekerjaan(),
			'kategori' => $this->pekerjaanModel->getJumKategoriPekerjaan(),
		];

		return view('menu1', $data);
	}

	public function menu2()
	{
		$data = [
			'title' => 'Menu 2',
			'totalLulus' => $this->alumniModel->getTotalLulus()['NIM'],
			'bidang' => $this->pekerjaanModel->getJumBidangPekerjaan(),
		];

		return view('menu2', $data);
	}

	public function menu3()
	{

		if ($this->request->getMethod() == "post") {
			$data = [
				'prodi' => $this->request->getVar('prodi') != "" ? $this->request->getVar('prodi') : null,
				'angkatan' => $this->request->getVar('angkatan') != "" ? $this->request->getVar('angkatan') : null,
				'perusahaan' => $this->request->getVar('perusahaan') != "" ? $this->request->getVar('perusahaan') : null,
				'jenis' => $this->request->getVar('j_pekerjaan') != "" ? $this->request->getVar('j_pekerjaan') : null,
				'kategori' => $this->request->getVar('kategori') != "" ? $this->request->getVar('kategori') : null

			];
			$query = "SELECT NAMA, PRODI, EMAIL, TLP, INSTITUSI FROM alumni JOIN pekerjaan USING (NIM)";

			$first = true;
			$prev = "";

			foreach ($data as $dat => $d) {
				switch ($dat) {
					case "prodi":
						$tambahan = 'PRODI';
						break;
					case "angkatan":
						$tambahan = 'ANGKATAN';
						break;
					case "perusahaan":
						$tambahan = 'INSTITUSI';
						break;
					case "jenis":
						$tambahan = 'JENIS';
						break;
					case "kategori":
						$tambahan = 'KATEGORI';
				}
				if ($first && $prev != $dat) {
					$prev = $dat;
					if ($d != null) {
						$query .= " WHERE $tambahan = '$d'";
						$first = false;
					}
				} elseif (!$first && $prev != $dat) {
					$prev = $dat;
					if ($d != null) {
						$query .= " AND $tambahan = '$d'";
						$first = false;
					}
				}
			}

			$filter = $this->pekerjaanModel->filterPekerjaan($query);

			$data = [
				'pekerjaan' => $filter
			];
		} else {
			$data = [
				'pekerjaan' => $this->pekerjaanModel->getInfoPekerjaan(),
			];
		}

		$data['title'] = 'Menu 3';
		$data['prodi'] = $this->alumniModel->getProdi();
		$data['angkatan'] = $this->alumniModel->getAngkatan();
		$data['perusahaan'] = $this->pekerjaanModel->getPerusahaan();
		$data['jenis'] = $this->pekerjaanModel->getJenis();
		$data['kategori'] = $this->pekerjaanModel->getKategori();


		return view('menu3', $data);
	}

	// public function index()
	// {

	// 	// $jumlahKerjaArray = $this->pekerjaanModel->getJumKerjaProdi();
	// 	// d($jumlahKerjaArray->getResultArray());

	// 	// $jumlahBlmKerjaArray = $this->pekerjaanModel->getJumBelumKerjaProdi();
	// 	// d($jumlahBlmKerjaArray->getResultArray());

	// 	// $jumlahLulusanArray = $this->alumniModel->cek();
	// 	// d($jumlahLulusanArray->getResultArray());

	// 	$data = [
	// 		'title' => 'Dashboard',
	// 		'jumKerjaProdi' => $this->pekerjaanModel->getJumKerjaProdi()
	// 	];

	// 	return view('menu1', $data);
	// }

	//--------------------------------------------------------------------

}
