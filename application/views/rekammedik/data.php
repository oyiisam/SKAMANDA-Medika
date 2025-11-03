<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header bg-white border-bottom-0">
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md">
                                <h4 class="card-title text-success text-uppercase fw-bold mb-0">
                                    Data Kunjungan Pasien
                                </h4>
                            </div>

                            <div class="col-12 col-md-auto mt-3 mt-md-0 text-center">
                                <a href="<?= base_url('rekammedik/add') ?>"
                                    class="btn btn-sm btn-success btn-icon-split">
                                    <span class="icon">
                                        <i class='bx bx-layer-plus'></i>
                                    </span>
                                    <span class="text">
                                        Tambah
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable nowrap" id="dataTable_noEdit" data-url="<?= base_url('rekammedik/getData') ?>" data-table="rekammedik" data-columns='[
                                       {"data": "no"},
                                       {"data": "tanggal_kunjungan"},
                                       {"data": "dokter_poliklinik"},
                                       {"data": "nama_pasien"},
                                       {"data": "anamnesa_status"},
                                       {"data": "ttv_status"},
                                       {"data": "diagnosa_status"}
                                   ]'>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Tanggal</th>
                                        <th>Poliklinik</th>
                                        <th>Nama Pasien</th>
                                        <th>Anamnesa</th>
                                        <th>TTV</th>
                                        <th>Diagnosa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat melalui AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Anamnesa -->
