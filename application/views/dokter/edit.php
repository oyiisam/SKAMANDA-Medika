<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <!-- Header -->
                    <div
                        class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-user-check"></i> Edit Data Dokter
                        </h5>
                        <a href="<?= base_url('dokter') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>

                        <!-- Pilih Dokter -->
                        <div class="form-floating mb-4">
                            <select name="user_id" id="user_id" class="form-select" required>
                                <option value="" disabled>Pilih Dokter</option>
                                <?php foreach ($user as $u) : ?>
                                    <option value="<?= $u['id_user']; ?>"
                                        <?= set_select('user_id', $u['id_user'], $dokter['user_id'] == $u['id_user']); ?>>
                                        <?= $u['nama']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="user_id">Nama Dokter</label>
                            <?= form_error('user_id', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Spesialisasi -->
                        <div class="form-floating mb-4">
                            <input
                                type="text"
                                class="form-control"
                                id="spesialisasi"
                                name="spesialisasi"
                                placeholder="Spesialisasi"
                                value="<?= set_value('spesialisasi', $dokter['spesialisasi']); ?>"
                                required>
                            <label for="spesialisasi">Spesialisasi</label>
                            <?= form_error('spesialisasi', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Poliklinik -->
                        <div class="form-floating mb-4">
                            <select name="poliklinik_id" id="poliklinik_id" class="form-select" required>
                                <option value="" disabled>Pilih Poliklinik</option>
                                <?php foreach ($poliklinik as $p) : ?>
                                    <option value="<?= $p['id_poliklinik']; ?>"
                                        <?= set_select('poliklinik_id', $p['id_poliklinik'], $dokter['poliklinik_id'] == $p['id_poliklinik']); ?>>
                                        <?= $p['nama_poliklinik']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <label for="poliklinik_id">Poliklinik</label>
                            <?= form_error('poliklinik_id', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Tombol -->
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