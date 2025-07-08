<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function is_logged_in() {
    $CI =& get_instance();
    return $CI->session->userdata('user_id') !== NULL;
}

function require_login() {
    if (!is_logged_in()) {
        redirect('auth/login');
    }
}
