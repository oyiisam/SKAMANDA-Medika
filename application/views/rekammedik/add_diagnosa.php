<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-4">

                <!-- CARD UTAMA -->
                <div class="card shadow border-0 rounded-3">
                    <!-- HEADER -->
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start bg-light">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Tambah Pemeriksaan & Diagnosa
                        </h5>
                        <a href="<?= base_url('rekammedik') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <!-- BODY -->
                    <div class="card-body p-4">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open(); ?>

                        <div class="accordion" id="accordionDiagnosa">
                            <!-- ==================== DATA PASIEN ==================== -->
                            <div class="accordion-item border rounded-3 mb-3">
                                <h2 class="accordion-header" id="headingPasien">
                                    <button class="accordion-button text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePasien" aria-expanded="true">
                                        <i class="bx bx-user me-2"></i> Data Pasien
                                    </button>
                                </h2>
                                <div id="collapsePasien" class="accordion-collapse collapse show">
                                    <div class="accordion-body bg-light rounded-bottom-3">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Nama Pasien</label>
                                                <input type="text" class="form-control" value="<?= $pasien['nama_pasien']; ?>" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">No. Rekam Medik</label>
                                                <input type="text" class="form-control" value="<?= $pasien['nomor_rm']; ?>" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Usia</label>
                                                <input type="text" class="form-control" value="<?= hitung_usia($pasien['tanggal_lahir']); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ==================== ANAMNESA ==================== -->
                            <div class="accordion-item border rounded-3 mb-3">
                                <h2 class="accordion-header" id="headingAnamnesa">
                                    <button class="accordion-button collapsed text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnamnesa">
                                        <i class="bx bx-notepad me-2"></i> Anamnesa
                                    </button>
                                </h2>
                                <div id="collapseAnamnesa" class="accordion-collapse collapse">
                                    <div class="accordion-body bg-light rounded-bottom-3">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label fw-semibold">Keluhan</label>
                                                <input type="text" class="form-control" value="<?= $anamnesa['keluhan']; ?>" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <label class="form-label fw-semibold">Lama</label>
                                                <input type="text" class="form-control" value="<?= $anamnesa['lama_keluhan']; ?>" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label fw-semibold">Riwayat Penyakit</label>
                                                <input type="text" class="form-control" value="<?= $anamnesa['riwayat_penyakit']; ?>" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="form-label fw-semibold">Terakhir Sakit</label>
                                                <input type="text" class="form-control" value="<?= $anamnesa['terakhir_sakit']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Riwayat Sakit Keluarga</label>
                                                <input type="text" class="form-control" value="<?= $anamnesa['riwayat_sakit_keluarga']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Alergi</label>
                                                <input type="text" class="form-control" value="<?= $anamnesa['alergi'] ?: 'Tidak ada'; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ==================== TANDA-TANDA VITAL ==================== -->
                            <div class="accordion-item border rounded-3 mb-3">
                                <h2 class="accordion-header" id="headingTTV">
                                    <button class="accordion-button collapsed text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTTV">
                                        <i class="bx bx-pulse me-2"></i> Tanda-Tanda Vital (TTV)
                                    </button>
                                </h2>
                                <div id="collapseTTV" class="accordion-collapse collapse">
                                    <div class="accordion-body bg-light rounded-bottom-3">
                                        <div class="row g-3">
                                            <div class="col-md-4"><input type="text" class="form-control" value="BB: <?= $ttv['berat_badan']; ?> Kg" readonly></div>
                                            <div class="col-md-4"><input type="text" class="form-control" value="TB: <?= $ttv['tinggi_badan']; ?> cm" readonly></div>
                                            <div class="col-md-4"><input type="text" class="form-control" value="Suhu: <?= $ttv['suhu_badan']; ?> °C" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control" value="TD: <?= $ttv['tekanan_darah']; ?> mmHg" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control" value="Nadi: <?= $ttv['nadi']; ?>/m" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control" value="RR: <?= $ttv['pernapasan']; ?>/m" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control" value="SpO₂: <?= $ttv['spo2']; ?>%" readonly></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ==================== PEMERIKSAAN & DIAGNOSA ==================== -->
                            <div class="accordion-item border rounded-3">
                                <h2 class="accordion-header" id="headingPeriksa">
                                    <button class="accordion-button collapsed text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePeriksa">
                                        <i class="bx bxs-first-aid me-2"></i> Pemeriksaan & Diagnosa
                                    </button>
                                </h2>
                                <div id="collapsePeriksa" class="accordion-collapse collapse">
                                    <div class="accordion-body bg-light rounded-bottom-3">

                                        <!-- Dokter -->
                                        <div class="mb-3">
                                            <?php if ($is_admin): ?>
                                                <label class="form-label fw-semibold">Dokter</label>
                                                <select class="form-select" id="dokter_id" name="dokter_id" required>
                                                    <option value="" selected disabled>Pilih Dokter</option>
                                                    <?php foreach ($user as $row): ?>
                                                        <option value="<?= $row['id_user'] ?>" <?= set_select('dokter_id', $row['id_user']); ?>><?= $row['nama'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            <?php else: ?>
                                                <input type="hidden" name="dokter_id" value="<?= $user[0]['id_user']; ?>">
                                                <input type="text" class="form-control" value="<?= $user[0]['nama']; ?>" readonly>
                                            <?php endif; ?>
                                        </div>

                                        <!-- Diagnosa -->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="diagnosa" name="diagnosa" style="height:100px" required><?= set_value('diagnosa'); ?></textarea>
                                            <label for="diagnosa">Diagnosa / Pemeriksaan</label>
                                        </div>

                                        <!-- Pemeriksaan Penunjang -->
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="togglePenunjang">
                                            <label class="form-check-label fw-semibold text-primary" for="togglePenunjang">Tambahkan Pemeriksaan Penunjang</label>
                                        </div>

                                        <div class="alert alert-primary py-2 small mb-3">
                                            <i class="bx bx-info-circle"></i>
                                            <strong>Catatan:</strong> Pemeriksaan penunjang bersifat opsional.
                                        </div>

                                        <div id="penunjangSection" style="display:none;">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="pemeriksaan_penunjang" name="pemeriksaan_penunjang" style="height:80px"><?= set_value('pemeriksaan_penunjang'); ?></textarea>
                                                <label for="pemeriksaan_penunjang">Pemeriksaan Penunjang</label>
                                            </div>
                                        </div>

                                        <!-- Tindakan -->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="tindakan" name="tindakan" style="height:100px" required><?= set_value('tindakan'); ?></textarea>
                                            <label for="tindakan">Tindakan</label>
                                        </div>

                                        <!-- RESEP -->
                                        <h6 class="text-uppercase fw-bold text-primary mt-4 mb-3">Resep Obat</h6>
                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="toggleResep">
                                            <label class="form-check-label fw-semibold text-primary" for="toggleResep">Tambahkan Resep Obat</label>
                                        </div>

                                        <div class="alert alert-primary py-2 small mb-3">
                                            <i class="bx bx-info-circle"></i>
                                            <strong>Catatan:</strong> Pengisian resep obat bersifat opsional.
                                        </div>

                                        <div id="formResepSection" style="display:none;">
                                            <div id="resep-container">
                                                <div class="row resep-item mb-2">
                                                    <div class="col-md-4">
                                                        <select name="obat_id[]" class="form-select">
                                                            <option value="">Pilih Obat</option>
                                                            <?php foreach ($obat as $o): ?>
                                                                <option value="<?= $o['id_barang']; ?>"><?= $o['nama_barang']; ?> (Stok: <?= $o['stok']; ?>)</option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2"><input type="number" name="jumlah_obat[]" class="form-control" min="1" placeholder="Jumlah"></div>
                                                    <div class="col-md-3"><input type="text" name="dosis_obat[]" class="form-control" placeholder="Dosis / Aturan Pakai"></div>
                                                    <div class="col-md-2"><input type="text" name="keterangan_obat[]" class="form-control" placeholder="Keterangan"></div>
                                                    <div class="col-md-1 d-flex justify-content-md-end justify-content-center align-items-center mt-2 mt-md-0">
                                                        <button type="button" class="btn btn-outline-danger btn-sm remove-row">
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <button type="button" class="btn w-100 btn-sm btn-outline-primary" id="add-resep">
                                                    <i class="bx bx-plus-medical"></i> Tambah Obat
                                                </button>
                                            </div>
                                        </div>

                                        <input type="hidden" name="resep_kode" value="<?= $resep_kode; ?>">

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="text-center mt-4 d-flex justify-content-center gap-2">
                            <button type="reset" class="btn btn-outline-secondary btn-sm px-3">
                                <i class="bx bx-reset"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm px-3">
                                <i class="bx bx-save"></i> Simpan
                            </button>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Script -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePenunjang = document.getElementById('togglePenunjang');
        const penunjangSection = document.getElementById('penunjangSection');
        const toggleResep = document.getElementById('toggleResep');
        const formResepSection = document.getElementById('formResepSection');
        const resepContainer = document.getElementById('resep-container');
        const addResepBtn = document.getElementById('add-resep');

        // Toggle Pemeriksaan Penunjang
        togglePenunjang.addEventListener('change', function() {
            penunjangSection.style.display = this.checked ? 'block' : 'none';
        });

        // Toggle Resep Obat
        toggleResep.addEventListener('change', function() {
            formResepSection.style.display = this.checked ? 'block' : 'none';
        });

        // Tambah baris obat
        addResepBtn.addEventListener('click', function() {
            const newRow = document.createElement('div');
            newRow.classList.add('row', 'resep-item', 'mb-2');
            newRow.innerHTML = `
            <div class="col-md-4">
                <select name="obat_id[]" class="form-select">
                    <option value="">Pilih Obat</option>
                    <?php foreach ($obat as $o): ?>
                        <option value="<?= $o['id_barang']; ?>">
                            <?= $o['nama_barang']; ?> (Stok: <?= $o['stok']; ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <input type="number" name="jumlah_obat[]" class="form-control" min="1" placeholder="Jumlah">
            </div>
            <div class="col-md-3">
                <input type="text" name="dosis_obat[]" class="form-control" placeholder="Dosis / Aturan Pakai">
            </div>
            <div class="col-md-2">
                <input type="text" name="keterangan_obat[]" class="form-control" placeholder="Keterangan">
            </div>
           <div class="col-md-1 d-flex justify-content-md-end justify-content-center align-items-center mt-2 mt-md-0">
                <button type="button" class="btn btn-outline-danger btn-sm remove-row">
                    <i class="bx bx-trash"></i>
                </button>
            </div>
        `;
            resepContainer.appendChild(newRow);
        });

        // Hapus baris obat
        resepContainer.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('.resep-item').remove();
            }
        });
    });
</script>