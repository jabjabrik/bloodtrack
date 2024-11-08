<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pmi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		authorize();
		$this->load->model('pmi_model');
	}

	public function index()
	{
		$result = $this->pmi_model->get_all_pmi();

		if (!$result['status']) {
			set_toasts($result['message'], 'danger');
		}

		$data['title']  = 'Kelola PMI';
		$data['pmi'] = $result['data'] ?? [];

		$this->load->view('pmi/index', $data);
	}
	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect('pmi');
			return;
		}

		$data = [
			'nama_pmi' => trim($this->input->post('nama_pmi')),
			'contact_person' => trim($this->input->post('contact_person')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$result = $this->pmi_model->insert_pmi($data);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("pmi", 'refresh');
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect('pemilihan');
			return;
		}

		$id_pmi = $this->input->post('id_pmi');

		$data = [
			'nama_pmi' => trim($this->input->post('nama_pmi')),
			'contact_person' => trim($this->input->post('contact_person')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$result = $this->pmi_model->update_pmi($id_pmi, $data);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("pmi", 'refresh');
	}

	public function delete($id_pmi = null)
	{
		if (is_null($id_pmi)) {
			show_404();
		}

		$result = $this->pmi_model->delete_pmi($id_pmi);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("pmi", 'refresh');
	}
}
