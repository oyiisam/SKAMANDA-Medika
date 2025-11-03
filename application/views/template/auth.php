    <!DOCTYPE html>

    <!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
    <!-- beautify ignore:start -->
    <html
      lang="en"
      class="light-style customizer-hide"
      dir="ltr"
      data-theme="theme-default"
      data-assets-path="../assets/"
      data-template="vertical-menu-template-free">

    <head>
      <meta charset="utf-8" />
      <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

      <title><?= $title ?></title>

      <meta name="description" content="" />

      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/assets/img/favicon/favicon_green.ico" />

      <!-- Fonts -->
      <link rel="preconnect" href="https://fonts.googleapis.com" />
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
      <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

      <!-- Icons. Uncomment required icon fonts -->
      <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/fonts/boxicons.css" />

      <!-- Core CSS -->
      <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
      <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
      <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/demo.css" />

      <!-- Vendors CSS -->
      <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

      <!-- FontAwesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-m2WvSk6mEvPQZJDYo51PtwvvB5GQoOLYZcF12MLL5VaV0BkoN6I++lsTV49IMzUAc9g9eN3vGTwvVdZqfN0dEw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

      <!-- Page CSS -->
      <!-- Page -->
      <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/css/pages/page-auth.css" />
      <!-- Helpers -->
      <script src="<?= base_url(); ?>/assets/vendor/js/helpers.js"></script>

      <script src="<?= base_url(); ?>/assets/js/config.js"></script>
    </head>

    <style>
      /* GLOBAL BASE STYLES */
      body {
        margin: 0;
        padding: 0;
        background-color: #f6faf8;
        font-family: 'Inter', sans-serif;
        overflow-x: hidden;
      }

      /* PAGE WRAPPER */
      .login-box,
      .register-box {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100vw;
        height: 100vh;
      }

      .login-box::before,
      .register-box::before {
        inset: 0;
        background: rgba(0, 0, 0, 0.04);
        /* sedikit lebih pekat */
        box-shadow:
          inset 0 0 120px rgba(0, 0, 0, 0.15),
          /* lebih tebal & luas */
          0 0 80px rgba(0, 0, 0, 0.1);
        /* efek luar lembut */
        z-index: -1;
      }

      /* FORM CONTAINERS */
      .login-form,
      .register-form {
        background: linear-gradient(135deg, #e8f5e9, #ffffff, #f0fdf4);
        border-radius: 0.75rem;
        padding: 3rem 2.5rem;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
      }

      .login-form {
        width: 420px;
      }

      .register-form {
        width: 900px;
      }

      /* FORM FIELDS & LABELS */
      .form-floating label {
        color: #777;
      }

      .form-control:focus {
        border-color: #0A6C4D;
        box-shadow: 0 0 0 0.2rem rgba(10, 108, 77, 0.25);
      }

      /* TEXT COLORS */
      .text-success {
        color: #0A6C4D !important;
      }

      a.text-success:hover,
      .text-success-hover:hover {
        color: #0C7A56 !important;
      }

      /* BUTTONS */
      /* Solid Success */
      /* === Tombol Success Brand Custom === */
      .btn-success {
        background-color: #0A6C4D !important;
        border-color: #0A6C4D !important;
        color: #fff !important;
        transition: all 0.3s ease;
      }

      .btn-success:hover {
        background-color: #0C7A56 !important;
        border-color: #0C7A56 !important;
        transform: translateY(-2px);
      }

      .btn-success:focus,
      .btn-success:active,
      .btn-success.active,
      .show>.btn-success.dropdown-toggle {
        background-color: #0C7A56 !important;
        border-color: #0C7A56 !important;
        color: #fff !important;
        box-shadow: 0 0 0 0.2rem rgba(10, 108, 77, 0.25) !important;
      }


      /* Outline Success (Universal) */
      .btn-outline-success {
        background-color: #fff !important;
        color: #0A6C4D !important;
        border-color: #0A6C4D !important;
        transition: all 0.3s ease !important;
      }

      .btn-outline-success:hover,
      .btn-outline-success:focus,
      .btn-outline-success:active {
        background-color: #0A6C4D !important;
        color: #fff !important;
        border-color: #0A6C4D !important;
        box-shadow: 0 0 0 0.15rem rgba(10, 108, 77, 0.25) !important;
      }

      /* Spesifik untuk login & register (backup, jika override dari tema lain) */
      .login-form .btn-outline-success,
      .register-form .btn-outline-success {
        background-color: #fff !important;
        color: #0A6C4D !important;
        border-color: #0A6C4D !important;
      }

      .login-form .btn-outline-success:hover,
      .register-form .btn-outline-success:hover {
        background-color: #0A6C4D !important;
        color: #fff !important;
      }

      /* ANIMATIONS */
      .fade-in {
        animation: fadeInUp 0.8s ease-out;
      }

      @keyframes fadeInUp {
        0% {
          opacity: 0;
          transform: translateY(40px);
        }

        100% {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* RESPONSIVE */
      @media (max-width: 768px) {
        .login-form {
          width: 90%;
          padding: 2rem 1.5rem;
        }

        .register-form {
          width: 95%;
          padding: 2rem 1.5rem;
        }

        .row.g-3 {
          display: block;
        }

        .col-md-6 {
          width: 100%;
          margin-bottom: 1rem;
        }
      }
    </style>


    <body>
      <!-- KONTEN -->
      <?= $contents; ?>
      <!-- /KONTEN -->

      <!-- Core JS -->
      <!-- build:js assets/vendor/js/core.js -->
      <script src="<?= base_url(); ?>/assets/vendor/libs/jquery/jquery.js"></script>
      <script src="<?= base_url(); ?>/assets/vendor/libs/popper/popper.js"></script>
      <script src="<?= base_url(); ?>/assets/vendor/js/bootstrap.js"></script>
      <script src="<?= base_url(); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

      <script src="<?= base_url(); ?>/assets/vendor/js/menu.js"></script>
      <!-- endbuild -->

      <!-- Vendors JS -->

      <!-- Main JS -->
      <script src="<?= base_url(); ?>/assets/js/main.js"></script>

      <!-- Password JS -->
      <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");
        togglePassword.addEventListener("click", function() {
          const type = password.getAttribute("type") === "password" ? "text" : "password";
          password.setAttribute("type", type);
          this.querySelector("i").classList.toggle("bx-hide");
          this.querySelector("i").classList.toggle("bx-show");
        });
      </script>

      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>

    </html>