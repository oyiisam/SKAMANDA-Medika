<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rekammedik extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login(); // Cek apakah user sudah login
        if (is_user() || is_tf() || is_lk() || is_mm()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->load->model('Rekammedik_model', 'rekammedik'); // Load model rm
        $this->load->model('Admin_model', 'admin'); // Load model admin
        $this->load->model('Penjualan_model', 'penjualan'); // Load model penjualan
        $this->load->library('form_validation'); // Load form validation
    }

    // Menampilkan halaman utama data rekam medik
    public function index()
    {
        $data['title'] = "Data Rekam Medik | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'rekammedik/data', $data);
    }

    public function getData()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'rekammedik'; // Ganti dengan nama tabel yang sesuai

        // Cek jika tabel ada
        if (!$this->db->table_exists($nama_tabel)) {
            // Kirim pesan error jika tabel tidak ada
            echo json_encode(['error' => 'Tabel tidak ditemukan. Silahkan hubungi Admin!']);
            return;
        }

        // Fungsi untuk menghitung usia
        function hitung_usia($tanggal_lahir)
        {
            if ($tanggal_lahir) {
                $birthdate = new DateTime($tanggal_lahir);
                $today = new DateTime('today');
                return $birthdate->diff($today)->y . ' tahun';
            }
            return '-';
        }

        // Ambil data dari tabel
        $data = $this->rekammedik->getAllKunjungan($nama_tabel);

        // Format data untuk DataTables
        foreach ($data as &$item) {
            $item['tanggal_kunjungan'] = mediumdate_indo($item['tanggal_kunjungan']);
            $item['dokter_poliklinik'] = $item['nama_poliklinik'] . '<br><span class="text-muted small">' . $item['nama'] . '</span>';

            // Format Nama Pasien + Usia
            $item['nama_pasien'] = '<strong>' . $item['nama_pasien'] . '</strong>' .
                '<br><span class="text-muted small">' . mediumdate_indo($item['tanggal_lahir']) .
                ' (' . hitung_usia($item['tanggal_lahir']) . ')' . '</span>' .
                '<br><span class="text-muted small">' . $item['nomor_rm'] . '</span>';

            // Button anamnesa
            if ($item['anamnesa_status'] == null) {
                $item['anamnesa_status'] = '<a href="' . base_url("rekammedik/add_anamnesa/") . $item['id_rekammedik'] . '" 
                        class="btn btn-sm btn-info btn-icon-split">
                            <span class="icon">
                                <i class="bx bx-layer-plus"></i>
                            </span>
                            <span class="text">Tambah</span>
                       </a>';
            } else {
                $item['anamnesa_status'] = '<button type="button" class="btn btn-sm btn-success btn-icon-split view-anamnesa" 
                                data-id="' . $item['id_rekammedik'] . '">
                                <span class="icon">
                                    <i class="bx bx-show"></i>
                                </span>
                                <span class="text">Lihat</span>
                                </button>';
            }


            // Button TTV
            if ($item['ttv_status'] == null) {
                $item['ttv_status'] = '<a href="' . base_url("rekammedik/add_ttv/") . $item['id_rekammedik'] . '" 
                                class="btn btn-sm btn-blue btn-icon-split">
                                    <span class="icon">
                                        <i class="bx bx-layer-plus"></i>
                                    </span>
                                    <span class="text">Tambah</span>
                               </a>';
            } else {
                $item['ttv_status'] = '<button type="button" class="btn btn-sm btn-success btn-icon-split view-ttv" 
                                        data-id="' . $item['id_rekammedik'] . '">
                                        <span class="icon">
                                            <i class="bx bx-show"></i>
                                        </span>
                                        <span class="text">Lihat</span>
                                        </button>';
            }


            // Menampilkan tombol sesuai status diagnosa
            if ($item['diagnosa_status'] == null) {
                $item['diagnosa_status'] = '<a href="' . base_url("rekammedik/add_diagnosa/") . $item['id_rekammedik'] . '" 
                                    class="btn btn-sm btn-blue btn-icon-split">
                                        <span class="icon">
                                            <i class="bx bx-layer-plus"></i>
                                        </span>
                                        <span class="text">Tambah</span>
                                    </a>';
            } elseif ($item['diagnosa_status'] == 1) {
                $item['diagnosa_status'] = '<a href="' . base_url("rekammedik/edit_diagnosa/") . $item['id_rekammedik'] . '" 
                                    class="btn btn-sm btn-warning btn-icon-split">
                                        <span class="icon">
                                            <i class="bx bx-check-circle"></i>
                                        </span>
                                        <span class="text">Konfirmasi</span>
                                    </a>';
            } else {
                $item['diagnosa_status'] = '<a href="' . base_url("rekammedik/lihat_diagnosa/") . $item['id_rekammedik'] . '" 
                                    class="btn btn-sm btn-success btn-icon-split">
                                        <span class="icon">
                                            <i class="bx bx-show"></i>
                                        </span>
                                        <span class="text">Lihat</span>
                                    </a>';
            }

            $item['edit_url'] = base_url('rekammedik/edit/') . $item['id_rekammedik']; // URL untuk edit
            $item['delete_url'] = base_url('rekammedik/delete/') . $item['id_rekammedik']; // URL untuk delete
        }

        echo json_encode($data);
    }

    private function _validasiAdd()
    {
        $this->form_validation->set_rules('tanggal_kunjungan', 'Tanggal Kunjungan', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('pasien_id', 'Pasien', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('poliklinik_id', 'Poliklinik', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('dokter_id', 'Dokter', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('keluhan', 'Keluhan', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
    }

    public function cek_nomor_rm()
    {
        $nomor_rm = $this->input->post('nomor_rm');
        $rekammedik = $this->rekammedik->getPasienByRM($nomor_rm);

        if ($rekammedik) {
            echo json_encode(['status' => 'success', 'data' => $rekammedik]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Kode belum terdaftar.']);
        }
    }

    public function cek_dokter_polikliniik($id)
    {
        $dokter = $this->rekammedik->getDokterByPoliklinik($id);
        echo json_encode($dokter);
    }

    // Tambah data kunjungan baru
    public function add()
    {
        $this->_validasiAdd();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Rekam Medik | #SKAMANDA Medika";
            $data['poliklinik'] = $this->admin->get('poliklinik');
            $this->template->load('template/dashboard', 'rekammedik/add', $data);
        } else {
            // Data kunjungan (rekammedik)
            $inputRekam = [
                'tanggal_kunjungan' => $this->input->post('tanggal_kunjungan'),
                'pasien_id'         => $this->input->post('pasien_id'),
                'poliklinik_id'     => $this->input->post('poliklinik_id'),
                'dokter_id'         => $this->input->post('dokter_id'),
                'anamnesa_status'  => 1, // set status 1
                'ttv_status'        => NULL,
                'diagnosa_status'   => NULL,
            ];

            // Insert rekammedik
            $id_rekam = $this->rekammedik->insertKunjungan($inputRekam);

            if ($id_rekam) {
                // Data anamnesa (relasi ke rekammedik_id)
                $inputanamnesa = [
                    'rekammedik_id'             => $id_rekam,
                    'keluhan'                   => $this->input->post('keluhan', true),
                    'lama_keluhan'              => $this->input->post('lama_keluhan', true),
                    'riwayat_penyakit'          => $this->input->post('riwayat_penyakit') ?: $this->input->post('riwayat_penyakit_hidden'),
                    'terakhir_sakit'            => $this->input->post('terakhir_sakit') ?: null,
                    'riwayat_sakit_keluarga'    => $this->input->post('riwayat_sakit_keluarga') ?: $this->input->post('riwayat_sakit_keluarga_hidden'),
                    'alergi'                    => $this->input->post('alergi') ?: $this->input->post('alergi_hidden'),
                ];

                $this->rekammedik->insertanamnesa($inputanamnesa);

                set_pesan('Data berhasil disimpan.');
                redirect('rekammedik');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('rekammedik/add');
            }
        }
    }

    // ANAMNESA
    // Ambil anamnesa by rekammedik
    public function get_anamnesa($id_rekammedik)
    {
        $data = $this->rekammedik->get_anamnesa_by_rekammedikID($id_rekammedik);

        if ($data) {
            echo json_encode([
                'status' => 'success',
                'data'   => $data
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Data anamnesa tidak ditemukan.'
            ]);
        }
    }

    // Update anamnesa
    public function update_anamnesa($id_rekammedik)
    {
        $post = $this->input->post();
        $update = [
            'keluhan'                => $post['keluhan'],
            'lama_keluhan'           => $post['lama_keluhan'],
            'riwayat_penyakit'       => $post['riwayat_penyakit'],
            'terakhir_sakit'         => $post['terakhir_sakit'],
            'riwayat_sakit_keluarga' => $post['riwayat_sakit_keluarga'],
            'alergi'                 => $post['alergi'],
        ];

        $this->db->where('rekammedik_id', $id_rekammedik)->update('anamnesa', $update);

        if ($this->db->affected_rows() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Data anamnesa berhasil diperbarui.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Tidak ada perubahan atau gagal update.']);
        }
    }

    // TTV
    public function get_ttv($id_rekammedik)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $data = $this->rekammedik->getTtvById($id_rekammedik);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }

    // DIAGNOSA
    public function get_diagnosa($id_rekammedik)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $data = $this->rekammedik->getDiagnosaById($id_rekammedik);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak ditemukan']);
        }
    }


    // Menambahkan data TTV berdasarkan ID rekammedik
    public function add_ttv($id_rekammedik)
    {
        $this->form_validation->set_rules('berat_badan', 'Berat Badan', 'required');
        $this->form_validation->set_rules('suhu_badan', 'Suhu', 'required');
        $this->form_validation->set_rules('tekanan_darah', 'Tekanan Darah', 'required');
        $this->form_validation->set_rules('tinggi_badan', 'Tinggi Badan', '');
        $this->form_validation->set_rules('nadi', 'Tekanan Darah', '');
        $this->form_validation->set_rules('pernapasan', 'Frekuensi Pernapasan', '');
        $this->form_validation->set_rules('spo2', 'Saturasi Oksigen', '');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah TTV | #SKAMANDA Medika";
            $data['id_rekammedik'] = $id_rekammedik;
            $this->template->load('template/dashboard', 'rekammedik/add_ttv', $data);
        } else {
            $input = [
                'rekammedik_id'  => $id_rekammedik,
                'berat_badan'    => $this->input->post('berat_badan'),
                'suhu_badan'     => $this->input->post('suhu_badan'),
                'tekanan_darah'  => $this->input->post('tekanan_darah'),
                'tinggi_badan'   => $this->input->post('tinggi_badan'),
                'nadi'           => $this->input->post('nadi'),
                'pernapasan'     => $this->input->post('pernapasan'),
                'spo2'           => $this->input->post('spo2')
            ];
            $this->rekammedik->insertTTV($input);
            $this->rekammedik->updateStatus($id_rekammedik, 'ttv_status', 1);
            set_pesan('Data TTV berhasil ditambahkan.');
            redirect('rekammedik');
        }
    }

    public function update_ttv($id_rekammedik)
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
        }

        $data = [
            'berat_badan'   => $this->input->post('berat_badan'),
            'suhu_badan'    => $this->input->post('suhu_badan'),
            'tekanan_darah' => $this->input->post('tekanan_darah'),
            'tinggi_badan'   => $this->input->post('tinggi_badan'),
            'nadi'           => $this->input->post('nadi'),
            'pernapasan'     => $this->input->post('pernapasan'),
            'spo2'           => $this->input->post('spo2')
        ];

        $update = $this->rekammedik->updateTtvById($id_rekammedik, $data);

        if ($update) {
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error']);
        }
    }
    // TTV

    // DIAGNOSA
    // Menambahkan Diagnosa + Tindakan + Resep
    public function add_diagnosa($id_rekammedik)
    {
        // Validasi input
        $this->form_validation->set_rules('diagnosa', 'Diagnosa', 'required');
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('resep_kode', 'Kode Resep', 'required');
        $this->form_validation->set_rules('dokter_id', 'Dokter', 'required');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Tambah Diagnosa | #SKAMANDA Medika";
            $data['id_rekammedik'] = $id_rekammedik;

            // Fungsi untuk menghitung usia
            function hitung_usia($tanggal_lahir)
            {
                if ($tanggal_lahir) {
                    $birthdate = new DateTime($tanggal_lahir);
                    $today = new DateTime('today');
                    return $birthdate->diff($today)->y . ' tahun';
                }
                return '-';
            }

            // ✅ Ambil data pasien
            $data['pasien'] = $this->rekammedik->getPasienByRekam($id_rekammedik);

            // ✅ Ambil data anamnesa
            $data['anamnesa'] = $this->rekammedik->getAnamnesaByRekam($id_rekammedik);

            // ✅ Ambil data TTV
            $data['ttv'] = $this->rekammedik->getTTVByRekam($id_rekammedik);

            // ✅ Generate Kode Resep
            $kode = 'klinik/' . date('d.m.y/');
            $kode_terakhir = $this->admin->getMax('diagnosa', 'resep_kode', $kode);
            $kode_tambah = substr($kode_terakhir, -3, 3);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 3, '0', STR_PAD_LEFT);
            $data['resep_kode'] = $kode . $number;

            // ✅ Ambil data user login
            $login_session = $this->session->userdata('login_session');
            $user_id = $login_session['user'];
            $role = $login_session['role'];

            if ($role == 'admin') {
                $this->db->where('role', 'dokter');
                $this->db->order_by('nama', 'ASC');
                $data['user'] = $this->admin->get('user');
            } else {
                $this->db->where('id_user', $user_id);
                $data['user'] = $this->admin->get('user');
            }

            $data['is_admin'] = ($role == 'admin');

            // ✅ Ambil data obat
            $this->db->where('tempat_barang', 'klinik');
            $data['obat'] = $this->admin->getDataBarang('barang');

            $this->template->load('template/dashboard', 'rekammedik/add_diagnosa', $data);
        } else {
            $this->db->trans_start();

            // ✅ Tambahkan pemeriksaan_penunjang ke input
            $inputDiagnosa = [
                'rekammedik_id'        => $id_rekammedik,
                'dokter_id'            => $this->input->post('dokter_id'),
                'diagnosa'             => $this->input->post('diagnosa'),
                'pemeriksaan_penunjang' => $this->input->post('pemeriksaan_penunjang'), // baru
                'tindakan'             => $this->input->post('tindakan'),
                'resep_kode'           => $this->input->post('resep_kode')
            ];
            $this->rekammedik->insertDiagnosa($inputDiagnosa);
            $diagnosa_id = $this->db->insert_id();

            // ✅ Detail resep obat
            $obat_id         = $this->input->post('obat_id');
            $jumlah_obat     = $this->input->post('jumlah_obat');
            $dosis_obat      = $this->input->post('dosis_obat');
            $keterangan_obat = $this->input->post('keterangan_obat');

            if (!empty($obat_id)) {
                $detailResep = [];
                foreach ($obat_id as $i => $id) {
                    if (!empty($id)) {
                        $detailResep[] = [
                            'diagnosa_id'     => $diagnosa_id,
                            'obat_id'         => $id,
                            'jumlah_obat'     => $jumlah_obat[$i],
                            'dosis_obat'      => $dosis_obat[$i],
                            'keterangan_obat' => $keterangan_obat[$i],
                            'status_obat'     => 'Menunggu Konfirmasi'
                        ];
                    }
                }
                if (!empty($detailResep)) {
                    $this->rekammedik->insertDetailResepBatch($detailResep);
                }
            }

            // ✅ Update status rekam medis
            $this->rekammedik->updateStatus($id_rekammedik, 'diagnosa_status', 1);
            $this->db->trans_complete();

            if ($this->db->trans_status() === FALSE) {
                set_pesan('Terjadi kesalahan! Data gagal disimpan.', false);
            } else {
                set_pesan('Data Diagnosa dan Resep berhasil ditambahkan.');
            }

            redirect('rekammedik');
        }
    }


    // ==========================
    // EDIT DIAGNOSA
    // ==========================
    public function edit_diagnosa($id_rekammedik)
    {
        $data['title'] = "Data Rekam Medik | #SKAMANDA Medika";
        $data['id_rekammedik'] = $id_rekammedik;

        // === Fungsi bantu menghitung usia ===
        function hitung_usia2($tanggal_lahir)
        {
            if ($tanggal_lahir) {
                $birthdate = new DateTime($tanggal_lahir);
                $today = new DateTime('today');
                return $birthdate->diff($today)->y . ' tahun';
            }
            return '-';
        }

        // === Ambil data utama pasien ===
        $data['pasien'] = $this->rekammedik->getPasienByRekam($id_rekammedik);
        $data['anamnesa'] = $this->rekammedik->getAnamnesaByRekam($id_rekammedik);
        $data['ttv'] = $this->rekammedik->getTTVByRekam($id_rekammedik);
        $data['diagnosa'] = $this->rekammedik->getDiagnosaByRekamMedik($id_rekammedik);

        // Antisipasi jika belum ada diagnosa (null)
        if (!$data['diagnosa']) {
            set_pesan('Data diagnosa tidak ditemukan!', false);
            redirect('rekammedik');
        }

        // === Ambil detail resep (jika sudah ada) ===
        $data['detail_resep'] = $this->rekammedik->getDetailResepByDiagnosa($data['diagnosa']['id_diagnosa']);

        // === Cek user login ===
        $login_session = $this->session->userdata('login_session');
        $user_id = $login_session['user'];
        $role = $login_session['role'];

        // === Ambil data dokter ===
        if ($role == 'admin') {
            $this->db->where('role', 'dokter');
            $this->db->order_by('nama', 'ASC');
            $data['user'] = $this->admin->get('user');
        } else {
            $this->db->where('id_user', $user_id);
            $data['user'] = $this->admin->get('user');
        }

        $data['is_admin'] = ($role == 'admin');

        // === Ambil data obat dari gudang klinik ===
        $this->db->where('tempat_barang', 'klinik');
        $data['obat'] = $this->admin->getDataBarang('barang');

        // === Kirim ke view ===
        $this->template->load('template/dashboard', 'rekammedik/edit_diagnosa', $data);
    }



    // ==========================
    // UPDATE DIAGNOSA
    // ==========================
    public function update_diagnosa()
    {
        $this->form_validation->set_rules('diagnosa', 'Diagnosa', 'required');
        $this->form_validation->set_rules('tindakan', 'Tindakan', 'required');
        $this->form_validation->set_rules('dokter_id', 'Dokter', 'required');

        $id_rekammedik = $this->input->post('id_rekammedik');
        $id_diagnosa   = $this->input->post('id_diagnosa');

        if ($this->form_validation->run() == false) {
            $this->edit_diagnosa($id_rekammedik);
            return;
        }

        $resep_kode = $this->input->post('resep_kode') ?: 'RSP-' . date('YmdHis');
        $obat_id         = $this->input->post('obat_id');
        $jumlah_obat     = $this->input->post('jumlah_obat');
        $dosis_obat      = $this->input->post('dosis_obat');
        $keterangan_obat = $this->input->post('keterangan_obat');
        $status_obat     = $this->input->post('status_obat');

        // pastikan tidak ada status Menunggu Konfirmasi
        if (!empty($status_obat)) {
            foreach ($status_obat as $st) {
                if (strtolower(trim($st)) === 'menunggu konfirmasi') {
                    set_pesan('Ubah status obat "Menunggu Konfirmasi" sebelum menyimpan.', false);
                    $this->edit_diagnosa($id_rekammedik);
                    return;
                }
            }
        }

        $this->db->trans_start();

        // ============ UPDATE DATA DIAGNOSA ============
        $this->rekammedik->updateDiagnosa($id_diagnosa, [
            'dokter_id'             => $this->input->post('dokter_id'),
            'diagnosa'              => $this->input->post('diagnosa'),
            'tindakan'              => $this->input->post('tindakan'),
            'pemeriksaan_penunjang' => $this->input->post('pemeriksaan_penunjang'),
            'update_at'             => date('Y-m-d H:i:s')
        ]);
        $this->rekammedik->updateStatus($id_rekammedik, 'diagnosa_status', 2);

        // ============ RESEP ============
        $resepLama = $this->rekammedik->getDetailResepByDiagnosa($id_diagnosa);
        $this->rekammedik->deleteDetailResep($id_diagnosa);

        if (empty($obat_id)) {
            $this->db->trans_complete();
            set_pesan('Diagnosa diperbarui tanpa resep.');
            redirect('rekammedik');
            return;
        }

        // simpan resep baru
        $batchInsert = [];
        foreach ($obat_id as $i => $oid) {
            if (!$oid) continue;
            $batchInsert[] = [
                'diagnosa_id'     => $id_diagnosa,
                'obat_id'         => $oid,
                'jumlah_obat'     => intval($jumlah_obat[$i] ?? 0),
                'dosis_obat'      => $dosis_obat[$i] ?? '',
                'keterangan_obat' => $keterangan_obat[$i] ?? '',
                'status_obat'     => $status_obat[$i] ?? 'Menunggu Konfirmasi',
                'resep_kode'      => $resep_kode,
                'created_at'      => date('Y-m-d H:i:s')
            ];
        }
        if ($batchInsert) $this->rekammedik->insertDetailResepBatch($batchInsert);

        // ============ PENJUALAN ============
        $user_id = $this->session->userdata('login_session')['user'];
        $penjualan = $this->db->get_where('penjualan', ['nota_penjualan' => $resep_kode])->row_array();
        if (!$penjualan) {
            $this->db->insert('penjualan', [
                'tanggal_penjualan'     => date('Y-m-d'),
                'nota_penjualan'        => $resep_kode,
                'keterangan_penjualan'  => 'Resep #' . $id_diagnosa,
                'total_harga_penjualan' => 0,
                'user_id'               => $user_id,
                'time_stamp'            => date('Y-m-d H:i:s')
            ]);
            $penjualan_id = $this->db->insert_id();
        } else $penjualan_id = $penjualan['id_penjualan'];

        // buat map resep lama untuk perbandingan cepat
        $mapLama = [];
        foreach ($resepLama as $r) $mapLama[$r['obat_id']] = strtolower($r['status_obat']);

        // ============ LOOP OBAT ============
        foreach ($obat_id as $i => $oid) {
            if (!$oid) continue;
            $statusBaru = strtolower(trim($status_obat[$i]));
            $jumlahBaru = intval($jumlah_obat[$i]);
            if ($jumlahBaru <= 0) continue;

            $statusLama = $mapLama[$oid] ?? '';

            // data barang
            $barang = $this->db->get_where('barang', ['id_barang' => $oid])->row_array();
            if (!$barang) {
                $this->db->trans_rollback();
                set_pesan('Barang tidak ditemukan: ' . $oid, false);
                redirect('rekammedik/edit_diagnosa/' . $id_rekammedik);
                return;
            }
            $harga_jual = floatval($barang['harga_terkini']);

            // === STATUS BERUBAH ===
            if ($statusLama === 'farmasi' && $statusBaru === 'beli di luar') {
                // kembalikan semua stok batch yang sudah terjual
                $details = $this->db->get_where('detail_penjualan', [
                    'penjualan_id' => $penjualan_id,
                    'barang_id' => $oid
                ])->result_array();

                foreach ($details as $d) {
                    $qty = intval($d['jumlah_penjualan']);
                    $this->db->set('jumlah_sisa', 'jumlah_sisa + ' . $qty, false)
                        ->where('id_batch', $d['batch_id'])->update('batch_barang');
                    $this->db->set('stok', 'stok + ' . $qty, false)
                        ->where('id_barang', $oid)->update('barang');
                }
                $this->db->delete('detail_penjualan', [
                    'penjualan_id' => $penjualan_id,
                    'barang_id' => $oid
                ]);
            }

            // === TAMBAH STOK FARMASI ===
            if (in_array($statusBaru, ['farmasi']) && $statusLama !== 'farmasi') {
                $sisa = $jumlahBaru;
                while ($sisa > 0) {
                    $batch = $this->db
                        ->where('barang_id', $oid)
                        ->where('jumlah_sisa >', 0)
                        ->order_by('expired_date', 'ASC') // FEFO
                        ->limit(1)
                        ->get('batch_barang')->row_array();

                    if (!$batch) {
                        $this->db->trans_rollback();
                        set_pesan('Stok tidak cukup untuk ' . $barang['nama_barang'], false);
                        redirect('rekammedik/edit_diagnosa/' . $id_rekammedik);
                        return;
                    }

                    $take = min($sisa, intval($batch['jumlah_sisa']));
                    $this->db->insert('detail_penjualan', [
                        'penjualan_id'             => $penjualan_id,
                        'barang_id'                => $oid,
                        'batch_id'                 => $batch['id_batch'],
                        'jumlah_penjualan'         => $take,
                        'harga_penjualan'          => $harga_jual,
                        'subtotal_harga_penjualan' => $harga_jual * $take,
                        'user_id'                  => $user_id,
                        'time_stamp'               => date('Y-m-d H:i:s')
                    ]);

                    $this->db->set('jumlah_sisa', 'jumlah_sisa - ' . $take, false)
                        ->where('id_batch', $batch['id_batch'])->update('batch_barang');
                    $this->db->set('stok', 'stok - ' . $take, false)
                        ->where('id_barang', $oid)->update('barang');

                    $sisa -= $take;
                }
            }

            // === TETAP FARMASI (UBAH JUMLAH) ===
            if ($statusLama === 'farmasi' && $statusBaru === 'farmasi') {
                // hitung jumlah sebelumnya
                $qtyLama = $this->db->select_sum('jumlah_penjualan')->get_where('detail_penjualan', [
                    'penjualan_id' => $penjualan_id,
                    'barang_id' => $oid
                ])->row()->jumlah_penjualan ?? 0;
                $selisih = $jumlahBaru - intval($qtyLama);

                if ($selisih > 0) {
                    // tambahkan (FEFO)
                    $sisa = $selisih;
                    while ($sisa > 0) {
                        $batch = $this->db
                            ->where('barang_id', $oid)
                            ->where('jumlah_sisa >', 0)
                            ->order_by('expired_date', 'ASC')
                            ->limit(1)->get('batch_barang')->row_array();

                        if (!$batch) {
                            $this->db->trans_rollback();
                            set_pesan('Stok tidak cukup untuk ' . $barang['nama_barang'], false);
                            redirect('rekammedik/edit_diagnosa/' . $id_rekammedik);
                            return;
                        }

                        $take = min($sisa, intval($batch['jumlah_sisa']));
                        $this->db->insert('detail_penjualan', [
                            'penjualan_id'             => $penjualan_id,
                            'barang_id'                => $oid,
                            'batch_id'                 => $batch['id_batch'],
                            'jumlah_penjualan'         => $take,
                            'harga_penjualan'          => $harga_jual,
                            'subtotal_harga_penjualan' => $harga_jual * $take,
                            'user_id'                  => $user_id,
                            'time_stamp'               => date('Y-m-d H:i:s')
                        ]);
                        $this->db->set('jumlah_sisa', 'jumlah_sisa - ' . $take, false)
                            ->where('id_batch', $batch['id_batch'])->update('batch_barang');
                        $this->db->set('stok', 'stok - ' . $take, false)
                            ->where('id_barang', $oid)->update('barang');
                        $sisa -= $take;
                    }
                } elseif ($selisih < 0) {
                    // kembalikan stok (LIFO)
                    $toReturn = abs($selisih);
                    $details = $this->db->order_by('id_detail_penjualan', 'DESC')
                        ->get_where('detail_penjualan', [
                            'penjualan_id' => $penjualan_id,
                            'barang_id' => $oid
                        ])->result_array();

                    foreach ($details as $d) {
                        if ($toReturn <= 0) break;
                        $qtyRow = intval($d['jumlah_penjualan']);
                        $takeBack = min($toReturn, $qtyRow);

                        $this->db->set('jumlah_sisa', 'jumlah_sisa + ' . $takeBack, false)
                            ->where('id_batch', $d['batch_id'])->update('batch_barang');
                        $this->db->set('stok', 'stok + ' . $takeBack, false)
                            ->where('id_barang', $oid)->update('barang');

                        if ($takeBack == $qtyRow)
                            $this->db->delete('detail_penjualan', ['id_detail_penjualan' => $d['id_detail_penjualan']]);
                        else
                            $this->db->set('jumlah_penjualan', $qtyRow - $takeBack)
                                ->set('subtotal_harga_penjualan', $harga_jual * ($qtyRow - $takeBack))
                                ->where('id_detail_penjualan', $d['id_detail_penjualan'])->update('detail_penjualan');

                        $toReturn -= $takeBack;
                    }
                }
            }
        }

        // 🧭 Update expired_date_terdekat setelah stok berubah
        $this->rekammedik->updateExpiredTerdekat($oid);

        // ==================== SINKRONISASI: HAPUS OBAT DI VIEW ====================
        $obatBaru = array_filter($obat_id);
        $obatLamaIds = array_keys($mapLama);
        $hapusIds = array_diff($obatLamaIds, $obatBaru);

        foreach ($hapusIds as $hapusOid) {
            $details = $this->db->get_where('detail_penjualan', [
                'penjualan_id' => $penjualan_id,
                'barang_id' => $hapusOid
            ])->result_array();

            foreach ($details as $d) {
                $qty = intval($d['jumlah_penjualan']);
                $this->db->set('jumlah_sisa', 'jumlah_sisa + ' . $qty, false)
                    ->where('id_batch', $d['batch_id'])->update('batch_barang');
                $this->db->set('stok', 'stok + ' . $qty, false)
                    ->where('id_barang', $hapusOid)->update('barang');
            }

            $this->db->delete('detail_penjualan', [
                'penjualan_id' => $penjualan_id,
                'barang_id' => $hapusOid
            ]);
        }

        // ============ TOTAL PENJUALAN ============
        $total = $this->db->select_sum('subtotal_harga_penjualan', 'total')
            ->get_where('detail_penjualan', ['penjualan_id' => $penjualan_id])->row()->total ?? 0;
        if ($total > 0)
            $this->db->update('penjualan', ['total_harga_penjualan' => $total], ['id_penjualan' => $penjualan_id]);
        else
            $this->db->delete('penjualan', ['id_penjualan' => $penjualan_id]);

        $this->db->trans_complete();

        if ($this->db->trans_status() === false)
            set_pesan('Terjadi kesalahan, data gagal diperbarui.', false);
        else
            set_pesan('Diagnosa & stok berhasil diperbarui (FEFO).');

        redirect('rekammedik');
    }



    public function lihat_diagnosa($id_rekammedik)
    {
        $data['title'] = "Data Rekam Medik | #SKAMANDA Medika";
        $data['id_rekammedik'] = $id_rekammedik;
        $data['diagnosa'] = $this->rekammedik->getDiagnosaByRekamMedik($id_rekammedik);
        // === Ambil data utama pasien ===
        $data['pasien'] = $this->rekammedik->getPasienByRekam($id_rekammedik);
        $data['anamnesa'] = $this->rekammedik->getAnamnesaByRekam($id_rekammedik);
        $data['ttv'] = $this->rekammedik->getTTVByRekam($id_rekammedik);
        $data['detail_resep'] = $this->rekammedik->getDetailResepByDiagnosa($data['diagnosa']['id_diagnosa']);

        // === Fungsi bantu menghitung usia ===
        function hitung_usia3($tanggal_lahir)
        {
            if ($tanggal_lahir) {
                $birthdate = new DateTime($tanggal_lahir);
                $today = new DateTime('today');
                return $birthdate->diff($today)->y . ' tahun';
            }
            return '-';
        }

        $login_session = $this->session->userdata('login_session');
        $user_id = $login_session['user'];
        $role = $login_session['role'];

        // Ambil data dokter dan obat
        if ($role == 'admin') {
            $this->db->where('role', 'dokter');
            $this->db->order_by('nama', 'ASC');
            $data['user'] = $this->admin->get('user');
        } else {
            $this->db->where('id_user', $user_id);
            $data['user'] = $this->admin->get('user');
        }

        $data['is_admin'] = ($role == 'admin');
        $this->db->where('tempat_barang', 'klinik');
        $data['obat'] = $this->admin->getDataBarang('barang');

        $this->template->load('template/dashboard', 'rekammedik/lihat_diagnosa', $data);
    }

    public function lihat_modal_diagnosa($id_rekammedik)
    {
        $data['title'] = "Data Rekam Medik | #SKAMANDA Medika";
        $data['id_rekammedik'] = $id_rekammedik;
        $data['diagnosa'] = $this->rekammedik->getDiagnosaByRekamMedik($id_rekammedik);
        // === Ambil data utama pasien ===
        $data['pasien'] = $this->rekammedik->getPasienByRekam($id_rekammedik);
        $data['anamnesa'] = $this->rekammedik->getAnamnesaByRekam($id_rekammedik);
        $data['ttv'] = $this->rekammedik->getTTVByRekam($id_rekammedik);
        $data['detail_resep'] = $this->rekammedik->getDetailResepByDiagnosa($data['diagnosa']['id_diagnosa']);

        // === Fungsi bantu menghitung usia ===
        function hitung_usia5($tanggal_lahir)
        {
            if ($tanggal_lahir) {
                $birthdate = new DateTime($tanggal_lahir);
                $today = new DateTime('today');
                return $birthdate->diff($today)->y . ' tahun';
            }
            return '-';
        }

        $login_session = $this->session->userdata('login_session');
        $user_id = $login_session['user'];
        $role = $login_session['role'];

        // Ambil data dokter dan obat
        if ($role == 'admin') {
            $this->db->where('role', 'dokter');
            $this->db->order_by('nama', 'ASC');
            $data['user'] = $this->admin->get('user');
        } else {
            $this->db->where('id_user', $user_id);
            $data['user'] = $this->admin->get('user');
        }

        $data['is_admin'] = ($role == 'admin');
        $this->db->where('tempat_barang', 'klinik');
        $data['obat'] = $this->admin->getDataBarang('barang');

        $this->load->view('rekammedik/lihat_modal_diagnosa', $data);
    }

    // DETAIL
    // DETAIL
    // DETAIL
    // Tambahkan ke dalam class Rekammedik (mis. di bawah method getData atau di bagian bawah file)
    public function detail($nomor_rm = null)
    {
        // halaman awal untuk input nomor_rm. Jika $nomor_rm diberikan, tampilkan tabel yang memanggil getDataByRM/$nomor_rm
        $data['title'] = "Detail Rekam Medik | #SKAMANDA Medika";
        $data['nomor_rm'] = $nomor_rm;

        // Fungsi bantu usia (sama seperti di getData)
        function hitung_usia6($tanggal_lahir)
        {
            if ($tanggal_lahir) {
                $birthdate = new DateTime($tanggal_lahir);
                $today = new DateTime('today');
                return $birthdate->diff($today)->y . ' tahun';
            }
            return '-';
        }

        // jika nomor_rm diberikan, ambil data pasien (opsional, untuk menampilkan nama pasien)
        if ($nomor_rm) {
            $data['pasien'] = $this->rekammedik->getPasienByRM($nomor_rm);
        } else {
            $data['pasien'] = null;
        }

        $this->template->load('template/dashboard', 'rekammedik/detail', $data);
    }

    public function getDataByRM($nomor_rm = null)
    {
        // hanya untuk AJAX
        // if (!$this->input->is_ajax_request()) {
        //     show_404();
        // }

        // Validasi
        if (!$nomor_rm) {
            echo json_encode(['error' => 'Nomor RM tidak boleh kosong']);
            return;
        }

        // Fungsi bantu usia (sama seperti di getData)
        function hitung_usia4($tanggal_lahir)
        {
            if ($tanggal_lahir) {
                $birthdate = new DateTime($tanggal_lahir);
                $today = new DateTime('today');
                return $birthdate->diff($today)->y . ' tahun';
            }
            return '-';
        }

        // Ambil data kunjungan berdasarkan nomor_rm
        // Jika model Anda belum punya method, saya sertakan contoh implementasi model di bawah.
        $data = $this->rekammedik->getKunjunganByRM($nomor_rm);

        // Jika tidak ada data atau kesalahan
        if ($data === false) {
            echo json_encode(['error' => 'Terjadi kesalahan mengambil data.']);
            return;
        }

        // Format data sama seperti getData()
        foreach ($data as &$item) {
            // pastikan field-field ada di result set model: tanggal_kunjungan, nama_poliklinik, nama (dokter), nama_pasien, tanggal_lahir, nomor_rm, anamnesa_status, ttv_status, diagnosa_status, id_rekammedik
            $item['tanggal_kunjungan'] = mediumdate_indo($item['tanggal_kunjungan']);
            $item['dokter_poliklinik'] = $item['nama_poliklinik'] . '<br><span class="text-muted small">' . $item['nama'] . '</span>';

            $item['detail_diagnosa'] = '
                <div class="diagnosa-detail">
                    <strong>Diagnosa:</strong> ' . htmlspecialchars($item['diagnosa'] ?? '-', ENT_QUOTES, 'UTF-8') . '<br>
                    <span class="text-muted small d-block">
                        <em>Pemeriksaan Penunjang:</em> ' . htmlspecialchars(!empty($item['pemeriksaan_penunjang']) ? $item['pemeriksaan_penunjang'] : '-', ENT_QUOTES, 'UTF-8') . '
                    </span>
                    <span class="text-muted small d-block">
                        <em>Tindakan:</em> ' . htmlspecialchars(!empty($item['tindakan']) ? $item['tindakan'] : '-', ENT_QUOTES, 'UTF-8') . '
                    </span>
                </div>
            ';

            $item['nama_pasien'] = '<strong>' . $item['nama_pasien'] . '</strong>' .
                '<br><span class="text-muted small">' . mediumdate_indo($item['tanggal_lahir']) .
                ' (' . hitung_usia4($item['tanggal_lahir']) . ')' . '</span>' .
                '<br><span class="text-muted small">' . $item['nomor_rm'] . '</span>';


            // Diagnosa button (sama logika seperti getData)
            if ($item['diagnosa_status'] == null) {
                $item['diagnosa_status'] = '<a href="' . base_url("rekammedik/add_diagnosa/") . $item['id_rekammedik'] . '" 
                                class="btn btn-sm btn-info btn-icon-split">
                                    <span class="icon">
                                        <i class="bx bx-layer-plus"></i>
                                    </span>
                                    <span class="text">Tambah</span>
                                </a>';
            } elseif ($item['diagnosa_status'] == 1) {
                $item['diagnosa_status'] = '<a href="' . base_url("rekammedik/edit_diagnosa/") . $item['id_rekammedik'] . '" 
                                class="btn btn-sm btn-warning btn-icon-split">
                                    <span class="icon">
                                        <i class="bx bx-check-circle"></i>
                                    </span>
                                    <span class="text">Konfirmasi</span>
                                </a>';
            } else {
                $item['diagnosa_status'] = '
    <button class="btn btn-sm btn-success btn-icon-split btnLihatDiagnosa" 
            data-id="' . $item['id_rekammedik'] . '">
        <span class="icon"><i class="bx bx-show"></i></span>
        <span class="text">Lihat</span>
    </button>';
            }

            $item['edit_url'] = base_url('rekammedik/edit/') . $item['id_rekammedik'];
            $item['delete_url'] = base_url('rekammedik/delete/') . $item['id_rekammedik'];
        }

        echo json_encode($data);
    }
}
