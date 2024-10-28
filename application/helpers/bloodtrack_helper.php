<?php

function is_logged_in()
{
    $CI = &get_instance();
    if (!$CI->session->userdata('is_login')) {
        redirect();
    }
}

function authorize($_role = 'admin')
{
    $CI = &get_instance();
    $role = $CI->session->userdata('role');
    if ($role !=  $_role  && !($role == 'admin')) redirect('dashboard');
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
