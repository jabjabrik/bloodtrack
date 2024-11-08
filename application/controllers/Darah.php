<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Darah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		authorize();
		$this->load->model('darah_model');
	}

	public function index()
	{
		$result = $this->darah_model->get_all_darah();

		if (!$result['status']) {
			set_toasts($result['message'], 'danger');
		}

		$data['title']  = 'Kelola Darah';
		$data['darah'] = $result['data'] ?? [];

		$this->load->view('darah/index', $data);
	}
	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect('darah');
			return;
		}

		$data = [
			'rekam_medis' => trim($this->input->post('rekam_medis')),
			'nik' => trim($this->input->post('nik')),
			'nama_darah' => trim($this->input->post('nama_darah')),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_telepon' => trim($this->input->post('no_telepon')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$result = $this->darah_model->insert_darah($data);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("darah", 'refresh');
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect('pemilihan');
			return;
		}

		$id_darah = $this->input->post('id_darah');

		$data = [
			'rekam_medis' => trim($this->input->post('rekam_medis')),
			'nik' => trim($this->input->post('nik')),
			'nama_darah' => trim($this->input->post('nama_darah')),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_telepon' => trim($this->input->post('no_telepon')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$result = $this->darah_model->update_darah($id_darah, $data);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("darah", 'refresh');
	}

	public function delete($id_darah = null)
	{
		if (is_null($id_darah)) {
			show_404();
		}

		$result = $this->darah_model->delete_darah($id_darah);

		if ($result['status']) {
			set_toasts($result['message'], 'success');
		} else {
			set_toasts($result['message'], 'danger');
		}

		redirect("darah", 'refresh');
	}
}
