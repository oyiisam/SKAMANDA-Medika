<!-- application/views/rekammedik/detail.php -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header bg-white border-bottom-0">
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md">
                                <h4 class="card-title text-success text-uppercase fw-bold mb-0">
                                    Rekam Medik Pasien
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

                        <style>
                            /* Desktop */
                            @media (min-width: 768px) {
                                #formCariRM {
                                    margin-left: 0 !important;
                                }

                                #formCariRM .input-group .form-control {
                                    border-top-right-radius: 0;
                                    border-bottom-right-radius: 0;
                                }

                                #formCariRM .btn-search {
                                    border-top-left-radius: 0;
                                    border-bottom-left-radius: 0;
                                }

                                #formCariRM .btn-reset {
                                    margin-left: 6px;
                                }
                            }

                            /* Mobile */
                            @media (max-width: 767.98px) {
                                #formCariRM {
                                    text-align: center;
                                }

                                #formCariRM .btn {
                                    width: 100%;
                                    margin-top: 8px;
                                }
                            }
                        </style>

                        <form id="formCariRM" class="row g-2 mb-3 align-items-center">
                            <div class="col-12 col-md-8 px-0">
                                <div class="input-group">
                                    <input
                                        type="text"
                                        id="nomor_rm_input"
                                        name="nomor_rm"
                                        class="form-control"
                                        placeholder="Masukkan Nomor RM"
                                        value="<?= htmlspecialchars($nomor_rm, ENT_QUOTES, 'UTF-8'); ?>">
                                    <button type="submit" class="btn btn-success btn-search">
                                        <i class="bx bx-search"></i> Cari
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 col-md-auto d-flex justify-content-md-start justify-content-center px-0">
                                <button type="button" id="btnReset" class="btn btn-outline-secondary btn-reset">
                                    <i class="bx bx-reset"></i> Reset
                                </button>
                            </div>
                        </form>




                        <!-- Jika pasien ditemukan, tampilkan ringkasan singkat -->
                        <?php if (!empty($pasien)) : ?>
                            <?php
                            $jk = ($pasien['jenis_kelamin'] == 'P') ? 'Perempuan' : 'Laki-Laki';
                            ?>
                            <style>
                                /* --- MOBILE VIEW --- */
                                @media (max-width: 767.98px) {

                                    /* Usia pindah ke bawah nama */
                                    .pasien-nama small {
                                        display: block;
                                        margin-top: 2px;
                                    }

                                    /* Jenis kelamin dan golongan darah jadi satu baris dengan tanda ":" */
                                    .info-item p {
                                        margin-bottom: 0;
                                    }

                                    .info-label {
                                        color: #6c757d;
                                        font-weight: 600;
                                        font-size: 0.875rem;
                                        /* small */
                                    }

                                    .info-value {
                                        font-size: 0.875rem;
                                        margin-left: 4px;
                                    }
                                }
                            </style>

                            <div class="card shadow-sm border-0 mb-3" style="border-radius: 12px;">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center"
                                            style="width: 55px; height: 55px; font-size: 20px; font-weight: bold;">
                                            <?= strtoupper(substr($pasien['nama_pasien'], 0, 2)); ?>
                                        </div>
                                        <div class="ms-3 pasien-nama">
                                            <h5 class="mb-1 fw-bold">
                                                <?= htmlspecialchars($pasien['nama_pasien'], ENT_QUOTES, 'UTF-8'); ?>
                                                <small class="text-muted fw-normal">
                                                    (<?= hitung_usia6($pasien['tanggal_lahir']); ?>)
                                                </small>
                                            </h5>
                                            <div class="text-muted small">
                                                Nomor RM:
                                                <span class="fw-semibold">
                                                    <?= htmlspecialchars($pasien['nomor_rm'], ENT_QUOTES, 'UTF-8'); ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row gy-3 gx-4">
                                        <div class="col-sm-6 col-lg-4">
                                            <p class="mb-1 text-secondary fw-semibold small">Tempat, Tanggal Lahir</p>
                                            <p class="mb-0"><?= htmlspecialchars($pasien['tempat_lahir'], ENT_QUOTES, 'UTF-8'); ?>,
                                                <?= mediumdate_indo($pasien['tanggal_lahir']); ?></p>
                                        </div>

                                        <div class="col-sm-6 col-lg-4 info-item">
                                            <p class="mb-1 text-secondary fw-semibold small">Jenis Kelamin<span class="info-value">: <?= $jk; ?></span></p>
                                        </div>

                                        <div class="col-sm-6 col-lg-4 info-item">
                                            <p class="mb-0 text-secondary fw-semibold small">Golongan Darah<span class="info-value">: <?= htmlspecialchars($pasien['golongan_darah'] ?? '-', ENT_QUOTES, 'UTF-8'); ?></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        <?php endif; ?>



                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable nowrap" id="tableDetailRM"
                                data-url="<?= $nomor_rm ? base_url('rekammedik/getDataByRM/' . $nomor_rm) : '' ?>"
                                data-columns='[
                                   {"data": "no"},
                                   {"data": "tanggal_kunjungan"},
                                   {"data": "dokter_poliklinik"},
                                   {"data": "detail_diagnosa"},
                                   {"data": "diagnosa_status"}
                          
                                ]'>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Poliklinik</th>
                                        <th>Diagnosa & Pemeriksaan</th>
                                        <th>Detail</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- akan diisi AJAX -->
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat Diagnosa -->
<div class="modal fade" id="modalLihatDiagnosa" tabindex="-1" aria-labelledby="modalLihatDiagnosaLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen p-3">
        <div class="modal-content">
            <div class="modal-header text-white rounded-top-3">
                <h5 class="modal-title fw-bold">
                    <i class="bx bx-notepad"></i> Detail Pemeriksaan & Diagnosa
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="diagnosaContent">
                <div class="text-center text-muted py-3">
                    <i class="bx bx-loader bx-spin fs-2"></i><br>
                    Memuat data diagnosa...
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    // Handler tombol "Lihat Diagnosa"
    $(document).on('click', '.btnLihatDiagnosa', function() {
        var id = $(this).data('id');
        var url = base_url + "rekammedik/lihat_modal_diagnosa/" + id;

        // Tampilkan modal + indikator loading
        $("#modalLihatDiagnosa").modal('show');
        $("#diagnosaContent").html(`
        <div class="text-center text-muted py-3">
            <i class="bx bx-loader bx-spin fs-2"></i><br>
            Memuat data diagnosa...
        </div>
    `);

        // Load halaman controller penuh, lalu ambil konten bagian tertentu
        $.get(url, function(response) {
            // Ambil hanya isi utama dari layout dashboard
            var parsed = $("<div>").html(response);
            var innerContent = parsed.find(".content-wrapper").html(); // ambil isi bagian utama
            if (innerContent) {
                $("#diagnosaContent").html(innerContent);
            } else {
                $("#diagnosaContent").html(response); // fallback
            }
        }).fail(function() {
            $("#diagnosaContent").html(`
            <div class="alert alert-danger m-0">
                Gagal memuat data diagnosa. Silakan coba lagi.
            </div>
        `);
        });
    });
