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
      /* GLOBAL BASE */
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
        width: 100%;
        min-height: 100vh;
        padding: clamp(12px, 3vh, 32px);
        /* fleksibel sesuai layar */
        position: relative;
      }

      .login-box::before,
      .register-box::before {
        content: "";
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.04);
        box-shadow:
          inset 0 0 120px rgba(0, 0, 0, 0.15),
          0 0 80px rgba(0, 0, 0, 0.1);
        z-index: -1;
      }

      /* FORM CARD */
      .login-form,
      .register-form {
        background: linear-gradient(135deg, #e8f5e9, #ffffff, #f0fdf4);
        border-radius: 0.75rem;
        padding: clamp(1.5rem, 3vw, 3rem);
        width: 100%;
        max-width: 450px;
        box-shadow: 0 8px 26px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
      }

      /* REGISTER CARD SPECIAL */
      .register-form {
        max-width: 960px;
      }

      /* GRID INSIDE REGISTER */
      .register-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 1rem 1.5rem;
      }

      /* FORM FIELDS */
      .form-floating label {
        color: #777;
      }

      .form-control:focus {
        border-color: #0A6C4D;
        box-shadow: 0 0 0 0.2rem rgba(10, 108, 77, 0.25);
      }

      /* COLORS */
      .text-success {
        color: #0A6C4D !important;
      }

      /* BUTTONS */
      .btn-success {
        background-color: #0A6C4D !important;
        border-color: #0A6C4D !important;
        color: #fff !important;
        transition: all 0.3s ease;
      }

      .btn-success:hover {
        background-color: #0C7A56 !important;
        transform: translateY(-2px);
      }

      .btn-outline-success {
        background-color: #fff !important;
        color: #0A6C4D !important;
        border-color: #0A6C4D !important;
        transition: all 0.3s ease;
      }

      .btn-outline-success:hover {
        background-color: #0A6C4D !important;
        color: #fff !important;
      }

      /* ANIMATION */
      .fade-in {
        animation: fadeInUp 0.7s ease-out;
      }

      /* typewriting animation */
      @keyframes typingReveal {
        0% {
          opacity: 0;
          letter-spacing: 0.3em;
        }

        100% {
          opacity: 1;
          letter-spacing: normal;
        }
      }

      .showing-text {
        animation: typingReveal 0.25s ease-out;
      }

      /* smooth hiding */
      .hiding-text {
        transition: opacity 0.15s ease-out;
        opacity: 0;
      }


      @keyframes fadeInUp {
        from {
          opacity: 0;
          transform: translateY(30px);
        }

        to {
          opacity: 1;
          transform: translateY(0);
        }
      }

      /* MEDIA RESPONSIVE */
      @media (max-width: 992px) {
        .register-form {
          padding: 2rem;
          max-width: 90%;
        }
      }

      @media (max-width: 768px) {

        .login-form,
        .register-form {
          padding: 1.8rem;
          max-width: 94%;
        }
      }

      @media (max-width: 480px) {

        .login-form,
        .register-form {
          border-radius: 10px;
          padding: 1.4rem;
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
        document.querySelectorAll(".toggle-password").forEach(toggle => {
          toggle.addEventListener("click", () => {
            const input = toggle.parentElement.querySelector("input");
            const icon = toggle.querySelector("i");

            // ADD ANIMATION CLASS
            if (input.type === "password") {
              // First hide bullet content smoothly
              input.classList.add("hiding-text");

              setTimeout(() => {
                input.type = "text";
                input.classList.remove("hiding-text");
                input.classList.add("showing-text");

                // remove animation class after finish
                setTimeout(() => input.classList.remove("showing-text"), 250);
              }, 150);

            } else {
              // hide text first then mask
              input.classList.add("hiding-text");
              setTimeout(() => {
                input.type = "password";
                input.classList.remove("hiding-text");
              }, 150);
            }

            // Toggle icon
            icon.classList.toggle("bx-hide");
            icon.classList.toggle("bx-show");
          });
        });
      </script>




      <!-- Place this tag in your head or just before your close body tag. -->
      <script async defer src="https://buttons.github.io/buttons.js"></script>
    </body>

    </html>
