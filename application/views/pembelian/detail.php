<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y ">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-success text-uppercase fw-bold">
                            <i class="bx bx-detail"></i> Detail Semua Barang Masuk
                        </h5>
                        <a href="<?= base_url('pembelian') ?>" class="btn btn-sm btn-outline-success">
                            <i class='bx bx-rotate-left'></i> Tambah Barang Masuk
                        </a>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover nowrap datatable" id="dataTable_noMenu" data-url="<?= base_url('pembelian/getDetailPembelian') ?>" data-table="pembelian" data-columns='[
                                {"data": "no"},
                                {"data": "tanggal_pembelian"},
                                {"data": "nama_barang"},
                                {"data": "expired_date"},
                                {"data": "harga_pembelian"},
                                {"data": "jumlah_pembelian_satuan"},
                                {"data": "harga_subtotal"},
                                {"data": "nota_pembelian"}
                            ]'>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Nama Barang</th>
                                        <th>Expired Date</th>
                                        <th>Harga Satuan</th>
                                        <th>Jumlah Terjual</th>
                                        <th>Harga SubTotal</th>
                                        <th>Nota</th>
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