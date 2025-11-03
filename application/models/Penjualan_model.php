<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function getDataPenjualan($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('penjualan.*, user.*');
        $this->db->order_by('id_penjualan', 'DESC');
        $this->db->from($table);
        $this->db->join('user', 'user.id_user = penjualan.user_id', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getOneDataPenjualan($id)
    {
        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('penjualan.*');
        $this->db->order_by('id_penjualan', 'DESC');
        $this->db->from('penjualan');
        $this->db->where('id_penjualan', $id);

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->row_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getDetailPenjualan($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('detail_penjualan.*, penjualan.*, barang.*, satuan.*, batch_barang.*');
        $this->db->order_by('id_detail_penjualan', 'DESC');
        $this->db->from($table);
        $this->db->join('penjualan', 'detail_penjualan.penjualan_id = penjualan.id_penjualan', 'left');
        $this->db->join('barang', 'detail_penjualan.barang_id = barang.id_barang', 'left');
        $this->db->join('satuan', 'barang.satuan_id = satuan.id_satuan', 'left');
        $this->db->join('batch_barang', 'batch_barang.id_batch = detail_penjualan.batch_id', 'left');
        $this->db->join('user', 'user.id_user = penjualan.user_id', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getOneDetailPenjualan($penjualan_id)
    {
        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->where('penjualan_id', $penjualan_id);
        $this->db->join('penjualan', 'detail_penjualan.penjualan_id = penjualan.id_penjualan', 'left');
        $this->db->join('barang', 'detail_penjualan.barang_id = barang.id_barang', 'left');
        $this->db->join('satuan', 'barang.satuan_id = satuan.id_satuan', 'left');
        $this->db->join('batch_barang', 'batch_barang.id_batch = detail_penjualan.batch_id', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function insert_penjualan($data)
    {
        $this->db->insert('penjualan', $data);
        return $this->db->insert_id();
    }

    public function insert_detail_penjualan($data)
    {
        $this->db->insert('detail_penjualan', $data);
    }

    public function updateTotalHarga($id_penjualan, $total_harga_penjualan)
    {
        $this->db->where('id_penjualan', $id_penjualan);
        $this->db->update('penjualan', ['total_harga_penjualan' => $total_harga_penjualan]);
    }

    public function getById($id)
    {
        $this->db->where('id_penjualan', $id);
        return $this->db->get('penjualan')->row_array();
    }

    public function getDetailByPenjualanId($penjualan_id)
    {
        $this->db->select('detail_penjualan.*, barang.*, satuan.*, batch_barang.*');
        $this->db->from('detail_penjualan');
        $this->db->join('barang', 'barang.id_barang = detail_penjualan.barang_id', 'left');
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');
        // join ke tabel batch_barang supaya ada nomor_batch & expired_date
        $this->db->join('batch_barang', 'batch_barang.id_batch = detail_penjualan.batch_id', 'left');
        $this->db->where('detail_penjualan.penjualan_id', $penjualan_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_penjualan($id, $data)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->update('penjualan', $data);
    }

    public function delete_detail_by_penjualan_id($penjualan_id)
    {
        $this->db->where('penjualan_id', $penjualan_id);
        $this->db->delete('detail_penjualan');
    }

    public function delete_penjualan($id)
    {
        $this->db->where('id_penjualan', $id);
        $this->db->delete('penjualan');
    }
}
