<!-- ===============================
     SKAMANDA Medika+ - LOGIN PAGE
     Modern Clean Layout + Fade-in
================================ -->
<div class="authentication-wrapper authentication-basic">
    <div class="login-box fade-in">

        <!-- RIGHT: FORM ONLY -->
        <div class="login-form" style="background: linear-gradient(135deg, #e8f5e9, #ffffff, #f0fdf4);">
            <div class="form-content">
                <div class="text-center mb-3">
                    <h2 class="text-success fw-bold mb-0">SKAMANDA MEDIKA+</h2>
                    <p class="h5 text-dark fw-semibold mb-2">Smart Health - Smarter Future</p>
                    <small class="text-success">Let's unlock and start the adventure!</small>
                </div>

                <form method="post">

                    <!-- Username -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                        <label for="username">Username</label>
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <div class="d-flex justify-content-end mb-1">
                            <a href="https://wa.me/6282140312545?text=Halo.%0ASaya%20mau%20bertanya%20tentang%20aplikasi%20*SKAMANDA%20Medika+*."
                                target="_blank" class="small text-success text-decoration-none">Forgot Password?</a>
                        </div>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="••••••••••••" aria-describedby="password" required />
                            <span class="input-group-text cursor-pointer" id="togglePassword">
                                <i class="bx bx-hide"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Checkbox -->
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="robot" required>
                        <label class="form-check-label small" for="robot">I am not a robot</label>
                    </div>

                    <!-- Sign In Button -->
                    <button type="submit" class="btn btn-success w-100 mb-3 py-2">Sign In</button>

                    <!-- Divider -->
                    <div class="text-center text-muted mb-2">OR</div>

                    <!-- Google Button -->
                    <a type="button" href="#" class="btn btn-outline-success w-100 mb-3 py-2">
                        <img src="<?= base_url('assets/img/icons/google.svg'); ?>" alt="Google" width="18" class="me-2">
                        Sign in with Google
                    </a>

                    <!-- Register -->
                    <p class="text-center mb-0">
                        <span class="text-muted">Don’t have an account?</span>
                        <a href="<?= base_url('register'); ?>" class="text-success fw-semibold">Create one</a>
                    </p>
                </form>
            </div>
        </div>

    </div>
</div>