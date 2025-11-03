<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header bg-white border-bottom-0">
                        <div class="row align-items-center text-center text-md-start">
                            <div class="col-12 col-md">
                                <h4 class="card-title text-primary text-uppercase fw-bold mb-0">
                                    Data Pasien
                                </h4>
                            </div>

                            <div class="col-12 col-md-auto mt-3 mt-md-0 text-center">
                                <div class="d-flex flex-column flex-sm-row justify-content-center justify-content-md-end gap-2">
                                    <a href="<?= base_url('pasien/import') ?>" class="btn btn-sm btn-outline-success btn-icon-split">
                                        <span class="icon">
                                            <i class='bx bx-cloud-upload'></i>
                                        </span>
                                        <span class="text">Import</span>
                                    </a>

                                    <a href="<?= base_url('pasien/add') ?>" class="btn btn-sm btn-primary btn-icon-split">
                                        <span class="icon">
                                            <i class='bx bx-layer-plus'></i>
                                        </span>
                                        <span class="text">Tambah</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-hover datatable nowrap" id="dataTable" data-url="<?= base_url('pasien/getDataPasien') ?>" data-table="pasien" data-columns='[
                                       {"data": "no"},
                                       {"data": "nomor_rm"},
                                       {"data": "nama_pasien"},
                                       {"data": "jenis_kelamin"},
                                       {"data": "tempat_tanggal_lahir"},
                                       {"data": "golongan_darah"},
                                       {"data": "nama_orangtua"},
                                       {"data": "agama"},
                                       {"data": "alamat"},
                                       {"data": "no_telp"},
                                       {"data": "pembaruan"},
                                       {"data": "menu"}
                                   ]'>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nomor RM</th>
                                        <th>Nama</th>
                                        <th>L/P</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Golongan Darah</th>
                                        <th>Nama Ibu Kandung</th>
                                        <th>Agama</th>
                                        <th>Alamat</th>
                                        <th>Nomor Telp/WA</th>
                                        <th>Pembaruan</th>
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