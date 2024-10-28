<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$is_login = $this->session->userdata('is_login');
		if ($is_login) redirect('dashboard');

		$this->form_validation->set_rules('username', 'Username', 'trim|callback_validate_username');
		$this->form_validation->set_rules('password', 'Password', 'trim|callback_validate_password');

		if ($this->form_validation->run() == false) {
			$data['title'] = 'Login';
			$this->load->view('auth/login', $data);
		} else {
			$username = $this->input->post('username');
			$this->_login($username);
		}
	}

	public function validate_username($username)
	{
		if (empty($username)) {
			$this->form_validation->set_message('validate_username', 'Silahkan masukan username');
			return FALSE;
		}

		$this->db->where('username', $username);
		$query = $this->db->get('user');

		if ($query->num_rows() === 0) {
			$this->form_validation->set_message('validate_username', 'Username tidak ditemukan');
			return FALSE;
		}
		return TRUE;
	}

	public function validate_password($password)
	{
		if (empty($password)) {
			$this->form_validation->set_message('validate_password', 'Silahkan masukan password');
			return FALSE;
		}

		$username = $this->input->post('username');
		$this->db->where('username', $username);
		$query = $this->db->get('user');

		if ($query->num_rows() == 0) {
			$this->form_validation->set_message('validate_password', '');
			return FALSE;
		}

		$user = $query->row();

		if (password_verify($password, $user->password)) {
			return TRUE;
		} else {
			$this->form_validation->set_message('validate_password', 'Password salah');
			return FALSE;
		}
	}

	private function _login($username)
	{
		$user = $this->db->get_where('user', ["username" => $username])->row();

		$data = [
			'is_login'  => TRUE,
			'username'  => $user->username,
			'id_user'   => $user->id_user,
			'role'      => $user->role,
			'nama'      => $user->nama,
		];

		$this->session->set_userdata($data);
		redirect('dashboard');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil logout!</div>');
		redirect();
	}
}
