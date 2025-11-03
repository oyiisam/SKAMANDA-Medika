<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-white border-bottom-0">
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md">
                                <h4 class="card-title text-success text-uppercase fw-bold mb-0">
                                    Pilih Kartu Stok
                                </h4>
                            </div>

                            <div class="col-12 col-md-auto mt-3 mt-md-0 text-center">
                                <a href="<?= base_url('dashboard') ?>"
                                    class="btn btn-sm btn-outline-secondary btn-icon-split">
                                    <span class="icon">
                                        <i class='bx bx-rotate-left'></i>
                                    </span>
                                    <span class="text">
                                        Kembali
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>

                        <!-- Pilih Barang -->
                        <div class="row mb-3">
                            <div class="col">
                                <div class="form-floating">
                                    <select name="barang_id" id="barang_id" class="form-select" required>
                                        <option value="" selected disabled>*Pilih Barang</option>
                                        <?php foreach ($barang as $b) : ?>
                                            <option value="<?= $b['id_barang'] ?>">
                                                <?= $b['tempat_barang'] . ' - ' . $b['nama_barang']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="barang_id">Barang</label>
                                </div>
                                <?= form_error('barang_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="row mt-4">
                            <div class="col text-end">
                                <button type="reset" class="btn btn-outline-secondary btn-sm me-2">
                                    <i class='bx bx-reset'></i> Reset
                                </button>
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class='bx bx-search'></i> Lihat Kartu Stok
                                </button>
                            </div>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>