<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        authorize_user(['admin', 'perawat', 'viewer']);
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->load->model('base_model');
        $data['total_petugas'] = count($this->base_model->get_all('petugas', true));
        $data['total_dokter'] = count($this->base_model->get_all('dokter', true));
        $data['total_pasien'] = count($this->base_model->get_all('pasien', true));
        $data['total_penerima'] = count($this->base_model->get_all('penerima', true));
        $data['total_darah'] = count($this->base_model->get_all('darah', true));
        $data['total_pmi'] = count($this->base_model->get_all('pmi', true));
        $this->load->view('dashboard/index', $data);
    }
}
