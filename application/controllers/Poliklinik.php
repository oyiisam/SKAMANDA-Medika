<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Poliklinik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (is_user() || is_tf() || is_lk() || is_mm() || is_dokter()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Poliklinik | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'poliklinik/data', $data);
    }

    public function getData()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'poliklinik'; // Ganti dengan nama tabel yang sesuai

        // Cek jika tabel ada
        if (!$this->db->table_exists($nama_tabel)) {
            // Kirim pesan error jika tabel tidak ada
            echo json_encode(['error' => 'Tabel tidak ditemukan. Silahkan hubungi Admin!']);
            return;
        }

        // Ambil data dari tabel
        $data = $this->admin->getData($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['edit_url'] = base_url('poliklinik/edit/') . $item['id_poliklinik']; // URL untuk edit
            $item['delete_url'] = base_url('poliklinik/delete/') . $item['id_poliklinik']; // URL untuk delete
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_poliklinik', 'Nama Poliklinik', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('keterangan_poliklinik', 'Keterangan', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Poliklinik | #SKAMANDA Medika";
            $this->template->load('template/dashboard', 'poliklinik/add', $data);
        } else {
            $input = $this->input->post(null, true); // Tangkap seluruh input form
            $insert = $this->admin->insert('poliklinik', $input); // Insert data ke database
            if ($insert) {
                set_pesan('Data berhasil disimpan.');
                redirect('poliklinik');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('poliklinik/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Poliklinik | #SKAMANDA Medika";
            $data['poliklinik'] = $this->admin->get('poliklinik', ['id_poliklinik' => $id]);
            $this->template->load('template/dashboard', 'poliklinik/edit', $data); // Arahkan ke view edit dengan data yang didapatkan
        } else {
            $input = $this->input->post(null, true); // Tangkap seluruh input form
            $update = $this->admin->update('poliklinik', 'id_poliklinik', $id, $input); // Lakukan update data poliklinik berdasarkan ID
            if ($update) {
                set_pesan('Data berhasil disimpan.');
                redirect('poliklinik');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('poliklinik/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('poliklinik', 'id_poliklinik', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('poliklinik');
    }
}
