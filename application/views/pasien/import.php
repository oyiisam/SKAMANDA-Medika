<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm">

                    <!-- Header -->
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-upload"></i> Import Data Pasien
                        </h5>
                        <a href="<?= base_url('pasien') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bx bx-rotate-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>

                        <!-- Catatan -->
                        <div class="alert alert-secondary text-center d-flex flex-column flex-md-row align-items-center justify-content-center gap-2 p-3" role="alert">
                            <div class="d-flex align-items-center mb-2 mb-md-0">
                                <i class="bx bx-info-circle fs-4 me-2 text-warning"></i>
                                <span class="fw-semibold">
                                    Isi data sesuai petunjuk template!
                                </span>
                            </div>
                            <a href="<?= base_url('upload/template/importpasien.xlsx') ?>" class="btn btn-sm btn-outline-warning">
                                <i class="bx bx-cloud-download"></i> Unduh Template
                            </a>
                        </div>


                        <!-- Upload File -->
                        <div class="text-center my-4">
                            <?= form_open_multipart('pasien/preview'); ?>
                            <div class="row justify-content-center">
                                <div class="col-md-6">
                                    <div class="form-floating mb-3">
                                        <input type="file" name="upload_file" id="upload_file" class="form-control" required>
                                        <label for="upload_file">Pilih File Excel</label>
                                    </div>
                                    <button name="preview" type="submit" class="btn btn-sm btn-primary">
                                        <i class="bx bx-search-alt-2"></i> Lihat Pratinjau
                                    </button>
                                </div>
                            </div>
                            <?= form_close(); ?>
                        </div>

                        <!-- Preview -->
                        <?php if (isset($_POST['preview'])) : ?>
                            <hr>
                            <h5 class="text-center text-info fw-bold mb-3">
                                <i class="bx bx-table"></i> Pratinjau Import Data
                            </h5>

                            <div class="table-responsive">
                                <table class="table table-striped table-hover align-middle text-center" id="dataTable_import">
                                    <thead class="table-light">
                                        <tr>
                                            <th>No</th>
                                            <th>Nomor RM</th>
                                            <th>Nama</th>
                                            <th>L/P</th>
                                            <th>Tempat Lahir</th>
                                            <th>Tanggal Lahir</th>
                                            <th>Agama</th>
                                            <th>Alamat</th>
                                            <th>Nama Ibu Kandung</th>
                                            <th>Nomor Telp/WA</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $status = true;
                                        if (empty($import)) {
                                            echo '<tr><td colspan="10" class="text-center text-muted fst-italic py-4">Data kosong! Pastikan file sudah diisi sesuai format template.</td></tr>';
                                        } else {
                                            $no = 1;
                                            foreach ($import as $data) :
                                                $is_invalid = fn($v) => $v == null ? 'table-danger fw-semibold text-danger' : '';
                                        ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td class="<?= $is_invalid($data['nomor_rm']); ?>"><?= $data['nomor_rm'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['nama_pasien']); ?>"><?= $data['nama_pasien'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['jenis_kelamin']); ?>"><?= $data['jenis_kelamin'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['tempat_lahir']); ?>"><?= $data['tempat_lahir'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['tanggal_lahir']); ?>"><?= $data['tanggal_lahir'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['agama']); ?>"><?= $data['agama'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['alamat']); ?>"><?= $data['alamat'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['nama_orangtua']); ?>"><?= $data['nama_orangtua'] ?? 'BELUM DIISI'; ?></td>
                                                    <td class="<?= $is_invalid($data['no_telp']); ?>"><?= $data['no_telp'] ?? 'BELUM DIISI'; ?></td>
                                                </tr>
                                        <?php
                                                if (in_array(null, $data, true)) $status = false;
                                            endforeach;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Tombol Import -->
                            <?php if ($status) : ?>
                                <?= form_open('pasien/do_import', null, ['data' => json_encode($import)]); ?>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        <i class="bx bx-cloud-upload"></i> Import Data
                                    </button>
                                </div>
                                <?= form_close(); ?>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>