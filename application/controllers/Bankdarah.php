<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bankdarah extends CI_Controller
{

	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = "bank_darah";
		$this->load->model('bank_darah_model');
		authorize_user(['admin', 'perawat', 'viewer']);
	}

	public function index()
	{
		$result_model = $this->bank_darah_model->get_all($this->service_name);
		$this->_show($result_model);
	}

	// public function nonactive()
	// {
	// 	$result_model = $this->base_model->get_all($this->service_name, FALSE);
	// 	$this->_show(FALSE, $result_model);
	// }

	private function _show(array $result_model)
	{
		$data['title']        	= "Informasi Bank Darah";
		$data['page_title']   	= "halaman informai Bank Darah";
		$data['data_result']    = $result_model;
		$this->load->view("bank_darah/index", $data);
	}

	public function detail()
	{
		$data['title']        	= "Informasi Bank Darah";
		$data['page_title']   	= "halaman informai Detail Bank Darah";
		$data['data_result']    = $this->bank_darah_model->get_detail_stok($this->service_name);
		$data['total_darah']    = $this->bank_darah_model->get_total_darah($this->service_name);
		$this->load->view("bank_darah/detail", $data);
	}


	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$data = [
			'kode_bank_darah' => trim($this->input->post('kode_bank_darah')),
			'nama_bank_darah' => trim($this->input->post('nama_bank_darah')),
		];

		$this->base_model->insert($this->service_name, $data);
		set_toasts("Data $this->service_name berhasil disimpan.", 'success');

		redirect($this->service_name, 'refresh');
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$id = $this->input->post('id_bank_darah');
		$nik = trim($this->input->post('nik'));

		$data = [
			'kode_bank_darah' => trim($this->input->post('kode_bank_darah')),
			'nama_bank_darah' => trim($this->input->post('nama_bank_darah')),
		];

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
