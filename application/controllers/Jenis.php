<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (is_user()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Jenis Barang | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'jenis/data', $data);
    }

    public function getData()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'jenis'; // Ganti dengan nama tabel yang sesuai

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
            $item['edit_url'] = base_url('jenis/edit/') . $item['id_jenis']; // URL untuk edit
            $item['delete_url'] = base_url('jenis/delete/') . $item['id_jenis']; // URL untuk delete
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    private function _validasi($mode)
    {
        if ($mode == 'add') {
            $this->form_validation->set_rules(
                'nama_jenis', // Nama field dari form
                'Jenis', // Nama label untuk field
                'required|trim|is_unique[jenis.nama_jenis]', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Jenis barang wajib diisi.',
                    'is_unique' => '*Jenis barang sudah ada.' // Pesan error jika data tidak unik
                )
            );
        } else {
            $this->form_validation->set_rules(
                'nama_jenis', // Nama field dari form
                'Jenis', // Nama label untuk field
                'required|trim', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Jenis barang wajib diisi.',
                )
            );
        }
    }

    public function add()
    {
        $this->_validasi('add');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis Barang | #SKAMANDA Medika";
            $this->template->load('template/dashboard', 'jenis/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('jenis', $input);
            if ($insert) {
                set_pesan('Data berhasil disimpan.');
                redirect('jenis');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('jenis/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Jenis Barang | #SKAMANDA Medika";
            $data['jenis'] = $this->admin->get('jenis', ['id_jenis' => $id]);
            $this->template->load('template/dashboard', 'jenis/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('jenis', 'id_jenis', $id, $input);
            if ($update) {
                set_pesan('Data berhasil disimpan.');
                redirect('jenis');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('jenis/edit');
            }
        }
    }

    public function delete($getId)
    {
        if (!is_admin()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('jenis');
        }

        $id = encode_php_tags($getId);
        if ($this->admin->delete('jenis', 'id_jenis', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('jenis');
    }
}
