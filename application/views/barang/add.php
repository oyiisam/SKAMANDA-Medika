<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-success text-uppercase fw-bold">
                            <i class="bx bx-package"></i> Tambah Data Barang
                        </h5>
                        <a href="<?= base_url('barang') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('', ['id' => 'barang_add']); ?>

                        <!-- Hidden tempat_barang -->
                        <div class="col-md-9" hidden>
                            <input type="text" name="tempat_barang" id="tempat_barang" class="form-control" value="Klinik" readonly>
                            <?= form_error('tempat_barang', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Kode & Jenis Barang -->
                        <div class="row mb-4 g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('kode_barang'); ?>" name="kode_barang" id="kode_barang" type="text" class="form-control" placeholder="Kode Barang" required autofocus>
                                    <label for="kode_barang">*Kode Barang</label>
                                </div>
                                <?= form_error('kode_barang', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="jenis_id" id="jenis_id" class="form-select" required>
                                        <option value="" selected disabled>*Pilih Jenis Barang</option>
                                        <?php foreach ($jenis as $j) : ?>
                                            <option <?= set_select('jenis_id', $j['id_jenis']) ?> value="<?= $j['id_jenis'] ?>">
                                                <?= $j['nama_jenis'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="jenis_id">Jenis Barang</label>
                                </div>
                                <?= form_error('jenis_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Nama & Satuan -->
                        <div class="row mb-4 g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input value="<?= set_value('nama_barang'); ?>" name="nama_barang" id="nama_barang" type="text" class="form-control" placeholder="Nama Barang" required>
                                    <label for="nama_barang">*Nama Barang</label>
                                </div>
                                <?= form_error('nama_barang', '<small class="text-danger">', '</small>'); ?>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="satuan_id" id="satuan_id" class="form-select" required>
                                        <option value="" selected disabled>*Pilih Satuan Barang</option>
                                        <?php foreach ($satuan as $s) : ?>
                                            <option <?= set_select('satuan_id', $s['id_satuan']) ?> value="<?= $s['id_satuan'] ?>">
                                                <?= $s['nama_satuan'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <label for="satuan_id">Satuan Barang</label>
                                </div>
                                <?= form_error('satuan_id', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Lokasi Barang -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <select name="lokasi_id" id="lokasi_id" class="form-select" required>
                                    <option value="" selected disabled>*Pilih Lokasi Barang</option>
                                    <?php foreach ($lokasi as $l) : ?>
                                        <option <?= set_select('lokasi_id', $l['id_lokasi']) ?> value="<?= $l['id_lokasi'] ?>">
                                            <?= $l['nama_lokasi'] . ' | ' . $l['kode_lokasi']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="lokasi_id">Lokasi Barang</label>
                            </div>
                            <?= form_error('lokasi_id', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Hidden Fields -->
                        <div hidden>
                            <input type="number" name="stok" id="stok" value="0" min="0">
                            <input type="date" name="expired_date_terdekat" id="expired_date_terdekat">
                            <input type="number" name="harga_terkini" id="harga_terkini" min="0">
                        </div>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2">
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