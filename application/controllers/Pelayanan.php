<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelayanan extends CI_Controller
{
	private $service_name;

	public function __construct()
	{
		parent::__construct();
		$this->service_name = 'pelayanan';
		$this->load->model('base_model');
		$this->load->model('pelayanan_model');
		$this->load->library('Dompdf_lib');
		authorize_user(['admin', 'perawat', 'viewer']);
	}

	public function index()
	{
		$data['title']        	= 'Pelayanan';
		$data['data_result']    = $this->base_model->get_all('pasien', TRUE);
		$this->load->view("pelayanan/index", $data);
	}

	public function pelayanan($id_pasien = null)
	{
		if (is_null($id_pasien)) show_404();

		$pasien = $this->base_model->get_data_by('pasien', 'id_pasien', $id_pasien);

		if (empty($pasien)) show_404();

		$data['title']        	= 'Pelayanan';
		$data['pasien']         = $pasien[0];
		$data['rekam_medis']    = 'RM-' . $this->base_model->generate_rm();
		$data['data_result']    = $this->pelayanan_model->get_pelayanan($id_pasien);
		$data['dokter']           = $this->base_model->get_all('dokter', true);
		$data['ruangan']           = $this->base_model->get_all('ruangan', true);
		$data['id_pasien']   	= $id_pasien;
		$data['jabatan'] = $this->session->userdata('jabatan');


		$this->load->view("pelayanan/pelayanan", $data);
	}

	public function pelayanan_insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}
		$id_pasien = trim($this->input->post('id_pasien', true));

		$data = [
			'rekam_medis' => trim($this->input->post('rekam_medis', true)),
			'id_pasien' => $id_pasien,
			'id_ruangan' => trim($this->input->post('id_ruangan', true)),
			'id_dokter' => trim($this->input->post('id_dokter', true)),
			'diagnosa' => trim($this->input->post('diagnosa', true)),
			'jumlah_darah' => trim($this->input->post('jumlah_darah', true)),
			'tanggal_pelayanan' => trim($this->input->post('tanggal_pelayanan', true)),
		];

		$this->base_model->insert($this->service_name, $data);
		set_toasts("Data $this->service_name berhasil disimpan.", 'success');

		redirect("$this->service_name/pelayanan/$id_pasien", 'refresh');
	}

	public function pelayanan_delete($id_pelayanan = null)
	{
		if (is_null($id_pelayanan)) {
			show_404();
		}

		$id_pasien = $this->base_model->get_data_by($this->service_name, 'id_pelayanan', $id_pelayanan)[0]->id_pasien;

		$is_exist_crossmatch = !empty($this->base_model->get_data_by('crossmatch', 'id_pelayanan', $id_pelayanan));

		$msg = "";
		$color = "";
		if ($is_exist_crossmatch) {
			$msg = "Data tidak dapat dihapus karna proses crossmatch telah dilakukan";
			$color = "danger";
		} else {
			$this->base_model->action_remove($this->service_name, 'delete', $id_pelayanan);
			$msg = "Data $this->service_name berhasil di hapus";
			$color = "success";
		}

		set_toasts($msg, $color);

		redirect("$this->service_name/pelayanan/$id_pasien", 'refresh');
	}

	public function crossmatch($id_pelayanan = null)
	{
		if (is_null($id_pelayanan)) show_404();

		$pelayanan = $this->base_model->get_data_by('pelayanan', 'id_pelayanan', $id_pelayanan);

		if (empty($pelayanan)) show_404();

		$pasien = $this->base_model->get_data_by('pasien', 'id_pasien', $pelayanan[0]->id_pasien);

		$data['title']        	= 'Pelayanan';
		$data['pasien']         = $pasien[0];
		$data['id_pasien']   	= $pasien[0]->id_pasien;
		$data['data_result']    = $this->pelayanan_model->get_crossmatch($id_pelayanan);
		$data['last_data'] = !empty($data['data_result']) ? $data['data_result'][array_key_last($data['data_result'])] : [];
		$data['darah_tersedia'] = $this->pelayanan_model->get_darah_tersedia($pasien[0]->golongan_darah);
		$data['stok_darah'] = $this->pelayanan_model->get_stok_darah($pasien[0]->golongan_darah);
		$data['total_stok_darah'] = $this->pelayanan_model->get_total_stok_darah($pasien[0]->golongan_darah);
		$data['id_pelayanan'] = $id_pelayanan;

		$total_biaya = 0;

		foreach ($data['data_result'] as $item) {
			$total_biaya = $total_biaya + $item->tarif;
		}

		$data['total_biaya'] = $total_biaya;

		$this->load->view("pelayanan/crossmatch", $data);
	}

	public function crossmatch_insert()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$id_pasien = trim($this->input->post('id_pasien', true));

		$id_pelayanan = trim($this->input->post('id_pelayanan', true));
		$id_penerimaan = trim($this->input->post('id_penerimaan', true));
		$mayor = trim($this->input->post('mayor', true));
		$minor = trim($this->input->post('minor', true));
		$autocontrol = trim($this->input->post('autocontrol', true));

		$hasil = $mayor == '-' && $minor == '-' && $autocontrol == '-' ? 'compatible' : 'incompatible';

		$data = [
			'id_pelayanan' => $id_pelayanan,
			'id_penerimaan' => $id_penerimaan,
			'mayor' => $mayor,
			'minor' => $minor,
			'autocontrol' => $autocontrol,
			'hasil' => $hasil,
		];

		$this->base_model->insert('crossmatch', $data);

		set_toasts("Data crossmatch berhasil disimpan.", 'success');

		redirect("$this->service_name/crossmatch/$id_pelayanan", 'refresh');
	}

	public function crossmatch_transfusi_retur($type, $id_crossmatch, $id_pelayanan, $id_penerimaan)
	{

		if (is_null($type) || is_null($id_crossmatch) || is_null($id_pelayanan)) show_404();

		$status;

		if ($type == 'transfusi') {
			$this->db->where("id_penerimaan", $id_penerimaan);
			$this->db->update('penerimaan', ['status' => '0']);
			$status = "transfusi";
		} else {
			$status = "retur";
		}

		$this->db->where("id_crossmatch", $id_crossmatch);
		$this->db->update('crossmatch', ['status' => $status]);

		set_toasts("Data crossmatch berhasil di $type.", 'success');

		redirect("$this->service_name/crossmatch/$id_pelayanan", 'refresh');
	}

	public function edit()
	{
		if ($this->input->server('REQUEST_METHOD') !== 'POST') {
			redirect($this->service_name, 'refresh');
		}

		$id = $this->input->post('id_pelayanan');
		$nik = trim($this->input->post('nik'));

		$data = [
			'rekam_medis' => trim($this->input->post('rekam_medis')),
			'nik' => $nik,
			'nama_pelayanan' => trim($this->input->post('nama_pelayanan')),
			'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			'tanggal_lahir' => $this->input->post('tanggal_lahir'),
			'no_telepon' => trim($this->input->post('no_telepon')),
			'alamat' => str_replace("\n", "\\n", trim($this->input->post('alamat'))),
		];

		$is_exist_nik = count($this->base_model->get_data_by($this->service_name, 'nik', $nik)) > 0;
		$is_current_nik = $this->base_model->get_data_by($this->service_name, "id_$this->service_name", $id)[0]->nik == $nik;

		if ($is_exist_nik && !$is_current_nik) {
			set_toasts("NIK dengan nilai ($nik) telah digunakan.", 'danger');
			redirect($this->service_name, 'refresh');
		}

		$this->base_model->update($this->service_name, $data, $id);
		set_toasts("Data $this->service_name berhasil diedit.", 'success');
		redirect($this->service_name, 'refresh');
	}

	public function report()
	{
		$id_pasien = $this->input->get('id_pasien');
		$tanggal = $this->input->get('tanggal');

		// Jika hanya tanggal yang diberikan (tanpa id_pasien), tampilkan semua pelayanan pada tanggal tsb
		if ($id_pasien === null && $tanggal !== null) {
			$data['data_result'] = $this->pelayanan_model->get_pelayanan_by_tanggal($tanggal);
		} else if ($id_pasien !== null) {
			$data['data_result'] = $this->pelayanan_model->get_pelayanan($id_pasien, $tanggal);
		} else {
			show_404();
		}
		$html = $this->load->view('pelayanan/report', $data, TRUE);
		$this->dompdf_lib->loadHtml($html);
		$this->dompdf_lib->setPaper('A4', 'landscape');
		$this->dompdf_lib->render();
		$this->dompdf_lib->stream("laporan-permintaan.pdf", array("Attachment" => 0));
	}
}
