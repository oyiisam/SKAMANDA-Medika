<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/instascan/jquery.min.js"></script>

<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Barang Keluar
                        </h5>
                        <a href="<?= base_url('pembelian') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('', ['id' => 'formPenjualan']); ?>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="tanggal_penjualan">Tanggal Pembelian</label>
                                <input type="date" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan" required value="<?= set_value('tanggal_penjualan', $penjualan['tanggal_penjualan']); ?>">
                                <?= form_error('tanggal_penjualan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-8">
                                <label for="nota_penjualan">Nota Penjualan</label>
                                <input type="text" class="form-control" id="nota_penjualan" name="nota_penjualan" required readonly value="<?= set_value('nota_penjualan', $penjualan['nota_penjualan']); ?>">
                                <?= form_error('nota_penjualan', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <hr>

                        <div class="table-responsive">
                            <table id="tabelPenjualan" class="table table-striped table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Kode Barang</th>
                                        <th>Nama Barang</th>
                                        <th>Batch</th>
                                        <th>Expired</th>
                                        <th>Stok Batch</th>
                                        <th>Harga Terakhir</th>
                                        <th>Jumlah</th>
                                        <th>Harga Baru</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="formtambah">
                                    <?php foreach ($detail_penjualan as $detail) : ?>
                                        <tr>
                                            <td>
                                                <input type="hidden" name="batch_id[]"
                                                    value="<?= $detail['batch_id']; ?>">
                                                <input type="text" class="form-control"
                                                    name="kode_barang[]" readonly
                                                    value="<?= set_value('kode_barang[]', $detail['kode_barang']); ?>">
                                            </td>
                                            <td>
                                                <span class="nama_barang"><?= $detail['nama_barang']; ?></span>
                                            </td>
                                            <td>
                                                <span class="nomor_batch"><?= $detail['nomor_batch']; ?></span>
                                            </td>
                                            <td>
                                                <span class="expired_date"><?= date('d-m-Y', strtotime($detail['expired_date'])); ?></span>
                                            </td>
                                            <td>
                                                <span class="stok_batch"><?= $detail['jumlah_sisa'] . ' ' . $detail['nama_satuan']; ?></span>
                                            </td>
                                            <td>
                                                <span class="riwayat_harga_terkini">
                                                    <?= 'Rp' . number_format($detail['riwayat_harga_terkini'], 0, ',', '.'); ?>
                                                </span>
                                            </td>
                                            <td>
                                                <input type="number" name="jumlah_penjualan[]"
                                                    class="form-control jumlah_penjualan"
                                                    value="<?= set_value('jumlah_penjualan[]', $detail['jumlah_penjualan']); ?>" required>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    name="harga_penjualan[]" required
                                                    value="<?= set_value('harga_penjualan[]', $detail['harga_penjualan']); ?>">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control"
                                                    name="subtotal_harga_penjualan[]" readonly
                                                    value="<?= set_value('subtotal_harga_penjualan[]', $detail['subtotal_harga_penjualan']); ?>">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>

                            </table>
                        </div>

                        <!-- Tombol Simpan dan Reset berada di tengah -->
                        <div class="d-flex justify-content-center gap-2 mt-2">
                            <button type="reset" class="btn btn-outline-secondary btn-sm">
                                <i class='bx bx-reset'></i> Reset
                            </button>
                            <button type="submit" class="btn btn-success btn-sm">
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

<script>
    $(document).ready(function() {
        // Update subtotal when jumlah_penjualan or harga_pembelian changes
        $('.formtambah').on('input', 'input[name="jumlah_penjualan[]"], input[name="harga_penjualan[]"]', function() {
            var $row = $(this).closest('tr');
            var jumlah_penjualan = $row.find('input[name="jumlah_penjualan[]"]').val();
            var harga_penjualan = $row.find('input[name="harga_penjualan[]"]').val();
            var subtotal = jumlah_penjualan * harga_penjualan;
            $row.find('input[name="subtotal_harga_penjualan[]"]').val(subtotal);
        });

    });
</script>

<style>
    /* Menghilangkan border antara baris pada tabel dengan ID tertentu */
    #tabelPenjualan {
        border-collapse: collapse;
        /* Menghilangkan double borders */
    }

    #tabelPenjualan th,
    #tabelPenjualan td {
        border: none !important;
        /* Menghilangkan border pada th dan td */
    }

    /* Jika Anda menggunakan Bootstrap, ini memastikan tidak ada border di hover */
    #tabelPenjualan tbody tr:hover {
        border: none !important;
    }
</style>

<!-- CSS tambahan agar input tidak terpotong -->
<style>
    #tabelPenjualan input {
        min-width: 100px;
        max-width: 150px;
        box-sizing: border-box;
    }

    #tabelPenjualan td,
    #tabelPenjualan th {
        white-space: nowrap;
        /* mencegah wrap */
    }

    .table-responsive {
        overflow-x: auto;
    }
</style>

<!-- Script DataTables -->
<script>
    $(document).ready(function() {
        $('#tabelPenjualan').DataTable({
            scrollX: true,
            responsive: true,
            paging: false,
            ordering: true,
            info: false,
            searching: false
        });
    });
</script>