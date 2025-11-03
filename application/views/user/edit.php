<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm border-0">
                    <div class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start">
                        <h5 class="mb-2 mb-md-0 text-success text-uppercase fw-bold">
                            <i class="bx bx-edit-alt"></i> Edit Data User
                        </h5>
                        <a href="<?= base_url('user') ?>" class="btn btn-sm btn-outline-secondary">
                            <i class='bx bx-rotate-left'></i> Kembali
                        </a>
                    </div>

                    <div class="card-body">
                        <?= $this->session->flashdata('pesan'); ?>
                        <?= form_open('', ['id' => 'user']); ?>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        placeholder="Nama User" value="<?= set_value('nama', $user['nama']); ?>" required autofocus>
                                    <label for="nama">Nama</label>
                                </div>
                                <?= form_error('nama', '<small class="text-danger ps-2">', '</small>'); ?>
                            </div>

                            <?php if (is_admin()) : ?>
                                <div class="col-md-6">
                                    <div class="form-floating">
                                        <select class="form-select" id="role" name="role" required>
                                            <option value="" selected disabled>Pilih Role</option>
                                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : ''; ?>>Admin</option>
                                            <option value="dokter" <?= $user['role'] == 'dokter' ? 'selected' : ''; ?>>Dokter</option>
                                            <option value="klinik" <?= $user['role'] == 'klinik' ? 'selected' : ''; ?>>Klinik</option>
                                            <option value="user" <?= $user['role'] == 'user' ? 'selected' : ''; ?>>User</option>
                                        </select>
                                        <label for="role">Role</label>
                                    </div>
                                    <?= form_error('role', '<small class="text-danger ps-2">', '</small>'); ?>
                                </div>
                            <?php endif; ?>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="username" name="username"
                                        placeholder="Username" value="<?= set_value('username', $user['username']); ?>" required>
                                    <label for="username">Username</label>
                                </div>
                                <?= form_error('username', '<small class="text-danger ps-2">', '</small>'); ?>
                            </div>

                            <div class="col-md-6 form-password-toggle">
                                <div class="form-floating input-group input-group-merge">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                    <label for="password">Password</label>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <?= form_error('password', '<small class="text-danger ps-2">', '</small>'); ?>
                            </div>

                            <div class="col-md-6 form-password-toggle">
                                <div class="form-floating input-group input-group-merge">
                                    <input type="password" class="form-control" id="password2" name="password2" placeholder="Konfirmasi Password" required>
                                    <label for="password2">Konfirmasi Password</label>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                <?= form_error('password2', '<small class="text-danger ps-2">', '</small>'); ?>
                            </div>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">+62</span>
                                    <div class="form-floating flex-grow-1">
                                        <input type="number" class="form-control" id="no_telp" name="no_telp"
                                            placeholder="Nomor HP/WA"
                                            value="<?= set_value('no_telp', substr($user['no_telp'], 3)); ?>" required>
                                        <label for="no_telp">Nomor HP/WA</label>
                                    </div>
                                </div>
                                <?= form_error('no_telp', '<small class="text-danger ps-2">', '</small>'); ?>
                            </div>

                            <script>
                                document.getElementById('user').addEventListener('submit', function(event) {
                                    const phone = document.getElementById('no_telp').value.trim();
                                    if (phone.startsWith('0')) {
                                        alert('Nomor HP/WA tidak perlu dimulai dengan angka 0.');
                                        event.preventDefault();
                                    }
                                });
                            </script>

                            <div class="col-12">
                                <hr>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="konfirmasi" required>
                                    <label class="form-check-label" for="konfirmasi">
                                        Data sudah sesuai.
                                    </label>
                                </div>
                            </div>

                            <div class="col-12 text-end mt-3">
                                <button type="reset" class="btn btn-sm btn-secondary me-1">
                                    <i class='bx bx-reset'></i> Reset
                                </button>
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class='bx bx-save'></i> Simpan
                                </button>
                            </div>
                        </div>

                        <?= form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>