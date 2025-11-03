<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start bg-light">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Tambah Data TTV
                        </h5>
                        <a href="<?= base_url('rekammedik') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Notifikasi flash data -->
                        <?= $this->session->flashdata('pesan'); ?>

                        <!-- Form Input -->
                        <?= form_open(); ?>
                        <div class="row g-3">

                            <!-- Berat Badan -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('berat_badan'); ?>" name="berat_badan" id="berat_badan"
                                        type="number" step="0.1" class="form-control" placeholder="Berat Badan" required>
                                    <label for="berat_badan">Berat Badan (kg)</label>
                                    <?= form_error('berat_badan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <!-- Tinggi Badan -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('tinggi_badan'); ?>" name="tinggi_badan" id="tinggi_badan"
                                        type="number" step="0.1" class="form-control" placeholder="Tinggi Badan" required>
                                    <label for="tinggi_badan">Tinggi Badan (cm)</label>
                                    <?= form_error('tinggi_badan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <!-- Suhu Badan -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('suhu_badan'); ?>" name="suhu_badan" id="suhu_badan"
                                        type="number" step="0.1" class="form-control" placeholder="Suhu Badan" required>
                                    <label for="suhu_badan">Suhu Badan (°C)</label>
                                    <?= form_error('suhu_badan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <!-- Nadi -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('nadi'); ?>" name="nadi" id="nadi"
                                        type="number" class="form-control" placeholder="Nadi" required>
                                    <label for="nadi">Nadi (/menit)</label>
                                    <?= form_error('nadi', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <!-- Pernapasan -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('pernapasan'); ?>" name="pernapasan" id="pernapasan"
                                        type="number" class="form-control" placeholder="Pernapasan" required>
                                    <label for="pernapasan">Pernapasan (/menit)</label>
                                    <?= form_error('pernapasan', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <!-- SpO2 -->
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('spo2'); ?>" name="spo2" id="spo2"
                                        type="number" class="form-control" placeholder="SpO2" required>
                                    <label for="spo2">SpO₂ (%)</label>
                                    <?= form_error('spo2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                            <!-- Tekanan Darah -->
                            <div class="col-md-12">
                                <div class="form-floating">
                                    <input value="<?= set_value('tekanan_darah'); ?>" name="tekanan_darah" id="tekanan_darah"
                                        type="text" class="form-control" placeholder="120/80" required>
                                    <label for="tekanan_darah">Tekanan Darah (Sys/Dia mmHg)</label>
                                    <?= form_error('tekanan_darah', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>

                        </div>

                        <!-- Tombol Aksi -->
                        <div class="mt-4 text-end">
                            <button type="reset" class="btn btn-sm btn-secondary me-2">
                                <i class='bx bx-reset'></i> Reset
                            </button>
                            <button type="submit" class="btn btn-sm btn-primary">
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