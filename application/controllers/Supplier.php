<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Supplier extends CI_Controller
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
        $data['title'] = "Supplier Barang | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'supplier/data', $data);
    }

    public function getData()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'supplier'; // Ganti dengan nama tabel yang sesuai

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
            $this->db->where('tempat_supplier', 'Teknologi Farmasi');
        } elseif (is_lk()) {
            $this->db->where('tempat_supplier', 'Layanan Kesehatan');
        } elseif (is_mm()) {
            $this->db->where('tempat_supplier', 'Multimedia');
        } elseif (is_klinik()) {
            $this->db->where('tempat_supplier', 'Klinik');
        }

        // Tambahkan kondisi ORDER BY di controller sebelum mengambil data
        $this->db->order_by('tempat_supplier', 'ASC'); // Sesuaikan nama kolom dan arah urutan (ASC atau DESC)
        $this->db->order_by('nama_supplier', 'ASC'); // Sesuaikan nama kolom dan arah urutan (ASC atau DESC)

        // Ambil data dari tabel
        $data = $this->admin->getData($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['edit_url'] = base_url('supplier/edit/') . $item['id_supplier']; // URL untuk edit
            $item['delete_url'] = base_url('supplier/delete/') . $item['id_supplier']; // URL untuk delete
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }
    private function _validasi($mode)
    {
        $this->form_validation->set_rules(
            'tempat_supplier', // Nama field dari form
            'Jurusan', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Jurusan wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'alamat_supplier', // Nama field dari form
            'Alamat', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Alamat supplier wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'nomor_supplier', // Nama field dari form
            'Nomor', // Nama label untuk field
            'required|trim|numeric', // Aturan validasi termasuk hanya angka
            array(
                'trim' => '',
                'required' => '*Nomor kontak supplier wajib diisi.',
                'numeric' => '*Nomor kontak hanya boleh berisi angka.' // Pesan error jika bukan angka
            )
        );
        if ($mode == 'add') {
            $this->form_validation->set_rules(
                'nama_supplier', // Nama field dari form
                'Supplier', // Nama label untuk field
                'required|trim|is_unique[supplier.nama_supplier]', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Supplier barang wajib diisi.',
                    'is_unique' => '*Supplier barang sudah ada.' // Pesan error jika data tidak unik
                )
            );
        } else {
            $this->form_validation->set_rules(
                'nama_supplier', // Nama field dari form
                'Supplier', // Nama label untuk field
                'required|trim', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Supplier barang wajib diisi.',
                )
            );
        }
    }

    public function add()
    {
        $this->_validasi('add');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Supplier Barang | #SKAMANDA Medika";
            $this->template->load('template/dashboard', 'supplier/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input_data = [
                'tempat_supplier'   => $input['tempat_supplier'],
                'nama_supplier'     => $input['nama_supplier'],
                'alamat_supplier'   => $input['alamat_supplier'],
                'nomor_supplier'    => '+62' . $input['nomor_supplier'],
            ];
            $insert = $this->admin->insert('supplier', $input_data);
            if ($insert) {
                set_pesan('Data berhasil disimpan.');
                redirect('supplier');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('supplier/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Supplier Barang | #SKAMANDA Medika";
            $data['supplier'] = $this->admin->get('supplier', ['id_supplier' => $id]);
            $this->template->load('template/dashboard', 'supplier/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $input_data = [
                'tempat_supplier'   => $input['tempat_supplier'],
                'nama_supplier'     => $input['nama_supplier'],
                'alamat_supplier'   => $input['alamat_supplier'],
                'nomor_supplier'    => '+62' . $input['nomor_supplier'],
            ];
            $update = $this->admin->update('supplier', 'id_supplier', $id, $input_data);
            if ($update) {
                set_pesan('Data berhasil disimpan.');
                redirect('supplier');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('supplier/edit');
            }
        }
    }

    public function delete($getId)
    {
        if (!is_admin()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('supplier');
        }

        $id = encode_php_tags($getId);
        if ($this->admin->delete('supplier', 'id_supplier', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('supplier');
    }
}
