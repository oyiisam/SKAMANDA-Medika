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
                                    Data Satuan Barang
                                </h4>
                            </div>

                            <div class="col-12 col-md-auto mt-3 mt-md-0 text-center">
                                <a href="<?= base_url('satuan/add') ?>"
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
                            <table class="table table-striped table-hover datatable nowrap" id="dataTable" data-url="<?= base_url('satuan/getData') ?>" data-table="satuan" data-columns='[
                                       {"data": "no"},
                                       {"data": "nama_satuan"},
                                       {"data": "menu"}
                                   ]'>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Satuan</th>
                                        <th>Menu</th>
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