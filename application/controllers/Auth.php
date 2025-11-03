<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Auth_model', 'auth');
        $this->load->model('Admin_model', 'admin');
    }

    private function _has_login()
    {
        if ($this->session->has_userdata('login_session')) {
            redirect('dashboard');
        }
    }

    public function index()
    {
        $this->_has_login();

        $this->form_validation->set_rules(
            'username', // Nama field dari form
            'Username', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Username wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'password', // Nama field dari form
            'Password', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Password wajib diisi.'
            )
        );

        if ($this->form_validation->run() == false) {
            $data['title'] = "#SKAMANDA Medika | Login";
            $this->template->load('template/auth', 'auth/login', $data);
        } else {
            $input = $this->input->post(null, true);
            $cek_username = $this->auth->cek_username($input['username']);
            if ($cek_username > 0) {
                $password = $this->auth->get_password($input['username']);
                if (password_verify($input['password'], $password)) {
                    $user_db = $this->auth->userdata($input['username']);
                    if ($user_db['is_active'] != 1) {
                        set_pesan('Akun anda belum aktif. Silahkan menghubungi admin!', false);
                        redirect('AppReady');
                    } else {
                        $userdata = [
                            'user'       => $user_db['id_user'],
                            'role'       => $user_db['role'],
                        ];
                        $this->session->set_userdata('login_session', $userdata);
                        redirect('dashboard');
                    }
                } else {
                    set_pesan('Password salah', false);
                    redirect('AppReady');
                }
            } else {
                set_pesan('Username belum terdaftar', false);
                redirect('AppReady');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('login_session');

        set_pesan('Anda berhasil logout.');
        redirect('AppReady');
    }

    public function register()
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);

        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'required' => '*{field} harus diisi.',
            'is_unique' => '*Username ini sudah digunakan, silakan gunakan yang lain.',
            'trim' => ''
        ]);

        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]|trim', [
            'required' => '*{field} harus diisi.',
            'min_length' => '*{field} minimal 5 karakter.',
            'trim' => ''
        ]);

        $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim', [
            'matches' => '*Password tidak valid.',
            'trim' => ''
        ]);

        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric', [
            'required' => '*{field} harus diisi.',
            'trim' => '',
            'numeric' => '*{field} harus berupa angka.'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "#SKAMANDA Medika | Register";
            $this->template->load('template/auth', 'auth/register', $data);
        } else {
            $input = $this->input->post(null, true);
            // jika password2 ditulis setelah password maka yang diinputkan hash-nya
            $input['password2']     = $input['password'];
            $input['password']      = password_hash($input['password'], PASSWORD_DEFAULT);
            $input['no_telp']       = '+62' . $input['no_telp'];
            $input['role']          = 'user';
            $input['foto']          = 'default.png';
            $input['is_active']     = '0';
            $query = $this->admin->insert('user', $input);
            if ($query) {
                set_pesan('Pendaftaran berhasil. Silahkan menghubungi Admin untuk aktivasi akun Anda!');
                redirect('AppReady');
            } else {
                set_pesan('Gagal menyimpan ke database', false);
                redirect('register');
            }
        }
    }
}
