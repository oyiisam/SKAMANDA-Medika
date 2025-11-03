<?php
class Stok extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (is_user()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->load->model('Stok_model', 'stok');
        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('barang_id', 'Barang', 'required', [
            'required' => 'Barang harus dipilih!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = "Kartu Stok Barang | #SKAMANDA Medika";
            $data['judul'] = "Kartu Stok Barang | #SKAMANDA Medika";

            $nama_tabel = 'barang';

            if (is_admin()) {
                // Admin full akses
            } elseif (is_tf()) {
                $this->db->where('tempat_barang', 'Teknologi Farmasi');
            } elseif (is_lk()) {
                $this->db->where('tempat_barang', 'Layanan Kesehatan');
            } elseif (is_mm()) {
                $this->db->where('tempat_barang', 'Multimedia');
            } elseif (is_klinik()) {
                $this->db->where('tempat_barang', 'Klinik');
            }

            $this->db->order_by('tempat_barang', 'ASC');
            $this->db->order_by('nama_barang', 'ASC');

            $data['barang'] = $this->admin->getDataBarang($nama_tabel);
            $this->template->load('template/dashboard', 'stok/add', $data);
        } else {
            $barang_id = $this->input->post('barang_id');
            redirect('stok/kartu_stok/' . $barang_id);
        }
    }

    public function kartu_stok($barang_id)
    {
        $barang = $this->stok->get_kartu_stok($barang_id);

        if (!$barang) {
            show_404();
        }

        $stok_awal   = $barang['stok_awal'];
        $nama_barang = $barang['nama_barang'];
        $kode_barang = $barang['kode_barang'];

        $data['title']      = "#" . $kode_barang . " | " . "Kartu Stok " . $nama_barang;
        $data['judul']      = "Kartu Stok Barang | #SKAMANDA Medika";
        $data['stok_awal']  = $stok_awal;
        $data['kartu_stok'] = $barang;

        $this->template->load('template/dashboard', 'stok/data', $data);
    }
}
