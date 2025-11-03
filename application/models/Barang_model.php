<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    /**
     * Smart Restock Advisor (AI Prediksi Kebutuhan Stok)
     * Berdasarkan rata-rata penjualan 3 bulan terakhir → estimasi kebutuhan 30 hari ke depan
     */
    public function get_restock_suggestions($months = 3, $days = 30, $limit = 6)
    {
        // Hitung tanggal mulai (3 bulan terakhir)
        $start_date = date('Y-m-d', strtotime("-{$months} months"));

        // Query gabungan dari detail_penjualan + barang + satuan
        $sql = "
            SELECT 
                b.id_barang,
                b.nama_barang,
                b.stok,
                s.nama_satuan,
                COALESCE(SUM(dp.jumlah_penjualan), 0) AS total_terjual,
                COALESCE(SUM(dp.jumlah_penjualan) / GREATEST(DATEDIFF(CURDATE(), ?), 1), 0) AS avg_daily_sales
            FROM barang b
            LEFT JOIN detail_penjualan dp 
                ON dp.barang_id = b.id_barang
                AND DATE(dp.time_stamp) >= ?
            LEFT JOIN satuan s 
                ON s.id_satuan = b.satuan_id
            GROUP BY b.id_barang, b.nama_barang, b.stok, s.nama_satuan
        ";

        $query = $this->db->query($sql, array($start_date, $start_date));
        $rows = $query->result_array();

        $result = [];
        foreach ($rows as $r) {
            $avg_daily = floatval($r['avg_daily_sales']);
            $est_need = ceil($avg_daily * $days);
            $recommended_order = max(0, $est_need - intval($r['stok']));

            $result[] = [
                'id_barang' => $r['id_barang'],
                'nama_barang' => $r['nama_barang'],
                'stok' => intval($r['stok']),
                'satuan' => $r['nama_satuan'] ?: '-',
                'total_terjual_periode' => intval($r['total_terjual']),
                'avg_daily_sales' => round($avg_daily, 2),
                'est_need_' . $days . 'd' => $est_need,
                'recommended_order' => $recommended_order
            ];
        }

        // Urutkan: rekomendasi order terbanyak dulu
        usort($result, function ($a, $b) {
            return $b['recommended_order'] <=> $a['recommended_order'];
        });

        // Jika tidak ingin dibatasi, kembalikan semua
        return $limit ? array_slice($result, 0, $limit) : $result;
    }
}
