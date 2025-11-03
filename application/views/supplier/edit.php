<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-success text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Data Supplier
                        </h5>
                        <a href="<?= base_url('supplier') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('', ['id' => 'supplier_edit']); ?>

                        <!-- Hidden tempat_supplier -->
                        <div class="col-md-9" hidden>
                            <input type="text" name="tempat_supplier" id="tempat_supplier" class="form-control" value="Klinik" readonly>
                            <?= form_error('tempat_supplier', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Supplier Name -->
                        <div class="form-floating mb-4">
                            <input
                                value="<?= set_value('nama_supplier', $supplier['nama_supplier']); ?>"
                                name="nama_supplier"
                                id="nama_supplier"
                                type="text"
                                class="form-control"
                                placeholder="Nama Supplier"
                                required
                                autofocus>
                            <label for="nama_supplier">Supplier Barang</label>
                            <?= form_error('nama_supplier', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Supplier Address -->
                        <div class="form-floating mb-4">
                            <textarea
                                name="alamat_supplier"
                                id="alamat_supplier"
                                class="form-control"
                                placeholder="Alamat Supplier"
                                style="height: 100px"
                                required><?= set_value('alamat_supplier', $supplier['alamat_supplier']); ?></textarea>
                            <label for="alamat_supplier">Alamat Supplier</label>
                            <?= form_error('alamat_supplier', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Phone Number -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-success" for="nomor_supplier">Nomor HP/WA</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input
                                    value="<?= set_value('nomor_supplier', substr($supplier['nomor_supplier'], 3)); ?>"
                                    name="nomor_supplier"
                                    id="nomor_supplier"
                                    type="number"
                                    class="form-control"
                                    placeholder="xxx-xxxx-xxxx"
                                    required>
                            </div>
                            <small class="text-danger">*Ditulis tanpa angka 0 di depan.</small>
                            <?= form_error('nomor_supplier', '<small class="text-danger d-block">', '</small>'); ?>
                        </div>

                        <script>
                            document.getElementById('supplier_edit').addEventListener('submit', function(event) {
                                let phone = document.getElementById('nomor_supplier').value.trim();
                                if (phone.startsWith('0')) {
                                    alert('Nomor HP/WA tidak perlu dimulai dengan angka 0.');
                                    event.preventDefault();
                                }
                            });
                        </script>

                        <!-- Buttons -->
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