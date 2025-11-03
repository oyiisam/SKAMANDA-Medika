<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi extends CI_Controller
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
        $data['title'] = "Lokasi Barang | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'lokasi/data', $data);
    }

    public function getData()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'lokasi'; // Ganti dengan nama tabel yang sesuai

        // Cek jika tabel ada
        if (!$this->db->table_exists($nama_tabel)) {
            // Kirim pesan error jika tabel tidak ada
            echo json_encode(['error' => 'Tabel tidak ditemukan. Silahkan hubungi Admin!']);
            return;
        }

        // Tambahkan kondisi berdasarkan peran
        if (is_admin()) {
            // Admin melihat semua data, tidak ada filter tambahan
        } elseif (is_tf()) {
            $this->db->where('tempat_lokasi', 'Teknologi Farmasi');
        } elseif (is_lk()) {
            $this->db->where('tempat_lokasi', 'Layanan Kesehatan');
        } elseif (is_mm()) {
            $this->db->where('tempat_lokasi', 'Multimedia');
        } elseif (is_klinik()) {
            $this->db->where('tempat_lokasi', 'Klinik');
        }

        // Tambahkan kondisi ORDER BY di controller sebelum mengambil data
        $this->db->order_by('tempat_lokasi', 'ASC'); // Sesuaikan nama kolom dan arah urutan (ASC atau DESC)
        $this->db->order_by('nama_lokasi', 'ASC'); // Sesuaikan nama kolom dan arah urutan (ASC atau DESC)

        // Ambil data dari tabel
        $data = $this->admin->getData($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['edit_url'] = base_url('lokasi/edit/') . $item['id_lokasi']; // URL untuk edit
            $item['delete_url'] = base_url('lokasi/delete/') . $item['id_lokasi']; // URL untuk delete
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    private function _validasi($mode)
    {
        $this->form_validation->set_rules(
            'tempat_lokasi', // Nama field dari form
            'Ruangan', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Ruangan wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'kode_lokasi', // Nama field dari form
            'Kode', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Kode lokasi wajib diisi.'
            )
        );
        if ($mode == 'add') {
            $this->form_validation->set_rules(
                'nama_lokasi', // Nama field dari form
                'Lokasi', // Nama label untuk field
                'required|trim|is_unique[lokasi.nama_lokasi]', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Lokasi barang wajib diisi.',
                    'is_unique' => '*Lokasi barang sudah ada.' // Pesan error jika data tidak unik
                )
            );
        } else {
            $this->form_validation->set_rules(
                'nama_lokasi', // Nama field dari form
                'Lokasi', // Nama label untuk field
                'required|trim', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Lokasi barang wajib diisi.',
                )
            );
        }
    }

    public function add()
    {
        $this->_validasi('add');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Lokasi Barang | #SKAMANDA Medika";
            $this->template->load('template/dashboard', 'lokasi/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $insert = $this->admin->insert('lokasi', $input);
            if ($insert) {
                set_pesan('Data berhasil disimpan.');
                redirect('lokasi');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('lokasi/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Lokasi Barang | #SKAMANDA Medika";
            $data['lokasi'] = $this->admin->get('lokasi', ['id_lokasi' => $id]);
            $this->template->load('template/dashboard', 'lokasi/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('lokasi', 'id_lokasi', $id, $input);
            if ($update) {
                set_pesan('Data berhasil disimpan.');
                redirect('lokasi');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('lokasi/edit');
            }
        }
    }

    public function delete($getId)
    {
        if (!is_admin()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('lokasi');
        }

        $id = encode_php_tags($getId);
        if ($this->admin->delete('lokasi', 'id_lokasi', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('lokasi');
    }
}
