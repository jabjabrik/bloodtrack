<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Darah extends CI_Controller
{

	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = "darah";
		$this->load->model('base_model');
		is_logged_in();
		authorize();
	}

	public function index()
	{
		$result_model = $this->base_model->get_all($this->service_name, TRUE);
		$this->_show(TRUE, $result_model);
	}

	private function _show(bool $is_active, array $result_model)
	{
		$data['title']        	= "Kelola " . ucfirst($this->service_name);
		$data['page_title']   	= "halaman manajemen $this->service_name";
		$data['service_name'] 	= $this->service_name;
		$data['is_active_page'] = $is_active;
		$data['kode_darah']    = mt_rand(100000, 999999) . '-KDDRH';
		$data['data_result']    = $result_model;

		$this->load->view("darah/index", $data);
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$id = $this->input->post('id_darah');

		$data = [
			'stok_minimal' => trim($this->input->post('stok_minimal', true)),
			'stok_maksimal' => trim($this->input->post('stok_maksimal', true)),
			'harga_beli' => trim($this->input->post('harga_beli', true)),
			'harga_jual' => trim($this->input->post('harga_jual', true)),
		];

		$this->base_model->update($this->service_name, $data, $id);
		set_toasts("Data $this->service_name berhasil diedit.", 'success');
		redirect($this->service_name, 'refresh');
	}
}
