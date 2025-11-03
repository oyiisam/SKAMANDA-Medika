<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Barang | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'barang/data', $data);
    }

    public function getDataBarang()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'barang'; // Ganti dengan nama tabel yang sesuai

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
            $this->db->where('tempat_barang', 'Teknologi Farmasi');
        } elseif (is_lk()) {
            $this->db->where('tempat_barang', 'Layanan Kesehatan');
        } elseif (is_mm()) {
            $this->db->where('tempat_barang', 'Multimedia');
        } elseif (is_klinik()) {
            $this->db->where('tempat_barang', 'Klinik');
        }

        // Tambahkan kondisi ORDER BY di controller sebelum mengambil data
        $this->db->order_by('tempat_barang', 'ASC'); // Sesuaikan nama kolom dan arah urutan (ASC atau DESC)
        $this->db->order_by('nama_barang', 'ASC'); // Sesuaikan nama kolom dan arah urutan (ASC atau DESC)

        // Ambil data dari tabel
        $data = $this->admin->getDataBarang($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['stok_satuan'] = $item['stok'] . ' ' . $item['nama_satuan'];
            $item['expired_date_terdekat'] = mediumdate_indo($item['expired_date_terdekat']);
            $item['harga_terkini'] = 'Rp' . number_format($item['harga_terkini'], 0, ',', '.');
            $item['edit_url'] = base_url('barang/edit/') . $item['id_barang']; // URL untuk edit
            $item['delete_url'] = base_url('barang/delete/') . $item['id_barang']; // URL untuk delete
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    private function _validasi($mode)
    {
        $this->form_validation->set_rules(
            'tempat_barang', // Nama field dari form
            'Jurusan', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Jurusan wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'nama_barang', // Nama field dari form
            'Nama', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Nama barang wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'jenis_id', // Nama field dari form
            'Jenis', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Jenis barang wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'satuan_id', // Nama field dari form
            'Satuan', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Satuan barang wajib diisi.'
            )
        );
        $this->form_validation->set_rules(
            'lokasi_id', // Nama field dari form
            'Lokasi', // Nama label untuk field
            'required|trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => '',
                'required' => '*Lokasi barang wajib diisi.'
            )
        );

        $this->form_validation->set_rules(
            'harga_terkini', // Nama field dari form
            'Harga Terkini', // Nama label untuk field
            'trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => ''
            )
        );
        $this->form_validation->set_rules(
            'expired_date_terdekat', // Nama field dari form
            'Expired Date Terdekat', // Nama label untuk field
            'trim', // Aturan validasi nama_tabel.nama_kolom
            array(
                'trim' => ''
            )
        );
        if ($mode == 'add') {
            $this->form_validation->set_rules(
                'kode_barang', // Nama field dari form
                'Kode', // Nama label untuk field
                'required|trim|is_unique[barang.kode_barang]', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Kode barang wajib diisi.',
                    'is_unique' => '*Kode barang sudah ada.' // Pesan error jika data tidak unik
                )
            );
            $this->form_validation->set_rules(
                'stok', // Nama field dari form
                'Jumlah Awal', // Nama label untuk field
                'required|trim', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Jumlah awal wajib diisi.'
                )
            );
        } else {
            $this->form_validation->set_rules(
                'kode_barang', // Nama field dari form
                'Kode', // Nama label untuk field
                'required|trim', // Aturan validasi nama_tabel.nama_kolom
                array(
                    'trim' => '',
                    'required' => '*Kode barang wajib diisi.',
                )
            );
        }
    }

    public function add()
    {
        if (is_user()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->_validasi('add');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Barang | #SKAMANDA Medika";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');

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

            $data['lokasi'] = $this->admin->get('lokasi');

            $this->template->load('template/dashboard', 'barang/add', $data);
        } else {
            $input = $this->input->post(null, true);
            $input['stok_awal'] = $input['stok'];
            $insert = $this->admin->insert('barang', $input);
            if ($insert) {
                set_pesan('Data berhasil disimpan.');
                redirect('barang');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('barang/add');
            }
        }
    }

    public function edit($getId)
    {
        if (is_user()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }
        $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Barang | #SKAMANDA Medika";
            $data['jenis'] = $this->admin->get('jenis');
            $data['satuan'] = $this->admin->get('satuan');
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
            $data['lokasi'] = $this->admin->get('lokasi');
            $data['barang'] = $this->admin->get('barang', ['id_barang' => $id]);
            $this->template->load('template/dashboard', 'barang/edit', $data);
        } else {
            $input = $this->input->post(null, true);
            $update = $this->admin->update('barang', 'id_barang', $id, $input);
            if ($update) {
                set_pesan('Data berhasil disimpan.');
                redirect('barang');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('barang/edit');
            }
        }
    }

    public function delete($getId)
    {
        if (!is_admin()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('barang');
        }

        $id = encode_php_tags($getId);
        if ($this->admin->delete('barang', 'id_barang', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('barang');
    }
}
