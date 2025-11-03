<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-success text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Lokasi Barang
                        </h5>
                        <a href="<?= base_url('lokasi') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>

                        <!-- Hidden tempat_lokasi -->
                        <div class="mb-3" hidden>
                            <select name="tempat_lokasi" id="tempat_lokasi" class="form-select" required>
                                <option value="Klinik" <?= $lokasi['tempat_lokasi'] == 'Klinik' ? 'selected' : ''; ?>>Klinik</option>
                                <option value="Layanan Kesehatan" <?= $lokasi['tempat_lokasi'] == 'Layanan Kesehatan' ? 'selected' : ''; ?>>Layanan Kesehatan</option>
                                <option value="Multimedia" <?= $lokasi['tempat_lokasi'] == 'Multimedia' ? 'selected' : ''; ?>>Multimedia</option>
                                <option value="Teknologi Farmasi" <?= $lokasi['tempat_lokasi'] == 'Teknologi Farmasi' ? 'selected' : ''; ?>>Teknologi Farmasi</option>
                            </select>
                            <?= form_error('tempat_lokasi', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Floating Input: Nama Lokasi -->
                        <div class="form-floating mb-4">
                            <input
                                value="<?= set_value('nama_lokasi', $lokasi['nama_lokasi']); ?>"
                                name="nama_lokasi"
                                id="nama_lokasi"
                                type="text"
                                class="form-control"
                                placeholder="Lokasi Barang"
                                required
                                autofocus>
                            <label for="nama_lokasi">Lokasi Barang</label>
                            <?= form_error('nama_lokasi', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Floating Input: Kode Lokasi -->
                        <div class="form-floating mb-4">
                            <input
                                value="<?= set_value('kode_lokasi', $lokasi['kode_lokasi']); ?>"
                                name="kode_lokasi"
                                id="kode_lokasi"
                                type="text"
                                class="form-control"
                                placeholder="Kode Lokasi"
                                required>
                            <label for="kode_lokasi">Kode Lokasi</label>
                            <?= form_error('kode_lokasi', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary btn-sm">
                                <i class='bx bx-reset'></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class='bx bx-save'></i> Simpan
                            </button>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>