<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-success text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Jenis Barang
                        </h5>
                        <a href="<?= base_url('jenis') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>

                        <!-- Floating Input -->
                        <div class="form-floating mb-4">
                            <input
                                type="text"
                                class="form-control"
                                id="nama_jenis"
                                name="nama_jenis"
                                placeholder="Jenis Barang"
                                value="<?= set_value('nama_jenis', $jenis['nama_jenis']); ?>"
                                required autofocus>
                            <label for="nama_jenis">Jenis Barang</label>
                            <?= form_error('nama_jenis', '<small class="text-danger">', '</small>'); ?>
                        </div>

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