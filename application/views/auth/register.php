<!-- ===============================
     SKAMANDA Medika+ - REGISTER PAGE
     2-Column Modern Layout + Fade-in
================================ -->
<div class="authentication-wrapper authentication-basic">
    <div class="register-box">
        <div class="register-form fade-in">
            <div class="form-content">
                <div class="text-center mb-4">
                    <h2 class="text-success fw-bold mb-0">SKAMANDA MEDIKA+</h2>
                    <p class="h5 text-dark fw-semibold mb-2">Smart Health - Smarter Future</p>
                    <small class="text-success">Create your account and join the innovation!</small>
                </div>

                <?= $this->session->flashdata('pesan'); ?>
                <?= form_open('', ['id' => 'register']); ?>

                <!-- Grid 2 Columns -->
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= set_value('nama'); ?>" placeholder="Full Name" required>
                            <label for="nama">Full Name</label>
                            <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username'); ?>" placeholder="Username" required>
                            <label for="username">Username</label>
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                    </div>

                    <!-- Password -->
                    <div class="col-md-6">
                        <!-- <label class="form-label small fw-semibold text-muted mb-1" for="password">Unlock Key</label> -->
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password" placeholder="Password" aria-describedby="password" required />
                            <span class="input-group-text cursor-pointer toggle-password"><i class="bx bx-hide"></i></span>
                        </div>
                        <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <!-- Confirm Password -->
                    <div class="col-md-6">
                        <!-- <label class="form-label small fw-semibold text-muted mb-1" for="password2">Confirm Unlock Key</label> -->
                        <div class="input-group input-group-merge">
                            <input type="password" id="password2" class="form-control" name="password2" placeholder="Konfirmasi Password" aria-describedby="password2" required />
                            <span class="input-group-text cursor-pointer toggle-password"><i class="bx bx-hide"></i></span>
                        </div>
                        <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-md-6">
                        <div class="input-group form-floating">
                            <span class="input-group-text">+62</span>
                            <input type="number" class="form-control" id="no_telp" name="no_telp" value="<?= set_value('no_telp'); ?>" placeholder="xxx-xxxx-xxxx" required>
                        </div>
                        <?= form_error('no_telp', '<small class="text-danger">', '</small>'); ?>
                    </div>

                    <div class="col-md-6 d-flex align-items-center">
                        <div class="form-check mt-2">
                            <input class="form-check-input" type="checkbox" id="robot" required>
                            <label class="form-check-label small" for="robot">I am not a robot</label>
                        </div>
                    </div>
                </div>

                <!-- Prevent 0 prefix -->
                <script>
                    document.getElementById('register').addEventListener('submit', function(event) {
                        let phone = document.getElementById('no_telp').value.trim();
                        if (phone.startsWith('0')) {
                            alert('Nomor telepon tidak perlu dimulai dengan angka 0.');
                            event.preventDefault();
                        }
                    });
                </script>

                <!-- Button -->
                <div class="mt-4">
                    <button type="submit" class="btn btn-success w-100 py-2">Create Account</button>
                </div>

                <!-- Divider -->
                <div class="text-center text-muted my-3">OR</div>

                <!-- Google Button -->
                <a href="#" class="btn btn-outline-success w-100 py-2">
                    <img src="<?= base_url('assets/img/icons/google.svg'); ?>" alt="Google" width="18" class="me-2">
                    Sign up with Google
                </a>

                <!-- Sign In -->
                <p class="text-center mt-3 mb-0">
                    <span class="text-muted">Already have an account?</span>
                    <a href="<?= base_url('login'); ?>" class="text-success fw-semibold">Sign In</a>
                </p>

                <?= form_close(); ?>
            </div>
        </div>
    </div>
</div>