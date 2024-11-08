<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penerimaan extends CI_Controller
{

	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = "penerimaan";
		$this->load->model('base_model');
		$this->load->model('penerimaan_model');
		is_logged_in();
		authorize();
	}

	public function index()
	{
		$result_model = $this->penerimaan_model->get_all($this->service_name);
		$this->_show($result_model);
	}

	// public function nonactive()
	// {
	// 	$result_model = $this->base_model->get_all($this->service_name, FALSE);
	// 	$this->_show(FALSE, $result_model);
	// }

	private function _show(array $result_model)
	{
		$data['title']        	= "Penerimaan Darah";
		$data['page_title']   	= "Transaksi Data Penerimaan Darah";
		$data['service_name'] 	= $this->service_name;
		// $data['is_active_page'] = $is_active;
		$data['kode_penerimaan']    = mt_rand(100000, 999999) . '-KDPNRM';
		$data['data_result']    = $result_model;

		$this->load->view("penerimaan/index", $data);
	}

	public function insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$kode_darah = trim($this->input->post('kode_darah'));
		$kode_pmi = trim($this->input->post('kode_pmi'));
		$kode_kurir = trim($this->input->post('kode_kurir'));
		$kode_penerima = trim($this->input->post('kode_penerima'));

		$id_darah = $this->base_model->get_data_by('darah', 'kode_darah', $kode_darah)[0]->id_darah;
		$id_pmi = $this->base_model->get_data_by('pmi', 'kode_pmi', $kode_pmi)[0]->id_pmi;
		$id_kurir = $this->base_model->get_data_by('kurir', 'kode_kurir', $kode_kurir)[0]->id_kurir;
		$id_penerima = $this->base_model->get_data_by('penerima', 'kode_penerima', $kode_penerima)[0]->id_penerima;

		$data = [
			'kode_penerimaan' => trim($this->input->post('kode_penerimaan')),
			'no_kantong' => trim($this->input->post('no_kantong')),
			'jumlah_kantong' => trim($this->input->post('jumlah_kantong')),
			'tanggal_terima' => trim($this->input->post('tanggal_terima')),
			'tanggal_aftap' => trim($this->input->post('tanggal_aftap')),
			'tanggal_kadaluarsa' => trim($this->input->post('tanggal_kadaluarsa')),
			'id_darah' => $id_darah,
			'id_pmi' => $id_pmi,
			'id_kurir' => $id_kurir,
			'id_penerima' => $id_penerima,
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

		$id = $this->input->post('id_penerimaan');
		$nik = trim($this->input->post('nik'));

		$data = [
			'rekam_medis' => trim($this->input->post('rekam_medis')),
			'nik' => $nik,
			'nama_penerimaan' => trim($this->input->post('nama_penerimaan')),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_telepon' => trim($this->input->post('no_telepon')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$is_exist_nik = $this->base_model->get_data_by($this->service_name, 'nik', $nik)['data']->num_rows() > 0;

		if ($is_exist_nik && !$is_current_nik) {
			set_toasts("NIK dengan nilai ($nik) telah digunakan.", 'danger');
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
