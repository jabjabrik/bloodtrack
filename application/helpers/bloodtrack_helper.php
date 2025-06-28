<?php

function authorize_user($_jabatan)
{
    $CI = &get_instance();
    $jabatan = $CI->session->userdata('jabatan');

    if (!$jabatan) redirect('auth');

    if (!in_array($jabatan, $_jabatan)) {
        redirect('dashboard');
    }
    return true;
}

function dd($data)
{
    var_dump($data);
    die();
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
