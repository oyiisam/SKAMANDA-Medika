<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;

class Pasien extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (is_user() || is_tf() || is_lk() || is_mm() || is_dokter()) {
            set_pesan('Anda tidak memiliki akses!', false);
            redirect('dashboard');
        }

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "Data Pasien | #SKAMANDA Medika";
        $this->template->load('template/dashboard', 'pasien/data', $data);
    }

    public function getDataPasien()
    {
        // Verifikasi permintaan AJAX dan keamanan
        if (!$this->input->is_ajax_request()) {
            show_404(); // Tampilkan halaman 404 jika bukan permintaan AJAX
        }

        $nama_tabel = 'pasien'; // Ganti dengan nama tabel yang sesuai

        // Cek jika tabel ada
        if (!$this->db->table_exists($nama_tabel)) {
            // Kirim pesan error jika tabel tidak ada
            echo json_encode(['error' => 'Tabel tidak ditemukan. Silahkan hubungi Admin!']);
            return;
        }

        // Ambil data dari tabel
        $data = $this->admin->getData($nama_tabel);

        // Tambahkan URL dinamis ke setiap item
        foreach ($data as &$item) {
            // Mengambil tanggal saja dari timestamp
            $item['pembaruan'] = mediumdate_indo(date('Y-m-d', strtotime($item['update_at'])));
            $item['golongan_darah'] = $item['golongan_darah'] ?? 'Tidak Diketahui';
            $item['tempat_tanggal_lahir'] = $item['tempat_lahir'] . ', ' .  mediumdate_indo($item['tanggal_lahir']);
            $item['no_telp'] = formatNomorTelepon($item['no_telp']);
            $item['edit_url'] = base_url('pasien/edit/') . $item['id_pasien']; // URL untuk edit
            $item['delete_url'] = base_url('pasien/delete/') . $item['id_pasien']; // URL untuk delete
        }

        // Kirim data ke DataTables
        echo json_encode($data);
    }

    private function _validasi()
    {
        $this->form_validation->set_rules('nama_pasien', 'Nama Pasien', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('nama_orangtua', 'Nama Orang Tua', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim|numeric', [
            'required' => '*{field} harus diisi.',
            'trim' => '',
            'numeric' => '*{field} harus berupa angka.'
        ]);
        $this->form_validation->set_rules('nomor_rm', 'Nomor RM', 'required|trim', [
            'required' => '*{field} harus diisi.',
            'trim' => ''
        ]);
    }

    public function add()
    {
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Pasien | #SKAMANDA Medika";
            // Generate Nota Pasien
            $kode = 'RM-' . date('dmy-');
            $kode_terakhir = $this->admin->getMax('pasien', 'nomor_rm', $kode);
            $kode_tambah = substr($kode_terakhir, -3, 3);
            $kode_tambah++;
            $number = str_pad($kode_tambah, 3, '0', STR_PAD_LEFT);
            $data['nomor_rm'] = $kode . $number;

            $this->template->load('template/dashboard', 'pasien/add', $data);
        } else {
            $input = $this->input->post(null, true); // Tangkap seluruh input form
            $input['no_telp'] = '+62' . $input['no_telp']; // Tambahkan awalan +62 pada nomor telepon
            // Tangani nilai 'tidak_diketahui' pada golongan_darah agar tersimpan sebagai null di DB
            if (isset($input['golongan_darah']) && $input['golongan_darah'] === 'tidak_diketahui') {
                $input['golongan_darah'] = null;
            }
            $insert = $this->admin->insert('pasien', $input); // Insert data ke database
            if ($insert) {
                set_pesan('Data berhasil disimpan.');
                redirect('pasien');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('pasien/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Data Pasien | #SKAMANDA Medika";
            $data['pasien'] = $this->admin->get('pasien', ['id_pasien' => $id]); // Ambil data murid yang akan diedit berdasarkan ID
            $this->template->load('template/dashboard', 'pasien/edit', $data); // Arahkan ke view edit dengan data yang didapatkan
        } else {
            $input = $this->input->post(null, true); // Tangkap seluruh input form
            $input['no_telp'] = '+62' . $input['no_telp']; // Tambahkan awalan +62 pada nomor telepon
            if (isset($input['golongan_darah']) && $input['golongan_darah'] === 'tidak_diketahui') {
                $input['golongan_darah'] = null;
            }
            $update = $this->admin->update('pasien', 'id_pasien', $id, $input); // Lakukan update data pasien berdasarkan ID
            if ($update) {
                set_pesan('Data berhasil disimpan.');
                redirect('pasien');
            } else {
                set_pesan('Data gagal disimpan.', false);
                redirect('pasien/edit/' . $id);
            }
        }
    }

    public function import($import_data = null)
    {
        cek_login();
        if (!is_admin() && !is_klinik()) {
            set_pesan('Maaf, Anda tidak punya akses!', false);
            redirect('dashboard');
        }
        $data['title'] = "Data Pasien | #SKAMANDA Medika";
        if ($import_data != null) $data['import'] = $import_data;
        $this->template->load('template/dashboard', 'pasien/import', $data);
    }

    public function preview()
    {
        cek_login();
        if (!is_admin() && !is_klinik()) {
            set_pesan('Maaf, Anda tidak punya akses!', false);
            redirect('dashboard');
        }
        $config['upload_path']      = './upload/'; //folder upload file import
        $config['allowed_types']    = 'xls|xlsx|csv';
        $config['max_size']         = 0;
        $config['encrypt_name']     = true;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('upload_file')) {
            set_pesan('Maaf, Anda belum memilih dokumen atau format tidak didukung!', FALSE);
            redirect('pasien/import');
        } else {
            $file = $this->upload->data('full_path');
            $ext = $this->upload->data('file_ext');
            switch ($ext) {
                case '.xlsx':
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    break;
                case '.xls':
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
                    break;
                case '.csv':
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
                    break;
                default:
                    echo "Format tidak didukung.";
                    die;
            }
            $spreadsheet = $reader->load($file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();
            $data = [];
            for ($i = 1; $i < count($sheetData); $i++) {
                $data[] = [
                    'nomor_rm'          => $sheetData[$i][0], // Kolom A
                    'nama_pasien'       => $sheetData[$i][1], // Kolom B
                    'jenis_kelamin'     => $sheetData[$i][2], // Kolom C
                    'tempat_lahir'      => $sheetData[$i][3], // Kolom D
                    'tanggal_lahir'     => $sheetData[$i][4], // Kolom e
                    'agama'             => $sheetData[$i][5], // Kolom f
                    'alamat'            => $sheetData[$i][6], // Kolom g
                    'nama_orangtua'     => $sheetData[$i][7], // Kolom h
                    'no_telp'           => $sheetData[$i][8], // Kolom i
                ];
            }
            unlink($file);
            $this->import($data);
        }
    }

    public function do_import()
    {
        cek_login();
        if (!is_admin() && !is_klinik()) {
            set_pesan('Maaf, Anda tidak punya akses!', false);
            redirect('dashboard');
        }

        $input = json_decode($this->input->post('data', true));

        // Mengubah array objek menjadi array asosiatif
        $data = array_map(function ($d) {
            return [
                'nomor_rm'        => $d->nomor_rm,
                'nama_pasien'     => $d->nama_pasien,
                'jenis_kelamin'   => $d->jenis_kelamin,
                'tempat_lahir'    => $d->tempat_lahir,
                'tanggal_lahir'   => $d->tanggal_lahir,
                'agama'           => $d->agama,
                'alamat'          => $d->alamat,
                'nama_orangtua'   => $d->nama_orangtua,
                'no_telp'         => $d->no_telp,
            ];
        }, $input);

        // Validasi duplikasi nomor_rm dalam file Excel
        $rm_counts = array_count_values(array_column($data, 'nomor_rm')); // Hitung jumlah kemunculan setiap nomor_rm
        $duplicate_excel_rm = array_keys(array_filter($rm_counts, function ($count) {
            return $count > 1; // Ambil nomor_rm yang muncul lebih dari 1 kali
        }));

        if (!empty($duplicate_excel_rm)) {
            $duplicate_list = implode(', ', $duplicate_excel_rm);
            set_pesan("Data gagal diimpor. Nomor RM berikut duplikasi dalam file Excel: $duplicate_list", false);
            redirect('pasien/import');
        }

        // Ambil semua nomor_rm yang sudah ada di database
        $existing_rm = $this->db->select('nomor_rm')->from('pasien')->get()->result_array();
        $existing_rm = array_column($existing_rm, 'nomor_rm'); // Hanya ambil nilai `nomor_rm`

        // Validasi untuk menemukan nomor_rm yang sudah ada di database
        $duplicate_db_rm = [];
        $valid_data = [];
        foreach ($data as $row) {
            if (in_array($row['nomor_rm'], $existing_rm)) {
                $duplicate_db_rm[] = $row['nomor_rm'];
            } else {
                $valid_data[] = $row;
            }
        }

        // Jika ada nomor_rm yang duplikasi di database, kirimkan pesan error
        if (!empty($duplicate_db_rm)) {
            $duplicate_list = implode(', ', $duplicate_db_rm); // Gabungkan nomor_rm yang duplikasi
            set_pesan("Data gagal diimpor. Nomor RM berikut sudah ada di database: $duplicate_list", false);
            redirect('pasien/import');
        }

        // Jika tidak ada data yang valid untuk diimpor
        if (empty($valid_data)) {
            set_pesan('Tidak ada data yang valid untuk diimpor.', false);
            redirect('pasien/import');
        }

        // Melakukan insert data valid ke database
        $insert = $this->admin->insert_ignore('pasien', $valid_data);

        // Mengatur pesan berdasarkan hasil insert
        if ($insert) {
            set_pesan('Data berhasil disimpan', true);
        } else {
            set_pesan('Data gagal disimpan', false);
        }

        redirect('pasien');
    }



    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('pasien', 'id_pasien', $id)) {
            set_pesan('Data berhasil dihapus.');
        } else {
            set_pesan('Data gagal dihapus.', false);
        }
        redirect('pasien');
    }
}
