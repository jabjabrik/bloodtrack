<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kurir extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		authorize();
		$this->load->model('kurir_model');
	}

	public function index()
	{
		$result = $this->kurir_model->get_all_kurir();

		if (!$result['status']) {
			set_toasts($result['message'], 'danger');
		}

		$data['title']  = 'Kelola Kurir';
		$data['kurir'] = $result['data'] ?? [];

		$this->load->view('kurir/index', $data);
	}
	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect('kurir');
			return;
		}

		$data = [
			'nama_kurir' => trim($this->input->post('nama_kurir')),
		];

		$result = $this->kurir_model->insert_kurir($data);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("kurir", 'refresh');
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect('pemilihan');
			return;
		}

		$id_kurir = $this->input->post('id_kurir');

		$data = [
			'nama_kurir' => trim($this->input->post('nama_kurir')),
		];

		$result = $this->kurir_model->update_kurir($id_kurir, $data);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("kurir", 'refresh');
	}

	public function delete($id_kurir = null)
	{
		if (is_null($id_kurir)) {
			show_404();
		}

		$result = $this->kurir_model->delete_kurir($id_kurir);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("kurir", 'refresh');
	}
}
