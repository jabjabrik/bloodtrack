<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan extends CI_Controller
{

	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = 'pelayanan';
		$this->load->model('base_model');
		$this->load->model('pelayanan_model');
		is_logged_in();
		authorize();
	}



	public function index()
	{
		redirect('pelayanan/reg', 'refresh');
	}

	public function reg()
	{
		$data['title']        	= 'Pelayanan';
		$data['page_title']   	= 'halaman pelayanan pasien';
		$data['kode_pelayanan']    = mt_rand(100000, 999999) . '-KDPYN';
		$data['data_result']    = $this->pelayanan_model->get_all('pelayanan');
		$data['pasien']    = $this->base_model->get_all('pasien', TRUE);
		$data['dokter']    = $this->base_model->get_all('dokter', TRUE);
		$data['ruangan']    = $this->base_model->get_all('ruangan', TRUE);

		$this->load->view("pelayanan/index", $data);
	}

	public function permintaan($id_pelayanan = null)
	{
		if (is_null($id_pelayanan)) {
			show_404();
		}

		$data['title']        	= 'Pelayanan';
		$data['page_title']   	= 'halaman permintaan darah';
		$data['kode_pelayanan']    = mt_rand(100000, 999999) . '-KDPYN';
		$data['data_result']    = $this->pelayanan_model->get_permintaan('permintaan');
		$data['id_pelayanan'] = $id_pelayanan;

		$this->load->view("pelayanan/permintaan", $data);
	}

	public function crossmatch($id_permintaan = null)
	{
		if (is_null($id_permintaan)) {
			show_404();
		}

		$data['title']        	= 'Pelayanan';
		$data['page_title']   	= 'halaman crossmatch darah';
		$data['kode_pelayanan']    = mt_rand(100000, 999999) . '-KDCRMC';
		$data['data_result']    = $this->pelayanan_model->get_crossmatch($id_permintaan);
		$data['id_permintaan'] = $id_permintaan;

		$this->load->view("pelayanan/crossmatch", $data);
	}

	private function _show(bool $is_active, array $result_model)
	{
		$data['title']        	= "Kelola " . ucfirst($this->service_name);
		$data['page_title']   	= $is_active ? "halaman manajemen $this->service_name Aktif" : "halaman $this->service_name tidak aktif";
		$data['service_name'] 	= $this->service_name;
		$data['is_active_page'] = $is_active;
		$data['rekam_medis']    = mt_rand(100000, 999999) . '-RM';
		$data['data_result']    = $result_model;

		$this->load->view("pelayanan/index", $data);
	}

	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$nik = trim($this->input->post('nik'));

		$data = [
			'rekam_medis' => trim($this->input->post('rekam_medis')),
			'nik' => $nik,
			'nama_pelayanan' => trim($this->input->post('nama_pelayanan')),
			'jenis_kelamin' => trim($this->input->post('jenis_kelamin')),
			'tanggal_lahir' => trim($this->input->post('tanggal_lahir')),
			'no_telepon' => trim($this->input->post('no_telepon')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$is_exist_nik = count($this->base_model->get_data_by($this->service_name, 'nik', $nik)) > 0;

		if ($is_exist_nik) {
			set_toasts("NIK dengan nilai ($nik) telah digunakan.", 'danger');
			redirect($this->service_name, 'refresh');
		}

		$this->base_model->insert($this->service_name, $data);
		set_toasts("Data $this->service_name berhasil disimpan.", 'success');

		redirect($this->service_name, 'refresh');
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$id = $this->input->post('id_pelayanan');
		$nik = trim($this->input->post('nik'));

		$data = [
			'rekam_medis' => trim($this->input->post('rekam_medis')),
			'nik' => $nik,
			'nama_pelayanan' => trim($this->input->post('nama_pelayanan')),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_telepon' => trim($this->input->post('no_telepon')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$is_exist_nik = count($this->base_model->get_data_by($this->service_name, 'nik', $nik)) > 0;
		$is_current_nik = $this->base_model->get_data_by($this->service_name, "id_$this->service_name", $id)[0]->nik == $nik;

		if ($is_exist_nik && !$is_current_nik) {
			set_toasts("NIK dengan nilai ($nik) telah digunakan.", 'danger');
			redirect($this->service_name, 'refresh');
		}

		$this->base_model->update($this->service_name, $data, $id);
		set_toasts("Data $this->service_name berhasil diedit.", 'success');
		redirect($this->service_name, 'refresh');
	}

	public function action_remove($type = null, $id = null)
	{
		if (is_null($type) || is_null($id)) {
			show_404();
		}

		$this->base_model->action_remove($this->service_name, $type, $id);

		$msg = "Data $this->service_name berhasil di " . ($type == 'delete' ? 'hapus' : ($type == 'active' ? 'Aktifkan' : 'nonaktifkan'));
		set_toasts($msg, 'success');

		redirect("$this->service_name/" . ($type == 'active' ? 'nonactive' : ''), 'refresh');
	}
}
