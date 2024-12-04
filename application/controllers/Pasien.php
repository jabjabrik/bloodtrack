<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pasien extends CI_Controller
{

	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = "pasien";
		$this->load->model('base_model');
		// $this->load->model('pasien_model');
		is_logged_in();
		authorize();
	}

	public function index()
	{
		$result_model = $this->base_model->get_all($this->service_name, TRUE);
		$this->_show(TRUE, $result_model);
	}

	public function nonactive()
	{
		$result_model = $this->base_model->get_all($this->service_name, FALSE);
		$this->_show(FALSE, $result_model);
	}

	private function _show(bool $is_active, array $result_model)
	{
		$data['title']        	= "Kelola " . ucfirst($this->service_name);
		$data['page_title']   	= $is_active ? "halaman manajemen $this->service_name Aktif" : "halaman $this->service_name tidak aktif";
		$data['service_name'] 	= $this->service_name;
		$data['is_active_page'] = $is_active;
		$data['kode_pasien']    = mt_rand(100000, 999999) . '-KDPSN';
		$data['data_result']    = $result_model;

		$this->load->view("pasien/index", $data);
	}

	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$nik = trim($this->input->post('nik'));

		$data = [
			'kode_pasien' => trim($this->input->post('kode_pasien')),
			'nik' => $nik,
			'nama_pasien' => trim($this->input->post('nama_pasien')),
			'golongan_darah' => trim($this->input->post('golongan_darah')),
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

		$id = $this->input->post('id_pasien');
		$nik = trim($this->input->post('nik'));

		$data = [
			'kode_pasien' => trim($this->input->post('kode_pasien')),
			'nik' => $nik,
			'nama_pasien' => trim($this->input->post('nama_pasien')),
			'golongan_darah' => trim($this->input->post('golongan_darah')),
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
