<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (is_user()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->load->model('Pembelian_model', 'pembelian'); //AWAS!! besar kecil alias berpengaruh!
        $this->load->model('Admin_model', 'admin'); //AWAS!! besar kecil alias berpengaruh!
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Transaksi Masuk | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'pembelian/data', $data);
    }

    public function getDataPembelian()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'pembelian'; // Ganti dengan nama tabel yang sesuai

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
        $data = $this->pembelian->getDataPembelian($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['tanggal_pembelian'] = mediumdate_indo($item['tanggal_pembelian']);
            $item['total_harga_pembelian'] = 'Rp' . number_format($item['total_harga_pembelian'], 0, ',', '.');
            $item['edit_url'] = base_url('pembelian/edit/') . $item['id_pembelian'];
            $item['delete_url'] = base_url('pembelian/delete/') . $item['id_pembelian'];
            // $item['detail_url'] = base_url('pembelian/detailById/') . $item['id_pembelian'];
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    public function detail()
    {
        $data['title'] = "Detail Transaksi Masuk | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'pembelian/detail', $data);
    }

    public function getDetailById($id)
    {
        $data['pembelian'] = $this->pembelian->getOneDataPembelian($id);
        $data['detail_pembelian'] = $this->pembelian->getOneDetailPembelian($id);
        $this->load->view('pembelian/detailById', $data);
    }

    public function getDetailPembelian()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'detail_pembelian'; // Ganti dengan nama tabel yang sesuai

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
        $data = $this->pembelian->getDetailPembelian($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            $item['jumlah_pembelian_satuan'] = $item['jumlah_pembelian'] . ' ' . $item['nama_satuan'];
            // $item['tanggal_pembelian'] = mediumdate_indo($item['tanggal_pembelian']);
            // $item['expired_date'] = mediumdate_indo($item['expired_date']);
            $item['tanggal_pembelian'] = !empty($item['tanggal_pembelian'])
                ? mediumdate_indo($item['tanggal_pembelian'])
                : '-';

            $item['expired_date'] = !empty($item['expired_date'])
                ? mediumdate_indo($item['expired_date'])
                : '-';

            // Menyimpan harga_pembelian asli sebelum format
            $harga_pembelian = $item['harga_pembelian'];

            // Format harga_pembelian
            $item['harga_pembelian'] = 'Rp' . number_format($harga_pembelian, 0, ',', '.');

            // Menghitung harga subtotal
            $harga_subtotal = $harga_pembelian * $item['jumlah_pembelian'];
            $item['harga_subtotal'] = 'Rp' . number_format($harga_subtotal, 0, ',', '.');
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
        $this->form_validation->set_rules('tanggal_pembelian', 'Tanggal Pembelian', 'required');
        $this->form_validation->set_rules('nota_pembelian', 'Nota Pembelian', 'required');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');
        $this->form_validation->set_rules('kode_barang[]', 'Kode Barang', 'required');
        $this->form_validation->set_rules('jumlah_pembelian[]', 'Jumlah Pembelian', 'required|numeric');
        $this->form_validation->set_rules('expired_date[]', 'Expired Date', 'required');
        $this->form_validation->set_rules('nomor_batch[]', 'Nomor Batch', 'required'); // validasi batch

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = "Tambah Transaksi Masuk | #SKAMANDA Medika";

            // Filter supplier sesuai role
            if (is_klinik()) {
                $this->db->where('tempat_supplier', 'Klinik');
            } elseif (is_tf()) {
                $this->db->where('tempat_supplier', 'Teknologi Farmasi');
            } elseif (is_lk()) {
                $this->db->where('tempat_supplier', 'Layanan Kesehatan');
            } elseif (is_mm()) {
                $this->db->where('tempat_supplier', 'Multimedia');
            }
            $this->db->order_by('tempat_supplier', 'ASC');
            $this->db->order_by('nama_supplier', 'ASC');
            $data['supplier'] = $this->pembelian->get('supplier');

            // Jika request AJAX, load view tanpa template
            if ($this->input->is_ajax_request()) {
                $this->load->view('pembelian/add', $data);
            } else {
                // Akses normal (non-AJAX), tetap bisa buka halaman penuh
                $this->template->load('template/dashboard', 'pembelian/data', $data);
            }
        } else {
            $tanggal           = $this->input->post('tanggal_pembelian');
            $nota              = $this->input->post('nota_pembelian');
            $supplier_id       = $this->input->post('supplier_id');
            $kode_barang       = $this->input->post('kode_barang');
            $jumlah_pembelian  = $this->input->post('jumlah_pembelian');
            $harga_sama        = $this->input->post('harga_sama');
            $harga_baru        = $this->input->post('harga_baru');
            $expired_date      = $this->input->post('expired_date');
            $nomor_batch       = $this->input->post('nomor_batch'); // input batch manual
            $user_id           = userdata('id_user');

            // Cek nomor batch unik sebelum insert
            $batch_existing = [];
            foreach ($nomor_batch as $batch) {
                $cek = $this->db->get_where('batch_barang', ['nomor_batch' => strtoupper($batch)])->row();
                if ($cek) {
                    $batch_existing[] = $batch;
                }
            }

            if (!empty($batch_existing)) {
                $this->session->set_flashdata(
                    'pesan',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Nomor batch sudah ada: ' . implode(', ', $batch_existing) . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>'
                );

                redirect('pembelian'); // reload form
            }

            $this->db->trans_start();

            // insert ke pembelian
            $pembelian_data = [
                'tanggal_pembelian' => $tanggal,
                'nota_pembelian'    => $nota,
                'supplier_id'       => $supplier_id,
                'user_id'           => $user_id,
            ];
            $this->pembelian->insert_pembelian($pembelian_data);
            $pembelian_id = $this->db->insert_id();

            $total_harga_pembelian = 0;

            foreach ($kode_barang as $index => $kode) {
                $barang = $this->admin->getByKode($kode);

                // simpan riwayat stok & harga
                $riwayat_stok          = $barang['stok'];
                $riwayat_harga_terkini = $barang['harga_terkini'];
                $this->admin->updateRiwayat($barang['id_barang'], $riwayat_stok, $riwayat_harga_terkini);

                // harga
                $harga_pembelian = ($harga_sama[$index] == 'yes') ?
                    $barang['harga_terkini'] :
                    $harga_baru[$index];

                if ($harga_sama[$index] == 'no') {
                    $this->admin->updateHargaTerkini($barang['id_barang'], $harga_baru[$index]);
                }

                // insert detail pembelian
                $detail_data = [
                    'pembelian_id'             => $pembelian_id,
                    'barang_id'                => $barang['id_barang'],
                    'jumlah_pembelian'         => $jumlah_pembelian[$index],
                    'harga_pembelian'          => $harga_pembelian,
                    'subtotal_harga_pembelian' => $jumlah_pembelian[$index] * $harga_pembelian,
                    'nomor_batch'             => $nomor_batch[$index],
                    'expired_date'             => $expired_date[$index],
                    'user_id'                  => $user_id
                ];
                $this->pembelian->insert_detail_pembelian($detail_data);
                $detail_pembelian_id = $this->db->insert_id();

                // insert ke batch_barang (pakai input manual nomor_batch + relasi pembelian/detail)
                $batch_data = [
                    'barang_id'          => $barang['id_barang'],
                    'pembelian_id'       => $pembelian_id,          // simpan relasi pembelian
                    'detail_pembelian_id' => $detail_pembelian_id,   // simpan relasi detail
                    'nomor_batch'        => strtoupper($nomor_batch[$index]),
                    'jumlah_awal'        => $jumlah_pembelian[$index],
                    'jumlah_sisa'        => $jumlah_pembelian[$index],
                    'harga_beli'         => $harga_pembelian,
                    'expired_date'       => $expired_date[$index],
                    'user_id'            => $user_id,
                    'time_stamp'         => date('Y-m-d H:i:s')
                ];
                $this->db->insert('batch_barang', $batch_data);

                // update stok total
                $this->admin->updateStok($barang['id_barang'], $jumlah_pembelian[$index]);

                // update expired_date_terdekat pakai fungsi
                $this->admin->updateExpiredTerdekat($barang['id_barang']);

                $total_harga_pembelian += $detail_data['subtotal_harga_pembelian'];
            }

            // update total pembelian
            $this->pembelian->updateTotalHarga($pembelian_id, $total_harga_pembelian);

            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                set_pesan('Data gagal disimpan!');
            } else {
                set_pesan('Data berhasil disimpan!');
            }

            redirect('pembelian');
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $data['title'] = "Edit Transaksi Masuk | #SKAMANDA Medika";
        $data['pembelian'] = $this->pembelian->getById($id);
        $data['detail_pembelian'] = $this->pembelian->getDetailByPembelianId($id);

        // Filter supplier sesuai role
        if (is_admin()) {
            // lihat semua
        } elseif (is_klinik()) {
            $this->db->where('tempat_supplier', 'Klinik');
        } elseif (is_tf()) {
            $this->db->where('tempat_supplier', 'Teknologi Farmasi');
        } elseif (is_lk()) {
            $this->db->where('tempat_supplier', 'Layanan Kesehatan');
        } elseif (is_mm()) {
            $this->db->where('tempat_supplier', 'Multimedia');
        }
        $this->db->order_by('tempat_supplier', 'ASC');
        $this->db->order_by('nama_supplier', 'ASC');
        $data['supplier'] = $this->pembelian->get('supplier');

        // Validasi header
        $this->form_validation->set_rules('tanggal_pembelian', 'Tanggal Pembelian', 'required');
        $this->form_validation->set_rules('nota_pembelian', 'Nota Pembelian', 'required');
        $this->form_validation->set_rules('supplier_id', 'Supplier', 'required');

        if ($this->form_validation->run() == FALSE) {
            // pertama kali tampil atau validasi header gagal
            $this->template->load('template/dashboard', 'pembelian/edit', $data);
            return;
        }

        // --- Ambil input detail dari POST (nama input di view harus menggunakan indeks) ---
        // contoh: nama input di view -> nomor_batch[0], nomor_batch[1], dsb
        $kode_barang_post = $this->input->post('kode_barang');               // array indexed
        $jumlah_pembelian_post = $this->input->post('jumlah_pembelian');
        $harga_pembelian_post = $this->input->post('harga_pembelian');
        $subtotal_harga_pembelian_post = $this->input->post('subtotal_harga_pembelian');
        $expired_date_post = $this->input->post('expired_date');
        $nomor_batch_post = $this->input->post('nomor_batch');

        // --- VALIDASI NOMOR BATCH ---
        $batch_conflict_numbers = [];   // hanya nomor batch yang bentrok (raw)
        $batch_conflict_messages = [];  // pesan lebih lengkap untuk alert

        // 1) cek duplikasi di dalam form (user memasukkan nomor batch yang sama di beberapa baris)
        if (is_array($nomor_batch_post)) {
            $counts = array_count_values($nomor_batch_post);
            foreach ($counts as $nb => $ct) {
                if (trim($nb) !== '' && $ct > 1) {
                    $batch_conflict_numbers[] = $nb;
                    $batch_conflict_messages[] = $nb . ' (terduplikasi di form)';
                }
            }
        }

        // 2) cek ke DB: nomor batch untuk barang yang sama, tapi kecualikan pembelian ini
        if ($kode_barang_post && is_array($kode_barang_post)) {
            foreach ($kode_barang_post as $index => $kode) {
                $nomor = isset($nomor_batch_post[$index]) ? trim($nomor_batch_post[$index]) : '';
                if ($nomor === '') continue;

                // dapatkan data barang (menggunakan kode)
                $barang = $this->admin->getByKode($kode);
                if (!$barang) continue;

                // cek di DB apakah nomor_batch sudah ada untuk barang ini di pembelian lain
                $cek = $this->db->where('nomor_batch', $nomor)
                    ->where('barang_id', $barang['id_barang'])
                    ->where('pembelian_id !=', $id)
                    ->get('batch_barang')
                    ->row_array();

                if ($cek) {
                    $batch_conflict_numbers[] = $nomor;
                    $batch_conflict_messages[] = $nomor . ' (' . $barang['nama_barang'] . ')';
                }
            }
        }

        // unikkan daftar konflik
        $batch_conflict_numbers = array_values(array_unique($batch_conflict_numbers));
        $batch_conflict_messages = array_values(array_unique($batch_conflict_messages));

        if (!empty($batch_conflict_numbers)) {
            // TIDAK redirect supaya POST tetap ada → muat ulang view dengan error dan data POST masih bisa diakses lewat set_value()
            $data['batch_bentrok_numbers'] = $batch_conflict_numbers;
            $data['batch_bentrok_messages'] = $batch_conflict_messages;
            // Tampilkan pesan di bagian atas
            $data['error_batch_alert'] = 'Nomor batch sudah ada: ' . implode(', ', $batch_conflict_messages);

            // muat view edit ulang (POST masih tersedia pada request ini sehingga set_value() akan menampilkan input terakhir)
            $this->template->load('template/dashboard', 'pembelian/edit', $data);
            return;
        }

        // --- JIKA TIDAK ADA KONFLIK, LANJUTKAN PROSES UPDATE ---
        $this->db->trans_start();

        // Update header pembelian
        $pembelian_data = [
            'tanggal_pembelian' => $this->input->post('tanggal_pembelian'),
            'nota_pembelian'    => $this->input->post('nota_pembelian'),
            'supplier_id'       => $this->input->post('supplier_id')
        ];
        $this->pembelian->update_pembelian($id, $pembelian_data);

        // Rollback stok barang lama
        $old_detail = $this->pembelian->getDetailByPembelianId($id);
        foreach ($old_detail as $detail) {
            $this->admin->updateStokInEdit($detail['barang_id'], -$detail['jumlah_pembelian']);
        }

        // Hapus detail & batch lama
        $this->pembelian->delete_detail_by_pembelian_id($id);
        $this->pembelian->delete_batch_by_pembelian_id($id);

        // Masukkan detail & batch baru
        $total_harga_pembelian = 0;
        if ($kode_barang_post && is_array($kode_barang_post)) {
            foreach ($kode_barang_post as $index => $kode) {
                $barang = $this->admin->getByKode($kode);
                if (!$barang) continue;

                $jumlah_val = isset($jumlah_pembelian_post[$index]) ? $jumlah_pembelian_post[$index] : 0;
                $harga_val = isset($harga_pembelian_post[$index]) ? $harga_pembelian_post[$index] : 0;
                $subtotal_val = isset($subtotal_harga_pembelian_post[$index]) ? $subtotal_harga_pembelian_post[$index] : ($jumlah_val * $harga_val);
                $expired_val = isset($expired_date_post[$index]) ? $expired_date_post[$index] : null;
                $nomor_val = isset($nomor_batch_post[$index]) ? strtoupper(trim($nomor_batch_post[$index])) : '';

                // Simpan detail pembelian (pastikan model insert_detail_pembelian mengembalikan insert_id)
                $detail_data = [
                    'pembelian_id' => $id,
                    'barang_id' => $barang['id_barang'],
                    'jumlah_pembelian' => $jumlah_val,
                    'harga_pembelian' => $harga_val,
                    'subtotal_harga_pembelian' => $subtotal_val,
                    'expired_date' => $expired_val,
                    'nomor_batch' => $nomor_val,
                    'user_id' => userdata('id_user'),
                    'time_stamp' => date('Y-m-d H:i:s')
                ];
                $detail_id = $this->pembelian->insert_detail_pembelian($detail_data); // harus mengembalikan insert_id

                // Simpan batch barang
                $batch_data = [
                    'barang_id' => $barang['id_barang'],
                    'nomor_batch' => $nomor_val,
                    'jumlah_awal' => $jumlah_val,
                    'jumlah_sisa' => $jumlah_val,
                    'harga_beli' => $harga_val,
                    'expired_date' => $expired_val,
                    'pembelian_id' => $id,
                    'detail_pembelian_id' => $detail_id,
                    'user_id' => userdata('id_user'),
                    'time_stamp' => date('Y-m-d H:i:s')
                ];
                $this->pembelian->insert_batch_barang($batch_data);

                // Update stok & harga terkini & expired terdekat
                $this->admin->updateStokInEdit($barang['id_barang'], $jumlah_val);
                $this->admin->updateHargaTerkiniInEdit($barang['id_barang'], $harga_val);
                $this->admin->updateExpiredTerdekat($barang['id_barang']);

                $total_harga_pembelian += $subtotal_val;
            }
        }

        // Update total harga
        $this->pembelian->updateTotalHarga($id, $total_harga_pembelian);

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            set_pesan('Data gagal diperbarui!');
        } else {
            set_pesan('Data berhasil diperbarui!');
        }
        redirect('pembelian');
    }

    public function delete($id)
    {
        if (!is_admin()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('pembelian');
        }

        $this->db->trans_start();

        // Ambil detail pembelian berdasarkan ID pembelian
        $detail_pembelian = $this->pembelian->getDetailByPembelianId($id);

        foreach ($detail_pembelian as $detail) {
            // Kembalikan stok ke jumlah sebelum penambahan
            $this->admin->updateStokInEdit($detail['barang_id'], -$detail['jumlah_pembelian']);

            // Ambil nilai riwayat_harga_terkini dari tabel barang
            $barang = $this->admin->getById($detail['barang_id']);
            $riwayat_harga_terkini = $barang['riwayat_harga_terkini'];

            // Kembalikan harga_terkini ke nilai riwayat_harga_terkini
            $this->admin->updateHargaTerkini($detail['barang_id'], $riwayat_harga_terkini);
        }

        // Hapus batch terkait pembelian ini
        $this->pembelian->delete_batch_by_pembelian_id($id);

        // Hapus detail pembelian
        $this->pembelian->delete_detail_by_pembelian_id($id);

        // Hapus data pembelian
        $this->pembelian->delete_pembelian($id);

        // --- Update expired_date_terdekat untuk semua barang terdampak ---
        foreach ($detail_pembelian as $detail) {
            $this->admin->updateExpiredTerdekat($detail['barang_id']);
        }

        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            set_pesan('Data gagal dihapus!');
        } else {
            set_pesan('Data berhasil dihapus!');
        }

        redirect('pembelian');
    }
}
