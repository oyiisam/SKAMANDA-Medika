<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>
<!-- Content -->
<div class="row d-flex justify-content-center">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', ['id' => 'formPembelian']); ?>

                <div class="row">
                    <div class="col-md-2">
                        <label for="tanggal_penjualan">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_penjualan" name="tanggal_penjualan" required value="<?= set_value('tanggal_penjualan', date('Y-m-d')); ?>">
                        <?= form_error('tanggal_penjualan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-6">
                        <label for="keterangan_penjualan">Keterangan</label>
                        <textarea id="keterangan_penjualan" name="keterangan_penjualan" value="" rows="2" class="form-control" placeholder="Keterangan Barang Keluar" required><?= set_value('keterangan_penjualan') ?></textarea>
                        <?= form_error('keterangan_penjualan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-4">
                        <label for="nota_penjualan">Nota</label>
                        <input id="nota_penjualan" name="nota_penjualan" value="<?= $nota_penjualan; ?>" readonly="readonly" type="text" class="form-control" placeholder="Nota">
                        <?= form_error('nota_penjualan', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table table-striped table-hover table-responsive w-100 nowrap">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Stok</th>
                                <th>Harga Terkini</th>
                                <th>Jumlah</th>
                                <th>Subtotal</th>
                                <th>#</th>
                            </tr>
                        </thead>
                        <tbody class="formtambah">
                            <tr>
                                <td>
                                    <input name="kode_barang[]" class="form-control kode_barang" type="text" placeholder="Kode" autofocus required>
                                </td>
                                <td>
                                    <span class="nama_barang"></span>
                                </td>
                                <td>
                                    <span class="stok"></span>
                                </td>
                                <td>
                                    <span class="harga_terkini"></span>
                                </td>
                                <td>
                                    <input type="number" name="jumlah_penjualan[]" class="form-control jumlah_penjualan" placeholder="Jumlah" required>
                                </td>
                                <td><span class="subtotal_penjualan"></span></td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row"><i class="bx bx-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <hr>

                <!-- Tombol Tambah Barang penuh satu baris -->
                <div class="row mt-4 justify-content-center">
                    <div class="d-grid gap-2 col-lg-12 mx-auto">
                        <button type="button" class="btn btn-sm btn-primary btn-block add-row">
                            <i class='bx bx-layer-plus'></i>
                            Tambah Barang
                        </button>
                    </div>
                </div>

                <hr>

                <!-- Tombol Simpan dan Reset berada di tengah -->
                <div class="d-flex justify-content-center gap-2 mt-2">
                    <button type="reset" class="btn btn-outline-secondary btn-sm" onclick="return confirm('Yakin ingin mereset? Data akan terhapus semua!')">
                        <i class='bx bx-reset'></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary btn-sm">
                        <i class='bx bx-save'></i> Simpan
                    </button>
                </div>


                <?= form_close(); ?>
            </div>

            <script>
                $(document).ready(function() {
                    // Function to add a new row
                    function addRow() {
                        var newRow = '<tr>' +
                            '<td><input name="kode_barang[]" class="form-control kode_barang" type="text" placeholder="Kode" required></td>' +
                            '<td><span class="nama_barang"></span></td>' +
                            '<td><span class="stok"></span></td>' +
                            '<td ><span class="harga_terkini"></span></td>' +
                            '<td><input type="number" name="jumlah_penjualan[]" class="form-control jumlah_penjualan" placeholder="Jumlah" required></td>' +
                            '<td ><span class="subtotal_penjualan"></span></td>' +
                            '<td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bx bx-trash"></i></button></td>' +
                            '</tr>';

                        $('.formtambah').append(newRow);

                        // Fokus pada input kode_barang yang baru
                        var newRowElement = $('.formtambah tr').last();
                        newRowElement.find('.kode_barang').focus();
                    }

                    // Add row secara manual
                    $('.add-row').click(function() {
                        addRow();
                    });

                    // Remove row
                    $('.formtambah').on('click', '.remove-row', function() {
                        $(this).closest('tr').remove();
                    });

                    // Fetch barang details on kode_barang input blur
                    $('.formtambah').on('blur', '.kode_barang', function() {
                        var kode_barang = $(this).val();
                        var $row = $(this).closest('tr');

                        if (kode_barang !== '') {
                            $.ajax({
                                url: '<?= base_url('penjualan/cek_kode_barang') ?>',
                                type: 'POST',
                                data: {
                                    kode_barang: kode_barang
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        var harga_terkini = response.data.harga_terkini;
                                        var jumlah_penjualan = 1;
                                        var subtotal_penjualan = harga_terkini * jumlah_penjualan;

                                        $row.find('.nama_barang').text(response.data.nama_barang);
                                        $row.find('.stok').text(response.data.stok + ' ' + response.data.nama_satuan);
                                        $row.find('.harga_terkini').text(harga_terkini);
                                        $row.find('.jumlah_penjualan').val(jumlah_penjualan);
                                        $row.find('.subtotal_penjualan').text(subtotal_penjualan);

                                        addRow(); // Tambah baris form baru setelah sukses
                                    } else {
                                        alert(response.message);
                                        $row.find('.kode_barang').val('').focus();
                                        $row.find('.nama_barang').text('');
                                        $row.find('.stok').text('');
                                        $row.find('.harga_terkini').text('');
                                        $row.find('.jumlah_penjualan').val('');
                                        $row.find('.subtotal_penjualan').text('');
                                    }
                                }
                            });
                        } else {
                            $row.find('.nama_barang').text('');
                            $row.find('.stok').text('');
                            $row.find('.harga_terkini').text('');
                            $row.find('.jumlah_penjualan').val('');
                            $row.find('.subtotal_penjualan').text('');
                        }
                    });

                    // Calculate subtotal on jumlah_penjualan change
                    $('.formtambah').on('input', '.jumlah_penjualan', function() {
                        var $row = $(this).closest('tr');
                        var jumlah_penjualan = $(this).val();
                        var harga_terkini = $row.find('.harga_terkini').text();
                        var subtotal_penjualan = jumlah_penjualan * harga_terkini;
                        $row.find('.subtotal_penjualan').text(subtotal_penjualan);
                    });
                });
            </script>

        </div>
    </div>
</div>