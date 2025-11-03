<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function getUsers($id)
    {

        return $this->db->get('user')->result_array();
    }

    public function getUsersSaja($id)
    {
        //  JIKA INGIN HANYA MENAMPILKAN USER SESUAI ID SAJA MAKA AKTIFKAN WHERE DI BAWAH INI!
        $this->db->where('id_user =', $id);
        return $this->db->get('user')->result_array();
    }

    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function getData($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        // Ambil data dari tabel yang diberikan
        $query = $this->db->get($table);
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getDataBarang($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('barang.*, jenis.*, lokasi.*, satuan.*');
        $this->db->from($table);
        $this->db->join('jenis', 'jenis.id_jenis = barang.jenis_id', 'left');
        $this->db->join('lokasi', 'lokasi.id_lokasi = barang.lokasi_id', 'left');
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getByKode($kode_barang)
    {
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get('barang')->row_array();
    }

    public function getKlinikByKode($kode_barang)
    {
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');
        $this->db->where('tempat_barang', 'Klinik');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get('barang')->row_array();
    }

    public function getFarmasiByKode($kode_barang)
    {
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');
        $this->db->where('tempat_barang', 'Teknologi Farmasi');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get('barang')->row_array();
    }

    public function getPerawatByKode($kode_barang)
    {
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');
        $this->db->where('tempat_barang', 'Layanan Kesehatan');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get('barang')->row_array();
    }

    public function getKomputerByKode($kode_barang)
    {
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');
        $this->db->where('tempat_barang', 'Multimedia');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get('barang')->row_array();
    }

    public function getById($barang_id)
    {
        return $this->db->get_where('barang', ['id_barang' => $barang_id])->row_array();
    }

    public function updateHargaTerkini($id_barang, $harga_terkini)
    {
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang', ['harga_terkini' => $harga_terkini]);
    }

    public function updateExpiredTerdekat($barang_id)
    {
        // Ambil batch yang masih ada stoknya
        $batch = $this->db->select('expired_date')
            ->from('batch_barang')
            ->where('barang_id', $barang_id)
            ->where('jumlah_sisa >', 0)
            ->order_by('expired_date', 'ASC')
            ->limit(1)
            ->get()
            ->row_array();

        if ($batch) {
            // Update expired_date_terdekat sesuai batch terdekat
            $this->db->set('expired_date_terdekat', $batch['expired_date'])
                ->where('id_barang', $barang_id)
                ->update('barang');
        } else {
            // Kalau sudah habis semua batch → expired_date_terdekat di-null-kan
            $this->db->set('expired_date_terdekat', null)
                ->where('id_barang', $barang_id)
                ->update('barang');
        }
    }

    public function updateStok($id_barang, $jumlah_pembelian)
    {
        $this->db->set('stok', 'stok + ' . $jumlah_pembelian, FALSE);
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang');
    }

    public function updateStokPenjualan($id_barang, $jumlah_pembelian)
    {
        $this->db->set('stok', 'stok - ' . $jumlah_pembelian, FALSE);
        $this->db->where('id_barang', $id_barang);
        $this->db->update('barang');
    }

    public function updateRiwayat($barang_id, $riwayat_stok, $riwayat_harga_terkini)
    {
        $this->db->set('riwayat_stok', $riwayat_stok);
        $this->db->set('riwayat_harga_terkini', $riwayat_harga_terkini);
        $this->db->where('id_barang', $barang_id);
        $this->db->update('barang');
    }

    public function updateStokInEdit($barang_id, $jumlah)
    {
        $this->db->set('stok', 'stok+' . intval($jumlah), FALSE);
        $this->db->where('id_barang', $barang_id);
        $this->db->update('barang');
    }

    public function updateHargaTerkiniInEdit($barang_id, $harga)
    {
        $this->db->set('harga_terkini', $harga);
        $this->db->where('id_barang', $barang_id);
        $this->db->update('barang');
    }

    public function getDataDokter($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('*');
        $this->db->from($table);
        $this->db->join('user', 'user.id_user = dokter.user_id', 'left');
        $this->db->join('poliklinik', 'poliklinik.id_poliklinik = dokter.poliklinik_id', 'left');
        $this->db->order_by('nama', 'DESC'); // Pasien baru ada di baris paling atas


        // Ambil data dari tabel yang diberikan
        $query = $this->db->get(); //parameter tidak perlu diisi karena tabel sudah ditentukan dengan $this->db->from($table)
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getDokter($id)
    {
        // Ambil data dokter berdasarkan ID yang diberikan
        $this->db->select('*');
        $this->db->from('dokter');
        $this->db->join('user', 'user.id_user = dokter.user_id', 'left');
        $this->db->join('poliklinik', 'poliklinik.id_poliklinik = dokter.poliklinik_id', 'left');
        $this->db->where('id_dokter', $id);
        $query = $this->db->get();
        return $query->row_array(); // Kembalikan data dalam bentuk array tunggal (satu baris)
    }

    public function order_by($data, $order)
    {

        return $this->db->order_by($data, $order);
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function insert_ignore($table, $data)
    {
        $this->db->trans_start();
        foreach ($data as $data) {
            $insert_query = $this->db->insert_string($table, $data);
            $insert_query = str_replace('INSERT INTO', 'INSERT IGNORE INTO', $insert_query);
            $this->db->query($insert_query);
        }
        $this->db->trans_complete();

        // Mengembalikan true jika transaksi berhasil, false jika tidak
        return $this->db->trans_status();
    }

    public function delete($table, $pk, $id)
    {

        return $this->db->delete($table, [$pk => $id]);
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }
}
