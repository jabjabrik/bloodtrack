<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Darah extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		authorize();
	}

	public function index()
	{
		// $data['user'] = $this->db->get('user')->result();
		$data['title'] = 'Kelola Darah';
		$this->load->view('darah/index', $data);
	}
}
