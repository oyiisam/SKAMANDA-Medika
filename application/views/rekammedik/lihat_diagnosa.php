<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow border-0 rounded-3">
                    <!-- Header -->
                    <div
                        class="card-header bg-light d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start rounded-top-3">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-notepad"></i> Detail Pemeriksaan & Diagnosa
                        </h5>
                        <a href="<?= base_url('rekammedik') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bx bx-arrow-back"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>

                        <div class="accordion" id="accordionViewDiagnosa">

                            <!-- DATA PASIEN -->
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                                <h2 class="accordion-header" id="headingPasien">
                                    <button class="accordion-button fw-semibold text-primary text-uppercase" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsePasien" aria-expanded="true">
                                        <i class="bx bx-user me-2"></i> Data Pasien
                                    </button>
                                </h2>
                                <div id="collapsePasien" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
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
                                                <input type="text" class="form-control" value="<?= hitung_usia3($pasien['tanggal_lahir']); ?>"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ANAMNESA -->
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                                <h2 class="accordion-header" id="headingAnamnesa">
                                    <button class="accordion-button fw-semibold text-primary text-uppercase" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseAnamnesa" aria-expanded="true">
                                        <i class="bx bx-notepad me-2"></i> Anamnesa
                                    </button>
                                </h2>
                                <div id="collapseAnamnesa" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 mb-2">
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
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Riwayat Sakit Keluarga</label>
                                                <input type="text" class="form-control"
                                                    value="<?= $anamnesa['riwayat_sakit_keluarga']; ?>" readonly>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label fw-semibold">Alergi</label>
                                                <input type="text" class="form-control"
                                                    value="<?= $anamnesa['alergi'] ?: 'Tidak ada'; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TANDA-TANDA VITAL -->
                            <div class="accordion-item mb-3 border-0 shadow-sm rounded-3">
                                <h2 class="accordion-header" id="headingTTV">
                                    <button class="accordion-button fw-semibold text-primary text-uppercase" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapseTTV">
                                        <i class="bx bx-heart me-2"></i> Tanda-Tanda Vital (TTV)
                                    </button>
                                </h2>
                                <div id="collapseTTV" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row g-3 mb-2">
                                            <div class="col-md-4"><input type="text" class="form-control"
                                                    value="BB: <?= $ttv['berat_badan']; ?> Kg" readonly></div>
                                            <div class="col-md-4"><input type="text" class="form-control"
                                                    value="TB: <?= $ttv['tinggi_badan']; ?> cm" readonly></div>
                                            <div class="col-md-4"><input type="text" class="form-control"
                                                    value="Suhu: <?= $ttv['suhu_badan']; ?> °C" readonly></div>
                                        </div>
                                        <div class="row g-3">
                                            <div class="col-md-3"><input type="text" class="form-control"
                                                    value="TD: <?= $ttv['tekanan_darah']; ?> mmHg" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control"
                                                    value="Nadi: <?= $ttv['nadi']; ?>/m" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control"
                                                    value="RR: <?= $ttv['pernapasan']; ?>/m" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control"
                                                    value="SpO₂: <?= $ttv['spo2']; ?>%" readonly></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- PEMERIKSAAN & DIAGNOSA -->
                            <div class="accordion-item border-0 shadow-sm rounded-3">
                                <h2 class="accordion-header" id="headingPeriksa">
                                    <button class="accordion-button fw-semibold text-primary text-uppercase" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapsePeriksa">
                                        <i class="bx bx-pulse me-2"></i> Pemeriksaan & Diagnosa
                                    </button>
                                </h2>
                                <div id="collapsePeriksa" class="accordion-collapse collapse show">
                                    <div class="accordion-body">

                                        <!-- Dokter -->
                                        <div class="mb-3">
                                            <label class="form-label fw-semibold">Dokter</label>
                                            <select class="form-select" disabled>
                                                <option value="">Pilih Dokter</option>
                                                <?php foreach ($user as $row): ?>
                                                    <option value="<?= $row['id_user']; ?>"
                                                        <?= ($row['id_user'] == $diagnosa['dokter_id']) ? 'selected' : ''; ?>>
                                                        <?= $row['nama']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Diagnosa -->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="height:100px"
                                                readonly><?= $diagnosa['diagnosa']; ?></textarea>
                                            <label>Diagnosa / Pemeriksaan</label>
                                        </div>

                                        <!-- Pemeriksaan Penunjang -->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="height:80px"
                                                readonly><?= $diagnosa['pemeriksaan_penunjang']; ?></textarea>
                                            <label>Pemeriksaan Penunjang</label>
                                        </div>

                                        <!-- Tindakan -->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" style="height:100px"
                                                readonly><?= $diagnosa['tindakan']; ?></textarea>
                                            <label>Tindakan</label>
                                        </div>

                                        <!-- Resep Obat -->
                                        <h6 class="text-uppercase fw-bold text-primary mt-4 mb-3">
                                            <i class="bx bx-capsule"></i> Resep Obat
                                        </h6>

                                        <?php if (!empty($detail_resep)): ?>
                                            <?php foreach ($detail_resep as $resep): ?>
                                                <div class="row g-3 align-items-center mb-2">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" value="<?= $resep['nama_barang']; ?>" readonly>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="text" class="form-control"
                                                            value="<?= $resep['jumlah_obat'] . ' ' . $resep['nama_satuan']; ?>" readonly>
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
                                            <p class="text-muted fst-italic">Tidak ada resep obat.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="text-center mt-4">
                            <a href="<?= base_url('rekammedik/edit_diagnosa/' . $id_rekammedik) ?>" class="btn btn-sm btn-warning btn-lg">
                                <i class="bx bx-edit-alt"></i> Edit Pemeriksaan & Diagnosa
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>