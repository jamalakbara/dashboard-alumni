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

	public function rekapitulasi()
	{
		if ($this->request->getMethod() == 'post') {
			$filterTahun = $this->request->getPost("thnKeluar");
			$data['totalLulus'] = $this->alumniModel->getTotalLulus($filterTahun)['ID'];
			$data['jenis'] = $this->pekerjaanModel->getJumJenisPekerjaan($filterTahun);
			$data['kategori'] = $this->pekerjaanModel->getJumKategoriPekerjaan($filterTahun);
		} else {
			$data['totalLulus'] = $this->alumniModel->getTotalLulus()['ID'];
			$data['jenis'] = $this->pekerjaanModel->getJumJenisPekerjaan();
			$data['kategori'] = $this->pekerjaanModel->getJumKategoriPekerjaan();
		}

		$data['title'] = 'Rekapitulasi';
		$data['thnKeluar'] = $this->alumniModel->getTahunKeluar();

		return view('rekapitulasi', $data);
	}

	public function bidang()
	{
		if ($this->request->getMethod() == 'post') {
			$filterTahun = $this->request->getPost("thnKeluar");
			$data['totalLulus'] = $this->alumniModel->getTotalLulus($filterTahun)['ID'];
			$data['bidang'] = $this->pekerjaanModel->getJumBidangPekerjaan($filterTahun);
		} else {

			$data = [
				'totalLulus' => $this->alumniModel->getTotalLulus()['ID'],
				'bidang' => $this->pekerjaanModel->getJumBidangPekerjaan(),
			];
		}

		$data['title'] = 'Bidang';
		$data['thnKeluar'] = $this->alumniModel->getTahunKeluar();

		return view('bidang', $data);
	}

	public function alumni()
	{
		$pager = \Config\Services::pager();

		if ($this->request->getMethod() == "post") {
			$data = [
				'prodi' => $this->request->getVar('prodi') != "" ? $this->request->getVar('prodi') : null,
				'angkatan' => $this->request->getVar('angkatan') != "" ? $this->request->getVar('angkatan') : null,
				'perusahaan' => $this->request->getVar('perusahaan') != "" ? $this->request->getVar('perusahaan') : null,
				'jenis' => $this->request->getVar('j_pekerjaan') != "" ? $this->request->getVar('j_pekerjaan') : null,
				'kategori' => $this->request->getVar('kategori') != "" ? $this->request->getVar('kategori') : null

			];
			$query = "SELECT pekerjaan.ID, a.NAMA, a.PRODI, pekerjaan.TLP FROM pekerjaan JOIN (SELECT MAX(p.KEY) as MaxKey FROM pekerjaan p GROUP BY p.ID) AS JoinQuery ON JoinQuery.MaxKey = pekerjaan.KEY JOIN alumni AS a ON a.ID = pekerjaan.ID";

			$first = true;
			$prev = "";

			foreach ($data as $dat => $d) {
				switch ($dat) {
					case "prodi":
						$tambahan = 'a.PRODI';
						break;
					case "angkatan":
						$tambahan = 'a.ANGKATAN';
						break;
					case "perusahaan":
						$tambahan = 'pekerjaan.INSTITUSI';
						break;
					case "jenis":
						$tambahan = 'pekerjaan.JENIS';
						break;
					case "kategori":
						$tambahan = 'pekerjaan.KATEGORI';
				}
				if ($first && $prev != $dat) {
					$prev = $dat;
					if ($d != null) {
						if ($tambahan == 'a.PRODI') {
							$query .= " WHERE $tambahan LIKE '%$d%'";
						} else {
							$query .= " WHERE $tambahan = '$d'";
						}
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

			// inisiasi current page
			$currentPage = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
			// inisiasi jumlah data yang bakal di show
			$showPerPage = 10;
			// ini untuk offest limit di query builder sesuai current page
			$skip = ($currentPage - 1) * $showPerPage;
			// inisiasi untuk bikin paginator

			$filter = $this->pekerjaanModel->filterPekerjaan($showPerPage, $skip, $query);

			$page = [
				'paginate' => $this->pekerjaanModel->paginate(), //ngakalin biar bisa pake pager
				'pager' => $this->pekerjaanModel->pager,
				'currentPage' => $currentPage,
				'showPerPage' => $showPerPage
			];

			$data = [
				'pekerjaan' => $filter,
				'paginator' => $page
			];
		} else {
			// inisiasi current page
			$currentPage = $this->request->getGet('page') ? $this->request->getGet('page') : 1;
			// inisiasi jumlah data yang bakal di show
			$showPerPage = 10;
			// ini untuk offest limit di query builder sesuai current page
			$skip = ($currentPage - 1) * $showPerPage;
			// inisiasi untuk bikin paginator
			$page = [
				'paginate' => $this->pekerjaanModel->paginate(), //ngakalin biar bisa pake pager
				'pager' => $this->pekerjaanModel->pager,
				'currentPage' => $currentPage,
				'showPerPage' => $showPerPage
			];


			if ($this->request->getGet('q')) {
				$search = $this->request->getGet('q');
				$data['pekerjaan'] = $this->pekerjaanModel->getInfoPekerjaan($showPerPage, $skip, $search);
			} else {
				$data['pekerjaan'] = $this->pekerjaanModel->getInfoPekerjaan($showPerPage, $skip);
			}
			// dd($data['pekerjaan']['count']);

			$data['paginator'] = $page;
		}

		$data['title'] = 'Alumni';
		$data['prodi'] = $this->alumniModel->getProdi();
		$data['angkatan'] = $this->alumniModel->getAngkatan();
		$data['perusahaan'] = $this->pekerjaanModel->getPerusahaan();
		$data['jenis'] = $this->pekerjaanModel->getJenis();
		$data['kategori'] = $this->pekerjaanModel->getKategori();


		return view('alumni', $data);
	}

	public function alumniDetail($id)
	{
		$data = [
			'title' => "Detail Alumni",
			'pekerjaan' => $this->pekerjaanModel->getDetailInfoPekerjaan($id)
		];
		return view('alumni-detail', $data);
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
						if ($i == 1) continue;

						$nim = $row[1];
						$nama = $row[2];
						$tgl_lahir = $row[13];
						$alumniData = array(
							'NIM' => $row[1] ? $row[1] : rand(111111111111, 999999999999),
							'NAMA' => $row[2],
							'ANGKATAN' => $row[3],
							'K_DOSEN' => $row[4],
							'PRODI' => $row[5],
							'IPK' => $row[6],
							'TGL_KELUAR' => $row[7],
							'KWN' => $row[8],
							'PROVINSI' => $row[9],
							'TAK' => $row[10],
							'JK' => $row[11],
							'J_SELEKSI' => $row[12],
							'TGL_LAHIR' => $row[13],
							'THN_STUDI' => $row[14],
							'DMS_TINGGAL' => $row[15],
							'WKT_TUNGGU' => $row[16],
							'PENDAPATAN' => $row[17],
							'POS_AWAL' => $row[18],
							'POS_SKRG' => $row[19],
							'CONTACT_UPDATED' => $row[20],
							'CAREER_UPDATED' => $row[21],
							'KAT_ANGKATAN' => $row[22],
							'FAKULTAS' => $row[23],
							'TGL_UPDATED' => date('d-m-Y')
						);

						if ($row[24] && $row[25] && $row[26] && $row[27] && $row[28] && $row[29] && $row[30] && $row[31] && $row[32] && $row[33]) {
							$pekerjaanData = array(
								'TLP' => $row[24],
								'EMAIL' => $row[25],
								'KARIR' => $row[26],
								'INSTITUSI' => $row[27],
								'DMS_KERJA' => $row[28],
								'BDG_PERUSAHAAN' => $row[29],
								'JENIS' => $row[30],
								'KATEGORI' => $row[31],
								'SEKTOR_KERJA' => $row[32],
								'NEGARA' => $row[33]
							);
						}

						// update / insert alumni table

						// kalo nim ada
						if ($nim) {
							if ($this->alumniModel->checkNim($nim)) {
								$alumniData['ID'] = $this->alumniModel->checkNim($nim)['ID'];
								$this->alumniModel->save($alumniData);
							} else {
								$alumniData['ID'] = $row[0] ? $row[0] : rand(1, 99999) . " $nama";
								$this->alumniModel->insert($alumniData);
							}
						}
						// kalo ada nama sama tgl lahir cocok 
						elseif ($this->alumniModel->checkNamaTgl($nama, $tgl_lahir)) {
							$id_alumni = $this->alumniModel->checkNamaTgl($nama, $tgl_lahir)['ID'];
							$nim_alumni = $this->alumniModel->checkNamaTgl($nama, $tgl_lahir)['NIM'];
							$alumniData['NIM'] = $nim_alumni;
							$alumniData['ID'] = $id_alumni;
							$this->alumniModel->save($alumniData);
						} else {
							$alumniData['ID'] = $row[0] ? $row[0] : rand(1, 99999) . " $nama";
							$this->alumniModel->insert($alumniData);
						}

						// end update / insert alumni table

						// insert pekerjaan table
						if (isset($pekerjaanData)) {
							try {
								//code...
								$pekerjaanData['ID'] = $alumniData['ID'];
							} catch (\Throwable $th) {
								dd($alumniData);
							}
							$pekerjaanData['TGL_UPDATED'] = date('d-m-Y');
							$this->pekerjaanModel->insert($pekerjaanData);
						}
						// end insert pekerjaan table
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
