<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (is_user()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->load->model('Penjualan_model', 'penjualan'); //AWAS!! besar kecil alias berpengaruh!
        $this->load->model('Admin_model', 'admin'); //AWAS!! besar kecil alias berpengaruh!
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Transaksi Keluar | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'penjualan/data', $data);
    }

    public function getDataPenjualan()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'penjualan'; // Ganti dengan nama tabel yang sesuai

        // Cek jika tabel ada
        if (!$this->db->table_exists($nama_tabel)) {
            // Kirim pesan error jika tabel tidak ada
            echo json_encode(['error' => 'Tabel tidak ditemukan. Silahkan hubungi Admin!']);
            return;
        }

        // Tambahkan kondisi berdasarkan peran
        if (is_admin()) {
            // Admin melihat semua data, tidak ada filter tambahan
        } elseif (is_klinik()) {
            $this->db->where('role', 'klinik');
        } elseif (is_tf()) {
            $this->db->where('role', 'teknologi farmasi');
        } elseif (is_lk()) {
            $this->db->where('role', 'layanan kesehatan');
        } elseif (is_mm()) {
            $this->db->where('role', 'multimedia');
        }

        // Ambil data dari tabel
        $data = $this->penjualan->getDataPenjualan($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['tanggal_penjualan'] = mediumdate_indo($item['tanggal_penjualan']);
            $item['total_harga_penjualan'] = 'Rp' . number_format($item['total_harga_penjualan'], 0, ',', '.');
            $item['edit_url'] = base_url('penjualan/edit/') . $item['id_penjualan'];
            $item['delete_url'] = base_url('penjualan/delete/') . $item['id_penjualan'];
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    public function detail()
    {
        $data['title'] = "Detail Transaksi Keluar | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'penjualan/detail', $data);
    }

    public function getDetailById($id)
    {
        $data['penjualan'] = $this->penjualan->getOneDataPenjualan($id);
        $data['detail_penjualan'] = $this->penjualan->getOneDetailPenjualan($id);
        $this->load->view('penjualan/detailById', $data);
    }

    public function getDetailPenjualan()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'detail_penjualan'; // Ganti dengan nama tabel yang sesuai

        // Cek jika tabel ada
        if (!$this->db->table_exists($nama_tabel)) {
            // Kirim pesan error jika tabel tidak ada
            echo json_encode(['error' => 'Tabel tidak ditemukan. Silahkan hubungi Admin!']);
            return;
        }

        // Tambahkan kondisi berdasarkan peran
        if (is_admin()) {
            // Admin melihat semua data, tidak ada filter tambahan
        } elseif (is_klinik()) {
            $this->db->where('role', 'klinik');
        } elseif (is_tf()) {
            $this->db->where('role', 'teknologi farmasi');
        } elseif (is_lk()) {
            $this->db->where('role', 'layanan kesehatan');
        } elseif (is_mm()) {
            $this->db->where('role', 'multimedia');
        }

        // Ambil data dari tabel
        $data = $this->penjualan->getDetailPenjualan($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['jumlah_penjualan_satuan'] = $item['jumlah_penjualan'] . ' ' . $item['nama_satuan'];
            // $item['tanggal_penjualan'] = mediumdate_indo($item['tanggal_penjualan']);
            // $item['expired_date'] = mediumdate_indo($item['expired_date']);
            $item['tanggal_penjualan'] = !empty($item['tanggal_penjualan'])
                ? mediumdate_indo($item['tanggal_penjualan'])
                : '-';

            $item['expired_date'] = !empty($item['expired_date'])
                ? mediumdate_indo($item['expired_date'])
                : '-';

            // Menyimpan harga_penjualan asli sebelum format
            $harga_penjualan = $item['harga_penjualan'];

            // Format harga_penjualan
            $item['harga_penjualan'] = 'Rp' . number_format($harga_penjualan, 0, ',', '.');

            // Menghitung harga subtotal
            $harga_subtotal = $harga_penjualan * $item['jumlah_penjualan'];
            $item['harga_subtotal'] = 'Rp' . number_format($harga_subtotal, 0, ',', '.');

            $item['edit_url'] = '#'; // Atau bisa kosong
            $item['delete_url'] = '#'; // Atau bisa kosong
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    public function cek_kode_barang()
    {
        $kode_barang = $this->input->post('kode_barang');
        // Tambahkan kondisi berdasarkan peran
        if (is_admin()) {
            $barang = $this->admin->getByKode($kode_barang); // Admin melihat semua data, tidak ada filter tambahan
        } elseif (is_klinik()) {
            $barang = $this->admin->getKlinikByKode($kode_barang);
        } elseif (is_tf()) {
            $barang = $this->admin->getFarmasiByKode($kode_barang);
        } elseif (is_lk()) {
            $barang = $this->admin->getPerawatByKode($kode_barang);
        } elseif (is_mm()) {
            $barang = $this->admin->getKomputerByKode($kode_barang);
        }

        if ($barang) {
            echo json_encode(['status' => 'success', 'data' => $barang]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Kode belum terdaftar.']);
        }
    }

    public function add()
    {
        $this->form_validation->set_rules('keterangan_penjualan', 'Keterangan', 'required');
        $this->form_validation->set_rules('tanggal_penjualan', 'Tanggal', 'required');
        $this->form_validation->set_rules('kode_barang[]', 'Kode Barang', 'required');
        $this->form_validation->set_rules('jumlah_penjualan[]', 'Jumlah', 'required|numeric|greater_than[0]');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Tambah Transaksi Keluar | #SKAMANDA Medika";

            // Generate Nota Penjualan
            // Buat prefix nota penjualan dengan format inf/dd.mm.yy/
            $prefix = 'inf/' . date('d.m.y/');
            // Ambil nota penjualan terakhir di tabel penjualan yang diawali prefix tersebut
            $kode_terakhir = $this->admin->getMax('penjualan', 'nota_penjualan', $prefix);
            // Jika ada nota sebelumnya, ambil 4 digit terakhir lalu +1, Jika tidak ada, mulai dari 1
            $angka = $kode_terakhir ? (intval(substr($kode_terakhir, -3)) + 1) : 1;
            // Bentuk nomor nota lengkap dengan menambahkan angka 4 digit (padding nol di depan)
            $data['nota_penjualan'] = $prefix . str_pad($angka, 3, '0', STR_PAD_LEFT);


            // Jika request AJAX, load view tanpa template
            if ($this->input->is_ajax_request()) {
                $this->load->view('penjualan/add', $data);
            } else {
                // Akses normal (non-AJAX), tetap bisa buka halaman penuh
                $this->template->load('template/dashboard', 'penjualan/data', $data);
            }
        } else {
            $tanggal      = $this->input->post('tanggal_penjualan');
            $nota         = $this->input->post('nota_penjualan');
            $keterangan   = $this->input->post('keterangan_penjualan');
            $kode_barang  = $this->input->post('kode_barang');
            $jumlah_jual  = $this->input->post('jumlah_penjualan');
            $user_id      = userdata('id_user');

            $this->db->trans_start();

            // Insert penjualan (header)
            $penjualan_data = [
                'tanggal_penjualan'    => $tanggal,
                'nota_penjualan'       => $nota,
                'keterangan_penjualan' => $keterangan,
                'user_id'              => $user_id
            ];
            $this->penjualan->insert_penjualan($penjualan_data);
            $penjualan_id = $this->db->insert_id();

            $total_harga = 0;

            // Loop semua barang
            foreach ($kode_barang as $i => $kode) {
                $barang = $this->admin->getByKode($kode);
                if (!$barang) {
                    $this->db->trans_rollback();
                    set_pesan("Barang dengan kode $kode tidak ditemukan!", false);
                    redirect('penjualan/add');
                    return;
                }

                $qty_sisa = (int)$jumlah_jual[$i];
                $harga    = $barang['harga_terkini'];

                // Ambil batch (FIFO → expired paling dekat)
                $batches = $this->db->where('barang_id', $barang['id_barang'])
                    ->where('jumlah_sisa >', 0)
                    ->order_by('expired_date', 'ASC')
                    ->get('batch_barang')->result_array();

                if (!$batches) {
                    $this->db->trans_rollback();
                    set_pesan("Stok untuk {$barang['nama_barang']} kosong!", false);
                    redirect('penjualan/add');
                    return;
                }

                foreach ($batches as $batch) {
                    if ($qty_sisa <= 0) break;

                    $ambil = min($qty_sisa, $batch['jumlah_sisa']);
                    $qty_sisa -= $ambil;

                    // Update jumlah_sisa batch
                    $this->db->set('jumlah_sisa', 'jumlah_sisa - ' . $ambil, FALSE)
                        ->where('id_batch', $batch['id_batch'])
                        ->update('batch_barang');

                    // Insert detail
                    $detail = [
                        'penjualan_id' => $penjualan_id,
                        'barang_id'    => $barang['id_barang'],
                        'batch_id'     => $batch['id_batch'],
                        'jumlah_penjualan' => $ambil,
                        'harga_penjualan'  => $harga,
                        'subtotal_harga_penjualan' => $ambil * $harga,
                        'user_id'       => $user_id
                    ];
                    $this->penjualan->insert_detail_penjualan($detail);

                    $total_harga += $detail['subtotal_harga_penjualan'];
                }

                if ($qty_sisa > 0) {
                    $this->db->trans_rollback();
                    set_pesan("Stok batch untuk {$barang['nama_barang']} tidak mencukupi!", false);
                    redirect('penjualan/add');
                    return;
                }

                // Update stok total barang
                $this->admin->updateStokPenjualan($barang['id_barang'], $jumlah_jual[$i]);

                // Update expired terdekat barang
                $this->admin->updateExpiredTerdekat($barang['id_barang']);
            }

            // Update total harga penjualan
            $this->penjualan->updateTotalHarga($penjualan_id, $total_harga);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                set_pesan('Data gagal disimpan!', false);
            } else {
                set_pesan('Data berhasil disimpan!');
            }
            redirect('penjualan');
        }
    }


    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $data['title'] = "Edit Transaksi Keluar | #SKAMANDA Medika";
        $data['penjualan'] = $this->penjualan->getById($id);
        $data['detail_penjualan'] = $this->penjualan->getDetailByPenjualanId($id);

        $this->form_validation->set_rules('tanggal_penjualan', 'Tanggal Penjualan', 'required');
        $this->form_validation->set_rules('nota_penjualan', 'Nota Penjualan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->template->load('template/dashboard', 'penjualan/edit', $data);
        } else {
            $this->db->trans_start();

            // 1️⃣ Update data penjualan
            $penjualan_data = [
                'tanggal_penjualan' => $this->input->post('tanggal_penjualan'),
            ];
            $this->penjualan->update_penjualan($id, $penjualan_data);

            // 2️⃣ Rollback stok lama (barang + batch)
            $old_detail = $this->penjualan->getDetailByPenjualanId($id);
            foreach ($old_detail as $detail) {
                // Kembalikan stok barang
                $this->admin->updateStokInEdit($detail['barang_id'], +$detail['jumlah_penjualan']);

                // Kembalikan stok batch
                $this->db->set('jumlah_sisa', 'jumlah_sisa + ' . (int)$detail['jumlah_penjualan'], FALSE)
                    ->where('id_batch', $detail['batch_id'])
                    ->update('batch_barang');
            }

            // Hapus detail lama
            $this->penjualan->delete_detail_by_penjualan_id($id);

            // 3️⃣ Insert detail baru dengan logika FIFO
            $kode_barang = $this->input->post('kode_barang');
            $jumlah_jual = $this->input->post('jumlah_penjualan');
            $harga_jual  = $this->input->post('harga_penjualan'); // kalau harga bisa berbeda
            $user_id     = userdata('id_user');

            $total_harga_penjualan = 0;

            if ($kode_barang && is_array($kode_barang)) {
                foreach ($kode_barang as $i => $kode) {
                    $barang = $this->admin->getByKode($kode);
                    if (!$barang) {
                        $this->db->trans_rollback();
                        set_pesan("Barang dengan kode $kode tidak ditemukan!", false);
                        redirect('penjualan/edit/' . $id);
                        return;
                    }

                    $qty_sisa = (int)$jumlah_jual[$i];
                    $harga    = (int)$harga_jual[$i];

                    // Ambil batch dengan stok > 0 urut expired
                    $batches = $this->db->where('barang_id', $barang['id_barang'])
                        ->where('jumlah_sisa >', 0)
                        ->order_by('expired_date', 'ASC')
                        ->get('batch_barang')->result_array();

                    if (!$batches) {
                        $this->db->trans_rollback();
                        set_pesan("Stok untuk {$barang['nama_barang']} kosong!", false);
                        redirect('penjualan/edit/' . $id);
                        return;
                    }

                    foreach ($batches as $batch) {
                        if ($qty_sisa <= 0) break;

                        $ambil = min($qty_sisa, $batch['jumlah_sisa']);
                        $qty_sisa -= $ambil;

                        // Kurangi stok batch
                        $this->db->set('jumlah_sisa', 'jumlah_sisa - ' . $ambil, FALSE)
                            ->where('id_batch', $batch['id_batch'])
                            ->update('batch_barang');

                        // Insert detail
                        $detail_data = [
                            'penjualan_id'             => $id,
                            'barang_id'                => $barang['id_barang'],
                            'batch_id'                 => $batch['id_batch'],
                            'jumlah_penjualan'         => $ambil,
                            'harga_penjualan'          => $harga,
                            'subtotal_harga_penjualan' => $ambil * $harga,
                            'user_id'                  => $user_id
                        ];
                        $this->penjualan->insert_detail_penjualan($detail_data);

                        $total_harga_penjualan += $detail_data['subtotal_harga_penjualan'];
                    }

                    // Kalau masih ada sisa qty artinya stok tidak cukup
                    if ($qty_sisa > 0) {
                        $this->db->trans_rollback();
                        set_pesan("Stok batch untuk {$barang['nama_barang']} tidak mencukupi!", false);
                        redirect('penjualan/edit/' . $id);
                        return;
                    }

                    // Update stok total barang & expired terdekat
                    $this->admin->updateStokPenjualan($barang['id_barang'], $jumlah_jual[$i]);
                    $this->admin->updateExpiredTerdekat($barang['id_barang']);
                }
            }

            // 4️⃣ Update total harga penjualan
            $this->penjualan->updateTotalHarga($id, $total_harga_penjualan);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                set_pesan('Data gagal diperbarui!');
            } else {
                set_pesan('Data berhasil diperbarui!');
            }

            redirect('penjualan');
        }
    }


    public function delete($id)
    {
        if (!is_admin()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('penjualan');
        }

        $this->db->trans_start();

        // Ambil detail penjualan berdasarkan ID penjualan
        $detail_penjualan = $this->penjualan->getDetailBypenjualanId($id);
        foreach ($detail_penjualan as $detail) {
            // 1. Kembalikan stok total barang
            $this->admin->updateStokInEdit($detail['barang_id'], +$detail['jumlah_penjualan']);

            // 2. Kembalikan jumlah_sisa di batch_barang
            $this->db->set('jumlah_sisa', 'jumlah_sisa + ' . (int)$detail['jumlah_penjualan'], FALSE)
                ->where('id_batch', $detail['batch_id'])
                ->update('batch_barang');

            // 3. Update expired_date_terdekat barang
            $this->admin->updateExpiredTerdekat($detail['barang_id']);

            // (opsional) kalau masih pakai riwayat harga
            $barang = $this->admin->getById($detail['barang_id']);
            $riwayat_harga_terkini = $barang['riwayat_harga_terkini'];
            $this->admin->updateHargaTerkini($detail['barang_id'], $riwayat_harga_terkini);
        }

        // Hapus detail penjualan berdasarkan ID penjualan
        $this->penjualan->delete_detail_by_penjualan_id($id);

        // Hapus data penjualan
        $this->penjualan->delete_penjualan($id);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            set_pesan('Data gagal dihapus!');
        } else {
            set_pesan('Data berhasil dihapus!');
        }

        redirect('penjualan');
    }
}
