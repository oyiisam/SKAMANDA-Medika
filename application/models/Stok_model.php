<?php
class Stok_model extends CI_Model
{

    public function get_kartu_stok($barang_id)
    {
        // Ambil data barang lengkap
        $this->db->select('barang.*, jenis.nama_jenis, lokasi.nama_lokasi, satuan.nama_satuan');
        $this->db->from('barang');
        $this->db->join('jenis', 'jenis.id_jenis = barang.jenis_id', 'left');
        $this->db->join('lokasi', 'lokasi.id_lokasi = barang.lokasi_id', 'left');
        $this->db->join('satuan', 'satuan.id_satuan = barang.satuan_id', 'left');
        $this->db->where('barang.id_barang', $barang_id);
        $barang = $this->db->get()->row_array();

        if (!$barang) return false;

        // -----------------------
        // Riwayat PEMBELIAN
        // -----------------------
        $this->db->select('pembelian.tanggal_pembelian AS tanggal,
                       detail_pembelian.jumlah_pembelian AS jumlah_masuk,
                       0 AS jumlah_keluar,
                       detail_pembelian.nomor_batch AS nomor_batch,
                       detail_pembelian.expired_date AS expired_date,
                        CONCAT("#", pembelian.nota_pembelian, " dari ", supplier.nama_supplier) AS keterangan,
                       "Pembelian" AS sumber');
        $this->db->from('detail_pembelian');
        $this->db->join('pembelian', 'detail_pembelian.pembelian_id = pembelian.id_pembelian');
        $this->db->join('supplier', 'supplier.id_supplier = pembelian.supplier_id');
        $this->db->where('detail_pembelian.barang_id', $barang_id);
        $pembelian = $this->db->get()->result_array();

        // -----------------------
        // Riwayat PENJUALAN
        // -----------------------
        $this->db->select('penjualan.tanggal_penjualan AS tanggal,
                       0 AS jumlah_masuk,
                       detail_penjualan.jumlah_penjualan AS jumlah_keluar,
                       batch_barang.nomor_batch AS nomor_batch,
                       batch_barang.expired_date AS expired_date,
                        CONCAT("#", penjualan.nota_penjualan, " : ", penjualan.keterangan_penjualan) AS keterangan,
                       "Penjualan" AS sumber');
        $this->db->from('detail_penjualan');
        $this->db->join('penjualan', 'detail_penjualan.penjualan_id = penjualan.id_penjualan');
        $this->db->join('batch_barang', 'batch_barang.id_batch = detail_penjualan.batch_id', 'left');
        $this->db->where('detail_penjualan.barang_id', $barang_id);
        $penjualan = $this->db->get()->result_array();

        // -----------------------
        // Gabungkan + urutkan
        // -----------------------
        $riwayat = array_merge($pembelian, $penjualan);

        usort($riwayat, function ($a, $b) {
            $ta = strtotime($a['tanggal']);
            $tb = strtotime($b['tanggal']);
            if ($ta == $tb) return 0;
            return ($ta < $tb) ? -1 : 1;
        });

        $barang['riwayat'] = $riwayat;
        return $barang;
    }
}
