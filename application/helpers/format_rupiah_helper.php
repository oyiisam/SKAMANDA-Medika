<?php
defined('BASEPATH') or exit('No direct script access allowed');

if (!function_exists('format_rupiah')) {
    /**
     * Format angka menjadi format mata uang Rupiah
     * 
     * @param mixed $angka Angka yang akan diformat (integer, float, atau string)
     * @param bool $tampilkan_desimal True untuk menampilkan dua angka di belakang koma
     * @return string Format Rupiah, contoh: "Rp 15.000" atau "Rp 15.000,00"
     */
    function format_rupiah($angka, $tampilkan_desimal = false)
    {
        // Pastikan angka valid
        if ($angka === null || $angka === '') {
            $angka = 0;
        }

        $angka = floatval($angka);

        // Format angka sesuai parameter
        if ($tampilkan_desimal) {
            $hasil = number_format($angka, 2, ',', '.');
        } else {
            $hasil = number_format($angka, 0, ',', '.');
        }

        return 'Rp ' . $hasil;
    }
}

if (!function_exists('hapus_format_rupiah')) {
    /**
     * Menghapus format Rupiah agar kembali menjadi angka mentah
     * 
     * @param string $nilai Nilai dengan format "Rp 15.000,00" atau "15.000"
     * @return float Nilai numerik tanpa simbol dan pemisah
     */
    function hapus_format_rupiah($nilai)
    {
        // Hilangkan huruf, Rp, spasi, dan titik
        $nilai = preg_replace('/[^0-9,]/', '', $nilai);

        // Ganti koma dengan titik agar bisa dikonversi ke float
        $nilai = str_replace(',', '.', $nilai);

        return floatval($nilai);
    }
}
