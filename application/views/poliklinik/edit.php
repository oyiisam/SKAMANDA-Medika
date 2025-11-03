<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div
                        class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Data Poliklinik
                        </h5>
                        <a href="<?= base_url('poliklinik') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>

                        <!-- Floating input -->
                        <div class="form-floating mb-4">
                            <input
                                type="text"
                                class="form-control"
                                id="nama_poliklinik"
                                name="nama_poliklinik"
                                placeholder="Nama Poliklinik"
                                value="<?= set_value('nama_poliklinik', $poliklinik['nama_poliklinik']); ?>"
                                required autofocus>
                            <label for="nama_poliklinik">Nama Poliklinik</label>
                            <?= form_error('nama_poliklinik', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="form-floating mb-4">
                            <textarea
                                class="form-control"
                                placeholder="Keterangan"
                                id="keterangan_poliklinik"
                                name="keterangan_poliklinik"
                                style="height: 100px"
                                required><?= set_value('keterangan_poliklinik', $poliklinik['keterangan_poliklinik']); ?></textarea>
                            <label for="keterangan_poliklinik">Keterangan</label>
                            <?= form_error('keterangan_poliklinik', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="reset" class="btn btn-outline-secondary btn-sm">
                                <i class='bx bx-reset'></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class='bx bx-save'></i> Simpan Perubahan
                            </button>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>