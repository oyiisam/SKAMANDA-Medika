<div class="row d-flex justify-content-center">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col">
                        <p class="card-title mb-0">
                            <strong>Hari, Tanggal :</strong> <?= longdate_indo($pembelian['tanggal_pembelian']); ?>
                        </p>
                        <p class="card-title mb-0">
                            <strong>Total Harga :</strong> <?= 'Rp' . number_format($pembelian['total_harga_pembelian'], 0, ',', '.'); ?>
                        </p>
                        <p class="card-title mb-0">
                            <strong>Supplier :</strong> <?= $pembelian['nama_supplier']; ?>
                        </p>
                        <p class="card-title mb-2">
                            <strong>Nota :</strong> <?= $pembelian['nota_pembelian']; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <?= $this->session->flashdata('pesan'); ?>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Nomor Batch</th>
                                <th>Expired Date</th>
                                <th>Harga SubTotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            if ($detail_pembelian) :
                                foreach ($detail_pembelian as $g) :
                            ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $g['nama_barang']; ?></td>
                                        <td><?= 'Rp' . number_format($g['harga_pembelian'], 0, ',', '.'); ?></td>
                                        <td><?= $g['jumlah_pembelian'] . ' ' . $g['nama_satuan']; ?></td>
                                        <td><?= $g['nomor_batch']; ?></td>
                                        <td><?= mediumdate_indo($g['expired_date']); ?></td>
                                        <td><?= 'Rp' . number_format($g['subtotal_harga_pembelian'], 0, ',', '.'); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                                <tr>
                                    <td colspan="6" class="text-center"><strong>Total</strong></td>
                                    <td><strong><?= 'Rp' . number_format($pembelian['total_harga_pembelian'], 0, ',', '.'); ?></strong></td>
                                </tr>
                            <?php else : ?>
                                <tr>
                                    <td colspan="7" class="text-center">
                                        Data Kosong
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>