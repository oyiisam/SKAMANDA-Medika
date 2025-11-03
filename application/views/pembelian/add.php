<!-- jQuery -->
<script src="<?= base_url() ?>/assets/vendor/jquery.min.js"></script>

<!-- Content -->
<div class="row d-flex justify-content-center">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open(''); ?>

                <div class="row">
                    <div class="col-md-3">
                        <label for="tanggal_pembelian">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required value="<?= set_value('tanggal_pembelian', date('Y-m-d')); ?>">
                        <?= form_error('tanggal_pembelian', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-3">
                        <label for="nota_pembelian">Nota</label>
                        <input type="text" class="form-control" id="nota_pembelian" name="nota_pembelian" required autofocus value="<?= set_value('nota_pembelian'); ?>">
                        <?= form_error('nota_pembelian', '<small class="text-danger">', '</small>'); ?>
                    </div>
                    <div class="col-md-6">
                        <label for="supplier_id">Supplier</label>
                        <select class="form-control" id="supplier_id" name="supplier_id" required>
                            <option value="" selected disabled>Pilih Supplier</option>
                            <?php foreach ($supplier as $row) : ?>
                                <?php if (is_admin()) : ?>
                                    <option value="<?= $row['id_supplier'] ?>" <?= set_select('supplier_id', $row['id_supplier']); ?>><?= $row['tempat_supplier'] . ' | ' . $row['nama_supplier'] ?></option>
                                <?php endif; ?>
                                <?php if (!is_admin()) : ?>
                                    <option value="<?= $row['id_supplier'] ?>" <?= set_select('supplier_id', $row['id_supplier']); ?>><?= $row['nama_supplier'] ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <?= form_error('supplier_id', '<small class="text-danger">', '</small>'); ?>
                    </div>
                </div>
                <hr>

                <div class="table-responsive">
                    <table class="table table-striped table-sm table-hover table-responsive w-100">
                        <thead>
                            <tr>
                                <th style="width: 10%;">Kode</th>
                                <th style="width: 12%;">Nama Barang</th>
                                <th style="width: 11%;">Stok</th>
                                <th style="width: 10%;">Harga Terkini</th>
                                <th style="width: 10%;">Jumlah</th>
                                <th style="width: 11%;">Nomor Batch</th>
                                <th style="width: 9%;">Expired Date</th>
                                <th style="width: 10%;">Harga Sama?</th>
                                <th style="width: 12%;">Harga Baru</th>
                                <th style="width: 4%;">#</th>
                            </tr>
                        </thead>
                        <tbody class="formtambah">
                            <tr>
                                <td>
                                    <input name="kode_barang[]" class="form-control kode_barang" type="text" placeholder="Kode" autofocus required>
                                </td>
                                <td><span class="nama_barang"></span></td>
                                <td><span class="stok"></span></td>
                                <td><span class="harga_terkini"></span></td>
                                <td>
                                    <input type="number" name="jumlah_pembelian[]" class="form-control jumlah_pembelian" placeholder="Jumlah" required>
                                </td>
                                <td>
                                    <input type="text" name="nomor_batch[]" class="form-control nomor_batch" placeholder="Nomor Batch" required>
                                </td>
                                <td>
                                    <input type="date" name="expired_date[]" class="form-control expired_date" placeholder="Expired Date" required>
                                </td>
                                <td>
                                    <select name="harga_sama[]" class="form-control harga_sama" required>
                                        <option value="yes">Ya</option>
                                        <option value="no">Tidak</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="number" name="harga_baru[]" class="form-control harga_baru" placeholder="Harga Baru" readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger btn-sm remove-row">
                                        <i class="bx bx-trash"></i>
                                    </button>
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
                    <button type="submit" class="btn btn-danger btn-sm">
                        <i class='bx bx-save'></i> Simpan
                    </button>
                </div>

                <?= form_close(); ?>
            </div>

            <script>
                $(document).ready(function() {
                    // Add row
                    $('.add-row').click(function() {
                        // Buat baris baru
                        var newRow = '<tr>' +
                            '<td><input name="kode_barang[]" class="form-control kode_barang" type="text" placeholder="Kode" required></td>' +
                            '<td><span class="nama_barang"></span></td>' +
                            '<td><span class="stok"></span></td>' +
                            '<td><span class="harga_terkini"></span></td>' +
                            '<td><input type="number" name="jumlah_pembelian[]" class="form-control jumlah_pembelian" placeholder="Jumlah" required></td>' +
                            '<td><input type="text" name="nomor_batch[]" class="form-control nomor_batch" placeholder="Nomor Batch" required></td>' +
                            '<td><input type="date" name="expired_date[]" class="form-control expired_date" placeholder="Expired Date" required></td>' +
                            '<td><select name="harga_sama[]" class="form-control harga_sama" required>' +
                            '<option value="yes">Ya</option>' +
                            '<option value="no">Tidak</option>' +
                            '</select></td>' +
                            '<td><input type="number" name="harga_baru[]" class="form-control harga_baru" placeholder="Harga Baru" readonly></td>' +
                            '<td><button type="button" class="btn btn-danger btn-sm remove-row"><i class="bx bx-trash"></i></button></td>' +
                            '</tr>';

                        $('.formtambah').append(newRow);

                        // Fokus pada input kode_barang yang baru
                        var newRowElement = $('.formtambah tr').last();
                        newRowElement.find('.kode_barang').focus();
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
                                url: '<?= base_url('pembelian/cek_kode_barang') ?>',
                                type: 'POST',
                                data: {
                                    kode_barang: kode_barang
                                },
                                dataType: 'json',
                                success: function(response) {
                                    if (response.status === 'success') {
                                        $row.find('.nama_barang').text(response.data.nama_barang);
                                        // Menampilkan stok dan satuan di kolom stok
                                        $row.find('.stok').text(response.data.stok + ' ' + response.data.nama_satuan);
                                        $row.find('.harga_terkini').text(response.data.harga_terkini);
                                        $row.find('.jumlah_pembelian').val('').focus();
                                    } else {
                                        alert(response.message);
                                        $row.find('.kode_barang').val('').focus();
                                        $row.find('.nama_barang').text('');
                                        $row.find('.stok').text('');
                                        $row.find('.harga_terkini').text('');
                                    }
                                }
                            });
                        } else {
                            $row.find('.nama_barang').text('');
                            $row.find('.stok').text('');
                            $row.find('.harga_terkini').text('');
                        }
                    });

                    // Enable harga_baru input if harga_sama is "no"
                    $('.formtambah').on('change', '.harga_sama', function() {
                        var $row = $(this).closest('tr');
                        if ($(this).val() === 'no') {
                            $row.find('.harga_baru').prop('readonly', false).val('');
                        } else {
                            $row.find('.harga_baru').prop('readonly', true).val('');
                        }
                    });
                });
            </script>

        </div>
    </div>
</div>