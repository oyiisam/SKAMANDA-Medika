<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/instascan/jquery.min.js"></script>

<div class="content-wrapper">

    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-danger text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Barang Masuk
                        </h5>
                        <a href="<?= base_url('pembelian') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <!-- tampilkan alert error batch (jika ada dari controller) -->
                        <?php if (!empty($error_batch_alert)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?= $error_batch_alert ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <?= form_open('', ['id' => 'formPembelian']); ?>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="tanggal_pembelian">Tanggal Pembelian</label>
                                <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required value="<?= set_value('tanggal_pembelian', $pembelian['tanggal_pembelian']); ?>">
                                <?= form_error('tanggal_pembelian', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-3">
                                <label for="nota_pembelian">Nota Pembelian</label>
                                <input type="text" class="form-control" id="nota_pembelian" name="nota_pembelian" required value="<?= set_value('nota_pembelian', $pembelian['nota_pembelian']); ?>">
                                <?= form_error('nota_pembelian', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <label for="supplier_id">Supplier</label>
                                <select class="form-control" id="supplier_id" name="supplier_id" required>
                                    <option value="" selected disabled>Pilih Supplier</option>
                                    <?php foreach ($supplier as $row) : ?>
                                        <?php if (is_admin()) : ?>
                                            <option value="<?= $row['id_supplier'] ?>" <?= $pembelian['supplier_id'] == $row['id_supplier'] ? 'selected' : ''; ?> <?= set_select('supplier_id', $row['id_supplier']); ?>>
                                                <?= $row['tempat_supplier'] . ' | ' . $row['nama_supplier'] ?>
                                            </option>
                                        <?php else : ?>
                                            <option value="<?= $row['id_supplier'] ?>" <?= $pembelian['supplier_id'] == $row['id_supplier'] ? 'selected' : ''; ?> <?= set_select('supplier_id', $row['id_supplier']); ?>>
                                                <?= $row['nama_supplier'] ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('supplier_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>
                        <hr>

                        <!-- Wrapper tabel responsive -->
                        <div class="table-responsive">
                            <table id="tabelPembelian" class="table table-striped table-hover nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama Barang</th>
                                        <th>Stok</th>
                                        <th>Harga Lama</th>
                                        <th>Jumlah</th>
                                        <th>Nomor Batch</th>
                                        <th>Expired Date</th>
                                        <th>Harga Baru</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="formtambah">
                                    <?php foreach ($detail_pembelian as $index => $detail) :
                                        // ambil nilai terakhir (POST) jika ada, atau fallback ke DB
                                        $kodeVal = set_value('kode_barang[' . $index . ']', $detail['kode_barang']);
                                        $jumlahVal = set_value('jumlah_pembelian[' . $index . ']', $detail['jumlah_pembelian']);
                                        $nomorVal = set_value('nomor_batch[' . $index . ']', $detail['nomor_batch']);
                                        $expiredVal = set_value('expired_date[' . $index . ']', $detail['expired_date']);
                                        $hargaVal = set_value('harga_pembelian[' . $index . ']', $detail['harga_pembelian']);
                                        $subtotalVal = set_value('subtotal_harga_pembelian[' . $index . ']', $detail['subtotal_harga_pembelian']);

                                        // cek apakah nomor batch ini bentrok (controller mengirim batch_bentrok_numbers)
                                        $batch_bentrok_numbers = isset($batch_bentrok_numbers) ? $batch_bentrok_numbers : [];
                                        $is_bentrok = !empty($nomorVal) && in_array($nomorVal, $batch_bentrok_numbers);
                                    ?>
                                        <tr>
                                            <td>
                                                <input type="text" class="form-control" name="kode_barang[<?= $index ?>]" readonly
                                                    value="<?= htmlspecialchars($kodeVal) ?>">
                                            </td>
                                            <td><span class="nama_barang"><?= htmlspecialchars($detail['nama_barang']); ?></span></td>
                                            <td><span class="stok"><?= htmlspecialchars($detail['stok'] . ' ' . $detail['nama_satuan']); ?></span></td>
                                            <td><span class="riwayat_harga_terkini"><?= 'Rp' . number_format($detail['riwayat_harga_terkini'], 0, ',', '.'); ?></span></td>
                                            <td>
                                                <input type="number" name="jumlah_pembelian[<?= $index ?>]" class="form-control jumlah_pembelian"
                                                    value="<?= htmlspecialchars($jumlahVal) ?>" required>
                                            </td>
                                            <td>
                                                <input type="text" name="nomor_batch[<?= $index ?>]" class="form-control nomor_batch <?= $is_bentrok ? 'is-invalid' : '' ?>"
                                                    value="<?= htmlspecialchars($nomorVal) ?>" required>
                                                <?php if ($is_bentrok) : ?>
                                                    <div class="invalid-feedback">
                                                        Nomor batch ini sudah digunakan.
                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <input type="date" class="form-control" name="expired_date[<?= $index ?>]" required
                                                    value="<?= htmlspecialchars($expiredVal) ?>">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control harga_pembelian" name="harga_pembelian[<?= $index ?>]" required
                                                    value="<?= htmlspecialchars($hargaVal) ?>">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control subtotal_harga_pembelian" name="subtotal_harga_pembelian[<?= $index ?>]" readonly
                                                    value="<?= htmlspecialchars($subtotalVal) ?>">
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
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class='bx bx-save'></i> Simpan
                            </button>
                        </div>

                        <?= form_close(); ?>
                    </div>

                    <script>
                        function hitungSubtotal($row) {
                            var jumlah = parseFloat($row.find('.jumlah_pembelian').val()) || 0;
                            var harga = parseFloat($row.find('.harga_pembelian').val()) || 0;
                            var subtotal = jumlah * harga;
                            $row.find('.subtotal_harga_pembelian').val(subtotal);
                            return subtotal;
                        }

                        function hitungSemuaSubtotal() {
                            var total = 0;
                            $('.formtambah tr').each(function() {
                                total += hitungSubtotal($(this));
                            });
                            return total;
                        }

                        $(document).ready(function() {
                            // Hitung ulang semua subtotal saat halaman pertama kali load
                            hitungSemuaSubtotal();

                            // Update subtotal ketika jumlah atau harga berubah
                            $('.formtambah').on('input', '.jumlah_pembelian, .harga_pembelian', function() {
                                var $row = $(this).closest('tr');
                                hitungSubtotal($row);
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Menghilangkan border antara baris pada tabel dengan ID tertentu */
    #tabelPembelian {
        border-collapse: collapse;
        /* Menghilangkan double borders */
    }

    #tabelPembelian th,
    #tabelPembelian td {
        border: none !important;
        /* Menghilangkan border pada th dan td */
    }

    /* Jika Anda menggunakan Bootstrap, ini memastikan tidak ada border di hover */
    #tabelPembelian tbody tr:hover {
        border: none !important;
    }
</style>

<!-- CSS tambahan agar input tidak terpotong -->
<style>
    #tabelPembelian input {
        min-width: 100px;
        max-width: 150px;
        box-sizing: border-box;
    }

    #tabelPembelian td,
    #tabelPembelian th {
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
        $('#tabelPembelian').DataTable({
            scrollX: true,
            responsive: true,
            paging: false,
            ordering: true,
            info: false,
            searching: false
        });
    });
</script>