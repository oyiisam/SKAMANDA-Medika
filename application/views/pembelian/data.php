<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>

<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card ">
                    <div class="card-header bg-white border-bottom-0">
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md">
                                <h4 class="card-title text-danger text-uppercase fw-bold mb-2">
                                    Data Barang Masuk
                                </h4>
                                <p class="small text-danger mb-0">
                                    <i class="bx bx-error"></i>
                                    *Menu <strong>DELETE</strong> akan menghapus data beserta detailnya. Stok dan harga terkini akan dikembalikan otomatis!
                                </p>
                            </div>

                            <!-- Tombol di bawah saat mobile -->
                            <div class="col-12 col-md-auto mt-3 mt-md-0 text-center">
                                <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-md-end gap-2">
                                    <a href="<?= base_url('pembelian/detail') ?>"
                                        class="btn btn-sm btn-outline-danger">
                                        <i class='bx bx-detail'></i> Detail Semua Barang Masuk
                                    </a>

                                    <button class="btn btn-sm btn-danger"
                                        id="btnAddPembelian"
                                        data-bs-toggle="modal"
                                        data-bs-target="#addModal">
                                        <i class='bx bx-layer-plus'></i> Tambah
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable align-middle nowrap"
                                id="dataTable_pembelian_withDetail"
                                data-url="<?= base_url('pembelian/getDataPembelian') ?>"
                                data-table="pembelian"
                                data-columns='[
                                    {"data": "no"},
                                    {"data": "tanggal_pembelian"},
                                    {"data": "total_harga_pembelian"},
                                    {"data": "nama_supplier"},
                                    {"data": "nota_pembelian"},
                                    {"data": "detail"},
                                    {"data": "menu"}
                                    ]'>
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Total Harga</th>
                                        <th>Supplier</th>
                                        <th>Nota</th>
                                        <th>Detail</th>
                                        <th>Menu</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Data akan dimuat via AJAX -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Detail Pembelian -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen p-3">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom">
                <h4 class="modal-title text-danger text-uppercase fw-bold mb-2">Detail Barang Masuk</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="detailModalContent">
                <div id="modalContent"></div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Pembelian -->
<div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen p-3">
        <div class="modal-content">
            <div class="modal-header bg-light border-bottom">
                <h4 class="modal-title text-danger text-uppercase fw-bold mb-2">Tambah Barang Masuk</h4>
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

<!-- JS Handling -->
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
                url: "<?= base_url('pembelian/add') ?>",
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