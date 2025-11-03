<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dokter extends CI_Controller
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
        $data['title'] = "Data Dokter | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'dokter/data', $data);
    }

    public function getData()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'dokter'; // Ganti dengan nama tabel yang sesuai

        // Cek jika tabel ada
        if (!$this->db->table_exists($nama_tabel)) {
            // Kirim pesan error jika tabel tidak ada
            echo json_encode(['error' => 'Tabel tidak ditemukan. Silahkan hubungi Admin!']);
            return;
        }

        // Ambil data dari tabel
        $data = $this->admin->getDataDokter($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['edit_url'] = base_url('dokter/edit/') . $item['id_dokter']; // URL untuk edit
            $item['delete_url'] = base_url('dokter/delete/') . $item['id_dokter']; // URL untuk delete
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('user_id', 'Dokter', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('poliklinik_id', 'Poliklinik', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('spesialisasi', 'Spesialisasi', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Dokter | #SKAMANDA Medika";
            $data['user'] = $this->admin->get('user', null, ['role' => 'dokter']); // get(tabel, data, where)
            $data['poliklinik'] = $this->admin->get('poliklinik');
            $this->template->load('template/dashboard', 'dokter/add', $data);
        } else {
            $input = $this->input->post(null, true); // Tangkap seluruh input form
            $insert = $this->admin->insert('dokter', $input); // Insert data ke database
            if ($insert) {
                set_pesan('Data berhasil disimpan.');
                redirect('dokter');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('dokter/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Edit Data Dokter | #SKAMANDA Medika";
            $data['dokter'] = $this->admin->getDokter($id); // Data dokter berdasarkan ID
            $data['poliklinik'] = $this->admin->get('poliklinik'); // Data poliklinik
            $data['user'] = $this->admin->get('user', null, ['role' => 'dokter']); // Data user dengan role dokter

            $this->template->load('template/dashboard', 'dokter/edit', $data); // Arahkan ke view edit
        } else {
            $input = $this->input->post(null, true); // Tangkap input form
            $update = $this->admin->update('dokter', 'id_dokter', $id, $input); // Update data dokter berdasarkan ID
            if ($update) {
                set_pesan('Data berhasil diperbarui.');
                redirect('dokter');
            } else {
                set_pesan('Data gagal diperbarui.', false);
                redirect('dokter/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('dokter', 'id_dokter', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('dokter');
    }
}
