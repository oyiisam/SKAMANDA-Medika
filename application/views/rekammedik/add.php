<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm border-0">

                    <!-- Header -->
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start bg-light">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-user-plus"></i> Tambah Data Kunjungan Pasien
                        </h5>
                        <a href="<?= base_url('rekammedik') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body p-4">

                        <!-- Notifikasi -->
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class="bx bx-info-circle fs-4 me-2 text-primary"></i>
                            <div>Pastikan data pasien dan dokter sudah terdaftar sebelum menambahkan kunjungan.</div>
                        </div>

                        <!-- Flash message -->
                        <?= $this->session->flashdata('pesan'); ?>

                        <!-- Form -->
                        <?= form_open(); ?>
                        <div class="row g-4">

                            <!-- Kolom Kiri -->
                            <div class="col-lg-4">
                                <h6 class="text-uppercase text-muted fw-bold mb-3">
                                    <i class="bx bx-calendar-check me-1"></i>Data Kunjungan
                                </h6>

                                <!-- Nomor RM -->
                                <div class="form-floating mb-3">
                                    <input type="text" name="nomor_rm" id="nomor_rm" class="form-control" placeholder="Nomor RM" required>
                                    <label for="nomor_rm">Nomor RM</label>
                                    <small class="text-muted">Masukkan nomor rekam medis pasien.</small>
                                    <div id="hasil_cek_nomor_rm" class="mt-2"></div>
                                    <?= form_error('nomor_rm', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <!-- Data Pasien -->
                                <div class="mb-3" id="data_pasien" style="display:none;">
                                    <div class="card bg-light border p-3 shadow-sm">
                                        <p class="mb-1"><strong>Nama Pasien:</strong> <span id="nama_pasien"></span></p>
                                        <p class="mb-1"><strong>Jenis Kelamin:</strong> <span id="jenis_kelamin"></span></p>
                                        <p class="mb-0"><strong>Tanggal Lahir:</strong> <span id="tanggal_lahir"></span></p>
                                    </div>
                                    <input type="hidden" name="pasien_id" id="pasien_id">
                                </div>

                                <!-- Poliklinik -->
                                <div class="form-floating mb-3">
                                    <select name="poliklinik_id" id="poliklinik_id" class="form-select" required>
                                        <option value="" selected disabled>Pilih Poliklinik</option>
                                        <?php foreach ($poliklinik as $p) : ?>
                                            <option value="<?= $p['id_poliklinik'] ?>"><?= $p['nama_poliklinik'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="poliklinik_id">Poliklinik</label>
                                    <?= form_error('poliklinik_id', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <!-- Dokter -->
                                <div class="form-floating mb-3">
                                    <select name="dokter_id" id="dokter_id" class="form-select" required disabled>
                                        <option value="" selected disabled>Pilih Dokter</option>
                                    </select>
                                    <label for="dokter_id">Dokter</label>
                                    <?= form_error('dokter_id', '<small class="text-danger">', '</small>'); ?>
                                </div>

                                <!-- Tanggal -->
                                <div class="form-floating mb-3">
                                    <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                                    <label for="tanggal_kunjungan">Tanggal Kunjungan</label>
                                </div>
                            </div>

                            <!-- Kolom Kanan -->
                            <div class="col-lg-8">
                                <h6 class="text-uppercase text-muted fw-bold mb-3">
                                    <i class="bx bx-notepad me-1"></i> Data Anamnesa
                                </h6>

                                <!-- Keluhan -->
                                <div class="form-floating mb-3">
                                    <textarea name="keluhan" id="keluhan" class="form-control" placeholder="Keluhan Pasien" style="height:100px" required></textarea>
                                    <label for="keluhan">Keluhan</label>
                                </div>

                                <!-- Lama Keluhan -->
                                <div class="form-floating mb-3">
                                    <input type="text" name="lama_keluhan" id="lama_keluhan" class="form-control" placeholder="Contoh: 3 hari, 2 minggu" required>
                                    <label for="lama_keluhan">Lama Keluhan</label>
                                </div>

                                <!-- Riwayat Penyakit -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Riwayat Penyakit</label>
                                    <div>
                                        <input type="radio" name="riwayat_penyakit_option" value="Tidak ada" id="riwayat_penyakit_none" checked>
                                        <label for="riwayat_penyakit_none">Tidak ada</label>
                                        <input type="radio" name="riwayat_penyakit_option" value="Ada" id="riwayat_penyakit_ada" class="ms-3">
                                        <label for="riwayat_penyakit_ada">Ada</label>
                                    </div>

                                    <div id="riwayat_penyakit_box" class="mt-2 d-none">
                                        <div class="form-floating mb-2">
                                            <textarea name="riwayat_penyakit" id="riwayat_penyakit" class="form-control" style="height:80px" placeholder="Riwayat Penyakit"></textarea>
                                            <label for="riwayat_penyakit">Riwayat Penyakit</label>
                                        </div>
                                        <div class="form-floating">
                                            <input type="date" name="terakhir_sakit" id="terakhir_sakit" class="form-control">
                                            <label for="terakhir_sakit">Tanggal Terakhir Sakit</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="riwayat_penyakit_hidden" id="riwayat_penyakit_hidden" value="Tidak ada">
                                </div>

                                <!-- Riwayat Sakit Keluarga -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Riwayat Sakit Keluarga</label>
                                    <div>
                                        <input type="radio" name="riwayat_sakit_keluarga_option" value="Tidak ada" id="riwayat_sakit_keluarga_none" checked>
                                        <label for="riwayat_sakit_keluarga_none">Tidak ada</label>
                                        <input type="radio" name="riwayat_sakit_keluarga_option" value="Ada" id="riwayat_sakit_keluarga_ada" class="ms-3">
                                        <label for="riwayat_sakit_keluarga_ada">Ada</label>
                                    </div>

                                    <div id="riwayat_sakit_keluarga_box" class="mt-2 d-none">
                                        <div class="form-floating">
                                            <textarea name="riwayat_sakit_keluarga" id="riwayat_sakit_keluarga" class="form-control" style="height:80px" placeholder="Riwayat sakit keluarga"></textarea>
                                            <label for="riwayat_sakit_keluarga">Riwayat Sakit Keluarga</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="riwayat_sakit_keluarga_hidden" id="riwayat_sakit_keluarga_hidden" value="Tidak ada">
                                </div>

                                <!-- Alergi -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Alergi</label>
                                    <div>
                                        <input type="radio" name="alergi_option" value="Tidak ada" id="alergi_none" checked>
                                        <label for="alergi_none">Tidak ada</label>
                                        <input type="radio" name="alergi_option" value="Ada" id="alergi_ada" class="ms-3">
                                        <label for="alergi_ada">Ada</label>
                                    </div>
                                    <div id="alergi_box" class="mt-2 d-none">
                                        <div class="form-floating">
                                            <textarea name="alergi" id="alergi" class="form-control" style="height:80px" placeholder="Alergi Pasien"></textarea>
                                            <label for="alergi">Alergi</label>
                                        </div>
                                    </div>
                                    <input type="hidden" name="alergi_hidden" id="alergi_hidden" value="Tidak ada">
                                </div>
                            </div>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-outline-secondary btn-sm">
                                <i class='bx bx-reset'></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
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


<!-- Script AJAX -->
<script>
    $(document).ready(function() {
        // Cek Nomor RM
        $('#nomor_rm').on('input', function() {
            var nomor_rm = $(this).val();
            if (nomor_rm.length > 0) {
                $.ajax({
                    url: '<?= base_url("rekammedik/cek_nomor_rm") ?>',
                    type: 'POST',
                    data: {
                        nomor_rm: nomor_rm
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#data_pasien').show();
                            $('#nama_pasien').text(response.data.nama_pasien);
                            $('#jenis_kelamin').text(response.data.jenis_kelamin);
                            $('#tanggal_lahir').text(response.data.tanggal_lahir);
                            $('#pasien_id').val(response.data.id_pasien);
                            $('#hasil_cek_nomor_rm').html('<small class="text-success">Data pasien ditemukan.</small>');
                        } else {
                            $('#data_pasien').hide();
                            $('#hasil_cek_nomor_rm').html('<small class="text-danger">' + response.message + '</small>');
                        }
                    }
                });
            } else {
                $('#data_pasien').hide();
                $('#hasil_cek_nomor_rm').html('');
            }
        });

        // Ambil Data Dokter berdasarkan Poliklinik
        $('#poliklinik_id').on('change', function() {
            var poliklinik_id = $(this).val();
            if (poliklinik_id) {
                $.ajax({
                    url: '<?= base_url("rekammedik/cek_dokter_polikliniik/") ?>' + poliklinik_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        $('#dokter_id').empty().append('<option value="" selected disabled>Pilih Dokter</option>');
                        if (response.length > 0) {
                            $('#dokter_id').prop('disabled', false);
                            $.each(response, function(key, value) {
                                $('#dokter_id').append('<option value="' + value.id_dokter + '">' + value.nama + '</option>');
                            });
                        } else {
                            $('#dokter_id').prop('disabled', true);
                        }
                    }
                });
            } else {
                $('#dokter_id').prop('disabled', true);
            }
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Riwayat Penyakit
        $("input[name='riwayat_penyakit_option']").change(function() {
            if ($(this).val() === "Ada") {
                $("#riwayat_penyakit_box").removeClass("d-none");
                $("#riwayat_penyakit_hidden").val("");
            } else {
                $("#riwayat_penyakit_box").addClass("d-none");
                $("#riwayat_penyakit").val("");
                $("#terakhir_sakit").val("");
                $("#riwayat_penyakit_hidden").val("Tidak ada");
            }
        });

        // Riwayat Sakit Keluarga
        $("input[name='riwayat_sakit_keluarga_option']").change(function() {
            if ($(this).val() === "Ada") {
                $("#riwayat_sakit_keluarga_box").removeClass("d-none");
                $("#riwayat_sakit_keluarga_hidden").val("");
            } else {
                $("#riwayat_sakit_keluarga_box").addClass("d-none");
                $("#riwayat_sakit_keluarga").val("");
                $("#riwayat_sakit_keluarga_hidden").val("Tidak ada");
            }
        });

        // Alergi
        $("input[name='alergi_option']").change(function() {
            if ($(this).val() === "Ada") {
                $("#alergi_box").removeClass("d-none");
                $("#alergi_hidden").val("");
            } else {
                $("#alergi_box").addClass("d-none");
                $("#alergi").val("");
                $("#alergi_hidden").val("Tidak ada");
            }
        });
    });
</script>