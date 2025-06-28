<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH . 'third_party/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

class Dompdf_lib extends Dompdf
{
    public function __construct()
    {
        parent::__construct();
    }
}
