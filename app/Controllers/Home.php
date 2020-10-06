<?php

namespace App\Controllers;

use App\Models\AlumniModel;
use App\Models\PekerjaanModel;

ini_set('max_execution_time', 0);
ini_set('memory_limit', '2048M');

class Home extends BaseController
{
	protected $alumniModel;

	public function __construct()
	{
		$this->alumniModel = new AlumniModel();
		$this->pekerjaanModel = new PekerjaanModel();
		helper('form');
	}

	public function index()
	{
		if ($this->request->getMethod() == 'post') {
			$filterTahun = $this->request->getPost("thnKeluar");
			$data['totalLulus'] = $this->alumniModel->getTotalLulusFilter($filterTahun)['ID'];
			$data['jenis'] = $this->pekerjaanModel->getJumJenisPekerjaanFilter($filterTahun);
			$data['kategori'] = $this->pekerjaanModel->getJumKategoriPekerjaanFilter($filterTahun);
		} else {
			$data['totalLulus'] = $this->alumniModel->getTotalLulus()['ID'];
			$data['jenis'] = $this->pekerjaanModel->getJumJenisPekerjaan();
			$data['kategori'] = $this->pekerjaanModel->getJumKategoriPekerjaan();
		}

		$data['title'] = 'Menu 1';
		$data['thnKeluar'] = $this->alumniModel->getTahunKeluar();

		return view('menu1', $data);
	}

	public function menu2()
	{
		$data = [
			'title' => 'Menu 2',
			'totalLulus' => $this->alumniModel->getTotalLulus()['ID'],
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
			$query = "SELECT NAMA, PRODI, EMAIL, TLP, INSTITUSI FROM alumni JOIN pekerjaan USING (ID)";

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

		// dd($data["pekerjaan"]);

		$data['title'] = 'Menu 3';
		$data['prodi'] = $this->alumniModel->getProdi();
		$data['angkatan'] = $this->alumniModel->getAngkatan();
		$data['perusahaan'] = $this->pekerjaanModel->getPerusahaan();
		$data['jenis'] = $this->pekerjaanModel->getJenis();
		$data['kategori'] = $this->pekerjaanModel->getKategori();


		return view('menu3', $data);
	}

	public function upload()
	{
		if ($this->request->getMethod() == 'post') {
			$file = $this->request->getFile('berkas')->getTempName();

			$ekstensi = explode('.', $this->request->getFile('berkas')->getName());
			$size = explode('.', $this->request->getFile('berkas')->getSize());

			if (empty($file)) {
				echo '<pre>';
				echo 'File tidak boleh kosong';
				echo '</pre>';
			} else {
				if (strtolower(end($ekstensi)) === 'csv' && $size > 0) {
					$i = 0;
					$handle = fopen($file, "r");
					while (($row = fgetcsv($handle))) {
						$i++;
						if ($i == 1 || $i == 2) continue;

						// Data yang akan disimpan ke dalam databse
						$nim = $row[1];
						// dd($this->alumniModel->where('NIM', $nim));
						$rec = array(
							'NIM' => $row[1],
							'ANGKATAN' => $row[5],
							'K_DOSEN' => $row[6],
							'PRODI' => $row[7],
							'IPK' => $row[8],
							'TGL_KELUAR' => $row[9],
							'KWN' => $row[10],
							'PROVINSI' => $row[11],
							'TAK' => $row[12],
							'JK' => $row[13],
							'J_SELEKSI' => $row[14],
							'TGL_LAHIR' => $row[15],
							'THN_STUDI' => $row[16],
							'DMS_TINGGAL' => $row[20],
							'WKT_TUNGGU' => $row[22],
							'PENDAPATAN' => $row[23],
							'POS_AWAL' => $row[26],
							'POS_SKRG' => $row[27],
							'CONTACT_UPDATED' => $row[30],
							'CAREER_UPDATED' => $row[31],
							'KAT_ANGKATAN' => $row[32],
							'FAKULTAS' => $row[33],
							'TGL_UPDATED' => 'cek',
						);
						try {
							$this->alumniModel->save($rec);
						} catch (\mysqli_sql_exception $e) {
							continue;
						}
					}
					fclose($handle);
					session()->setFlashData('success', 'Data berhasil di-update!!');
					return redirect()->to('/upload');
				} else {
					session()->setFlashData('fail', 'Data gagal di-update!!');
					return redirect()->to('/upload');
				}
			}
		} else {
			$data = [
				'title' => 'Upload'
			];

			return view('upload', $data);
		}
	}

	public function getData()
	{
		$data = [
			"draw" => null,
			"data" => [],
		];


		$info = $this->pekerjaanModel->getInfoPekerjaan()->getResultArray();
		$data['recordsTotal'] = count($info);
		$data['recordsFiltered'] = count($info);
		foreach ($info as $key => $value) {
			array_push($data['data'], [
				$value['NAMA'],
				$value['PRODI'],
				$value['INSTITUSI'],
				$value['EMAIL'],
				$value['TLP'],
			]);
		}


		echo json_encode($data, JSON_PRETTY_PRINT);
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
