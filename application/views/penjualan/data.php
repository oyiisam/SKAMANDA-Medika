<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <!-- Header -->
                    <div class="card-header bg-white border-bottom-0">
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md">
                                <h4 class="card-title text-primary text-uppercase fw-bold mb-2">
                                    Data Barang Keluar
                                </h4>
                                <p class="small text-primary mb-0">
                                    <i class="bx bx-error"></i>
                                    *Menu <strong>DELETE</strong> akan menghapus data beserta detailnya. Stok dan harga terkini akan dikembalikan otomatis!
                                </p>
                            </div>

                            <!-- Tombol di bawah saat mobile -->
                            <div class="col-12 col-md-auto mt-3 mt-md-0 text-center">
                                <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-md-end gap-2">
                                    <a href="<?= base_url('penjualan/detail') ?>"
                                        class="btn btn-sm btn-outline-primary">
                                        <i class='bx bx-detail'></i> Detail Semua Barang Keluar
                                    </a>

                                    <button class="btn btn-sm btn-primary"
                                        id="btnAddPenjualan"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addModal">
                                        <i class='bx bx-layer-plus'></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable align-middle nowrap"
                                id="dataTable_penjualan_withDetail"
                                data-url="<?= base_url('penjualan/getDataPenjualan') ?>"
                                data-table="penjualan"
                                data-columns='[
                                        {"data": "no"},
                                        {"data": "tanggal_penjualan"},
                                        {"data": "keterangan_penjualan"},
                                        {"data": "nota_penjualan"},
                                        {"data": "detail"},
                                        {"data": "menu"}
                                    ]'>
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Nota</th>
                                        <th>Detail</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Barang Keluar -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen p-3">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom">
                <h4 class="modal-title text-primary text-uppercase fw-bold mb-2">Detail Barang Keluar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalContent">
                <div id="modalContent"></div>
            </div>
            <div class="modal-footer bg-light border-top">
                <button type="button" class="btn btn-primary w-100" onclick="printModalContent()">
                    <i class="bx bx-printer"></i> Cetak
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Barang Keluar -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen p-3">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom">
                <h4 class="modal-title text-primary text-uppercase fw-bold mb-2">Tambah Barang Keluar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="addModalContent">
                <div class="text-center p-5">
                    <div class="spinner-border text-danger" role="status"></div>
                    <p class="mt-2 mb-0 text-muted">Memuat form...</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JS Print Function -->
<script>
    function printModalContent() {
        var content = document.getElementById('modalContent').innerHTML;
        var printWindow = window.open('', '', 'height=600,width=800');

        printWindow.document.write(`
      <html>
        <head>
          <title>SKAMANDA Business Center</title>
          <style>
            @media print {
              @page {
                size: 74cm auto;
                margin: 2mm;
              }
              body {
                font-family: "Courier New", Courier, monospace;
                font-size: 9px;
                margin: 0;
                padding: 0;
              }
              header, footer {
                text-align: center;
                font-size: 9px;
                margin: 0;
                padding: 0;
              }
              footer {
                margin-top: 10px;
                border-top: 0.5px solid #000;
                padding-top: 5px;
              }
              table {
                width: 100%;
                border-collapse: collapse;
                font-size: 9px;
              }
              th, td {
                border: 0.5px solid #000;
                padding: 5px;
                text-align: center;
              }
              p, h3, h4 {
                text-align: center;
                margin: 3px;
              }
            }
          </style>
        </head>
        <body>
          <header>
            <h3>#SKAMANDA Medika</h3>
            <p>Jalan Patimura 20, Junrejo, Kota Batu</p>
          </header>

          ${content}

          <footer>
            <p>Dicetak pada: ${new Date().toLocaleString()}</p>
          </footer>
        </body>
      </html>
    `);

        printWindow.document.close();
        printWindow.onload = function() {
            printWindow.focus();
            printWindow.print();
        };
        printWindow.onafterprint = function() {
            printWindow.close();
        };
    }
</script>

<!-- JS Handling Modal Tambah -->
<script>
    $(document).ready(function() {
        // Saat modal Tambah ditampilkan
        $('#addModal').on('show.bs.modal', function() {
            $('#addModalContent').html(`
        <div class="text-center p-5">
          <div class="spinner-border text-danger" role="status"></div>
          <p class="mt-2 mb-0 text-muted">Memuat form...</p>
        </div>
      `);

            $.ajax({
                url: "<?= base_url('penjualan/add') ?>",
                type: "GET",
                success: function(res) {
                    $('#addModalContent').html(res);
                },
                error: function() {
                    $('#addModalContent').html("<p class='text-danger text-center'>Gagal memuat form. Silakan coba lagi!</p>");
                }
            });
        });

        // Bersihkan modal saat ditutup
        $('#addModal').on('hidden.bs.modal', function() {
            $('#addModalContent').html("");
        });
    });
</script>