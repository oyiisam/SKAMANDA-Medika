<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="<?= base_url(); ?>/assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
  <title><?= $title ?></title>
  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="<?= base_url(); ?>/assets/img/favicon/favicon_green.ico" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700&display=swap" rel="stylesheet" />

  <!-- DataTables CSS -->
  <link href="<?= base_url(); ?>assets/vendor/DataTables/datatables.min.css" rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/demo.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/dashboard-skamanda-medika.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="<?= base_url(); ?>/assets/vendor/libs/apex-charts/apex-charts.css" />

  <!-- Helpers -->
  <script src="<?= base_url(); ?>/assets/vendor/js/helpers.js"></script>

  <!-- Config -->
  <script src="<?= base_url(); ?>/assets/js/config.js"></script>
</head>

<body>
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">

      <!-- style memberi shadow -->
      <style>
        :root {
          /* === Warna Brand Utama === */
          --bs-success: #0A6C4D !important;
          --bs-success-rgb: 10, 108, 77 !important;
          --bs-success-hover: #0C7A56;
          --bs-success-light: #E6F2EE;

          /* === Palet Senada === */
          --bs-primary: #118B63 !important;
          /* hijau cerah */
          --bs-primary-rgb: 17, 139, 99 !important;

          --bs-info: #23A97B !important;
          /* hijau muda lembut */
          --bs-info-rgb: 35, 169, 123 !important;

          --bs-warning: #F2B705 !important;
          /* kuning hangat */
          --bs-warning-rgb: 242, 183, 5 !important;

          --bs-danger: #D9534F !important;
          /* merah lembut */
          --bs-danger-rgb: 217, 83, 79 !important;

          --bs-light: #E6F2EE !important;
          --bs-dark: #052D20 !important;

          /* === Tambahan: Warna Biru === */
          --bs-blue: #1E73BE !important;
          /* biru elegan */
          --bs-blue-rgb: 30, 115, 190 !important;
          --bs-blue-hover: #1762A3 !important;
        }

        /* BUTTONS */
        /* BUTTONS */
        /* === Solid Buttons === */
        .btn-primary,
        .bg-primary,
        .border-primary {
          background-color: var(--bs-primary) !important;
          border-color: var(--bs-primary) !important;
          color: #fff !important;
        }

        .btn-primary:hover {
          background-color: #0F7C57 !important;
          border-color: #0F7C57 !important;
        }

        .btn-success,
        .bg-success,
        .border-success {
          background-color: var(--bs-success) !important;
          border-color: var(--bs-success) !important;
          color: #fff !important;
        }

        .btn-success:hover {
          background-color: var(--bs-success-hover) !important;
          border-color: var(--bs-success-hover) !important;
        }

        .btn-info,
        .bg-info,
        .border-info {
          background-color: var(--bs-info) !important;
          border-color: var(--bs-info) !important;
          color: #fff !important;
        }

        .btn-info:hover {
          background-color: #1E936C !important;
          border-color: #1E936C !important;
        }

        .btn-warning,
        .bg-warning,
        .border-warning {
          background-color: var(--bs-warning) !important;
          border-color: var(--bs-warning) !important;
          color: #fff !important;
        }

        .btn-warning:hover {
          background-color: #D9A605 !important;
          border-color: #D9A605 !important;
        }

        .btn-danger,
        .bg-danger,
        .border-danger {
          background-color: var(--bs-danger) !important;
          border-color: var(--bs-danger) !important;
          color: #fff !important;
        }

        .btn-danger:hover {
          background-color: #C64541 !important;
          border-color: #C64541 !important;
        }

        /* === Tambahan: Blue Button === */
        .btn-blue,
        .bg-blue,
        .border-blue {
          background-color: var(--bs-blue) !important;
          border-color: var(--bs-blue) !important;
          color: #fff !important;
        }

        .btn-blue:hover {
          background-color: var(--bs-blue-hover) !important;
          border-color: var(--bs-blue-hover) !important;
        }

        /* === Outline Buttons === */
        .btn-outline-primary {
          color: var(--bs-primary) !important;
          border-color: var(--bs-primary) !important;
        }

        .btn-outline-primary:hover {
          background-color: var(--bs-primary) !important;
          color: #fff !important;
        }

        .btn-outline-success {
          color: var(--bs-success) !important;
          border-color: var(--bs-success) !important;
        }

        .btn-outline-success:hover {
          background-color: var(--bs-success) !important;
          color: #fff !important;
        }

        .btn-outline-info {
          color: var(--bs-info) !important;
          border-color: var(--bs-info) !important;
        }

        .btn-outline-info:hover {
          background-color: var(--bs-info) !important;
          color: #fff !important;
        }

        .btn-outline-warning {
          color: var(--bs-warning) !important;
          border-color: var(--bs-warning) !important;
        }

        .btn-outline-warning:hover {
          background-color: var(--bs-warning) !important;
          color: #fff !important;
        }

        .btn-outline-danger {
          color: var(--bs-danger) !important;
          border-color: var(--bs-danger) !important;
        }

        .btn-outline-danger:hover {
          background-color: var(--bs-danger) !important;
          color: #fff !important;
        }

        /* === Tambahan: Outline Blue === */
        .btn-outline-blue {
          color: var(--bs-blue) !important;
          border-color: var(--bs-blue) !important;
        }

        .btn-outline-blue:hover {
          background-color: var(--bs-blue) !important;
          color: #fff !important;
        }

        /* TEXT */
        /* TEXT */
        .text-primary {
          color: var(--bs-primary) !important;
        }

        .text-success {
          color: var(--bs-success) !important;
        }

        .text-info {
          color: var(--bs-info) !important;
        }

        .text-warning {
          color: var(--bs-warning) !important;
        }

        .text-danger {
          color: var(--bs-danger) !important;
        }

        .text-dark {
          color: var(--bs-dark) !important;
        }

        .text-light {
          color: var(--bs-light) !important;
        }

        /* Tambahan */
        .text-blue {
          color: var(--bs-blue) !important;
        }

        a.text-blue:hover {
          text-decoration: underline !important;
        }

        /* bg dan border */
        /* bg dan border */
        .bg-blue {
          background-color: var(--bs-blue) !important;
        }

        .border-blue {
          border-color: var(--bs-blue) !important;
        }

        /* BADGES */
        /* BADGES */
        .badge-blue {
          background-color: var(--bs-blue) !important;
        }


        /* SHADOW */
        /* SHADOW */
        */ #layout-navbar,
        #layout-menu,
        .card {
          transition: box-shadow 0.3s ease;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1),
            0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Hover shadow */
        #layout-navbar:hover,
        #layout-menu:hover,
        .card:hover {
          box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2),
            0 12px 24px rgba(0, 0, 0, 0.3);
        }

        /* Card tambahan: sudut melengkung */
        .card {
          border-radius: 8px;
        }
      </style>
      <!-- style memberi shadow -->


      <!-- SIDEBAR -->
      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="<?= base_url('onload'); ?>" class="app-brand-link d-flex align-items-center">

            <span class="d-flex align-items-center justify-content-center rounded-circle me-2"
              style="background: rgba(10,108,77,0.08); width:32px; height:32px;">
              <i class="bx bxs-first-aid" style="font-size:1.25rem;color:#0A6C4D;"></i>
            </span>

            <div class="d-flex flex-column lh-1">
              <span style="font-size:0.9rem; font-weight:800; color:#0A6C4D; letter-spacing:0.2px;">
                SKAMANDA Medika+
              </span>
              <span style="
                  font-size:0.7rem;
                  font-weight:400;
                  color:#0A6C4D;
                  opacity:0.65;
                  letter-spacing:0.25px;
                  font-style: italic;
                ">
                Smart Healt, Smarter Future
              </span>
            </div>

          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>
        <ul class="menu-inner py-1">
          <!-- Dashboard -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Dashboard</span>
          </li>
          <li class="menu-item <?= ($title == 'Dashboard | #SKAMANDA Medika') ? 'active' : ''; ?>">
            <a href="<?= base_url('dashboard'); ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bx-home-circle"></i>
              <div>Dashboard</div>
            </a>
          </li>

          <!-- Data Farmasi -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Farmasi</span>
          </li>
          <?php if (is_admin() || is_klinik() || is_tf() || is_lk() || is_mm()) : ?>
            <li class="menu-item <?= ($title == 'Jenis Barang | #SKAMANDA Medika' || $title == 'Lokasi Barang | #SKAMANDA Medika' || $title == 'Satuan Barang | #SKAMANDA Medika' || $title == 'Supplier Barang | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-info-circle"></i>
                <div>Data Awal</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item <?= ($title == 'Jenis Barang | #SKAMANDA Medika') ? 'active' : ''; ?>">
                  <a href="<?= base_url('jenis'); ?>" class="menu-link">
                    <div>Jenis</div>
                  </a>
                </li>
                <li class="menu-item <?= ($title == 'Lokasi Barang | #SKAMANDA Medika') ? 'active' : ''; ?>">
                  <a href="<?= base_url('lokasi'); ?>" class="menu-link">
                    <div>Lokasi</div>
                  </a>
                </li>
                <li class="menu-item <?= ($title == 'Satuan Barang | #SKAMANDA Medika') ? 'active' : ''; ?>">
                  <a href="<?= base_url('satuan'); ?>" class="menu-link">
                    <div>Satuan</div>
                  </a>
                </li>
                <li class="menu-item <?= ($title == 'Supplier Barang | #SKAMANDA Medika') ? 'active' : ''; ?>">
                  <a href="<?= base_url('supplier'); ?>" class="menu-link">
                    <div>Supplier</div>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (!is_dokter() && !is_klinik()) : ?>
            <li class="menu-item <?= ($title == 'Data Barang | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="<?= base_url('barang'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div>Data Barang</div>
              </a>
            </li>
          <?php endif; ?>

          <?php if (is_dokter() || is_klinik()) : ?>
            <li class="menu-item <?= ($title == 'Data Barang | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="<?= base_url('barang'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-dashboard"></i>
                <div>Data Obat</div>
              </a>
            </li>
          <?php endif; ?>

          <?php if (is_admin() || is_klinik() || is_tf() || is_lk() || is_mm()) : ?>
            <?php
            // Mendapatkan URL saat ini
            $current_url = current_url();
            ?>

            <li class="menu-item <?= ($current_url == base_url('stok') || strpos($current_url, base_url('stok/kartu_stok')) === 0) ? 'active' : ''; ?>">
              <a href="<?= base_url('stok'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-bar-chart-alt-2"></i>
                <div>Kartu Stok</div>
              </a>
            </li>
          <?php endif; ?>

          <?php if (is_admin() || is_klinik() || is_tf() || is_lk() || is_mm()) : ?>
            <!-- Transaksi -->
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Transaksi</span>
            </li>

            <li class="menu-item <?= ($title == 'Transaksi Masuk | #SKAMANDA Medika' || $title == 'Detail Transaksi Masuk | #SKAMANDA Medika' || $title == 'Tambah Transaksi Masuk | #SKAMANDA Medika' || $title == 'Edit Transaksi Masuk | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="<?= base_url('pembelian'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cloud-upload"></i>
                <div>Barang Masuk</div>
              </a>
            </li>

            <li class="menu-item <?= ($title == 'Transaksi Keluar | #SKAMANDA Medika' || $title == 'Detail Transaksi Keluar | #SKAMANDA Medika' || $title == 'Tambah Transaksi Keluar | #SKAMANDA Medika' || $title == 'Edit Transaksi Keluar | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="<?= base_url('penjualan'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-cloud-download"></i>
                <div>Barang Keluar</div>
              </a>
            </li>
          <?php endif; ?>

          <!-- Data Klinik -->
          <?php if (is_admin() || is_klinik()) : ?>
            <li class="menu-header small text-uppercase">
              <span class="menu-header-text">Klinik</span>
            </li>
            <li class="menu-item <?= ($title == 'Data Dokter | #SKAMANDA Medika' || $title == 'Data Pasien | #SKAMANDA Medika' || $title == 'Data Poliklinik | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-info-circle"></i>
                <div>Data Klinik</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item <?= ($title == 'Data Pasien | #SKAMANDA Medika') ? 'active' : ''; ?>">
                  <a href="<?= base_url('pasien'); ?>" class="menu-link">
                    <div>Pasien</div>
                  </a>
                </li>
                <li class="menu-item <?= ($title == 'Data Poliklinik | #SKAMANDA Medika') ? 'active' : ''; ?>">
                  <a href="<?= base_url('poliklinik'); ?>" class="menu-link">
                    <div>Poliklinik</div>
                  </a>
                </li>
                <li class="menu-item <?= ($title == 'Data Dokter | #SKAMANDA Medika') ? 'active' : ''; ?>">
                  <a href="<?= base_url('dokter'); ?>" class="menu-link">
                    <div>Dokter - Poliklinik</div>
                  </a>
                </li>
              </ul>
            </li>
          <?php endif; ?>

          <?php if (is_admin() || is_klinik() || is_dokter()) : ?>
            <li class="menu-item <?= ($title == 'Data Rekam Medik | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="<?= base_url('rekammedik'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div>Kunjungan</div>
              </a>
            </li>

            <li class="menu-item <?= ($title == 'Detail Rekam Medik | #SKAMANDA Medika') ? 'active' : ''; ?>">
              <a href="<?= base_url('rekammedik/detail'); ?>" class="menu-link">
                <i class="menu-icon tf-icons bx bx-notepad"></i>
                <div>Rekam Medik</div>
              </a>
            </li>
          <?php endif; ?>

          <!-- User Management -->
          <li class="menu-header small text-uppercase">
            <span class="menu-header-text">User</span>
          </li>
          <li class="menu-item <?= ($title == 'User Management | #SKAMANDA Medika') ? 'active' : ''; ?>">
            <a href="<?= base_url('user'); ?>" class="menu-link">
              <i class="menu-icon tf-icons bx bxs-user-detail"></i>
              <div>User Management</div>
            </a>
          </li>

          <!-- Log out -->
          <li class="menu-item">
            <a href="#" class="menu-link" data-bs-toggle="modal" data-bs-target="#logoutModal">
              <i class="menu-icon tf-icons bx bx-power-off"></i>
              <div>Log Out</div>
            </a>
          </li>
        </ul>
      </aside>
      <!-- /SIDEBAR -->

      <div class="layout-page">
        <!-- TOPBAR -->
        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>
          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- JUDUL BAR -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">

                <!-- Desktop text -->
                <span class="d-none d-md-inline">
                  <a href="https://clinicapp.smkamanahhusadabatu.sch.id/" target="_blank" class="fw-bolder text-success">#SKAMANDA Medika+</a>
                  &nbsp;
                  <span class="text-muted">Smart Health, Smarter Future — AI Powered ©
                    <script>
                      document.write(new Date().getFullYear());
                    </script>
                  </span>
                </span>

                <!-- Mobile text -->
                <span class="fw-bolder d-inline d-md-none">
                  <a href="https://clinicapp.smkamanahhusadabatu.sch.id/" target="_blank" class="fw-bolder text-success">#SKAMANDA Medika+</a>
                </span>

              </div>
            </div>

            <!-- /JUDUL BAR -->
            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- User -->
              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar avatar-online">
                    <img src="<?= base_url() ?>assets/img/avatars/<?= userdata('foto'); ?>" alt="<?= userdata('foto'); ?>" class="rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item" href="#">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="<?= base_url() ?>assets/img/avatars/<?= userdata('foto'); ?>" alt="<?= userdata('foto'); ?>" class="rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block"><?= userdata('nama'); ?></span>
                          <small class="text-muted text-uppercase"><?= userdata('role'); ?></small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="<?= base_url('user/edit/' . userdata('id_user')); ?>">
                      <i class="bx bx-user me-2"></i>
                      <span class="align-middle">Setting</span>
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logoutModal">
                      <i class="bx bx-power-off me-2 text-danger"></i>
                      <span class="align-middle">Log Out</span>
                    </a>
                  </li>
                </ul>
              </li>
              <!-- /User -->
            </ul>
          </div>
        </nav>
        <!-- /TOPBAR -->

        <div class="content-wrapper">

          <!-- KONTEN -->
          <?= $contents; ?>
          <!-- /KONTEN -->


          <!-- FOOTER -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

              <!-- Desktop View -->
              <div class="d-none d-md-block mb-2 mb-md-0">
                <span class="text-muted">
                  #SKAMANDA Medika+ Integrated Clinical & Pharmacy System for Vocational Schools ©
                  <script>
                    document.write(new Date().getFullYear());
                  </script>
                </span>
              </div>

              <div class="d-none d-md-block">
                <a href="https://wa.me/6282140312545?text=Selamat%20pagi.%0ASaya%20*<?= userdata('nama'); ?>*,%20mau%20bertanya%20tentang%20aplikasi%20*#SKAMANDA%20Medika+*%20SMK%20Kesehatan%20Amanah%20Husada%20Batu."
                  class="footer-link me-4" target="_blank">Support</a>
              </div>

              <!-- Mobile View -->
              <div class="d-flex d-md-none justify-content-center w-100 small">
                <span class="text-muted me-1">
                  #SKAMANDA Medika+ © <script>
                    document.write(new Date().getFullYear());
                  </script>
                </span>
                <span class="text-muted">•</span>
                <a href="https://wa.me/6282140312545?text=Halo.%0ASaya%20*<?= userdata('nama'); ?>*,%20mau%20bertanya%20tentang%20aplikasi%20*#SKAMANDA%20Medika+*."
                  class="footer-link ms-1" target="_blank">Support</a>
              </div>

            </div>
          </footer>
          <!-- /FOOTER -->

        </div>
      </div>
    </div>
    <div class="layout-overlay layout-menu-toggle"></div>
  </div>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutModalLabel">Yakin ingin logout?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">Klik "Logout" dibawah ini jika anda yakin ingin logout.</div>
        <div class="modal-footer">
          <a class="btn btn-danger" href="<?= base_url('logout'); ?>">Logout</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Core JS -->
  <script src="<?= base_url(); ?>/assets/vendor/libs/jquery/jquery.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/libs/popper/popper.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/js/bootstrap.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/js/menu.js"></script>
  <script src="<?= base_url(); ?>/assets/vendor/libs/apex-charts/apexcharts.js"></script>
  <script src="<?= base_url(); ?>/assets/js/main.js"></script>
  <script src="<?= base_url(); ?>/assets/js/dashboards-analytics.js"></script>
  <!-- Vendor JS -->
  <script src="<?= base_url('assets/vendor/libs/apex-charts/apexcharts.js'); ?>"></script>

  <!-- DASHBOARD -->
  <!-- <script src="<?= base_url(); ?>/assets/js/dashboard-skamanda-medika.js"></script> -->

  <script async defer src="https://buttons.github.io/buttons.js"></script>

  <!-- DataTables JS -->
  <script src="<?= base_url(); ?>assets/vendor/DataTables/datatables.min.js"></script>

  <!-- Style untuk menghilangkan border antar baris karena mengaktifkan scrollX -->
  <style>
    /* Menghilangkan border antara baris pada tabel dengan ID tertentu */
    #dataTable,
    #dataTable_user,
    #dataTable_import,
    #dataTable_noMenu,
    #dataTable_noEdit,
    #dataTable_pembelian_withDetail,
    #dataTable_pembelian_withDetail_noMenu,
    #dataTable_penjualan_withDetail_noMenu,
    #dataTable_penjualan_withDetail {
      border-collapse: collapse;
      /* Menghilangkan double borders */
    }

    #dataTable th,
    #dataTable td,
    #dataTable_import th,
    #dataTable_import td,
    #dataTable_user th,
    #dataTable_user td,
    #dataTable_noMenu th,
    #dataTable_noMenu td,
    #dataTable_noEdit th,
    #dataTable_noEdit td,
    #dataTable_pembelian_withDetail th,
    #dataTable_pembelian_withDetail td,
    #dataTable_pembelian_withDetail_noMenu th,
    #dataTable_pembelian_withDetail_noMenu td,
    #dataTable_penjualan_withDetail_noMenu th,
    #dataTable_penjualan_withDetail_noMenu td,
    #dataTable_penjualan_withDetail th,
    #dataTable_penjualan_withDetail td {
      border: none !important;
      /* Menghilangkan border pada th dan td */
    }

    /* Jika Anda menggunakan Bootstrap, ini memastikan tidak ada border di hover */
    #dataTable tbody tr:hover,
    #dataTable_import tbody tr:hover,
    #dataTable_user tbody tr:hover,
    #dataTable_noMenu tbody tr:hover,
    #dataTable_noEdit tbody tr:hover,
    #dataTable_pembelian_withDetail tbody tr:hover,
    #dataTable_pembelian_withDetail_noMenu tbody tr:hover,
    #dataTable_penjualan_withDetail_noMenu tbody tr:hover,
    #dataTable_penjualan_withDetail tbody tr:hover {
      border: none !important;
    }

    /* CSS untuk ukuran tombol default */
    .btn-small {
      padding: 8px 12px;
      font-size: 16px;
    }

    /* Media query untuk layar di bawah 768px (portrait mode) */
    @media (max-width: 768px) {
      .btn-small {
        padding: 4px 8px;
        /* Ukuran lebih kecil */
        font-size: 12px;
      }
    }

    /* Media query tambahan untuk mobile landscape (hingga 1024px) */
    @media (max-width: 1024px) {
      .btn-small {
        padding: 6px 10px;
        /* Agak lebih kecil dari default */
        font-size: 13px;
        /* Ukuran font lebih kecil */
      }
    }

    .table thead th {
      background-color: var(--bs-success-light);
      color: var(--bs-success);
      font-weight: 600;
    }
  </style>

  <!-- dataTable -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Inisialisasi DataTables untuk elemen dengan id 'dataTables'
      $('#dataTable').each(function() {
        var tableElement = $(this); // Elemen tabel
        var url = tableElement.data('url'); // URL untuk permintaan AJAX
        var table = tableElement.data('table'); // Nama tabel
        var columns = tableElement.data('columns'); // Kolom yang akan ditampilkan

        tableElement.DataTable({
          ajax: {
            url: url, // URL untuk data JSON
            type: 'POST',
            dataType: 'json',
            dataSrc: function(json) {
              // Cek jika ada pesan error dari server
              if (json.error) {
                // Menampilkan pesan error jika ada
                tableElement.find('tbody').html(`<tr><td colspan="${columns.length}" class="text-center">${json.error}</td></tr>`);
                return []; // Mengembalikan array kosong untuk DataTables
              }
              return json; // Mengembalikan data yang diterima
            }
          },
          columns: columns,
          columnDefs: [{
              targets: 0, // Indeks kolom untuk nomor urut
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row, meta) {
                return meta.row + 1; // Menampilkan nomor urut
              }
            },
            {
              targets: -1, // Indeks kolom terakhir
              orderable: false, // Kolom tidak dapat diurutkan
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row) {
                return `<a href="${row.edit_url}" class="btn btn-warning btn-xs" title="Edit" style="padding: 4px 8px;"><i class='bx bx-edit'></i></a>
                <a onclick="return confirm('Yakin ingin hapus?')" href="${row.delete_url}" class="btn btn-danger btn-xs" title="Delete" style="padding: 4px 8px;"><i class='bx bx-trash'></i></a>`;
              }
            }
          ],
          language: {
            emptyTable: "Data kosong. Silahkan tambah data!" // Pesan ketika tabel kosong
          },
          buttons: [{
              extend: 'colvis',
              className: 'btn btn-sm btn-outline-secondary'
            },
            {
              extend: 'print',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'excel',
              className: 'btn btn-sm btn-outline-success'
            },
            {
              extend: 'pdf',
              className: 'btn btn-sm btn-outline-danger'
            }
          ],
          dom:
            // Bagian atas: Length, Buttons, Search
            "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
            // Bagian tengah: Tabel
            "<'row'<'col-md-12'tr>>" +
            // Bagian bawah: Info, Pagination
            "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
          lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
          ],
          // fixedHeader: true, // Menambahkan fixedHeader agar header tetap di tempat
          scrollX: true, // Memungkinkan scroll horizontal
          responsive: true // Responsif untuk perangkat mobile
        });
      });
    });
  </script>

  <!-- dataTable_noEdit -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Inisialisasi DataTables untuk elemen dengan id 'dataTables'
      $('#dataTable_noEdit').each(function() {
        var tableElement = $(this); // Elemen tabel
        var url = tableElement.data('url'); // URL untuk permintaan AJAX
        var table = tableElement.data('table'); // Nama tabel
        var columns = tableElement.data('columns'); // Kolom yang akan ditampilkan

        tableElement.DataTable({
          ajax: {
            url: url, // URL untuk data JSON
            type: 'POST',
            dataType: 'json',
            dataSrc: function(json) {
              // Cek jika ada pesan error dari server
              if (json.error) {
                // Menampilkan pesan error jika ada
                tableElement.find('tbody').html(`<tr><td colspan="${columns.length}" class="text-center">${json.error}</td></tr>`);
                return []; // Mengembalikan array kosong untuk DataTables
              }
              return json; // Mengembalikan data yang diterima
            }
          },
          columns: columns,
          columnDefs: [{
              targets: 0, // Indeks kolom untuk nomor urut
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row, meta) {
                return meta.row + 1; // Menampilkan nomor urut
              }
            }

          ],
          language: {
            emptyTable: "Data kosong. Silahkan tambah data!" // Pesan ketika tabel kosong
          },
          buttons: [{
              extend: 'colvis',
              className: 'btn btn-sm btn-outline-secondary'
            },
            {
              extend: 'print',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'excel',
              className: 'btn btn-sm btn-outline-success'
            },
            {
              extend: 'pdf',
              className: 'btn btn-sm btn-outline-danger'
            }
          ],
          dom:
            // Bagian atas: Length, Buttons, Search
            "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
            // Bagian tengah: Tabel
            "<'row'<'col-md-12'tr>>" +
            // Bagian bawah: Info, Pagination
            "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
          lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
          ],
          // fixedHeader: true, // Menambahkan fixedHeader agar header tetap di tempat
          scrollX: true, // Memungkinkan scroll horizontal
          responsive: true // Responsif untuk perangkat mobile
        });
      });
    });
  </script>

  <!-- dataTable_import -->
  <script>
    $(document).ready(function() {
      var table = $('#dataTable_import').DataTable({
        dom:
          // Bagian atas: Length dan Search responsif
          "<'row px-2 px-md-4 pt-2 pb-4'<'col-12 col-md-6'l><'col-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-2 mt-md-0'f>>" +
          // Bagian tengah: Tabel
          "<'row'<'col-md-12'tr>>" +
          // Bagian bawah: Info dan Pagination
          "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",

        lengthMenu: [
          [-1],
          ["All"]
        ],
        columnDefs: [{
          targets: -1,
          orderable: false,
          searchable: false
        }],
        scrollX: true,
        responsive: true
      });

      table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');
    });
  </script>

  <!-- dataTable_import -->

  <!-- dataTable_user -->
  <script>
    $(document).ready(function() {
      var table = $('#dataTable_user').DataTable({
        // buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
        buttons: [{
            extend: 'colvis',
            className: 'btn btn-sm btn-outline-secondary'
          },
          {
            extend: 'print',
            className: 'btn btn-sm btn-outline-primary'
          },
          {
            extend: 'excel',
            className: 'btn btn-sm btn-outline-success'
          },
          {
            extend: 'pdf',
            className: 'btn btn-sm btn-outline-danger'
          }
        ],
        dom:
          // Bagian atas: Length, Buttons, Search
          "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
          // Bagian tengah: Tabel
          "<'row'<'col-md-12'tr>>" +
          // Bagian bawah: Info, Pagination
          "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
        lengthMenu: [
          [10, 25, 50, 100, -1],
          [10, 25, 50, 100, "All"]
        ],
        columnDefs: [{
          targets: -1,
          orderable: false,
          searchable: false
        }],
        scrollX: true, // Memungkinkan scroll horizontal
        responsive: true // Responsif untuk perangkat mobile
      });

      table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');
    });
  </script>
  <!-- dataTable_user -->

  <!-- dataTable_noMenu -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Inisialisasi DataTables untuk elemen dengan id 'dataTables'
      $('#dataTable_noMenu').each(function() {
        var tableElement = $(this); // Elemen tabel
        var url = tableElement.data('url'); // URL untuk permintaan AJAX
        var table = tableElement.data('table'); // Nama tabel
        var columns = tableElement.data('columns'); // Kolom yang akan ditampilkan

        tableElement.DataTable({
          ajax: {
            url: url, // URL untuk data JSON
            type: 'POST',
            dataType: 'json',
            dataSrc: function(json) {
              // Cek jika ada pesan error dari server
              if (json.error) {
                // Menampilkan pesan error jika ada
                tableElement.find('tbody').html(`<tr><td colspan="${columns.length}" class="text-center">${json.error}</td></tr>`);
                return []; // Mengembalikan array kosong untuk DataTables
              }
              return json; // Mengembalikan data yang diterima
            }
          },
          columns: columns,
          columnDefs: [{
            targets: 0, // Indeks kolom untuk nomor urut
            searchable: false, // Kolom tidak dapat dicari
            render: function(data, type, row, meta) {
              return meta.row + 1; // Menampilkan nomor urut
            }
          }, ],
          language: {
            emptyTable: "Data kosong. Silahkan tambah data!" // Pesan ketika tabel kosong
          },
          buttons: [{
              extend: 'colvis',
              className: 'btn btn-sm btn-outline-secondary'
            },
            {
              extend: 'print',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'excel',
              className: 'btn btn-sm btn-outline-success'
            },
            {
              extend: 'pdf',
              className: 'btn btn-sm btn-outline-danger'
            }
          ],
          dom:
            // Bagian atas: Length, Buttons, Search
            "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
            // Bagian tengah: Tabel
            "<'row'<'col-md-12'tr>>" +
            // Bagian bawah: Info, Pagination
            "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
          lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
          ],
          // fixedHeader: true, // Menambahkan fixedHeader agar header tetap di tempat
          scrollX: true, // Memungkinkan scroll horizontal
          responsive: true // Responsif untuk perangkat mobile
        });
      });
    });
  </script>

  <!-- dataTable_pembelian_withDetail -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Inisialisasi DataTables untuk elemen dengan id 'dataTables'
      $('#dataTable_pembelian_withDetail').each(function() {
        var tableElement = $(this); // Elemen tabel
        var url = tableElement.data('url'); // URL untuk permintaan AJAX
        var table = tableElement.data('table'); // Nama tabel
        var columns = tableElement.data('columns'); // Kolom yang akan ditampilkan

        tableElement.DataTable({
          ajax: {
            url: url, // URL untuk data JSON
            type: 'POST',
            dataType: 'json',
            dataSrc: function(json) {
              // Cek jika ada pesan error dari server
              if (json.error) {
                // Menampilkan pesan error jika ada
                tableElement.find('tbody').html(`<tr><td colspan="${columns.length}" class="text-center">${json.error}</td></tr>`);
                return []; // Mengembalikan array kosong untuk DataTables
              }
              return json; // Mengembalikan data yang diterima
            }
          },
          columns: columns,
          columnDefs: [{
              targets: 0, // Indeks kolom untuk nomor urut
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row, meta) {
                return meta.row + 1; // Menampilkan nomor urut
              }
            },
            {
              targets: -2, // Indeks kolom terakhir
              orderable: false, // Kolom tidak dapat diurutkan
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row) {
                return `<button class="btn btn-success btn-circle btn-sm" data-id="${row.id_pembelian}" data-bs-toggle="modal" data-bs-target="#detailModal"><i class='bx bx-search'></i></button>`;
              }
            },
            {
              targets: -1, // Indeks kolom terakhir
              orderable: false, // Kolom tidak dapat diurutkan
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row) {
                return `<a href="${row.edit_url}" class="btn btn-warning btn-circle btn-sm" title="Edit"><i class='bx bx-edit'></i></a>
                <a onclick="return confirm('Yakin ingin hapus?')" href="${row.delete_url}" class="btn btn-danger btn-circle btn-sm" title="Delete"><i class='bx bx-trash'></i></a>`;
              }
            }
          ],
          language: {
            emptyTable: "Data kosong. Silahkan tambah data!" // Pesan ketika tabel kosong
          },
          buttons: [{
              extend: 'colvis',
              className: 'btn btn-sm btn-outline-secondary'
            },
            {
              extend: 'print',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'excel',
              className: 'btn btn-sm btn-outline-success'
            },
            {
              extend: 'pdf',
              className: 'btn btn-sm btn-outline-danger'
            }
          ],
          dom:
            // Bagian atas: Length, Buttons, Search
            "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
            // Bagian tengah: Tabel
            "<'row'<'col-md-12'tr>>" +
            // Bagian bawah: Info, Pagination
            "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
          lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
          ],
          // fixedHeader: true, // Menambahkan fixedHeader agar header tetap di tempat
          scrollX: true, // Memungkinkan scroll horizontal
          responsive: true // Responsif untuk perangkat mobile
        });
      });
    });

    // Event handler untuk tombol detail di DataTables
    $('#dataTable_pembelian_withDetail').on('click', 'button[data-id]', function() {
      var id = $(this).data('id');

      $.ajax({
        url: '<?= base_url("pembelian/getDetailById/") ?>' + id,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#modalContent').html(response);
        },
        error: function() {
          $('#modalContent').html('<p>Terjadi kesalahan saat memuat data.</p>');
        }
      });
    });
  </script>

  <!-- dataTable_pembelian_withDetail_noMenu -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Inisialisasi DataTables untuk elemen dengan id 'dataTables'
      $('#dataTable_pembelian_withDetail_noMenu').each(function() {
        var tableElement = $(this); // Elemen tabel
        var url = tableElement.data('url'); // URL untuk permintaan AJAX
        var table = tableElement.data('table'); // Nama tabel
        var columns = tableElement.data('columns'); // Kolom yang akan ditampilkan

        tableElement.DataTable({
          ajax: {
            url: url, // URL untuk data JSON
            type: 'POST',
            dataType: 'json',
            dataSrc: function(json) {
              // Cek jika ada pesan error dari server
              if (json.error) {
                // Menampilkan pesan error jika ada
                tableElement.find('tbody').html(`<tr><td colspan="${columns.length}" class="text-center">${json.error}</td></tr>`);
                return []; // Mengembalikan array kosong untuk DataTables
              }
              return json; // Mengembalikan data yang diterima
            }
          },
          columns: columns,
          columnDefs: [{
              targets: 0, // Indeks kolom untuk nomor urut
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row, meta) {
                return meta.row + 1; // Menampilkan nomor urut
              }
            },
            {
              targets: -1, // Indeks kolom terakhir
              orderable: false, // Kolom tidak dapat diurutkan
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row) {
                return `<button class="btn btn-success btn-circle btn-sm" data-id="${row.id_pembelian}" data-bs-toggle="modal" data-bs-target="#detailModal"><i class='bx bx-search'></i></button>`;
              }
            }
          ],
          language: {
            emptyTable: "Data kosong. Silahkan tambah data!" // Pesan ketika tabel kosong
          },
          buttons: [{
              extend: 'colvis',
              className: 'btn btn-sm btn-outline-secondary'
            },
            {
              extend: 'print',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'excel',
              className: 'btn btn-sm btn-outline-success'
            },
            {
              extend: 'pdf',
              className: 'btn btn-sm btn-outline-danger'
            }
          ],
          dom:
            // Bagian atas: Length, Buttons, Search
            "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
            // Bagian tengah: Tabel
            "<'row'<'col-md-12'tr>>" +
            // Bagian bawah: Info, Pagination
            "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
          lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
          ],
          // fixedHeader: true, // Menambahkan fixedHeader agar header tetap di tempat
          scrollX: true, // Memungkinkan scroll horizontal
          responsive: true // Responsif untuk perangkat mobile
        });
      });
    });

    // Event handler untuk tombol detail di DataTables
    $('#dataTable_pembelian_withDetail_noMenu').on('click', 'button[data-id]', function() {
      var id = $(this).data('id');

      $.ajax({
        url: '<?= base_url("pembelian/getDetailById/") ?>' + id,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#modalContent').html(response);
        },
        error: function() {
          $('#modalContent').html('<p>Terjadi kesalahan saat memuat data.</p>');
        }
      });
    });
  </script>

  <!-- dataTable_penjualan_withDetail -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Inisialisasi DataTables untuk elemen dengan id 'dataTables'
      $('#dataTable_penjualan_withDetail').each(function() {
        var tableElement = $(this); // Elemen tabel
        var url = tableElement.data('url'); // URL untuk permintaan AJAX
        var table = tableElement.data('table'); // Nama tabel
        var columns = tableElement.data('columns'); // Kolom yang akan ditampilkan

        tableElement.DataTable({
          ajax: {
            url: url, // URL untuk data JSON
            type: 'POST',
            dataType: 'json',
            dataSrc: function(json) {
              // Cek jika ada pesan error dari server
              if (json.error) {
                // Menampilkan pesan error jika ada
                tableElement.find('tbody').html(`<tr><td colspan="${columns.length}" class="text-center">${json.error}</td></tr>`);
                return []; // Mengembalikan array kosong untuk DataTables
              }
              return json; // Mengembalikan data yang diterima
            }
          },
          columns: columns,
          columnDefs: [{
              targets: 0, // Indeks kolom untuk nomor urut
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row, meta) {
                return meta.row + 1; // Menampilkan nomor urut
              }
            },
            {
              targets: -2, // Indeks kolom terakhir
              orderable: false, // Kolom tidak dapat diurutkan
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row) {
                return `<button class="btn btn-success btn-circle btn-sm" data-id="${row.id_penjualan}" data-bs-toggle="modal" data-bs-target="#detailModal"><i class='bx bx-search'></i></button>`;
              }
            },
            {
              targets: -1, // Indeks kolom terakhir
              orderable: false, // Kolom tidak dapat diurutkan
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row) {
                return `<a href="${row.edit_url}" class="btn btn-warning btn-circle btn-sm" title="Edit"><i class='bx bx-edit'></i></a>
                <a onclick="return confirm('Yakin ingin hapus?')" href="${row.delete_url}" class="btn btn-danger btn-circle btn-sm" title="Delete"><i class='bx bx-trash'></i></a>`;
              }
            }
          ],
          language: {
            emptyTable: "Data kosong. Silahkan tambah data!" // Pesan ketika tabel kosong
          },
          buttons: [{
              extend: 'colvis',
              className: 'btn btn-sm btn-outline-secondary'
            },
            {
              extend: 'print',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'excel',
              className: 'btn btn-sm btn-outline-success'
            },
            {
              extend: 'pdf',
              className: 'btn btn-sm btn-outline-danger'
            }
          ],
          dom:
            // Bagian atas: Length, Buttons, Search
            "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
            // Bagian tengah: Tabel
            "<'row'<'col-md-12'tr>>" +
            // Bagian bawah: Info, Pagination
            "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
          lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
          ],
          // fixedHeader: true, // Menambahkan fixedHeader agar header tetap di tempat
          scrollX: true, // Memungkinkan scroll horizontal
          responsive: true // Responsif untuk perangkat mobile
        });
      });
    });

    // Event handler untuk tombol detail di DataTables
    $('#dataTable_penjualan_withDetail').on('click', 'button[data-id]', function() {
      var id = $(this).data('id');

      $.ajax({
        url: '<?= base_url("penjualan/getDetailById/") ?>' + id,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#modalContent').html(response);
        },
        error: function() {
          $('#modalContent').html('<p>Terjadi kesalahan saat memuat data.</p>');
        }
      });
    });
  </script>

  <!-- dataTable_penjualan_withDetail_noMenu -->
  <script type="text/javascript">
    $(document).ready(function() {
      // Inisialisasi DataTables untuk elemen dengan id 'dataTables'
      $('#dataTable_penjualan_withDetail_noMenu').each(function() {
        var tableElement = $(this); // Elemen tabel
        var url = tableElement.data('url'); // URL untuk permintaan AJAX
        var table = tableElement.data('table'); // Nama tabel
        var columns = tableElement.data('columns'); // Kolom yang akan ditampilkan

        tableElement.DataTable({
          ajax: {
            url: url, // URL untuk data JSON
            type: 'POST',
            dataType: 'json',
            dataSrc: function(json) {
              // Cek jika ada pesan error dari server
              if (json.error) {
                // Menampilkan pesan error jika ada
                tableElement.find('tbody').html(`<tr><td colspan="${columns.length}" class="text-center">${json.error}</td></tr>`);
                return []; // Mengembalikan array kosong untuk DataTables
              }
              return json; // Mengembalikan data yang diterima
            }
          },
          columns: columns,
          columnDefs: [{
              targets: 0, // Indeks kolom untuk nomor urut
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row, meta) {
                return meta.row + 1; // Menampilkan nomor urut
              }
            },
            {
              targets: -1, // Indeks kolom terakhir
              orderable: false, // Kolom tidak dapat diurutkan
              searchable: false, // Kolom tidak dapat dicari
              render: function(data, type, row) {
                return `<button class="btn btn-success btn-circle btn-sm" data-id="${row.id_penjualan}" data-bs-toggle="modal" data-bs-target="#detailModal"><i class='bx bx-search'></i></button>`;
              }
            },
          ],
          language: {
            emptyTable: "Data kosong. Silahkan tambah data!" // Pesan ketika tabel kosong
          },
          buttons: [{
              extend: 'colvis',
              className: 'btn btn-sm btn-outline-secondary'
            },
            {
              extend: 'print',
              className: 'btn btn-sm btn-outline-primary'
            },
            {
              extend: 'excel',
              className: 'btn btn-sm btn-outline-success'
            },
            {
              extend: 'pdf',
              className: 'btn btn-sm btn-outline-danger'
            }
          ],
          dom:
            // Bagian atas: Length, Buttons, Search
            "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
            // Bagian tengah: Tabel
            "<'row'<'col-md-12'tr>>" +
            // Bagian bawah: Info, Pagination
            "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
          lengthMenu: [
            [25, 50, 100, -1],
            [25, 50, 100, "All"]
          ],
          // fixedHeader: true, // Menambahkan fixedHeader agar header tetap di tempat
          scrollX: true, // Memungkinkan scroll horizontal
          responsive: true // Responsif untuk perangkat mobile
        });
      });
    });

    // Event handler untuk tombol detail di DataTables
    $('#dataTable_penjualan_withDetail_noMenu').on('click', 'button[data-id]', function() {
      var id = $(this).data('id');

      $.ajax({
        url: '<?= base_url("penjualan/getDetailById/") ?>' + id,
        type: 'GET',
        dataType: 'html',
        success: function(response) {
          $('#modalContent').html(response);
        },
        error: function() {
          $('#modalContent').html('<p>Terjadi kesalahan saat memuat data.</p>');
        }
      });
    });

    $(document).ready(function() {
      var table = $('#dataTableKartuStok').DataTable({
        // buttons: ['copy', 'csv', 'print', 'excel', 'pdf'],
        buttons: [{
            extend: 'excel',
            className: 'btn btn-sm btn-outline-success'
          },
          {
            extend: 'pdf',
            className: 'btn btn-sm btn-outline-danger'
          }
        ],
        dom:
          // Bagian atas: Length, Buttons, Search
          "<'row px-2 px-md-4 pt-2 pb-4'<'col-md-3'l><'col-md-6 d-flex justify-content-center'B><'col-md-3 d-flex justify-content-center justify-content-md-end'f>>" +
          // Bagian tengah: Tabel
          "<'row'<'col-md-12'tr>>" +
          // Bagian bawah: Info, Pagination
          "<'row px-2 px-md-4 py-3'<'col-md-8'i><'col-md-4 d-flex justify-content-center justify-content-md-end'p>>",
        lengthMenu: [
          [-1],
          ["All"]
          // [5, 10, 25, 50, 100, -1],
          // [5, 10, 25, 50, 100, "All"]
        ],
        scrollX: true, // Memungkinkan scroll horizontal
        responsive: true, // Responsif untuk perangkat mobile
        paging: false, // matikan pagination
        searching: false, // matikan search
        info: false, // matikan info
        ordering: true, // tetap bisa sorting
        columnDefs: [{
          targets: -1,
          orderable: false,
          searchable: false
        }]
      });

      table.buttons().container().appendTo('#dataTable_wrapper .col-md-5:eq(0)');
    });
  </script>
</body>

</html>