<div class="modal fade" id="modalAnamnesa" tabindex="-1" aria-labelledby="modalAnamnesaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="modalAnamnesaLabel">
                    <i class="bx bx-notepad"></i> Detail Anamnesa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formAnamnesa" class="row g-3">
                    <input type="hidden" id="id_rekammedik" name="id_rekammedik">

                    <!-- Keluhan + Lama Keluhan -->
                    <div class="col-md-8 form-floating">
                        <textarea class="form-control" id="keluhan" name="keluhan" placeholder="Keluhan" style="height:80px" readonly></textarea>
                        <label for="keluhan">Keluhan</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <input type="text" class="form-control" id="lama_keluhan" name="lama_keluhan" placeholder="Lama Keluhan" readonly>
                        <label for="lama_keluhan">Lama Keluhan</label>
                    </div>

                    <!-- Riwayat Penyakit + Terakhir Sakit -->
                    <div class="col-md-8 form-floating">
                        <textarea class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" placeholder="Riwayat Penyakit" style="height:70px" readonly></textarea>
                        <label for="riwayat_penyakit">Riwayat Penyakit</label>
                    </div>
                    <div class="col-md-4 form-floating">
                        <input type="date" class="form-control" id="terakhir_sakit" name="terakhir_sakit" placeholder="Terakhir Sakit" readonly>
                        <label for="terakhir_sakit">Terakhir Sakit</label>
                    </div>

                    <!-- Riwayat Sakit Keluarga -->
                    <div class="col-md-12 form-floating">
                        <textarea class="form-control" id="riwayat_sakit_keluarga" name="riwayat_sakit_keluarga" placeholder="Riwayat Sakit Keluarga" style="height:70px" readonly></textarea>
                        <label for="riwayat_sakit_keluarga">Riwayat Sakit Keluarga</label>
                    </div>

                    <!-- Alergi -->
                    <div class="col-md-12 form-floating">
                        <textarea class="form-control" id="alergi" name="alergi" placeholder="Alergi" style="height:70px" readonly></textarea>
                        <label for="alergi">Alergi</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" id="editAnamnesa" class="btn btn-sm btn-warning">
                    <i class="bx bx-edit"></i> Edit
                </button>
                <button type="button" id="saveAnamnesa" class="btn btn-sm  btn-success d-none">
                    <i class="bx bx-save"></i> Simpan
                </button>
                <button type="button" id="cancelAnamnesa" class="btn btn-sm btn-danger d-none">
                    <i class="bx bx-x-circle"></i> Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    var base_url = "<?= base_url(); ?>";
    let originalData = {};

    // Klik tombol lihat anamnesa
    $(document).on("click", ".view-anamnesa", function() {
        var id = $(this).data("id");

        $.ajax({
            url: base_url + "rekammedik/get_anamnesa/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(res) {
                if (res.status === 'success') {
                    let d = res.data;
                    $("#id_rekammedik").val(d.rekammedik_id);
                    $("#keluhan").val(d.keluhan);
                    $("#lama_keluhan").val(d.lama_keluhan);
                    $("#riwayat_penyakit").val(d.riwayat_penyakit);
                    $("#terakhir_sakit").val(d.terakhir_sakit);
                    $("#riwayat_sakit_keluarga").val(d.riwayat_sakit_keluarga);
                    $("#alergi").val(d.alergi);

                    // Simpan data awal
                    originalData = {
                        ...d
                    };

                    // pastikan readonly & tombol default
                    $("#formAnamnesa textarea, #formAnamnesa input").prop("readonly", true);
                    $("#editAnamnesa").removeClass("d-none");
                    $("#saveAnamnesa, #cancelAnamnesa").addClass("d-none");

                    $("#modalAnamnesa").modal("show");
                } else {
                    alert(res.message);
                }
            }
        });
    });

    // Tombol Edit
    $("#editAnamnesa").click(function() {
        $("#formAnamnesa textarea, #formAnamnesa input").prop("readonly", false);
        $("#editAnamnesa").addClass("d-none");
        $("#saveAnamnesa, #cancelAnamnesa").removeClass("d-none");
    });

    // Tombol Batal
    $("#cancelAnamnesa").click(function() {
        $("#keluhan").val(originalData.keluhan);
        $("#lama_keluhan").val(originalData.lama_keluhan);
        $("#riwayat_penyakit").val(originalData.riwayat_penyakit);
        $("#terakhir_sakit").val(originalData.terakhir_sakit);
        $("#riwayat_sakit_keluarga").val(originalData.riwayat_sakit_keluarga);
        $("#alergi").val(originalData.alergi);

        $("#formAnamnesa textarea, #formAnamnesa input").prop("readonly", true);
        $("#editAnamnesa").removeClass("d-none");
        $("#saveAnamnesa, #cancelAnamnesa").addClass("d-none");
    });

    // Tombol Simpan
    $("#saveAnamnesa").click(function() {
        let id = $("#id_rekammedik").val();
        let formData = $("#formAnamnesa").serialize();

        $.ajax({
            url: base_url + "rekammedik/update_anamnesa/" + id,
            type: "POST",
            data: formData,
            dataType: "JSON",
            success: function(res) {
                if (res.status === 'success') {
                    alert("Data berhasil diperbarui!");

                    // update originalData
                    originalData = $("#formAnamnesa").serializeArray()
                        .reduce((acc, cur) => ({
                            ...acc,
                            [cur.name]: cur.value
                        }), {});

                    // balik ke readonly
                    $("#formAnamnesa textarea, #formAnamnesa input").prop("readonly", true);
                    $("#editAnamnesa").removeClass("d-none");
                    $("#saveAnamnesa, #cancelAnamnesa").addClass("d-none");
                } else {
                    alert(res.message);
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error:", error);
                alert("Terjadi kesalahan, coba lagi!");
            }
        });
    });
</script>
<!-- MODAL ANAMNESA -->

<!-- MODAL TTV -->
<div class="modal fade" id="ttvModal" tabindex="-1" aria-labelledby="ttvModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content shadow-lg border-0 rounded-3">
            <div class="modal-header text-white rounded-top-3">
                <h5 class="modal-title fw-bold" id="modalAnamnesaLabel">
                    <i class="bx bx-notepad"></i> Detail Tanda-Tanda Vital
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="ttvForm" class="row g-3">
                    <input type="hidden" id="id_rekammedik" name="id_rekammedik">

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="berat_badan" name="berat_badan" readonly>
                            <label for="berat_badan">Berat Badan (Kg)</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" readonly>
                            <label for="tinggi_badan">Tinggi Badan (cm)</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" step="0.1" class="form-control" id="suhu_badan" name="suhu_badan" readonly>
                            <label for="suhu_badan">Suhu Badan (°C)</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="tekanan_darah" name="tekanan_darah" readonly>
                            <label for="tekanan_darah">Tekanan Darah (mmHg)</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="nadi" name="nadi" readonly>
                            <label for="nadi">Nadi (/menit)</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="pernapasan" name="pernapasan" readonly>
                            <label for="pernapasan">Pernapasan (/menit)</label>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="number" class="form-control" id="spo2" name="spo2" readonly>
                            <label for="spo2">SpO₂ (%)</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-sm btn-warning" id="editTtv">
                    <i class="bx bx-edit"></i> Edit
                </button>
                <button type="button" class="btn btn-sm btn-success d-none" id="saveTtv">
                    <i class="bx bx-save"></i> Simpan
                </button>
                <button type="button" class="btn btn-sm btn-danger d-none" id="cancelTtv">
                    <i class="bx bx-x-circle"></i> Batal
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        let originalData = {};

        // Tampilkan data
        $(document).on('click', '.view-ttv', function() {
            const id = $(this).data('id');
            $.getJSON("<?= base_url('rekammedik/get_ttv/') ?>" + id, function(response) {
                if (response.status === 'success') {
                    let d = response.data;
                    originalData = {
                        ...d
                    };

                    $("#id_rekammedik").val(d.rekammedik_id);
                    $("#berat_badan").val(d.berat_badan);
                    $("#tinggi_badan").val(d.tinggi_badan);
                    $("#suhu_badan").val(d.suhu_badan);
                    $("#tekanan_darah").val(d.tekanan_darah);
                    $("#nadi").val(d.nadi);
                    $("#pernapasan").val(d.pernapasan);
                    $("#spo2").val(d.spo2);

                    $("#ttvModal").modal("show");
                } else {
                    alert(response.message);
                }
            }).fail(function(xhr) {
                alert("Terjadi kesalahan, coba lagi!");
                console.error(xhr.responseText);
            });
        });

        // Edit
        $("#editTtv").click(function() {
            $("#ttvForm input").prop("readonly", false);
            $("#editTtv").addClass("d-none");
            $("#saveTtv, #cancelTtv").removeClass("d-none");
        });

        // Batal
        $("#cancelTtv").click(function() {
            Object.keys(originalData).forEach(k => {
                $("#" + k).val(originalData[k]);
            });
            $("#ttvForm input").prop("readonly", true);
            $("#editTtv").removeClass("d-none");
            $("#saveTtv, #cancelTtv").addClass("d-none");
        });

        // Simpan
        $("#saveTtv").click(function() {
            let id = $("#id_rekammedik").val();
            let data = $("#ttvForm").serialize();

            $.post("<?= base_url('rekammedik/update_ttv/') ?>" + id, data, function(response) {
                if (response.status === 'success') {
                    alert("Data berhasil diperbarui!");
                    originalData = {
                        ...response.data
                    };
                    $("#ttvForm input").prop("readonly", true);
                    $("#editTtv").removeClass("d-none");
                    $("#saveTtv, #cancelTtv").addClass("d-none");
                } else {
                    alert("Gagal memperbarui data!");
                }
            }, 'json').fail(function(xhr) {
                alert("Terjadi kesalahan saat update!");
                console.error(xhr.responseText);
            });
        });
    });
</script>