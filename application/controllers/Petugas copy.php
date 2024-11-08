<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		authorize();
		$this->load->model('base_model');
	}

	public function index()
	{
		$data['petugas'] = $this->base_model->get_all('petugas');
		dd($data);
		$data['title'] = 'Kelola Petugas';
		// dd($data);
		$this->load->view('petugas/index', $data);
	}

	public function delete($id_user)
	{
		$this->db->where('id_user', $id_user);
		$result = $this->db->delete('user');

		if ($this->db->affected_rows() > 0) {
			set_toasts('User  Berhasil di Hapus', 'success');
		} else {
			$error = $this->db->error();
			if ($error['code'] == 1451) {
				set_toasts('User gagal dihapus karena memiliki riwayat transaksi', 'danger');
			} else {
				set_toasts('User Gagal di Hapus', 'danger');
			}
		}
		redirect("user");
	}

	public function create()
	{
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if (strlen($username) < 5) {
			set_toasts('Username harus minimal 8 karakter.', 'danger');
			redirect('user');
			return;
		}

		if (strlen($password) < 8) {
			set_toasts('Password harus minimal 8 karakter.', 'danger');
			redirect('user');
			return;
		}

		$hashed_password = password_hash($password, PASSWORD_DEFAULT);

		$data = array(
			'nama' => $nama,
			'username' => $username,
			'password' => $hashed_password,
		);



		$is_exist_username = $this->db->get_where('user', array('username' => $username))->num_rows() > 0;
		if ($is_exist_username) {
			set_toasts("Username '$username' telah terpakai, Mohon inputkan username baru.", 'danger');
		} else {
			$result = $this->db->insert('user', $data);
			if ($result) {
				set_toasts('Berhasil Menambahkan User baru', 'success');
			} else {
				set_toasts('Gagal Menambahkan User baru', 'danger');
			}
		}

		redirect('user');
	}

	public function edit()
	{
		$id_petugas = $this->input->post('id_petugas');
		$nama_petugas = $this->input->post('nama_petugas');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if (strlen($username) < 5) {
			set_toasts('Username harus minimal 8 karakter.', 'danger');
			redirect('user');
			return;
		}


		$data = array(
			'nama' => $nama,
			'username' => $username,
		);

		if (!empty($password)) {
			if (strlen($password) < 8) {
				set_toasts('Password harus minimal 8 karakter.', 'danger');
				redirect('user');
				return;
			} else {
				$data['password'] = password_hash($password, PASSWORD_DEFAULT);
			}
		}

		$is_exist_username = $this->db->get_where('user', array('username' => $username))->num_rows() > 0;
		$is_current_username = $this->db->get_where('user', array('id_user' => $id_user))->row('username') == $username;

		if ($is_exist_username && !$is_current_username) {
			set_toasts("Username '$username' telah terpakai, Mohon gunakan username baru.", 'danger');
		} else {
			$this->db->where('id_user', $id_user);
			$result = $this->db->update('user', $data);

			if ($result) {
				set_toasts('User Berhasil di Update', 'success');
			} else {
				set_toasts('User Gagal di Update', 'danger');
			}
		}

		redirect('user');
	}
}
