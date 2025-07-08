<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('is_logged_in')) {
    function is_logged_in() {
        $CI =& get_instance();
        return $CI->session->userdata('user_id') ? true : false;
    }
}

if (!function_exists('require_login')) {
    function require_login() {
        if (!is_logged_in()) {
            $CI =& get_instance();
            $CI->session->set_flashdata('error', 'Anda harus login terlebih dahulu.');
            redirect(base_url('index.php/auth/login'));
            exit();
        }
    }
}

if (!function_exists('is_admin')) {
    function is_admin() {
        $CI =& get_instance();
        return $CI->session->userdata('role') === 'admin';
    }
}

if (!function_exists('require_admin')) {
    function require_admin() {
        if (!is_admin()) {
            $CI =& get_instance();
            $CI->session->set_flashdata('error', 'Anda tidak memiliki hak akses admin.');
            redirect(base_url('index.php/users/dashboard_user'));
            exit();
        }
    }
}
