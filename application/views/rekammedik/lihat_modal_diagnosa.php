<div class="row justify-content-center">
    <div class="col-lg-12 mb-4">
        <div class="card shadow-sm border-0 rounded-3">
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>

                <div class="accordion" id="accordionViewDiagnosa">

                    <!-- 🧍‍♂️ DATA PASIEN -->
                    <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="headingPasien">
                            <button class="accordion-button text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePasien" aria-expanded="true">
                                Data Pasien
                            </button>
                        </h2>
                        <div id="collapsePasien" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold text-secondary">Nama Pasien</label>
                                        <input type="text" class="form-control" value="<?= $pasien['nama_pasien']; ?>" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold text-secondary">No. Rekam Medik</label>
                                        <input type="text" class="form-control" value="<?= $pasien['nomor_rm']; ?>" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold text-secondary">Usia</label>
                                        <input type="text" class="form-control" value="<?= hitung_usia5($pasien['tanggal_lahir']); ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 💬 ANAMNESA -->
                    <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="headingAnamnesa">
                            <button class="accordion-button text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnamnesa" aria-expanded="true">
                                Anamnesa
                            </button>
                        </h2>
                        <div id="collapseAnamnesa" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="row g-3 mb-2">
                                    <div class="col-md-4">
                                        <label class="form-label fw-semibold text-secondary">Keluhan</label>
                                        <input type="text" class="form-control" value="<?= $anamnesa['keluhan']; ?>" readonly>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label fw-semibold text-secondary">Lama</label>
                                        <input type="text" class="form-control" value="<?= $anamnesa['lama_keluhan']; ?>" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold text-secondary">Riwayat Penyakit</label>
                                        <input type="text" class="form-control" value="<?= $anamnesa['riwayat_penyakit']; ?>" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-semibold text-secondary">Terakhir Sakit</label>
                                        <input type="text" class="form-control" value="<?= $anamnesa['terakhir_sakit']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Riwayat Sakit Keluarga</label>
                                        <input type="text" class="form-control" value="<?= $anamnesa['riwayat_sakit_keluarga']; ?>" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-semibold text-secondary">Alergi</label>
                                        <input type="text" class="form-control" value="<?= $anamnesa['alergi'] ?: 'Tidak ada'; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ❤️‍🔥 TANDA-TANDA VITAL -->
                    <div class="accordion-item mb-3 border rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="headingTTV">
                            <button class="accordion-button text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTTV" aria-expanded="true">
                                Tanda-Tanda Vital (TTV)
                            </button>
                        </h2>
                        <div id="collapseTTV" class="accordion-collapse collapse show">
                            <div class="accordion-body">
                                <div class="row g-3 mb-2">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="BB: <?= $ttv['berat_badan']; ?> Kg" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="TB: <?= $ttv['tinggi_badan']; ?> cm" readonly>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" value="Suhu: <?= $ttv['suhu_badan']; ?> °C" readonly>
                                    </div>
                                </div>
                                <div class="row g-3">
                                    <div class="col-md-3"><input type="text" class="form-control" value="TD: <?= $ttv['tekanan_darah']; ?> mmHg" readonly></div>
                                    <div class="col-md-3"><input type="text" class="form-control" value="Nadi: <?= $ttv['nadi']; ?>/m" readonly></div>
                                    <div class="col-md-3"><input type="text" class="form-control" value="RR: <?= $ttv['pernapasan']; ?>/m" readonly></div>
                                    <div class="col-md-3"><input type="text" class="form-control" value="SpO₂: <?= $ttv['spo2']; ?>%" readonly></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 🧾 PEMERIKSAAN & DIAGNOSA -->
                    <div class="accordion-item border rounded-3 overflow-hidden">
                        <h2 class="accordion-header" id="headingPeriksa">
                            <button class="accordion-button text-primary text-uppercase fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePeriksa" aria-expanded="true">
                                Pemeriksaan & Diagnosa
                            </button>
                        </h2>
                        <div id="collapsePeriksa" class="accordion-collapse collapse show">
                            <div class="accordion-body">

                                <!-- Dokter -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold text-secondary">Dokter</label>
                                    <select class="form-select" disabled>
                                        <option value="">Pilih Dokter</option>
                                        <?php foreach ($user as $row): ?>
                                            <option value="<?= $row['id_user']; ?>" <?= ($row['id_user'] == $diagnosa['dokter_id']) ? 'selected' : ''; ?>>
                                                <?= $row['nama']; ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <!-- Diagnosa -->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" style="height:100px" readonly><?= $diagnosa['diagnosa']; ?></textarea>
                                    <label>Diagnosa / Pemeriksaan</label>
                                </div>

                                <!-- Pemeriksaan Penunjang -->
                                <div class="form-floating mb-3">
                                    <textarea class="form-control" style="height:80px" readonly><?= $diagnosa['pemeriksaan_penunjang']; ?></textarea>
                                    <label>Pemeriksaan Penunjang</label>
                                </div>

                                <!-- Tindakan -->
                                <div class="form-floating mb-4">
                                    <textarea class="form-control" style="height:100px" readonly><?= $diagnosa['tindakan']; ?></textarea>
                                    <label>Tindakan</label>
                                </div>

                                <!-- Resep Obat -->
                                <h6 class="text-uppercase fw-bold text-primary mt-4 mb-3 border-bottom pb-2">Resep Obat</h6>

                                <?php if (!empty($detail_resep)): ?>
                                    <?php foreach ($detail_resep as $resep): ?>
                                        <div class="row g-3 mb-2">
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" value="<?= $resep['nama_barang']; ?>" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" value="<?= $resep['jumlah_obat'] . ' ' . $resep['nama_satuan']; ?>" readonly>
                                            </div>
                                            <div class="col-md-1">
                                                <input type="text" class="form-control" value="<?= $resep['dosis_obat']; ?>" readonly>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="text" class="form-control" value="<?= $resep['keterangan_obat']; ?>" readonly>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="text" class="form-control" value="<?= $resep['status_obat']; ?>" readonly>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p class="text-muted fst-italic mb-0">Tidak ada resep obat.</p>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>