</script>

<!-- Style untuk menghilangkan border antar baris karena mengaktifkan scrollX -->
<style>
    /* Menghilangkan border antara baris pada tabel dengan ID tertentu */
    #tableDetailRM {
        border-collapse: collapse;
        /* Menghilangkan double borders */
    }

    #tableDetailRM th,
    #tableDetailRM td {
        border: none !important;
        /* Menghilangkan border pada th dan td */
    }

    /* Jika Anda menggunakan Bootstrap, ini memastikan tidak ada border di hover */
    #tableDetailRM tbody tr:hover {
        border: none !important;
    }
</style>

<script>
    var base_url = "<?= base_url(); ?>";

    // 🔍 Submit cari RM -> redirect ke /rekammedik/detail/<nomor_rm>
    $("#formCariRM").on("submit", function(e) {
        e.preventDefault();
        var rm = $("#nomor_rm_input").val().trim();
        if (!rm) {
            alert("Nomor RM tidak boleh kosong");
            return;
        }

        $.post(base_url + "rekammedik/cek_nomor_rm", {
            nomor_rm: rm
        }, function(res) {
            try {
                var r = (typeof res === 'string') ? JSON.parse(res) : res;
            } catch (err) {
                window.location.href = base_url + "rekammedik/detail/" + encodeURIComponent(rm);
                return;
            }
            if (r.status === 'success') {
                window.location.href = base_url + "rekammedik/detail/" + encodeURIComponent(rm);
            } else {
                alert(r.message || "Nomor RM tidak terdaftar.");
            }
        }, 'json').fail(function() {
            alert("Terjadi kesalahan saat memeriksa nomor RM.");
        });
    });

    // 🔄 Tombol Reset -> reload halaman ke rekammedik/detail
    $("#btnReset").click(function() {
        window.location.href = base_url + "rekammedik/detail";
    });

    // 🧠 Inisialisasi DataTable otomatis jika sudah ada URL pada data-url
    $(document).ready(function() {
        var url = $("#tableDetailRM").data('url');
        if (url) {
            initTable("#tableDetailRM", url);
        }
    });

    // ⚙️ Fungsi utama DataTable dengan kolom nomor, tombol export, length, dan layout modern
    function initTable(selector, ajaxUrl) {
        if ($.fn.DataTable.isDataTable(selector)) {
            $(selector).DataTable().destroy();
        }

        $(selector).DataTable({
            ajax: {
                url: ajaxUrl,
                type: 'GET',
                dataSrc: function(json) {
                    if (json.error) {
                        $(selector).find('tbody').html(
                            `<tr><td colspan="5" class="text-center">${json.error}</td></tr>`
                        );
                        return [];
                    }
                    return json;
                }
            },
            processing: true,
            serverSide: false,
            columns: [{
                    data: null
                }, // Nomor urut
                {
                    data: 'tanggal_kunjungan'
                },
                {
                    data: 'dokter_poliklinik'
                },
                {
                    data: 'detail_diagnosa'
                },
                {
                    data: 'diagnosa_status'
                }
            ],
            columnDefs: [{
                targets: 0, // Kolom nomor urut
                searchable: false,
                orderable: false,
                render: function(data, type, row, meta) {
                    return meta.row + 1;
                }
            }],
            order: [
                [1, 'desc']
            ],
            responsive: true,
            scrollX: true,
            dom:
                // Bagian atas: Length, Buttons, Search
                "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
                // Bagian tengah: Tabel
                "<'row'<'col-md-12'tr>>" +
                // Bagian bawah: Info, Pagination
                "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
            buttons: [{
                    extend: 'colvis',
                    className: 'btn btn-sm btn-outline-secondary'
                },
                {
                    extend: 'print',
                    className: 'btn btn-sm btn-outline-primary'
                },
                {
                    extend: 'excel',
                    className: 'btn btn-sm btn-outline-success'
                },
                {
                    extend: 'pdf',
                    className: 'btn btn-sm btn-outline-danger'
                }
            ],
            lengthMenu: [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            language: {
                emptyTable: "Data kunjungan belum tersedia.",
                // lengthMenu: "Tampilkan _MENU_ data per halaman",
                search: "Cari:",
                // info: "Menampilkan _START_ - _END_ dari _TOTAL_ data",
                infoEmpty: "Tidak ada data tersedia",
                // paginate: {
                //     previous: "Sebelumnya",
                //     next: "Berikutnya"
                // }
            }
        });
    }
</script>