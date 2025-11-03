<?php

function cek_login()
{
    $ci = get_instance();
    if (!$ci->session->has_userdata('login_session')) {
        set_pesan('Silahkan login!');
        redirect('AppReady');
    }
}

function is_user()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'user') {
        $status = false;
    }

    return $status;
}

function is_admin()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'admin') {
        $status = false;
    }

    return $status;
}

function is_dokter()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'dokter') {
        $status = false;
    }

    return $status;
}

function is_klinik()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'klinik') {
        $status = false;
    }

    return $status;
}

function is_tf()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'teknologi farmasi') {
        $status = false;
    }

    return $status;
}

function is_lk()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'layanan kesehatan') {
        $status = false;
    }

    return $status;
}

function is_mm()
{
    $ci = get_instance();
    $role = $ci->session->userdata('login_session')['role'];

    $status = true;

    if ($role != 'multimedia') {
        $status = false;
    }

    return $status;
}

function set_pesan($pesan, $tipe = true)
{
    $ci = get_instance();
    $alert_class = $tipe ? 'alert-success' : 'alert-danger';
    $icon = $tipe ? '✓' : '✗'; // Simbol untuk sukses dan error
    $alert_html = "
        <div class='alert $alert_class alert-dismissible fade show' role='alert'>
            <strong>{$icon}</strong> {$pesan}
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";

    $ci->session->set_flashdata('pesan', $alert_html);
}


function set_audio($tipe = true)
{
    $ci = get_instance();
    if ($tipe) {
        $ci->session->set_flashdata('audio', "<audio src='" . base_url('assets/') . 'iphone_tri_tone.mp3' . "' autoplay></audio>");
    } else {
        $ci->session->set_flashdata('audio', "<audio src='" . base_url('assets/') . 'windows_10_notify.mp3' . "' autoplay></audio>");
    }
}

function userdata($field)
{
    $ci = get_instance();
    $ci->load->model('Admin_model', 'admin');

    $userId = $ci->session->userdata('login_session')['user'];
    return $ci->admin->get('user', ['id_user' => $userId])[$field];
}

function output_json($data)
{
    $ci = get_instance();
    $data = json_encode($data);
    $ci->output->set_content_type('application/json')->set_output($data);
}
