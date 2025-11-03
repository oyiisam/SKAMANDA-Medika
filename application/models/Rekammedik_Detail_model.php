<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekammedik_Detail_model extends CI_Model
{
    // ✅ Ambil data rekam medik lengkap berdasarkan nomor RM
    public function getRekamMedikByNomorRM($nomor_rm)
    {
        $this->db->select("
            rm.id_rekammedik,
            rm.tanggal_kunjungan,
            p.id_pasien, p.nama_pasien, p.jenis_kelamin, p.tanggal_lahir, 
            p.nomor_rm, p.alamat, p.no_telp,
            pol.nama_poliklinik,
            d.id_dokter, u.nama AS nama_dokter, d.spesialisasi,
            a.keluhan, a.lama_keluhan, a.riwayat_penyakit, a.terakhir_sakit, a.riwayat_sakit_keluarga, a.alergi,
            t.berat_badan, t.suhu_badan, t.tekanan_darah, t.tinggi_badan, t.nadi, t.pernapasan, t.spo2,
            dg.id_diagnosa, dg.diagnosa, dg.pemeriksaan_penunjang, dg.tindakan, dg.resep_kode,
            dr.obat_id, dr.jumlah_obat, dr.dosis_obat, dr.keterangan_obat, dr.status_obat,
            br.nama_barang, br.expired_date_terdekat, s.nama_satuan,
        ");
        $this->db->from('rekammedik rm');
        $this->db->join('pasien p', 'rm.pasien_id = p.id_pasien', 'left');
        $this->db->join('poliklinik pol', 'rm.poliklinik_id = pol.id_poliklinik', 'left');
        $this->db->join('dokter d', 'rm.dokter_id = d.id_dokter', 'left');
        $this->db->join('user u', 'd.user_id = u.id_user', 'left');
        $this->db->join('anamnesa a', 'rm.id_rekammedik = a.rekammedik_id', 'left');
        $this->db->join('ttv t', 'rm.id_rekammedik = t.rekammedik_id', 'left');
        $this->db->join('diagnosa dg', 'rm.id_rekammedik = dg.rekammedik_id', 'left');
        $this->db->join('detail_resep dr', 'dg.id_diagnosa = dr.diagnosa_id', 'left');
        $this->db->join('barang br', 'dr.obat_id = br.id_barang', 'left');
        $this->db->join('satuan s', 'br.satuan_id = s.id_satuan', 'left');
        $this->db->where('p.nomor_rm', $nomor_rm);
        $this->db->order_by('dg.created_at', 'DESC');

        return $this->db->get()->result_array();
    }

    // ✅ Ambil data lengkap berdasarkan kode resep
    public function getRekamMedikByResepKode($kode_resep)
    {
        $this->db->select("
            dg.resep_kode,
            dg.id_diagnosa, dg.diagnosa, dg.pemeriksaan_penunjang, dg.tindakan,
            rm.id_rekammedik, rm.tanggal_kunjungan,
            p.nama_pasien, p.nomor_rm, p.jenis_kelamin, p.tanggal_lahir, p.alamat,
            d.id_dokter, u.nama AS nama_dokter, d.spesialisasi,
            pol.nama_poliklinik,
            a.keluhan, a.riwayat_penyakit, a.alergi,
            dr.id_detail_resep, dr.obat_id, dr.jumlah_obat, dr.dosis_obat, dr.keterangan_obat, dr.status_obat,
            br.nama_barang, br.harga_jual, br.expired_date_terdekat,
            dp.jumlah_penjualan, dp.subtotal_harga_penjualan, b.nomor_batch, b.expired_date
        ");
        $this->db->from('diagnosa dg');
        $this->db->join('rekammedik rm', 'dg.rekammedik_id = rm.id_rekammedik', 'left');
        $this->db->join('pasien p', 'rm.pasien_id = p.id_pasien', 'left');
        $this->db->join('dokter d', 'dg.dokter_id = d.id_dokter', 'left');
        $this->db->join('user u', 'd.user_id = u.id_user', 'left');
        $this->db->join('poliklinik pol', 'rm.poliklinik_id = pol.id_poliklinik', 'left');
        $this->db->join('anamnesa a', 'rm.id_rekammedik = a.rekammedik_id', 'left');
        $this->db->join('detail_resep dr', 'dg.id_diagnosa = dr.diagnosa_id', 'left');
        $this->db->join('barang br', 'dr.obat_id = br.id_barang', 'left');
        $this->db->join('penjualan pj', 'pj.nota_penjualan = dg.resep_kode', 'left');
        $this->db->join('detail_penjualan dp', 'pj.id_penjualan = dp.penjualan_id AND dp.barang_id = br.id_barang', 'left');
        $this->db->join('batch_barang b', 'dp.batch_id = b.id_batch', 'left');
        $this->db->where('dg.resep_kode', $kode_resep);
        return $this->db->get()->result_array();
    }

    // ✅ Fungsi bantu: update expired terdekat setiap perubahan stok
    public function updateExpiredTerdekat($barang_id)
    {
        $batch = $this->db->select('expired_date')
            ->from('batch_barang')
            ->where('barang_id', $barang_id)
            ->where('jumlah_sisa >', 0)
            ->order_by('expired_date', 'ASC')
            ->limit(1)
            ->get()
            ->row_array();

        if ($batch) {
            $this->db->set('expired_date_terdekat', $batch['expired_date'])
                ->where('id_barang', $barang_id)
                ->update('barang');
        } else {
            $this->db->set('expired_date_terdekat', null)
                ->where('id_barang', $barang_id)
                ->update('barang');
        }
    }
}
