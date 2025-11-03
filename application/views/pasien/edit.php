<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm">
                    <!-- Header -->
                    <div
                        class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-user-check"></i> Edit Data Pasien
                        </h5>
                        <a href="<?= base_url('pasien') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class="bx bx-rotate-left"></i> Kembali
                        </a>
                    </div>

                    <!-- Body -->
                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('', ['id' => 'pasien']); ?>

                        <!-- Nomor RM -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <input name="nomor_rm" id="nomor_rm"
                                    value="<?= set_value('nomor_rm', $pasien['nomor_rm']); ?>" readonly
                                    type="text" class="form-control" placeholder="Nomor RM" required>
                                <label for="nomor_rm">Nomor Rekam Medik</label>
                            </div>
                            <?= form_error('nomor_rm', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Nama Pasien -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <input name="nama_pasien" id="nama_pasien"
                                    value="<?= set_value('nama_pasien', $pasien['nama_pasien']); ?>"
                                    type="text" class="form-control" placeholder="Nama Pasien" required autofocus>
                                <label for="nama_pasien">Nama Pasien</label>
                            </div>
                            <?= form_error('nama_pasien', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                    <option value="" disabled>Pilih Jenis Kelamin</option>
                                    <option value="L" <?= set_select('jenis_kelamin', 'L', $pasien['jenis_kelamin'] == 'L') ?>>Laki-laki</option>
                                    <option value="P" <?= set_select('jenis_kelamin', 'P', $pasien['jenis_kelamin'] == 'P') ?>>Perempuan</option>
                                </select>
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                            </div>
                            <?= form_error('jenis_kelamin', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Tempat & Tanggal Lahir -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input name="tempat_lahir" id="tempat_lahir"
                                        value="<?= set_value('tempat_lahir', $pasien['tempat_lahir']); ?>"
                                        type="text" class="form-control" placeholder="Tempat Lahir" required>
                                    <label for="tempat_lahir">Tempat Lahir</label>
                                </div>
                                <?= form_error('tempat_lahir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input name="tanggal_lahir" id="tanggal_lahir"
                                        value="<?= set_value('tanggal_lahir', $pasien['tanggal_lahir']); ?>"
                                        type="date" class="form-control" placeholder="Tanggal Lahir" required>
                                    <label for="tanggal_lahir">Tanggal Lahir</label>
                                </div>
                                <?= form_error('tanggal_lahir', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Ibu Kandung & Golongan Darah -->
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input name="nama_orangtua" id="nama_orangtua"
                                        value="<?= set_value('nama_orangtua', $pasien['nama_orangtua']); ?>"
                                        type="text" class="form-control" placeholder="Nama Ibu Kandung" required>
                                    <label for="nama_orangtua">Nama Ibu Kandung</label>
                                </div>
                                <?= form_error('nama_orangtua', '<small class="text-danger">', '</small>'); ?>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <select name="golongan_darah" id="golongan_darah" class="form-select" required>
                                        <option value="" disabled>Pilih Golongan Darah</option>
                                        <option value="A" <?= set_select('golongan_darah', 'A', $pasien['golongan_darah'] == 'A') ?>>A</option>
                                        <option value="B" <?= set_select('golongan_darah', 'B', $pasien['golongan_darah'] == 'B') ?>>B</option>
                                        <option value="AB" <?= set_select('golongan_darah', 'AB', $pasien['golongan_darah'] == 'AB') ?>>AB</option>
                                        <option value="O" <?= set_select('golongan_darah', 'O', $pasien['golongan_darah'] == 'O') ?>>O</option>
                                        <option value="tidak_diketahui" <?= set_select('golongan_darah', 'tidak_diketahui', $pasien['golongan_darah'] == 'tidak_diketahui') ?>>Tidak Diketahui</option>
                                    </select>
                                    <label for="golongan_darah">Golongan Darah</label>
                                </div>
                                <?= form_error('golongan_darah', '<small class="text-danger">', '</small>'); ?>
                            </div>
                        </div>

                        <!-- Agama -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <select name="agama" id="agama" class="form-select" required>
                                    <option value="" disabled>Pilih Agama</option>
                                    <option value="Islam" <?= set_select('agama', 'Islam', $pasien['agama'] == 'Islam') ?>>Islam</option>
                                    <option value="Kristen" <?= set_select('agama', 'Kristen', $pasien['agama'] == 'Kristen') ?>>Kristen</option>
                                    <option value="Katholik" <?= set_select('agama', 'Katholik', $pasien['agama'] == 'Katholik') ?>>Katholik</option>
                                    <option value="Hindu" <?= set_select('agama', 'Hindu', $pasien['agama'] == 'Hindu') ?>>Hindu</option>
                                    <option value="Buddha" <?= set_select('agama', 'Buddha', $pasien['agama'] == 'Buddha') ?>>Buddha</option>
                                    <option value="Konghucu" <?= set_select('agama', 'Konghucu', $pasien['agama'] == 'Konghucu') ?>>Konghucu</option>
                                </select>
                                <label for="agama">Agama</label>
                            </div>
                            <?= form_error('agama', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Alamat -->
                        <div class="mb-4">
                            <div class="form-floating">
                                <textarea name="alamat" id="alamat" class="form-control" placeholder="Alamat"
                                    style="height: 100px" required><?= set_value('alamat', $pasien['alamat']); ?></textarea>
                                <label for="alamat">Alamat</label>
                            </div>
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Nomor HP / WA -->
                        <div class="mb-4">
                            <label for="no_telp" class="form-label fw-semibold">Nomor HP / WA</label>
                            <div class="input-group">
                                <span class="input-group-text">+62</span>
                                <input name="no_telp" id="no_telp"
                                    value="<?= set_value('no_telp', substr($pasien['no_telp'], 3)); ?>"
                                    type="number" class="form-control" placeholder="xxx-xxxx-xxxx" required>
                            </div>
                            <p class="text-danger mt-1 mb-0 small">*Ditulis tanpa angka 0 di depan</p>
                            <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Validasi Nomor HP -->
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const nomor = document.getElementById('no_telp');
                                const form = document.querySelector('#pasien');
                                nomor.addEventListener('input', e => e.target.value = e.target.value.replace(/[.,]/g, ''));
                                form.addEventListener('submit', e => {
                                    const val = nomor.value.trim();
                                    if (val.includes(',') || val.includes('.')) {
                                        alert('Nomor HP/WA tidak boleh mengandung tanda koma atau titik');
                                        e.preventDefault();
                                    }
                                    if (val.startsWith('0')) {
                                        alert('Nomor HP/WA tidak boleh dimulai dengan angka 0');
                                        e.preventDefault();
                                    }
                                });
                            });
                        </script>

                        <!-- Tombol Aksi -->
                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-outline-secondary btn-sm">
                                <i class="bx bx-reset"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="bx bx-save"></i> Simpan Perubahan
                            </button>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>