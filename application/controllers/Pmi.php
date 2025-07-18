<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pmi extends CI_Controller
{

	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = "pmi";
		$this->load->model('base_model');
		authorize_user(['admin']);
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
		$data['title']        	= "Kelola " . strtoupper($this->service_name);
		$data['page_title']   	= $is_active ? "halaman manajemen " . strtoupper($this->service_name) . " Aktif" : "halaman " . strtoupper($this->service_name) . " tidak aktif";
		$data['service_name'] 	= $this->service_name;
		$data['is_active_page'] = $is_active;
		$data['kode_pmi']       = 'KDPMI-' . $this->base_model->generate_kode('pmi');
		$data['data_result']    = $result_model;

		$this->load->view("pmi/index", $data);
	}

	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$data = [
			'kode_pmi' => trim($this->input->post('kode_pmi')),
			'nama_pmi' => trim($this->input->post('nama_pmi')),
			'contact_person' => trim($this->input->post('contact_person')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
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

		$id = $this->input->post('id_pmi');

		$data = [
			'kode_pmi' => trim($this->input->post('kode_pmi')),
			'nama_pmi' => trim($this->input->post('nama_pmi')),
			'contact_person' => trim($this->input->post('contact_person')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
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
