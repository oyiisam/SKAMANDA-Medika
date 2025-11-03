<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">

        <!-- 🌿 Greeting Section -->
        <div class="card border-0 shadow-sm mb-4 p-4 position-relative"
            style="background: linear-gradient(135deg, #e8f5e9, #ffffff, #f0fdf4); border-left: 6px solid #28a745; border-radius: 1rem;">

            <!-- Role Badge -->
            <div class="position-absolute top-0 end-0 m-3 d-none d-md-block">
                <span class="badge bg-success bg-opacity-75 text-white px-3 py-2 shadow-sm"
                    style="font-size: 0.85rem; border-radius: 0.75rem;">
                    <i class="bx bx-user-check me-1"></i> <?= userdata('role'); ?>
                </span>
            </div>

            <!-- Role Badge for Mobile (above greeting) -->
            <div class="d-block d-md-none text-center mb-3">
                <span class="badge bg-success bg-opacity-75 text-white px-3 py-2 shadow-sm"
                    style="font-size: 0.85rem; border-radius: 0.75rem;">
                    <i class="bx bx-user-check me-1"></i> <?= userdata('role'); ?>
                </span>
            </div>

            <!-- Greeting Text -->
            <div class="text-center text-md-start">
                <h3 class="text-success fw-bold mb-1 fs-4">
                    Hi, <?= userdata('nama'); ?>
                </h3>
                <p class="text-muted mb-1 fs-6"
                    style="font-style: italic; letter-spacing: 0.2px; opacity: 0.9;">
                    Welcome to <strong>SKAMANDA Medika+</strong> — Integrated Pharmacy & Clinical System for Vocational Schools.
                </p>
            </div>
        </div>

        <!-- ====================================================== -->
        <!-- 🌿 SECTION: MANAJEMEN FARMASI -->
        <!-- ====================================================== -->
        <section class="mb-5">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                <h5 class="fw-bold text-success mb-2 mb-md-0">
                    <i class="bx bx-capsule me-1"></i> Manajemen Farmasi
                </h5>
                <hr class="d-md-none text-success opacity-50 mb-0">
            </div>

            <div class="row g-4 mb-3">
                <!-- ===================== -->
                <!-- 📊 KOLOM KIRI (Stats + Chart) -->
                <!-- ===================== -->
                <div class="col-lg-9">
                    <!-- Statistik Cards -->
                    <div class="row g-3 mb-4">

                        <!-- Total Supplier -->
                        <div class="col-6 col-sm-6 col-md-4 col-lg-3">

                            <a href="<?= base_url('supplier'); ?>" class="text-decoration-none">
                                <div class="card shadow-sm border-0 text-center h-100 hover-card"
                                    style="border-top: 4px solid #198754; border-radius: 1rem; background: linear-gradient(135deg, #f9fff9, #ffffff);">
                                    <div class="card-body p-3">
                                        <i class="bx bx-store-alt fs-1 text-success mb-2 opacity-75"></i>
                                        <p class="text-muted small mb-1">Total Supplier</p>
                                        <h4 class="fw-bold text-success mb-0 count-up" data-count="<?= $count_supplier; ?>">0</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Jumlah Obat -->
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="<?= base_url('barang'); ?>" class="text-decoration-none">
                                <div class="card shadow-sm border-0 text-center h-100 hover-card"
                                    style="border-top: 4px solid #20c997; border-radius: 1rem; background: linear-gradient(135deg, #f9fff9, #ffffff);">
                                    <div class="card-body p-3">
                                        <i class="bx bx-capsule fs-1 text-success mb-2 opacity-75"></i>
                                        <p class="text-muted small mb-1">Jumlah Obat</p>
                                        <h4 class="fw-bold text-success mb-0 count-up" data-count="<?= $count_barang; ?>">0</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Pembelian Bulan Ini -->
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card shadow-sm border-0 text-center h-100 hover-card"
                                style="border-top: 4px solid #dc3545; border-radius: 1rem; background: linear-gradient(135deg, #fff8f8, #ffffff);">
                                <div class="card-body p-3">
                                    <i class="bx bx-cloud-download fs-1 text-danger mb-2 opacity-75"></i>
                                    <p class="text-muted small mb-1">Pembelian Bulan Ini</p>
                                    <h5 class="fw-bold text-danger mb-0" id="totalPembelianBulanIni">Rp 0</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Penjualan Bulan Ini -->
                        <div class="col-12 col-md-4 col-lg-3">
                            <div class="card shadow-sm border-0 text-center h-100 hover-card"
                                style="border-top: 4px solid #28a745; border-radius: 1rem; background: linear-gradient(135deg, #f8fff9, #ffffff);">
                                <div class="card-body p-3">
                                    <i class="bx bx-cloud-upload fs-1 text-success mb-2 opacity-75"></i>
                                    <p class="text-muted small mb-1">Penjualan Bulan Ini</p>
                                    <h5 class="fw-bold text-success mb-0 count-up" id="totalPenjualanBulanIni">Rp 0</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart Keuangan -->
                    <div class="card shadow-sm border-0"
                        style="background: linear-gradient(135deg, #f8fff9, #ffffff); border-radius: 1rem;">
                        <div class="card-header bg-transparent border-0 fw-bold text-success">
                            <i class="bx bx-bar-chart-alt me-1"></i> Statistik Pembelian & Penjualan
                        </div>
                        <div class="card-body">
                            <div id="chartKeuangan" style="height:320px;"></div>
                        </div>
                    </div>
                </div>

                <!-- ===================== -->
                <!-- 📦 KOLOM KANAN (Expired + Low Stock) -->
                <!-- ===================== -->
                <div class="col-lg-3">
                    <div class="card shadow-sm border-0 h-100"
                        style="border-radius: 1rem; background: linear-gradient(180deg, #ffffff, #f7fdf9);">

                        <!-- Obat Akan Kedaluwarsa -->
                        <div class="card-header bg-white fw-bold text-warning border-0">
                            ⏳ Obat Akan Kedaluwarsa
                        </div>
                        <ul class="list-group list-group-flush small">
                            <?php if (!empty($expiring_stock)): ?>
                                <?php foreach ($expiring_stock as $o): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <i class="bx bx-time-five text-warning me-2"></i><?= $o['nama_barang']; ?>
                                        </span>
                                        <span class="badge bg-warning text-dark">
                                            <?= date('d M y', strtotime($o['expired_date_terdekat'])); ?>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item text-muted text-center">
                                    ✅ Tidak ada obat mendekati kedaluwarsa
                                </li>
                            <?php endif; ?>
                        </ul>

                        <!-- Obat Stok Menipis -->
                        <div class="card-header bg-white fw-bold text-danger border-top">
                            ⚠️ Obat Stok Menipis
                        </div>
                        <ul class="list-group list-group-flush small mb-2">
                            <?php if (!empty($low_stock)): ?>
                                <?php foreach ($low_stock as $o): ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <i class="bx bx-capsule text-danger me-2"></i><?= $o['nama_barang']; ?>
                                        </span>
                                        <span class="badge bg-danger"><?= $o['stok']; ?></span>
                                    </li>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <li class="list-group-item text-muted text-center">
                                    ✅ Semua stok aman
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- ============================================ -->
            <!-- 🤖 SMART RESTOCK ADVISOR -->
            <!-- ============================================ -->
            <div class="card shadow-sm border-0 mb-4"
                style="border-radius: 1rem; background: linear-gradient(135deg, #f0fcf7, #ffffff);">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center flex-wrap">
                    <div class="fw-bold text-success d-flex align-items-center gap-2 flex-wrap">
                        <i class="bx bx-analyse me-1"></i> Smart Restock Advisor
                        <i class="bx bx-info-circle text-info fs-5"
                            data-bs-toggle="tooltip"
                            data-bs-placement="right"
                            title="Smart Restock Advisor menganalisis data penjualan 3 bulan terakhir dan memperkirakan kebutuhan stok 30 hari ke depan."></i>
                        <small class="text-muted d-block" style="font-size:0.85rem;">
                            AI prediksi kebutuhan stok (3 bulan historis → estimasi 30 hari)
                        </small>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                        <span class="badge bg-info text-white">AI-Powered</span>
                    </div>
                </div>

                <div class="card-body pt-3">
                    <?php
                    $unsafe_items = array_filter($restock_suggestions, fn($x) => $x['recommended_order'] > 0);
                    usort($unsafe_items, function ($a, $b) {
                        $ratioA = ($a['est_need_30d'] ?? 0) > 0 ? ($a['stok'] / $a['est_need_30d']) : 1;
                        $ratioB = ($b['est_need_30d'] ?? 0) > 0 ? ($b['stok'] / $b['est_need_30d']) : 1;
                        return $ratioA <=> $ratioB;
                    });
                    $limited_unsafe = array_slice($unsafe_items, 0, 4);
                    $safe_items = array_filter($restock_suggestions, fn($x) => $x['recommended_order'] <= 0);
                    $all_items = array_merge($unsafe_items, $safe_items);
                    ?>

                    <?php if (!empty($limited_unsafe)): ?>
                        <div class="row g-3">
                            <?php foreach ($limited_unsafe as $item): ?>
                                <?php
                                $stok = intval($item['stok']);
                                $est_30 = intval($item['est_need_30d']);
                                $rec = intval($item['recommended_order']);
                                $ratio = $est_30 > 0 ? ($stok / $est_30) : 1;
                                $pct = $est_30 > 0 ? min(100, round($ratio * 100)) : 100;
                                if ($ratio < 0.3) {
                                    $status_label = 'Kritis';
                                    $status_class = 'danger';
                                } elseif ($ratio < 0.7) {
                                    $status_label = 'Menipis';
                                    $status_class = 'warning';
                                } else {
                                    $status_label = 'Aman';
                                    $status_class = 'success';
                                }
                                ?>
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <div class="card h-100 border-0 shadow-sm fade-card animate-up position-relative"
                                        style="border-left:3px solid #00bcd4; border-radius:0.8rem;">
                                        <span class="badge position-absolute top-0 end-0 m-2 bg-<?= $status_class; ?> text-white small shadow-sm">
                                            <?= $status_label; ?>
                                        </span>
                                        <div class="card-body">
                                            <h6 class="mb-1 fw-semibold"><?= htmlspecialchars($item['nama_barang']); ?></h6>
                                            <small class="text-muted">
                                                <?= htmlspecialchars($item['satuan'] ?: 'pcs'); ?> • Stok: <strong><?= $stok; ?></strong>
                                            </small>
                                            <div id="chart-<?= $item['id_barang']; ?>" class="my-3" style="height:80px;"></div>
                                            <div class="small text-muted d-flex justify-content-between mb-1">
                                                <span>Estimasi 30d</span>
                                                <span><strong><?= $est_30; ?></strong></span>
                                            </div>
                                            <div class="progress" style="height:6px;">
                                                <div class="progress-bar bg-<?= $status_class; ?>" style="width: <?= $pct; ?>%"></div>
                                            </div>
                                            <button class="btn btn-sm btn-outline-primary w-100 mt-3"
                                                onclick="openRestockModal(<?= $item['id_barang']; ?>)">
                                                Restock (<?= $rec; ?>)
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Legenda -->
                        <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 mt-4 small text-muted">
                            <div class="d-flex align-items-center"><span class="legend-box bg-success"></span>&nbsp;Stok Saat Ini</div>
                            <div class="d-flex align-items-center"><span class="legend-box bg-warning"></span>&nbsp;Estimasi 30 Hari</div>
                            <div class="d-flex align-items-center"><span class="legend-box bg-danger"></span>&nbsp;Rekomendasi Restock</div>
                        </div>

                        <div class="text-center mt-3">
                            <button id="btn-open-restock-modal" class="btn btn-outline-primary btn-sm px-3"
                                data-bs-toggle="modal" data-bs-target="#modalRestockAI">
                                <i class="bx bx-show me-1"></i> Lihat Semua Analisis (<?= count($all_items); ?>)
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted">
                            <i class="bx bx-check-circle text-success fs-4"></i>
                            Semua stok aman berdasarkan analisis AI (3 bulan terakhir).
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ============================= -->
            <!-- 🪟 MODAL RESTOCK AI -->
            <!-- ============================= -->
            <div class="modal fade" id="modalRestockAI" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">
                                <i class="bx bx-analyse me-2"></i> Analisis Lengkap Restock AI
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row g-3">
                                <?php foreach ($all_items as $item): ?>
                                    <?php
                                    $stok = intval($item['stok']);
                                    $est_30 = intval($item['est_need_30d']);
                                    $rec = intval($item['recommended_order']);
                                    $ratio = $est_30 > 0 ? ($stok / $est_30) : 1;
                                    $pct = $est_30 > 0 ? min(100, round($ratio * 100)) : 100;
                                    if ($ratio < 0.3) {
                                        $status_label = 'Kritis';
                                        $status_class = 'danger';
                                    } elseif ($ratio < 0.7) {
                                        $status_label = 'Menipis';
                                        $status_class = 'warning';
                                    } else {
                                        $status_label = 'Aman';
                                        $status_class = 'success';
                                    }
                                    ?>
                                    <div class="col-12 col-sm-4 col-lg-2 item-card" id="barang-<?= $item['id_barang']; ?>">
                                        <div class="card h-100 border-0 shadow-sm fade-card position-relative"
                                            style="border-left:3px solid <?= $item['recommended_order'] > 0 ? '#dc3545' : '#28a745'; ?>; border-radius:0.8rem;">
                                            <span class="badge position-absolute top-0 end-0 m-2 bg-<?= $status_class; ?> text-white small shadow-sm">
                                                <?= $status_label; ?>
                                            </span>
                                            <div class="card-body">
                                                <h6 class="mb-1 fw-semibold"><?= htmlspecialchars($item['nama_barang']); ?></h6>
                                                <small class="text-muted">
                                                    <?= htmlspecialchars($item['satuan'] ?: 'pcs'); ?> • Stok: <strong><?= $stok; ?></strong>
                                                </small>
                                                <div id="chart-modal-<?= $item['id_barang']; ?>" class="my-3" style="height:80px;"></div>
                                                <div class="small text-muted d-flex justify-content-between mb-1">
                                                    <span>Estimasi 30d</span>
                                                    <span><strong><?= $est_30; ?></strong></span>
                                                </div>
                                                <div class="progress" style="height:6px;">
                                                    <div class="progress-bar bg-<?= $status_class; ?>" style="width: <?= $pct; ?>%"></div>
                                                </div>

                                                <?php if ($item['recommended_order'] > 0): ?>
                                                    <button class="btn btn-sm btn-outline-primary w-100 mt-3"
                                                        onclick="openRestockModal(<?= $item['id_barang']; ?>)">
                                                        Restock (<?= $rec; ?>)
                                                    </button>
                                                <?php else: ?>
                                                    <button class="btn btn-sm btn-outline-success w-100 mt-3" disabled>
                                                        Aman ✔
                                                    </button>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Legenda -->
                            <div class="d-flex justify-content-center align-items-center flex-wrap gap-3 mt-4 small text-muted">
                                <div class="d-flex align-items-center"><span class="legend-box bg-success"></span>&nbsp;Stok Saat Ini</div>
                                <div class="d-flex align-items-center"><span class="legend-box bg-warning"></span>&nbsp;Estimasi 30 Hari</div>
                                <div class="d-flex align-items-center"><span class="legend-box bg-danger"></span>&nbsp;Rekomendasi Restock</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ===================== -->
            <!-- 📋 TABEL TRANSAKSI (1 BARIS PENUH) -->
            <!-- ===================== -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card shadow-sm border-0"
                        style="border-radius: 1rem; background: linear-gradient(135deg, #ffffff, #f9fff9);">
                        <div class="card-header bg-white border-0 fw-bold text-success">
                            <i class="bx bx-transfer me-1"></i> Ringkasan Transaksi Terbaru
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%">#</th>
                                        <th>Tanggal</th>
                                        <th>Jenis</th>
                                        <th>Nomor Nota</th>
                                        <th class="text-end">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($transaksi)): $no = 1; ?>
                                        <?php foreach ($transaksi as $t): ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= mediumdate_indo($t['tanggal']); ?></td>
                                                <td>
                                                    <span class="badge bg-<?= $t['jenis'] == 'Pembelian' ? 'danger' : 'success'; ?>">
                                                        <?= $t['jenis']; ?>
                                                    </span>
                                                </td>
                                                <td><?= $t['nota']; ?></td>
                                                <td class="text-end"><?= 'Rp ' . number_format($t['total'], 0, ',', '.'); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="5" class="text-center text-muted py-3">Belum ada transaksi</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================== -->
        <!-- 🏥 SECTION 2: KLINIK & REKAM MEDIK -->
        <!-- ========================================================== -->
        <section class="mb-5">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                <h5 class="fw-bold text-success mb-2 mb-md-0">
                    <i class="bx bx-first-aid  me-1"></i> Klinik & Rekam Medik
                </h5>
                <hr class="d-md-none text-success opacity-50 mb-0">
            </div>

            <!-- Statistik Medis -->
            <div class="row g-3 mb-3">

                <!-- Poliklinik -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="<?= base_url('poliklinik'); ?>" class="text-decoration-none">
                        <div class="card shadow-sm border-0 text-center h-100 hover-card"
                            style="border-top: 4px solid #0d6efd; border-radius: 1rem; background: linear-gradient(135deg, #f8fbff, #ffffff);">
                            <div class="card-body p-3">
                                <i class="bx bx-building-house fs-1 text-primary mb-2 opacity-75"></i>
                                <p class="text-muted small mb-1">Poliklinik</p>
                                <h4 class="fw-bold text-primary mb-0 count-up" data-count="<?= $count_poliklinik; ?>">0</h4>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Dokter -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="<?= base_url('user'); ?>" class="text-decoration-none">
                        <div class="card shadow-sm border-0 text-center h-100 hover-card"
                            style="border-top: 4px solid #198754; border-radius: 1rem; background: linear-gradient(135deg, #f9fff9, #ffffff);">
                            <div class="card-body p-3">
                                <i class="bx bx-plus-medical fs-1 text-success mb-2 opacity-75"></i>
                                <p class="text-muted small mb-1">Dokter Klinik</p>
                                <h4 class="fw-bold text-success mb-0 count-up" data-count="<?= $count_dokter; ?>">0</h4>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Total Pasien -->
                <div class="col-6 col-md-4 col-lg-3">
                    <a href="<?= base_url('pasien'); ?>" class="text-decoration-none">
                        <div class="card shadow-sm border-0 text-center h-100 hover-card"
                            style="border-top: 4px solid #20c997; border-radius: 1rem; background: linear-gradient(135deg, #f9fff9, #ffffff);">
                            <div class="card-body p-3">
                                <i class="bx bx-user fs-1 text-success mb-2 opacity-75"></i>
                                <p class="text-muted small mb-1">Total Pasien</p>
                                <h4 class="fw-bold text-success mb-0 count-up" data-count="<?= $count_pasien; ?>">0</h4>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Kunjungan Bulan Ini -->
                <div class="col-6 col-md-4 col-lg-3">
                    <div class="card shadow-sm border-0 text-center h-100 hover-card"
                        style="border-top: 4px solid #dc3545; border-radius: 1rem; background: linear-gradient(135deg, #fff8f8, #ffffff);">
                        <div class="card-body p-3">
                            <i class="bx bx-user-check fs-1 text-danger mb-2 opacity-75"></i>
                            <p class="text-muted small mb-1">Kunjungan Bulan Ini</p>
                            <h5 class="fw-bold text-danger mb-0" id="totalKunjunganBulanIni">0 Pasien</h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart Kunjungan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 fw-bold text-success">
                    <i class="bx bx-pulse me-1"></i> Grafik Kunjungan Pasien per Bulan
                </div>
                <div class="card-body">
                    <div id="chartKunjungan" style="height: 320px;"></div>
                </div>
            </div>

            <!-- 🤖 AI: Prediksi Kunjungan Bulan Depan -->
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white border-0 fw-bold text-info d-flex align-items-center">
                    <i class="bx bx-line-chart me-2 fs-5"></i>
                    Prediksi Kunjungan Bulan Depan (AI)
                    <i class="bx bx-info-circle ms-2 text-secondary"
                        data-bs-toggle="tooltip"
                        data-bs-placement="right"
                        title="AI ini menganalisis tren 3 bulan terakhir dari data rekam medis pasien untuk memprediksi jumlah kunjungan bulan berikutnya. Prediksi bersifat estimasi berbasis rata-rata sederhana.">
                    </i>
                </div>

                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="bx bx-pulse fs-1 text-info mb-2"></i>
                        <h5 class="fw-bold text-info mb-0">
                            <?= number_format($prediksi_kunjungan, 0, ',', '.'); ?> Pasien
                        </h5>
                        <small class="text-muted d-block">
                            <?= $persentase_prediksi >= 0 ? 'Naik' : 'Turun'; ?>
                            <?= abs($persentase_prediksi); ?>% dibanding bulan ini
                        </small>
                    </div>

                    <!-- Mini Chart -->
                    <div id="chartPrediksiKunjungan" style="height: 260px;"></div>

                    <!-- AI Insight Box -->
                    <div class="ai-insight-box mt-3">
                        <i class="bx bx-brain fs-4 d-block mb-1"></i>
                        <strong>AI Insight:</strong>
                        <div class="small fst-italic">
                            Berdasarkan tren 3 bulan terakhir, sistem memperkirakan
                            <?= $persentase_prediksi >= 0
                                ? '<span class="text-success">peningkatan</span>'
                                : '<span class="text-danger">penurunan</span>'; ?>
                            kunjungan sebesar <?= abs($persentase_prediksi); ?>% bulan depan.
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================== -->
        <!-- 🤖 SECTION 3: SMART FUTURE (INTERAKTIF) -->
        <!-- ========================================================== -->
        <section class="mb-5">
            <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between mb-3">
                <h5 class="fw-bold text-primary mb-3 mt-4 d-flex align-items-center">
                    <i class="bx bx-brain me-1"></i> Smart Future
                    <i class="bx bx-info-circle ms-2 text-secondary"
                        data-bs-toggle="tooltip"
                        title="Fitur Smart Future sedang dalam tahap pengembangan untuk integrasi AI klinik & farmasi masa depan.">
                    </i>
                </h5>
                <hr class="d-md-none text-success opacity-50 mb-0">
            </div>


            <div class="row g-3 mb-4">

                <!-- AI Prescription Advisor -->
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card shadow-sm border-0 text-center h-100 hover-card"
                        data-bs-toggle="modal" data-bs-target="#modalPrescription"
                        style="border-top: 4px solid #0d6efd; border-radius: 1rem; background: linear-gradient(135deg, #f8fbff, #ffffff); cursor: pointer;">
                        <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="bx bx-bulb fs-1 text-primary mb-2 opacity-75"></i>
                            <h6 class="fw-bold text-dark mb-1">AI Prescription Advisor</h6>
                            <span class="badge bg-secondary">Coming Soon</span>
                        </div>
                    </div>
                </div>

                <!-- Telehealth AI Notes -->
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card shadow-sm border-0 text-center h-100 hover-card"
                        data-bs-toggle="modal" data-bs-target="#modalTelehealth"
                        style="border-top: 4px solid #ffc107; border-radius: 1rem; background: linear-gradient(135deg, #fffbea, #ffffff); cursor: pointer;">
                        <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="bx bx-phone-call fs-1 text-warning mb-2 opacity-75"></i>
                            <h6 class="fw-bold text-dark mb-1">Telehealth AI Notes</h6>
                            <span class="badge bg-secondary">Coming Soon</span>
                        </div>
                    </div>
                </div>

                <!-- AI Disease Trend Analyzer -->
                <div class="col-12 col-md-4 col-lg-4">
                    <div class="card shadow-sm border-0 text-center h-100 hover-card"
                        data-bs-toggle="modal" data-bs-target="#modalDisease"
                        style="border-top: 4px solid #17a2b8; border-radius: 1rem; background: linear-gradient(135deg, #f0faff, #ffffff); cursor: pointer;">
                        <div class="card-body p-3 d-flex flex-column align-items-center justify-content-center">
                            <i class="bx bx-pulse fs-1 text-info mb-2 opacity-75"></i>
                            <h6 class="fw-bold text-dark mb-1">AI Disease Trend Analyzer</h6>
                            <span class="badge bg-secondary">Coming Soon</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ========================================================== -->
            <!-- 💬 MODALS (Penjelasan Fitur) -->
            <!-- ========================================================== -->

            <!-- Modal: Prescription Advisor -->
            <div class="modal fade" id="modalPrescription" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header bg-primary text-white rounded-top-4">
                            <h6 class="modal-title text-light mb-2">
                                <i class="bx bx-bulb me-1"></i> AI Prescription Advisor
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <p class="text-muted mb-3">
                                Menganalisis pola resep dokter dan interaksi obat untuk memberi saran otomatis
                                dalam penulisan resep yang lebih aman dan efisien.
                            </p>
                            <span class="badge bg-secondary">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal: Telehealth AI Notes -->
            <div class="modal fade" id="modalTelehealth" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header bg-warning text-dark rounded-top-4">
                            <h6 class="modal-title text-light mb-2">
                                <i class="bx bx-phone-call me-1"></i> Telehealth AI Notes
                            </h6>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <p class="text-muted mb-3">
                                Mengubah hasil konsultasi telemedicine menjadi catatan medis otomatis
                                yang terstruktur dan siap disimpan ke rekam medis elektronik.
                            </p>
                            <span class="badge bg-secondary">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal: Disease Trend Analyzer -->
            <div class="modal fade" id="modalDisease" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-4">
                        <div class="modal-header bg-info text-white rounded-top-4">
                            <h6 class="modal-title text-light mb-2">
                                <i class="bx bx-pulse me-1"></i> AI Disease Trend Analyzer
                            </h6>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body text-center p-4">
                            <p class="text-muted mb-3">
                                Menganalisis data diagnosa pasien untuk mendeteksi tren penyakit yang meningkat,
                                membantu antisipasi wabah dan manajemen stok obat.
                            </p>
                            <span class="badge bg-secondary">Coming Soon</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- Data dari PHP -->
<script>
    // kirim data dari PHP ke JS global
    const dataRestockAI = <?= json_encode($restock_suggestions); ?>;
    const dataKunjunganBulanan = <?= json_encode($kunjungan_bulanan); ?>;
    const prediksiKunjungan = <?= $prediksi_kunjungan; ?>;
    const dataKunjunganDashboard = <?= json_encode($kunjungan); ?>;
    const dataKeuanganDashboard = <?= json_encode($keuangan); ?>;
</script>
<script src="<?= base_url(); ?>/assets/js/dashboard-skamanda-medika.js"></script>