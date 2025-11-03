<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start bg-light">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Pemeriksaan & Diagnosa
                        </h5>
                        <a href="<?= base_url('rekammedik') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('rekammedik/update_diagnosa'); ?>

                        <!-- Hidden -->
                        <input type="hidden" name="id_diagnosa" value="<?= $diagnosa['id_diagnosa']; ?>">
                        <input type="hidden" name="id_rekammedik" value="<?= $id_rekammedik; ?>">
                        <?= form_hidden($this->security->get_csrf_token_name(), $this->security->get_csrf_hash()); ?>

                        <div class="accordion" id="accordionEditDiagnosa">

                            <!-- DATA PASIEN -->
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="headingPasien">
                                    <button class="accordion-button text-primary text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePasien" aria-expanded="true">
                                        Data Pasien
                                    </button>
                                </h2>
                                <div id="collapsePasien" class="accordion-collapse collapse show">
                                    <div class="accordion-body">
                                        <div class="row mb-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Nama Pasien</label>
                                                <input type="text" class="form-control" value="<?= $pasien['nama_pasien']; ?>" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">No. Rekam Medik</label>
                                                <input type="text" class="form-control" value="<?= $pasien['nomor_rm']; ?>" readonly>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Usia</label>
                                                <input type="text" class="form-control" value="<?= hitung_usia2($pasien['tanggal_lahir']); ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- ANAMNESA -->
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="headingAnamnesa">
                                    <button class="accordion-button collapsed text-primary text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseAnamnesa">
                                        Anamnesa
                                    </button>
                                </h2>
                                <div id="collapseAnamnesa" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row mb-2">
                                            <div class="col-md-4"><label class="form-label">Keluhan</label><input type="text" class="form-control" value="<?= $anamnesa['keluhan']; ?>" readonly></div>
                                            <div class="col-md-2"><label class="form-label">Lama</label><input type="text" class="form-control" value="<?= $anamnesa['lama_keluhan']; ?>" readonly></div>
                                            <div class="col-md-3"><label class="form-label">Riwayat Penyakit</label><input type="text" class="form-control" value="<?= $anamnesa['riwayat_penyakit']; ?>" readonly></div>
                                            <div class="col-md-3"><label class="form-label">Terakhir Sakit</label><input type="text" class="form-control" value="<?= $anamnesa['terakhir_sakit']; ?>" readonly></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-6"><label class="form-label">Riwayat Sakit Keluarga</label><input type="text" class="form-control" value="<?= $anamnesa['riwayat_sakit_keluarga']; ?>" readonly></div>
                                            <div class="col-md-6"><label class="form-label">Alergi</label><input type="text" class="form-control" value="<?= $anamnesa['alergi'] ?: 'Tidak ada'; ?>" readonly></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- TANDA-TANDA VITAL -->
                            <div class="accordion-item mb-3">
                                <h2 class="accordion-header" id="headingTTV">
                                    <button class="accordion-button collapsed text-primary text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTTV">
                                        Tanda-Tanda Vital (TTV)
                                    </button>
                                </h2>
                                <div id="collapseTTV" class="accordion-collapse collapse">
                                    <div class="accordion-body">
                                        <div class="row mb-2">
                                            <div class="col-md-4"><input type="text" class="form-control" value="BB: <?= $ttv['berat_badan']; ?> Kg" readonly></div>
                                            <div class="col-md-4"><input type="text" class="form-control" value="TB: <?= $ttv['tinggi_badan']; ?> cm" readonly></div>
                                            <div class="col-md-4"><input type="text" class="form-control" value="Suhu: <?= $ttv['suhu_badan']; ?> °C" readonly></div>
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-md-3"><input type="text" class="form-control" value="TD: <?= $ttv['tekanan_darah']; ?> mmHg" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control" value="Nadi: <?= $ttv['nadi']; ?>/m" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control" value="RR: <?= $ttv['pernapasan']; ?>/m" readonly></div>
                                            <div class="col-md-3"><input type="text" class="form-control" value="SpO₂: <?= $ttv['spo2']; ?>%" readonly></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Pemeriksaan & Diagnosa -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingPeriksa">
                                    <button class="accordion-button collapsed text-primary text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePeriksa">
                                        Pemeriksaan & Diagnosa
                                    </button>
                                </h2>
                                <div id="collapsePeriksa" class="accordion-collapse collapse show">
                                    <div class="accordion-body">

                                        <!-- Dokter -->
                                        <div class="mb-3">
                                            <label class="form-label">Dokter</label>
                                            <select class="form-select" id="dokter_id" name="dokter_id" required>
                                                <option value="" disabled>Pilih Dokter</option>
                                                <?php foreach ($user as $row): ?>
                                                    <option value="<?= $row['id_user']; ?>" <?= ($row['id_user'] == $diagnosa['dokter_id']) ? 'selected' : ''; ?>>
                                                        <?= $row['nama']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                        <!-- Diagnosa -->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="diagnosa" name="diagnosa" style="height:100px" required><?= $diagnosa['diagnosa']; ?></textarea>
                                            <label for="diagnosa">Diagnosa / Pemeriksaan</label>
                                        </div>

                                        <!-- Toggle Pemeriksaan Penunjang -->
                                        <div class="form-check form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" id="togglePenunjang" <?= !empty($diagnosa['pemeriksaan_penunjang']) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="togglePenunjang">Tambahkan Pemeriksaan Penunjang</label>
                                        </div>

                                        <div id="penunjangSection" style="display:<?= !empty($diagnosa['pemeriksaan_penunjang']) ? 'block' : 'none'; ?>;">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" id="pemeriksaan_penunjang" name="pemeriksaan_penunjang" style="height:80px"><?= $diagnosa['pemeriksaan_penunjang']; ?></textarea>
                                                <label for="pemeriksaan_penunjang">Pemeriksaan Penunjang</label>
                                            </div>
                                        </div>

                                        <!-- Tindakan -->
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" id="tindakan" name="tindakan" style="height:100px" required><?= $diagnosa['tindakan']; ?></textarea>
                                            <label for="tindakan">Tindakan</label>
                                        </div>

                                        <!-- RESEP OBAT -->
                                        <h6 class="text-uppercase fw-bold text-primary mt-4 mb-3">Resep Obat</h6>

                                        <div class="form-check form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" id="toggleResep" <?= !empty($detail_resep) ? 'checked' : ''; ?>>
                                            <label class="form-check-label" for="toggleResep">Tampilkan / Edit Resep Obat</label>
                                        </div>

                                        <div id="formResepSection" style="display:<?= !empty($detail_resep) ? 'block' : 'none'; ?>;">
                                            <div id="resep-container">
                                                <?php foreach ($detail_resep as $index => $resep): ?>
                                                    <div class="row resep-item mb-2 align-items-center">
                                                        <div class="col-md-3">
                                                            <select name="obat_id[]" class="form-select">
                                                                <option value="">Pilih Obat</option>
                                                                <?php foreach ($obat as $row): ?>
                                                                    <option value="<?= $row['id_barang']; ?>" <?= ($row['id_barang'] == $resep['obat_id']) ? 'selected' : ''; ?>>
                                                                        <?= $row['nama_barang']; ?> (Stok: <?= $row['stok']; ?>)
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <input name="jumlah_obat[]" type="number" class="form-control" value="<?= $resep['jumlah_obat']; ?>" min="1">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input name="dosis_obat[]" type="text" class="form-control" value="<?= $resep['dosis_obat']; ?>">
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input name="keterangan_obat[]" type="text" class="form-control" value="<?= $resep['keterangan_obat']; ?>">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select name="status_obat[]" class="form-select" required>
                                                                <option value="Menunggu Konfirmasi" <?= ($resep['status_obat'] == 'Menunggu Konfirmasi') ? 'selected' : ''; ?> disabled>Menunggu Konfirmasi</option>
                                                                <option value="Farmasi" <?= ($resep['status_obat'] == 'Farmasi') ? 'selected' : ''; ?>>Farmasi</option>
                                                                <option value="Beli Di Luar" <?= ($resep['status_obat'] == 'Beli Di Luar') ? 'selected' : ''; ?>>Beli Di Luar</option>
                                                            </select>

                                                        </div>
                                                        <div class="col-md-1 d-flex align-items-center">
                                                            <button type="button" class="btn btn-danger btn-sm remove-row"><i class='bx bx-trash'></i></button>
                                                        </div>
                                                    </div>
                                                <?php endforeach; ?>
                                            </div>

                                            <div class="mb-3">
                                                <button type="button" class="btn w-100 btn-sm btn-success" id="add-resep">
                                                    <i class='bx bx-plus-medical'></i> Tambah Obat
                                                </button>
                                            </div>

                                            <input type="hidden" name="resep_kode" value="<?= $diagnosa['resep_kode']; ?>">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="text-center mt-4">
                            <button type="reset" class="btn btn-sm btn-secondary"><i class='bx bx-reset'></i> Reset</button>
                            <button type="submit" class="btn btn-sm btn-primary"><i class='bx bx-save'></i> Simpan</button>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SCRIPT -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePenunjang = document.getElementById('togglePenunjang');
        const penunjangSection = document.getElementById('penunjangSection');
        const toggleResep = document.getElementById('toggleResep');
        const formResepSection = document.getElementById('formResepSection');
        const resepContainer = document.getElementById('resep-container');
        const addResepBtn = document.getElementById('add-resep');
        const form = document.querySelector('form');

        // --- Toggle penunjang ---
        if (togglePenunjang) {
            togglePenunjang.addEventListener('change', () => {
                penunjangSection.style.display = togglePenunjang.checked ? 'block' : 'none';
            });
        }

        // --- Toggle resep ---
        if (toggleResep) {
            toggleResep.addEventListener('change', () => {
                formResepSection.style.display = toggleResep.checked ? 'block' : 'none';
            });
        }

        // --- Tambah baris resep ---
        if (addResepBtn) {
            addResepBtn.addEventListener('click', () => {
                const newRow = document.createElement('div');
                newRow.classList.add('row', 'resep-item', 'mb-2', 'align-items-center');
                newRow.innerHTML = `
                <div class="col-md-3">
                    <select name="obat_id[]" class="form-select" required>
                        <option value="">Pilih Obat</option>
                        <?php foreach ($obat as $o): ?>
                            <option value="<?= $o['id_barang']; ?>">
                                <?= $o['nama_barang']; ?> (Stok: <?= $o['stok']; ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-1">
                    <input type="number" name="jumlah_obat[]" class="form-control" min="1" placeholder="Jumlah" required>
                </div>
                <div class="col-md-2">
                    <input type="text" name="dosis_obat[]" class="form-control" placeholder="Dosis / Aturan Pakai">
                </div>
                <div class="col-md-2">
                    <input type="text" name="keterangan_obat[]" class="form-control" placeholder="Keterangan">
                </div>
                <div class="col-md-3">
                    <select name="status_obat[]" class="form-select" required>
                        <option value="Menunggu Konfirmasi" selected disabled>Menunggu Konfirmasi</option>
                        <option value="Farmasi">Farmasi</option>
                        <option value="Beli Di Luar">Beli Di Luar</option>
                    </select>
                </div>
                <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-danger btn-sm remove-row">
                        <i class='bx bx-trash'></i>
                    </button>
                </div>`;
                resepContainer.appendChild(newRow);
            });
        }

        // --- Hapus baris resep ---
        document.addEventListener('click', function(e) {
            const target = e.target.closest('.remove-row');
            if (target) target.closest('.resep-item').remove();
        });

        // --- Validasi sebelum submit ---
        if (form) {
            form.addEventListener('submit', function(e) {
                const selects = form.querySelectorAll('select[name="status_obat[]"]');
                for (let sel of selects) {
                    if (!sel.value || sel.value.trim() === '' || sel.value === 'Menunggu Konfirmasi') {
                        e.preventDefault();
                        alert('❗ Harap ubah semua status obat dari "Menunggu Konfirmasi" menjadi "Farmasi" atau "Beli Di Luar" sebelum menyimpan.');
                        sel.focus();
                        return false;
                    }
                }
            });
        }
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form'); // pastikan ini selektor form benar (atau ganti id spesifik)
        if (!form) return;

        form.addEventListener('submit', function(e) {
            // cari semua select status_obat[] yang berada di form
            const selects = form.querySelectorAll('select[name="status_obat[]"]');
            for (let sel of selects) {
                if (!sel.value || sel.value.trim() === '' || sel.value === 'Menunggu Konfirmasi') {
                    e.preventDefault();
                    alert('Silakan ubah semua status obat dari "Menunggu Konfirmasi" (pilih Farmasi atau Beli Di Luar) sebelum menyimpan.');
                    sel.focus();
                    return false;
                }
            }
        });
    });
</script>