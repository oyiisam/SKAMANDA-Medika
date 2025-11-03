<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekammedik_model extends CI_Model
{
    // Mengambil semua data kunjungan dengan join tabel pasien dan dokter
    public function getAllKunjungan($table)
    {
        // Pastikan nama tabel yang diterima valid
        if (!$this->db->table_exists($table)) {
            return []; // Tabel tidak ada, kembalikan array kosong
        }

        $this->db->select('rekammedik.*, anamnesa.*, pasien.*, poliklinik.*, dokter.*, user.*');
        $this->db->from($table);
        $this->db->join('anamnesa', 'anamnesa.rekammedik_id = rekammedik.id_rekammedik', 'left');
        $this->db->join('pasien', 'pasien.id_pasien = rekammedik.pasien_id', 'left');
        $this->db->join('poliklinik', 'poliklinik.id_poliklinik = rekammedik.poliklinik_id', 'left');
        $this->db->join('dokter', 'dokter.id_dokter = rekammedik.dokter_id', 'left');
        $this->db->join('user', 'user.id_user = dokter.user_id', 'left');
        $this->db->order_by('id_rekammedik', 'DESC'); // RM baru ada di baris paling atas


        // Jalankan query dan kembalikan hasilnya
        $query = $this->db->get();
        return $query->result_array(); // Kembalikan hasil dalam bentuk array
    }

    public function getKunjunganByRM($nomor_rm)
    {
        if (!$nomor_rm) return [];

        // contoh join — sesuaikan nama kolom/alias dengan struktur database Anda
        $this->db->select('rk.*, p.*, pol.*, u.*, d.*');
        $this->db->from('rekammedik rk');
        $this->db->join('pasien p', 'p.id_pasien = rk.pasien_id', 'left');
        $this->db->join('poliklinik pol', 'pol.id_poliklinik = rk.poliklinik_id', 'left');
        $this->db->join('user u', 'u.id_user = rk.dokter_id', 'left');
        $this->db->join('diagnosa d', 'd.rekammedik_id = rk.id_rekammedik', 'left');
        $this->db->where('p.nomor_rm', $nomor_rm);
        $this->db->order_by('rk.tanggal_kunjungan', 'DESC');

        $query = $this->db->get();
        if ($query) {
            return $query->result_array();
        }
        return [];
    }




    public function getPasienByRM($nomor_rm)
    {
        return $this->db->get_where('pasien', ['nomor_rm' => $nomor_rm])->row_array();
    }

    public function getDokterByPoliklinik($poliklinik_id)
    {
        $this->db->join('user', 'id_user = dokter.user_id', 'left');
        return $this->db->get_where('dokter', ['poliklinik_id' => $poliklinik_id])->result_array();
    }

    // Insert data kunjungan
    public function insertKunjungan($data)
    {
        $this->db->insert('rekammedik', $data);
        return $this->db->insert_id(); // ambil id_rekammedik terakhir
    }

    // Insert anamnesa
    public function insertanamnesa($data)
    {
        return $this->db->insert('anamnesa', $data);
    }

    // data Anamnesa
    public function get_anamnesa_by_rekammedikID($id_rekammedik)
    {
        return $this->db->get_where('anamnesa', ['rekammedik_id' => $id_rekammedik])->row_array();
    }


    // data TTV //
    public function insertTTV($data)
    {
        return $this->db->insert('ttv', $data);
    }

    public function getTtvById($id_rekammedik)
    {
        return $this->db->get_where('ttv', ['rekammedik_id' => $id_rekammedik])->row_array();
    }

    public function updateTtvById($id_rekammedik, $data)
    {
        $this->db->where('rekammedik_id', $id_rekammedik);
        return $this->db->update('ttv', $data);
    }
    // data TTV //


    // Insert data Diagnosa + Tindakan + Resep
    public function getPasienByRekam($id_rekammedik)
    {
        return $this->db->select('p.*')
            ->from('rekammedik r')
            ->join('pasien p', 'p.id_pasien = r.pasien_id')
            ->where('r.id_rekammedik', $id_rekammedik)
            ->get()->row_array();
    }

    public function getAnamnesaByRekam($id_rekammedik)
    {
        return $this->db->get_where('anamnesa', ['rekammedik_id' => $id_rekammedik])->row_array();
    }

    public function getTTVByRekam($id_rekammedik)
    {
        return $this->db->get_where('ttv', ['rekammedik_id' => $id_rekammedik])->row_array();
    }

    public function insertDiagnosa($data)
    {
        $this->db->insert('diagnosa', $data);
    }

    // Insert multiple detail resep (batch insert)
    public function insertDetailResepBatch($data)
    {
        $this->db->insert_batch('detail_resep', $data);
    }

    // UPDATE STATUS
    // Update status rekammedik (misalnya ttv_status atau diagnosa_status)
    public function updateStatus($id, $field, $value)
    {
        $this->db->where('id_rekammedik', $id);
        $this->db->update('rekammedik', [$field => $value]);
    }

    // DIAGNOSA
    // Ambil diagnosa berdasarkan ID RekamMedik
    public function getDiagnosaByRekamMedik($id_rekammedik)
    {
        return $this->db->get_where('diagnosa', ['rekammedik_id' => $id_rekammedik])->row_array();
    }

    // Ambil diagnosa berdasarkan ID Diagnosa
    public function getDiagnosaById($id_diagnosa)
    {
        return $this->db->get_where('diagnosa', ['id_diagnosa' => $id_diagnosa])->row_array();
    }

    // Update data diagnosa berdasarkan ID Diagnosa
    public function updateDiagnosa($id_diagnosa, $data)
    {
        $this->db->where('id_diagnosa', $id_diagnosa);
        return $this->db->update('diagnosa', $data);
    }

    // Ambil detail resep berdasarkan ID Diagnosa
    public function getDetailResepByDiagnosa($id_diagnosa)
    {
        $this->db->select('dr.*, s.*, b.*');
        $this->db->from('detail_resep dr');
        $this->db->join('barang b', 'dr.obat_id = b.id_barang', 'left');
        $this->db->join('satuan s', 'b.satuan_id = s.id_satuan', 'left');
        $this->db->where('dr.diagnosa_id', $id_diagnosa);
        return $this->db->get()->result_array();
    }

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

        $expired = $batch ? $batch['expired_date'] : null;

        $this->db->set('expired_date_terdekat', $expired)
            ->where('id_barang', $barang_id)
            ->update('barang');
    }

    // Hapus detail resep berdasarkan ID Diagnosa
    public function deleteDetailResep($id_diagnosa)
    {
        $this->db->where('diagnosa_id', $id_diagnosa);
        return $this->db->delete('detail_resep');
    }
}
