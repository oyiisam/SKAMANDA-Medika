<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kunjungan_model extends CI_Model
{
    /**
     * Ambil data kunjungan pasien per bulan (6 bulan terakhir)
     */
    public function get_monthly_visits($limit = 6)
    {
        $this->db->select("DATE_FORMAT(tanggal_kunjungan, '%Y-%m') AS bulan, COUNT(*) AS total_kunjungan");
        $this->db->from('rekammedik');
        $this->db->group_by("DATE_FORMAT(tanggal_kunjungan, '%Y-%m')");
        $this->db->order_by("bulan", "DESC");
        $this->db->limit($limit);
        return $this->db->get()->result_array();
    }

    /**
     * Hitung prediksi kunjungan bulan depan berdasarkan rata-rata 3 bulan terakhir
     */
    public function predict_next_month($data)
    {
        if (empty($data)) return 0;

        $recent = array_slice($data, 0, min(3, count($data)));
        $sum = array_sum(array_column($recent, 'total_kunjungan'));
        $avg = round($sum / count($recent));

        return $avg;
    }
}
