<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $data['title'] = "User Management | #SKAMANDA Medika";
        if (is_admin()) {
            $data['users'] = $this->admin->getUsers(userdata('id_user'));
        }
        if (!is_admin()) {
            $data['users'] = $this->admin->getUsersSaja(userdata('id_user'));
        }
        $this->template->load('template/dashboard', 'user/data', $data);
    }

    private function _validasi($mode)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric', [
            'required' => '*{field} harus diisi.',
            'trim' => '',
            'numeric' => '*{field} harus berupa angka.'
        ]);
        if ($mode == 'add') {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
                'required' => '*{field} harus diisi.',
                'is_unique' => '*Username ini sudah digunakan, silakan pilih yang lain.',
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
            $this->form_validation->set_rules('role', 'Role', 'required|trim', [
                'required' => '*{field} harus diisi.',
                'trim' => '',
            ]);
        } else {
            $this->form_validation->set_rules('username', 'Username', 'required|trim', [
                'required' => '*{field} harus diisi.',
                'trim' => ''
            ]);
        }
    }

    public function add()
    {
        cek_login();
        if (!is_admin()) {
            redirect('dashboard');
        }

        $this->_validasi('add');

        if ($this->form_validation->run() == false) {
            $data['title'] = "User Management | #SKAMANDA Medika";
            $this->template->load('template/dashboard', 'user/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input_data = [
                'nama'                  => $input['nama'],
                'username'              => $input['username'],
                'password2'             => $input['password'],
                'password'              => password_hash($input['password'], PASSWORD_DEFAULT),
                'no_telp'               => '+62' . $input['no_telp'],
                'role'                  => $input['role'],
                'foto'                  => 'default.png',
                'is_active'             => '0',
            ];
            if ($this->admin->insert('user', $input_data)) {
                set_pesan('Data berhasil disimpan.');
                redirect('user');
            } else {
                set_pesan('Data gagal disimpan', false);
                redirect('user/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false) {
            $data['title'] = "User Management | #SKAMANDA Medika";
            $data['user'] = $this->admin->get('user', ['id_user' => $id]);
            $this->template->load('template/dashboard', 'user/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            if (is_admin()) {
                $input_data = [
                    'nama'              => $input['nama'],
                    'username'          => $input['username'],
                    'no_telp'           => '+62' . $input['no_telp'],
                    'role'              => $input['role'],
                    'password2'         => $input['password'],
                    'password'          => password_hash($input['password'], PASSWORD_DEFAULT),
                ];
            }
            if (!is_admin()) {
                $input_data = [
                    'nama'              => $input['nama'],
                    'username'          => $input['username'],
                    'no_telp'           => '+62' . $input['no_telp'],
                    'password2'         => $input['password'],
                    'password'          => password_hash($input['password'], PASSWORD_DEFAULT),
                ];
            }
            if ($this->admin->update('user', 'id_user', $id, $input_data)) {
                set_pesan('Data berhasil diubah.');
                redirect('user');
            } else {
                set_pesan('Data gagal diubah.', false);
                redirect('user/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        cek_login();
        if (!is_admin()) {
            redirect('dashboard');
        }

        $id = encode_php_tags($getId);

        // Cek apakah ID = 1 dan username = "M. Syamsu Hidayat"
        $user = $this->admin->get('user', ['id_user' => $id]);
        if ($id == 1 && ($user && $user['username'] == "M. Syamsu Hidayat, S.Pd")) {
            set_pesan('Data ini tidak dapat dihapus.', false);
            redirect('user');
            return;
        }

        if ($this->admin->delete('user', 'id_user', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('user');
    }


    public function toggle($getId)
    {
        cek_login();
        if (!is_admin()) {
            redirect('dashboard');
        }

        $id = encode_php_tags($getId);
        $status = $this->admin->get('user', ['id_user' => $id])['is_active'];
        $toggle = $status ? '0' : '1'; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
        $pesan = $toggle ? 'User diaktifkan.' : 'User dinonaktifkan.';
        if ($this->admin->update('user', 'id_user', $id, ['is_active' => $toggle])) {
            set_pesan($pesan);
        }
        redirect('user');
    }
}
