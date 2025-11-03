<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        $this->load->model('Admin_model', 'admin');
        $this->load->model('Barang_model', 'barang');
    }

    public function index()
    {
        $data['title'] = "Dashboard | #SKAMANDA Medika";

        $data['count_pasien'] = $this->db->count_all('pasien');
        $data['count_supplier'] = $this->db->count_all('supplier');
        $data['count_poliklinik'] = $this->db->count_all('poliklinik');
        $data['count_dokter'] = $this->db->where('role', 'Dokter')->count_all_results('user');
        $data['count_barang'] = $this->db->count_all('barang');

        // =========================================
        // Panggil smart restock (3 bulan historis, estimasi 30 hari, top 6)
        // =========================================
        $data['restock_suggestions'] = $this->barang->get_restock_suggestions(3, 30, null);

        // =========================================
        // 🤖 Prediksi Kunjungan (AI Sederhana)
        // =========================================
        $this->load->model('Kunjungan_model');
        $data['kunjungan_bulanan'] = $this->Kunjungan_model->get_monthly_visits(6);
        $data['prediksi_kunjungan'] = $this->Kunjungan_model->predict_next_month($data['kunjungan_bulanan']);

        $bulan_ini = $data['kunjungan_bulanan'][0]['total_kunjungan'] ?? 0;
        $prediksi = $data['prediksi_kunjungan'];
        $data['persentase_prediksi'] = $bulan_ini ? round((($prediksi - $bulan_ini) / $bulan_ini) * 100, 1) : 0;



        // Grafik kunjungan pasien
        $data['kunjungan'] = $this->db
            ->select("MONTH(tanggal_kunjungan) as bulan, COUNT(*) as total")
            ->group_by("MONTH(tanggal_kunjungan)")
            ->order_by("bulan", "ASC")
            ->get("rekammedik")
            ->result_array();

        // Grafik keuangan (pembelian & penjualan)
        $data['keuangan'] = $this->db->query("
        SELECT bulan
            FROM (
            SELECT MONTH(tanggal_pembelian) AS bulan FROM pembelian
            UNION
            SELECT MONTH(tanggal_penjualan) AS bulan FROM penjualan
            ) b
            GROUP BY bulan
            ORDER BY bulan ASC
        ")->result_array();

        foreach ($data['keuangan'] as &$b) {
            $bulan = $b['bulan'];
            $b['total_pembelian'] = $this->db
                ->select_sum('total_harga_pembelian')
                ->where("MONTH(tanggal_pembelian)", $bulan)
                ->get('pembelian')
                ->row()->total_harga_pembelian ?? 0;

            $b['total_penjualan'] = $this->db
                ->select_sum('total_harga_penjualan')
                ->where("MONTH(tanggal_penjualan)", $bulan)
                ->get('penjualan')
                ->row()->total_harga_penjualan ?? 0;
        }

        // Obat stok menipis
        $data['low_stock'] = $this->db
            ->select('barang.*, satuan.*')
            ->from('barang')
            ->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left')
            ->where('stok <=', 10)
            ->order_by('stok', 'ASC')
            ->limit(5)
            ->get()
            ->result_array();

        // Obat akan kadaluarsa ≤ 3 bulan
        $data['expiring_stock'] = $this->db->query("
            SELECT b.nama_barang, s.nama_satuan, 
            MIN(b.expired_date_terdekat) AS expired_date_terdekat
            FROM barang b
            LEFT JOIN satuan s ON s.id_satuan = b.satuan_id
            WHERE expired_date_terdekat IS NOT NULL
                AND expired_date_terdekat <= DATE_ADD(CURDATE(), INTERVAL 3 MONTH)
                AND expired_date_terdekat >= CURDATE()
            GROUP BY b.id_barang
            ORDER BY expired_date_terdekat ASC
            LIMIT 5
        ")->result_array();

        // Gabungan transaksi pembelian & penjualan
        $data['transaksi'] = $this->db->query("
            SELECT 
                id_pembelian AS id,
                tanggal_pembelian AS tanggal,
                'Pembelian' AS jenis,
                nota_pembelian AS nota,
                total_harga_pembelian AS total
            FROM pembelian
            UNION ALL
            SELECT 
                id_penjualan AS id,
                tanggal_penjualan AS tanggal,
                'Penjualan' AS jenis,
                nota_penjualan AS nota,
                total_harga_penjualan AS total
            FROM penjualan
            ORDER BY tanggal DESC
            LIMIT 5
        ")->result_array();

        $this->template->load('template/dashboard', 'dashboard', $data);
    }
}
