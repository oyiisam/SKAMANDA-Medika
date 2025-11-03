<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends CI_Model
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

    public function getDataPembelian($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('pembelian.*, supplier.*, user.*');
        $this->db->order_by('id_pembelian', 'DESC');
        $this->db->from($table);
        $this->db->join('supplier', 'supplier.id_supplier = pembelian.supplier_id', 'left');
        $this->db->join('user', 'user.id_user = pembelian.user_id', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getOneDataPembelian($id)
    {
        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('pembelian.*, supplier.*');
        $this->db->order_by('id_pembelian', 'DESC');
        $this->db->from('pembelian');
        $this->db->where('id_pembelian', $id);
        $this->db->join('supplier', 'supplier.id_supplier = pembelian.supplier_id', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->row_array(); // Kembalikan hasil dalam sesuai row data
    }

    public function getDetailPembelian($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('detail_pembelian.*, pembelian.*, barang.*, satuan.*');
        $this->db->order_by('id_detail_pembelian', 'DESC');
        $this->db->from($table);
        $this->db->join('pembelian', 'detail_pembelian.pembelian_id = pembelian.id_pembelian', 'left');
        $this->db->join('barang', 'detail_pembelian.barang_id = barang.id_barang', 'left');
        $this->db->join('satuan', 'barang.satuan_id = satuan.id_satuan', 'left');
        $this->db->join('user', 'user.id_user = pembelian.user_id', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getOneDetailPembelian($pembelian_id)
    {
        // Ambil data dari tabel yang diberikan dengan join ke tabel terkait
        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->where('pembelian_id', $pembelian_id);
        $this->db->join('pembelian', 'detail_pembelian.pembelian_id = pembelian.id_pembelian', 'left');
        $this->db->join('barang', 'detail_pembelian.barang_id = barang.id_barang', 'left');
        $this->db->join('satuan', 'barang.satuan_id = satuan.id_satuan', 'left');

        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function insert_pembelian($data)
    {
        $this->db->insert('pembelian', $data);
        return $this->db->insert_id();
    }

    public function insert_detail_pembelian($data)
    {
        $this->db->insert('detail_pembelian', $data);
        return $this->db->insert_id(); // ambil ID detail yang baru
    }

    public function updateTotalHarga($id_pembelian, $total_harga_pembelian)
    {
        $this->db->where('id_pembelian', $id_pembelian);
        $this->db->update('pembelian', ['total_harga_pembelian' => $total_harga_pembelian]);
    }

    public function getById($id)
    {
        $this->db->where('id_pembelian', $id);
        return $this->db->get('pembelian')->row_array();
    }

    public function getNearestExpiredDate($barang_id)
    {
        $this->db->select_min('expired_date');
        $this->db->where('barang_id', $barang_id);
        $result = $this->db->get('detail_pembelian')->row();
        return $result ? $result->expired_date : null;
    }

    public function getDetailByPembelianId($pembelian_id)
    {
        $this->db->select('detail_pembelian.*, barang.*, satuan.*,');
        $this->db->from('detail_pembelian');
        $this->db->join('barang', 'barang.id_barang = detail_pembelian.barang_id');
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id');
        $this->db->where('detail_pembelian.pembelian_id', $pembelian_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function update_pembelian($id, $data)
    {
        $this->db->where('id_pembelian', $id);
        $this->db->update('pembelian', $data);
    }

    public function insert_batch_barang($data)
    {
        $this->db->insert('batch_barang', $data);
    }

    public function delete_batch_by_pembelian_id($pembelian_id)
    {
        $this->db->where('pembelian_id', $pembelian_id);
        $this->db->delete('batch_barang');
    }

    public function delete_detail_by_pembelian_id($pembelian_id)
    {
        $this->db->where('pembelian_id', $pembelian_id);
        $this->db->delete('detail_pembelian');
    }

    public function delete_pembelian($id)
    {
        $this->db->where('id_pembelian', $id);
        $this->db->delete('pembelian');
    }
}
