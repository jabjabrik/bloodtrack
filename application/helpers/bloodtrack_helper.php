<?php

function is_logged_in()
{
    $CI = &get_instance();
    if (!$CI->session->userdata('is_login')) {
        redirect();
    }
}

function authorize($_role = 'administrator')
{
    $CI = &get_instance();
    $jabatan = $CI->session->userdata('jabatan');
    if ($jabatan !=  $jabatan  && !($jabatan == 'admin')) redirect('dashboard');
}

function dd($data)
{
    var_dump($data);
    die();
}

function set_alert($message, $color)
{
    $CI = get_instance();
    $params = array(
        'message' => $message,
        'color' => $color
    );
    $CI->session->set_flashdata('alert', $params);
}

function set_toasts($message, $color)
{
    $CI = get_instance();
    $params = array(
        'message' => $message,
        'color' => $color
    );
    $CI->session->set_flashdata('toasts', $params);
}

function calculateAge($birthDate)
{

    $birthDate = new DateTime($birthDate);
    $currentDate = new DateTime();
    return $currentDate->diff($birthDate)->y;
}

// // Contoh penggunaan
// $birthDate = "1990-09-25";
// $age = calculateAge($birthDate);
// echo "Umur: {$age['years']} tahun, {$age['months']} bulan, {$age['days']} hari";
// // Output: Umur: xx tahun, xx bulan, xx hari (bergantung pada tanggal hari ini)
