<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{

	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = "petugas";
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
		$data['title']        	= "Kelola " . ucfirst($this->service_name);
		$data['page_title']   	= $is_active ? "halaman manajemen $this->service_name Aktif" : "halaman $this->service_name tidak aktif";
		$data['service_name'] 	= $this->service_name;
		$data['is_active_page'] = $is_active;
		$data['kode_petugas']    = 'KDPTGS-' . $this->base_model->generate_kode('petugas');
		$data['data_result']    = $result_model;

		$this->load->view("petugas/index", $data);
	}

	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if (strlen($username) < 5) {
			set_toasts('Username harus minimal 5 karakter.', 'danger');
			redirect($this->service_name, 'refresh');
		}

		if (strlen($password) < 8) {
			set_toasts('Password harus minimal 8 karakter.', 'danger');
			redirect($this->service_name, 'refresh');
		}

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$data = [
			'kode_petugas' => $this->input->post('kode_petugas'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'username' => $username,
			'password' => $hashed_password,
			'jabatan' => $this->input->post('jabatan'),
		];

		$is_exist_username = count($this->base_model->get_data_by($this->service_name, 'username', $username))  > 0;

		if ($is_exist_username) {
			set_toasts("Username dengan nilai ($username) telah digunakan.", 'danger');
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

		$id = $this->input->post('id_petugas');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if (strlen($username) < 5) {
			set_toasts('Username harus minimal 8 karakter.', 'danger');
			redirect($this->service_name, 'refresh');
		}

		$data = [
			'kode_petugas' => $this->input->post('kode_petugas'),
			'nama_petugas' => $this->input->post('nama_petugas'),
			'username' => $username,
			'jabatan' => $this->input->post('jabatan'),
		];

		if (!empty($password)) {
			if (strlen($password) < 8) {
				set_toasts('Password harus minimal 8 karakter.', 'danger');
				redirect($this->service_name, 'refresh');
			}
			$data['password'] = password_hash($password, PASSWORD_DEFAULT);
		}

		$is_exist_username = count($this->base_model->get_data_by($this->service_name, 'username', $username)) > 0;
		$is_current_username = $this->base_model->get_data_by($this->service_name, "id_$this->service_name", $id)[0]->username == $username;

		if ($is_exist_username && !$is_current_username) {
			set_toasts("Username dengan nilai ($username) telah digunakan.", 'danger');
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
