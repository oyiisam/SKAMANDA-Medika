<!-- DATA STOK -->
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <!-- Header versi cetak -->
                    <div class="d-none d-print-block mt-4 mb-0 text-center">
                        <h3 class="text-primary fw-bold text-uppercase mb-1">
                            KARTU STOK <?= strtoupper($kartu_stok['nama_barang']); ?>
                        </h3>
                        <h5 class="mb-2">
                            <?= '#' . $kartu_stok['kode_barang'] . ' | ' . $kartu_stok['nama_lokasi']; ?>
                        </h5>
                        <p class="mb-0" style="font-family: 'Courier New', Courier, monospace;">
                            Dicetak pada:
                            <script>
                                document.write(new Date().toLocaleString("id-ID", {
                                    hour12: false
                                }));
                            </script>
                        </p>
                    </div>

                    <!-- Header versi layar -->
                    <div class="card-header bg-white border-bottom-0 d-print-none">
                        <div class="row align-items-center text-center text-md-start">
                            <!-- Bagian kiri: judul dan detail barang -->
                            <div class="col-12 col-md">
                                <h4 class="card-title text-primary text-uppercase fw-bold mb-2">
                                    Kartu Stok Barang
                                </h4>
                                <ul class="list-unstyled mb-0 ps-3">
                                    <li>
                                        <p class="mb-1">
                                            <strong>Nama Barang:</strong>
                                            <?= '#' . $kartu_stok['kode_barang'] . ' | ' . $kartu_stok['nama_barang'] ?>
                                        </p>
                                    </li>
                                    <li>
                                        <p class="mb-0">
                                            <strong>Lokasi:</strong> <?= $kartu_stok['nama_lokasi'] ?>
                                        </p>
                                    </li>
                                </ul>
                            </div>

                            <!-- Bagian kanan: tombol aksi -->
                            <div class="col-12 col-md-auto mt-3 mt-md-0 text-center text-md-end">
                                <div class="d-flex justify-content-center justify-content-md-end gap-2">
                                    <button onclick="window.print()" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon">
                                            <i class="bx bx-printer"></i>
                                        </span>
                                        <span class="text">Print</span>
                                    </button>
                                    <a href="<?= base_url('stok') ?>" class="btn btn-sm btn-outline-secondary btn-icon-split">
                                        <span class="icon">
                                            <i class="bx bx-rotate-left"></i>
                                        </span>
                                        <span class="text">Kembali</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Body -->
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap" id="dataTableKartuStok">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Nomor Batch</th>
                                        <th>Expired Date</th>
                                        <th>Masuk</th>
                                        <th>Keluar</th>
                                        <th>Stok</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $stok_akhir = $stok_awal;
                                    ?>
                                    <tr style="font-weight:bold; font-family:monospace; color:red;">
                                        <td><?= $no++; ?></td>
                                        <td><?= mediumdate_indo(date('Y-m-d', strtotime($kartu_stok['time_stamp']))); ?></td>
                                        <td><?= $kartu_stok['nama_barang']; ?></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td><?= $stok_awal; ?></td>
                                    </tr>
                                    <?php foreach ($kartu_stok['riwayat'] as $r): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= mediumdate_indo($r['tanggal']); ?></td>
                                            <td><?= $r['keterangan']; ?></td>
                                            <td><?= $r['nomor_batch'] ?? '-'; ?></td>
                                            <td><?= isset($r['expired_date']) ? mediumdate_indo($r['expired_date']) : '-'; ?></td>
                                            <td><?= $r['jumlah_masuk'] ?: '-'; ?></td>
                                            <td><?= $r['jumlah_keluar'] ?: '-'; ?></td>
                                            <td>
                                                <?php
                                                $stok_akhir += $r['jumlah_masuk'] - $r['jumlah_keluar'];
                                                echo $stok_akhir;
                                                ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- CSS CETAK -->
<style>
    @media print {
        body {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
            font-size: 12px;
        }

        /* Sembunyikan elemen non-cetak */
        #layout-menu,
        .layout-overlay,
        .content-footer,
        .d-print-none,
        .dt-buttons {
            display: none !important;
        }

        /* Tampilkan header cetak */
        .d-print-block {
            display: block !important;
        }

        /* Tabel */
        table {
            border-collapse: collapse !important;
            width: 100% !important;
            font-size: 11px;
        }

        th,
        td {
            border: 1px solid #000 !important;
            padding: 4px !important;
        }

        thead {
            display: table-header-group;
        }

        tr {
            page-break-inside: avoid !important;
        }

        /* Hilangkan sorting icons */
        table.dataTable thead .sorting:after,
        table.dataTable thead .sorting_asc:after,
        table.dataTable thead .sorting_desc:after {
            display: none !important;
        }

        /* Ukuran kertas & margin */
        @page {
            size: F4 landscape;
            margin: 5mm;
        }

        .table-responsive {
            overflow: visible !important;
        }

        footer {
            position: relative !important;
            text-align: center;
            font-size: 11px;
            color: #000;
            font-family: "Courier New", Courier, monospace;
        }
    }
</style>

<!-- FOOTER CETAK -->
<footer class="d-print-block d-none">
    <hr class="mt-3">
    <p class="mb-0">
        Dicetak pada:
        <script>
            document.write(new Date().toLocaleString("id-ID", {
                hour12: false
            }));
        </script>
    </p>
</footer>