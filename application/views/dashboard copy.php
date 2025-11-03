<!-- ============================= -->
<!-- Dashboard Assets -->
<!-- ============================= -->
<link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css'); ?>">

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    // Inject data PHP ke JS global
    window.restockData = <?= json_encode($restock_suggestions); ?>;
</script>
<script src="<?= base_url('assets/js/dashboard.js'); ?>"></script>


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
                    Welcome to <strong>SKAMANDA Medika</strong> — Integrated Pharmacy & Clinical System for Vocational Schools.
                </p>
            </div>
        </div>

        <!-- ====================================================== -->
        <!-- 🌿 SECTION: MANAJEMEN FARMASI -->
        <!-- ====================================================== -->
        <section class="mb-5">
            <!-- Header Section -->
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
                        <div class="col-6 col-md-4 col-lg-3">
                            <a href="<?= base_url('supplier'); ?>" class="text-decoration-none">
                                <div class="card stat-card border-success-light">
                                    <div class="card-body text-center p-3">
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
                                <div class="card stat-card border-teal-light">
                                    <div class="card-body text-center p-3">
                                        <i class="bx bx-capsule fs-1 text-success mb-2 opacity-75"></i>
                                        <p class="text-muted small mb-1">Jumlah Obat</p>
                                        <h4 class="fw-bold text-success mb-0 count-up" data-count="<?= $count_barang; ?>">0</h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <!-- Pembelian Bulan Ini -->
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card stat-card border-danger-light">
                                <div class="card-body text-center p-3">
                                    <i class="bx bx-cloud-download fs-1 text-danger mb-2 opacity-75"></i>
                                    <p class="text-muted small mb-1">Pembelian Bulan Ini</p>
                                    <h5 class="fw-bold text-danger mb-0" id="totalPembelianBulanIni">Rp 0</h5>
                                </div>
                            </div>
                        </div>

                        <!-- Penjualan Bulan Ini -->
                        <div class="col-6 col-md-4 col-lg-3">
                            <div class="card stat-card border-green-light">
                                <div class="card-body text-center p-3">
                                    <i class="bx bx-cloud-upload fs-1 text-success mb-2 opacity-75"></i>
                                    <p class="text-muted small mb-1">Penjualan Bulan Ini</p>
                                    <h5 class="fw-bold text-success mb-0 count-up" id="totalPenjualanBulanIni">Rp 0</h5>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Chart -->
                    <div class="card shadow-sm border-0 gradient-card">
                        <div class="card-header bg-transparent border-0 fw-bold text-success">
                            <i class="bx bx-bar-chart-alt me-1"></i> Statistik Pembelian & Penjualan
                        </div>
                        <div class="card-body">
                            <div id="chartKeuangan" style="height: 320px;"></div>
                        </div>
                    </div>
                </div>

                <!-- ===================== -->
                <!-- 📦 KOLOM KANAN (Expired + Low Stock) -->
                <!-- ===================== -->
                <div class="col-lg-3">
                    <div class="card shadow-sm border-0 h-100 gradient-side">
                        <!-- Obat Mendekati Kedaluwarsa -->
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
            <!-- 🤖 Smart Restock Advisor (AI Prediksi Stok) -->
            <!-- ============================================ -->
            <div class="card shadow-sm border-0 mb-4 gradient-ai">
                <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center flex-wrap">
                    <div class="fw-bold text-success d-flex align-items-center gap-2 flex-wrap">
                        <i class="bx bx-analyse me-1"></i> Smart Restock Advisor
                        <i class="bx bx-info-circle text-info fs-5"
                            data-bs-toggle="tooltip"
                            data-bs-placement="right"
                            title="Smart Restock Advisor menganalisis data penjualan 3 bulan terakhir 
dan memperkirakan kebutuhan stok 30 hari ke depan."></i>
                        <small class="text-muted d-block fs-85">
                            AI prediksi kebutuhan stok (3 bulan historis → estimasi 30 hari)
                        </small>
                    </div>
                    <div class="d-flex align-items-center gap-2 mt-2 mt-md-0">
                        <span class="badge bg-info text-white">AI-Powered</span>
                    </div>
                </div>

                <div class="card-body pt-3">
                    <?php
                    // Ambil dan urutkan stok tidak aman berdasarkan rasio (stok/est)
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
                            <?php foreach ($limited_unsafe as $i => $item): ?>
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
                                    <div class="card restock-card border-left-cyan position-relative h-100">
                                        <span class="badge position-absolute top-0 end-0 m-2 bg-<?= $status_class; ?> text-white small shadow-sm">
                                            <?= $status_label; ?>
                                        </span>

                                        <div class="card-body">
                                            <h6 class="mb-1 fw-semibold"><?= htmlspecialchars($item['nama_barang']); ?></h6>
                                            <small class="text-muted">
                                                <?= htmlspecialchars($item['satuan'] ?: 'pcs'); ?> • Stok: <strong><?= $stok; ?></strong>
                                            </small>

                                            <div id="chart-<?= $item['id_barang']; ?>" class="chart-mini"></div>

                                            <div class="small text-muted d-flex justify-content-between mb-1">
                                                <span>Estimasi 30d</span>
                                                <span><strong><?= $est_30; ?></strong></span>
                                            </div>

                                            <div class="progress progress-thin">
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

                        <!-- Legenda Chart -->
                        <div class="chart-legend mt-4">
                            <div><span class="legend-box bg-success"></span> Stok Saat Ini</div>
                            <div><span class="legend-box bg-warning"></span> Estimasi 30 Hari</div>
                            <div><span class="legend-box bg-danger"></span> Rekomendasi Restock</div>
                        </div>

                        <div class="text-center mt-3">
                            <button id="btn-open-restock-modal" class="btn btn-outline-secondary btn-sm px-3"
                                data-bs-toggle="modal" data-bs-target="#modalRestockAI">
                                <i class="bx bx-show me-1"></i> Lihat Semua Analisis (<?= count($all_items); ?>)
                            </button>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4 text-muted position-relative">
                            <div class="d-inline-flex align-items-center justify-content-center gap-1 flex-wrap">
                                <i class="bx bx-check-circle text-success fs-4"></i>
                                <span>Semua stok aman berdasarkan analisis AI (3 bulan terakhir).</span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- ============================= -->
            <!-- Modal: Fullscreen -->
            <!-- ============================= -->
            <div class="modal fade" id="modalRestockAI" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-fullscreen modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title"><i class="bx bx-analyse me-2"></i> Analisis Lengkap Restock AI</h5>
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
                                        <div class="card restock-card h-100 border-left-dynamic position-relative"
                                            data-order="<?= $item['recommended_order'] > 0 ? 'danger' : 'success'; ?>">
                                            <span class="badge position-absolute top-0 end-0 m-2 bg-<?= $status_class; ?> text-white small shadow-sm">
                                                <?= $status_label; ?>
                                            </span>

                                            <div class="card-body">
                                                <h6 class="mb-1 fw-semibold"><?= htmlspecialchars($item['nama_barang']); ?></h6>
                                                <small class="text-muted">
                                                    <?= htmlspecialchars($item['satuan'] ?: 'pcs'); ?> • Stok: <strong><?= $stok; ?></strong>
                                                </small>

                                                <div id="chart-modal-<?= $item['id_barang']; ?>" class="chart-mini"></div>

                                                <div class="small text-muted d-flex justify-content-between mb-1">
                                                    <span>Estimasi 30d</span>
                                                    <span><strong><?= $est_30; ?></strong></span>
                                                </div>

                                                <div class="progress progress-thin">
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

                            <div class="chart-legend mt-4">
                                <div><span class="legend-box bg-success"></span> Stok Saat Ini</div>
                                <div><span class="legend-box bg-warning"></span> Estimasi 30 Hari</div>
                                <div><span class="legend-box bg-danger"></span> Rekomendasi Restock</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- ============================= -->
            <!-- Scripts -->
            <!-- ============================= -->
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                    tooltipTriggerList.map(el => new bootstrap.Tooltip(el));

                    document.querySelectorAll('.animate-up').forEach((el, i) => {
                        setTimeout(() => el.classList.add('visible'), i * 100);
                    });

                    setTimeout(() => renderCharts(false), 600);

                    const modalEl = document.getElementById('modalRestockAI');
                    if (modalEl) {
                        modalEl.addEventListener('shown.bs.modal', function() {
                            renderCharts(true);
                        });
                    }
                });

                function renderCharts(inModal = false) {
                    const dataAI = <?= json_encode($restock_suggestions); ?>;
                    if (!Array.isArray(dataAI)) return;

                    dataAI.forEach(item => {
                        const stok = Number(item.stok) || 0;
                        const est = Number(item.est_need_30d) || 0;
                        const rec = Number(item.recommended_order) || 0;
                        const id = item.id_barang;
                        if (!id) return;

                        const options = {
                            chart: {
                                type: 'bar',
                                sparkline: {
                                    enabled: true
                                }
                            },
                            series: [{
                                data: [stok, est, rec]
                            }],
                            plotOptions: {
                                bar: {
                                    columnWidth: '60%',
                                    distributed: true
                                }
                            },
                            colors: ['#28a745', '#ffc107', '#dc3545'],
                            tooltip: {
                                enabled: false
                            }
                        };

                        const sel = inModal ? '#chart-modal-' + id : '#chart-' + id;
                        const el = document.querySelector(sel);
                        if (el && !el.dataset.chartRendered) {
                            new ApexCharts(el, options).render();
                            el.dataset.chartRendered = '1';
                        }
                    });
                }

                // ✅ Saat klik tombol Restock → buka modal fullscreen dan scroll ke item
                function openRestockModal(barangId) {
                    const modalEl = document.getElementById('modalRestockAI');
                    if (!modalEl) return;

                    // Gunakan getOrCreateInstance untuk menghindari multiple instances/backdrop
                    const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
                    modalInstance.show();

                    // scroll ke item di modal (tetap lakukan scroll, tapi tanpa highlight)
                    setTimeout(() => {
                        const target = document.getElementById('barang-' + barangId);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                            // NO highlight: hapus baris yang menambahkan class highlight-item
                        }
                    }, 500);
                }

                // --- Tambahkan cleanup fail-safe jika backdrop tersisa setelah modal ditutup ---
                document.addEventListener('DOMContentLoaded', function() {
                    const modalEl = document.getElementById('modalRestockAI');
                    if (!modalEl) return;

                    modalEl.addEventListener('hidden.bs.modal', function() {
                        // Hapus backdrop yang tersisa (jika ada) dan pastikan body tidak memiliki class modal-open
                        const backdrops = document.querySelectorAll('.modal-backdrop');
                        backdrops.forEach(b => b.remove());
                        document.body.classList.remove('modal-open');
                    });
                });
            </script>

            <!-- ============================= -->
            <!-- Styles -->
            <!-- ============================= -->
            <style>
                .fade-card {
                    transition: transform .3s ease, box-shadow .3s ease;
                }

                .fade-card:hover {
                    transform: translateY(-3px);
                    box-shadow: 0 6px 12px rgba(0, 0, 0, .1);
                }

                .animate-up {
                    opacity: 0;
                    transform: translateY(20px);
                }

                .animate-up.visible {
                    opacity: 1;
                    transform: translateY(0);
                    transition: all .5s ease;
                }

                .legend-box {
                    display: inline-block;
                    width: 14px;
                    height: 14px;
                    border-radius: 3px;
                    margin-right: 6px;
                }

                .highlight-item {
                    animation: pulseHighlight 1.5s ease-out;
                    box-shadow: 0 0 0 4px rgba(0, 123, 255, .4) !important;
                }

                @keyframes pulseHighlight {
                    0% {
                        transform: scale(1);
                        opacity: 1;
                    }

                    50% {
                        transform: scale(1.02);
                        opacity: 1;
                    }

                    100% {
                        transform: scale(1);
                        opacity: 1;
                    }
                }

                @media (max-width: 768px) {
                    .card-body h6 {
                        font-size: 0.95rem;
                    }

                    .card-body small {
                        font-size: 0.8rem;
                    }
                }

                @media (max-width: 992px) {

                    .col-lg-3,
                    .col-lg-2 {
                        flex: 0 0 50%;
                        max-width: 50%;
                    }
                }

                @media (max-width: 576px) {

                    .col-lg-3,
                    .col-lg-2 {
                        flex: 0 0 100%;
                        max-width: 100%;
                    }
                }
            </style>

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
        <h5 class="fw-bold text-success mb-3 mt-4">
            <i class="bx bx-first-aid me-1"></i> Klinik & Rekam Medik
        </h5>

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

        <!-- ========================================================== -->
        <!-- ✨ Animasi Count-Up -->
        <!-- ========================================================== -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const easeOutQuad = t => t * (2 - t);
                const counters = document.querySelectorAll('.count-up');

                const animateCount = (el, target) => {
                    const duration = 1500;
                    const frameRate = 30;
                    const totalFrames = Math.round(duration / frameRate);
                    let frame = 0;

                    const timer = setInterval(() => {
                        frame++;
                        const progress = easeOutQuad(frame / totalFrames);
                        const current = Math.round(target * progress);
                        el.textContent = current.toLocaleString('id-ID');
                        if (frame === totalFrames) clearInterval(timer);
                    }, frameRate);
                };

                counters.forEach(el => {
                    const target = parseInt(el.getAttribute('data-count')) || 0;
                    animateCount(el, target);
                });
            });
        </script>

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
                        <?= $persentase_prediksi >= 0 ? '<span class="text-success">peningkatan</span>' : '<span class="text-danger">penurunan</span>'; ?>
                        kunjungan sebesar <?= abs($persentase_prediksi); ?>% bulan depan.
                    </div>
                </div>
            </div>
        </div>


        <!-- ========================================================== -->
        <!-- 📈 Script Chart Prediksi -->
        <!-- ========================================================== -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const dataKunjungan = <?= json_encode($kunjungan_bulanan); ?>;
                const prediksi = <?= $prediksi_kunjungan; ?>;

                const bulan = dataKunjungan.map(d => d.bulan).reverse();
                const total = dataKunjungan.map(d => Number(d.total_kunjungan)).reverse();

                bulan.push('Prediksi');
                total.push(prediksi);

                const optionsPrediksi = {
                    chart: {
                        type: 'line',
                        height: 260,
                        toolbar: {
                            show: false
                        },
                        animations: {
                            easing: 'easeinout',
                            speed: 800
                        }
                    },
                    series: [{
                        name: 'Kunjungan',
                        data: total
                    }],
                    xaxis: {
                        categories: bulan,
                        labels: {
                            style: {
                                fontSize: '12px'
                            }
                        }
                    },
                    stroke: {
                        curve: 'smooth',
                        width: 3
                    },
                    colors: ['#0dcaf0'],
                    markers: {
                        size: 5
                    },
                    tooltip: {
                        y: {
                            formatter: val => val + ' pasien'
                        }
                    },
                    responsive: [{
                        breakpoint: 768,
                        options: {
                            chart: {
                                height: 220
                            },
                            stroke: {
                                width: 2
                            },
                            markers: {
                                size: 4
                            }
                        }
                    }]
                };

                new ApexCharts(document.querySelector("#chartPrediksiKunjungan"), optionsPrediksi).render();

                // Aktifkan semua tooltip Bootstrap
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(el) {
                    return new bootstrap.Tooltip(el);
                });
            });
        </script>


        <style>
            /* Hover-card efek lembut */
            .hover-card {
                transition: transform 0.25s ease, box-shadow 0.25s ease;
                border-radius: 1rem;
                background: linear-gradient(135deg, #ffffff, #f9fbfc);
            }

            .hover-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            }

            /* Responsif grid spacing */
            @media (max-width: 768px) {
                .card-body i.fs-1 {
                    font-size: 2.2rem !important;
                }

                .card-body h4,
                .card-body h5 {
                    font-size: 1.1rem;
                }
            }

            /* Card AI Insight khusus */
            .ai-insight-box {
                border-radius: 0.75rem;
                background: linear-gradient(135deg, #e8f8ff, #ffffff);
                border: 1px solid #b3ecff;
                padding: 1rem;
                text-align: center;
                color: #0dcaf0;
                box-shadow: 0 2px 10px rgba(13, 202, 240, 0.15);
            }
        </style>






        <!-- ========================================================== -->
        <!-- 🤖 SECTION 3: SMART FUTURE (INTERAKTIF) -->
        <!-- ========================================================== -->
        <h5 class="fw-bold text-primary mb-3 mt-4 d-flex align-items-center">
            <i class="bx bx-brain me-1"></i> Smart Future
            <i class="bx bx-info-circle ms-2 text-secondary"
                data-bs-toggle="tooltip"
                title="Fitur Smart Future sedang dalam tahap pengembangan untuk integrasi AI klinik & farmasi masa depan.">
            </i>
        </h5>

        <div class="row g-3 mb-4">

            <!-- AI Prescription Advisor -->
            <div class="col-6 col-md-4 col-lg-4">
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
            <div class="col-6 col-md-4 col-lg-4">
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
            <div class="col-6 col-md-4 col-lg-4">
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
                        <h6 class="modal-title text-light mb-2"><i class="bx bx-bulb me-1"></i> AI Prescription Advisor</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <p class="text-muted mb-3">Menganalisis pola resep dokter dan interaksi obat untuk memberi saran otomatis dalam penulisan resep yang lebih aman dan efisien.</p>
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
                        <h6 class="modal-title text-light mb-2"><i class="bx bx-phone-call me-1"></i> Telehealth AI Notes</h6>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <p class="text-muted mb-3">Mengubah hasil konsultasi telemedicine menjadi catatan medis otomatis yang terstruktur dan siap disimpan ke rekam medis elektronik.</p>
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
                        <h6 class="modal-title text-light mb-2"><i class="bx bx-pulse me-1"></i> AI Disease Trend Analyzer</h6>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body text-center p-4">
                        <p class="text-muted mb-3">Menganalisis data diagnosa pasien untuk mendeteksi tren penyakit yang meningkat, membantu antisipasi wabah dan manajemen stok obat.</p>
                        <span class="badge bg-secondary">Coming Soon</span>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(el => new bootstrap.Tooltip(el));
            });
        </script>

        <style>
            .hover-card {
                transition: transform 0.2s ease, box-shadow 0.2s ease;
            }

            .hover-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
            }
        </style>


    </div>
</div>

<!-- ApexCharts -->
<script src="<?= base_url('assets/vendor/libs/apex-charts/apexcharts.js'); ?>"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // 🌿 Warna tema
        config.colors = {
            primary: '#118B63',
            success: '#0A6C4D',
            info: '#23A97B',
            warning: '#F2B705',
            danger: '#D9534F',
            textMuted: '#8A8A8A',
            headingColor: '#052D20',
            borderColor: '#E0E6E3',
            white: '#FFFFFF'
        };

        if (typeof config === 'undefined') return;

        const cardColor = config.colors.white;
        const headingColor = config.colors.headingColor;
        const labelColor = config.colors.textMuted;
        const borderColor = config.colors.borderColor;
        const primaryColor = config.colors.primary;
        const namaBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // 🔹 Data
        const labels = <?= json_encode(array_column($kunjungan, 'bulan')); ?>;
        const dataKunjungan = <?= json_encode(array_column($kunjungan, 'total')); ?>;
        const labelsFormatted = labels.map(b => namaBulan[b - 1]);

        const bulanKeuangan = <?= json_encode(array_column($keuangan, 'bulan')); ?>;
        const dataPembelian = <?= json_encode(array_column($keuangan, 'total_pembelian')); ?>;
        const dataPenjualan = <?= json_encode(array_column($keuangan, 'total_penjualan')); ?>;
        const bulanLabel = bulanKeuangan.map(b => namaBulan[b - 1]);

        // 🔹 Total bulan ini
        const totalKunjunganBulanIni = dataKunjungan.slice(-1)[0] || 0;
        const totalPembelianBulanIni = dataPembelian.slice(-1)[0] || 0;
        const totalPenjualanBulanIni = dataPenjualan.slice(-1)[0] || 0;

        // ✅ Format rupiah
        const formatRupiah = (num) => 'Rp ' + Number(num).toLocaleString('id-ID');

        // ✅ Fungsi animasi angka
        const animateCount = (el, target, isRupiah = false, suffix = '') => {
            const duration = 1500; // durasi total (ms)
            const frameRate = 30; // per frame
            const totalFrames = Math.round(duration / frameRate);
            let frame = 0;

            const counter = setInterval(() => {
                frame++;
                const progress = frame / totalFrames;
                const currentValue = Math.round(target * progress);

                el.textContent = isRupiah ?
                    "Rp " + currentValue.toLocaleString("id-ID") :
                    currentValue.toLocaleString("id-ID") + (suffix ? ' ' + suffix : '');

                if (frame === totalFrames) clearInterval(counter);
            }, frameRate);
        };

        // ✅ Jalankan animasi setelah 300ms
        setTimeout(() => {
            animateCount(document.getElementById('totalKunjunganBulanIni'), totalKunjunganBulanIni, false, 'Pasien');
            animateCount(document.getElementById('totalPembelianBulanIni'), totalPembelianBulanIni, true);
            animateCount(document.getElementById('totalPenjualanBulanIni'), totalPenjualanBulanIni, true);
        }, 300);

        // 🌿 Chart Kunjungan
        new ApexCharts(document.querySelector("#chartKunjungan"), {
            chart: {
                type: 'area',
                height: 320,
                toolbar: {
                    show: false
                }
            },
            series: [{
                name: 'Kunjungan',
                data: dataKunjungan
            }],
            xaxis: {
                categories: labelsFormatted,
                labels: {
                    style: {
                        colors: labelColor
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: val => Math.round(val),
                    style: {
                        colors: labelColor
                    }
                }
            },
            colors: [primaryColor],
            stroke: {
                curve: 'smooth',
                width: 3
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 0.5,
                    opacityFrom: 0.5,
                    opacityTo: 0.2
                }
            },
            grid: {
                borderColor,
                strokeDashArray: 4
            },
            markers: {
                size: 4,
                colors: [cardColor],
                strokeColors: primaryColor
            },
            tooltip: {
                y: {
                    formatter: val => Math.round(val) + " pasien"
                }
            },
            dataLabels: {
                enabled: false
            }
        }).render();

        // 🌿 Chart Keuangan
        new ApexCharts(document.querySelector("#chartKeuangan"), {
            chart: {
                type: 'bar',
                height: 320,
                toolbar: {
                    show: false
                }
            },
            series: [{
                    name: 'Pembelian',
                    data: dataPembelian
                },
                {
                    name: 'Penjualan',
                    data: dataPenjualan
                }
            ],
            xaxis: {
                categories: bulanLabel,
                labels: {
                    style: {
                        colors: labelColor
                    }
                }
            },
            yaxis: {
                labels: {
                    formatter: val => formatRupiah(val),
                    style: {
                        colors: labelColor
                    }
                }
            },
            colors: [config.colors.danger, config.colors.success],
            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    borderRadius: 6,
                    dataLabels: {
                        position: 'top'
                    }
                }
            },
            grid: {
                borderColor,
                strokeDashArray: 4
            },
            legend: {
                labels: {
                    colors: headingColor
                }
            },
            tooltip: {
                y: {
                    formatter: val => formatRupiah(val)
                }
            },
            dataLabels: {
                enabled: false
            }
        }).render();
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.count-up');

        // Fungsi easing biar animasinya halus, nggak linear
        const easeOutQuad = t => t * (2 - t);

        // Fungsi utama animasi angka
        const animateCount = (el, target) => {
            const duration = 1500; // durasi animasi (ms)
            const frameRate = 30; // kecepatan refresh
            const totalFrames = Math.round(duration / frameRate);
            let frame = 0;

            const timer = setInterval(() => {
                frame++;
                const progress = easeOutQuad(frame / totalFrames);
                const current = Math.round(target * progress);
                el.textContent = current.toLocaleString('id-ID');
                if (frame === totalFrames) clearInterval(timer);
            }, frameRate);
        };

        // Jalankan animasi untuk setiap elemen
        counters.forEach(el => {
            const target = parseInt(el.getAttribute('data-count')) || 0;
            animateCount(el, target);
        });
    });
</script>



<style>
    .hover-card:hover {
        transform: translateY(-3px);
        transition: all 0.2s ease-in-out;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .icon-circle {
        width: 48px;
        height: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .bg-light-green {
        background-color: #ecfdf5;
    }

    .table-hover tbody tr:hover {
        background-color: #f9fafb;
    }

    .table tbody tr:hover {
        background-color: var(--bs-success-light) !important;
    }

    .badge.bg-primary {
        background-color: var(--bs-primary) !important;
    }

    .badge.bg-success {
        background-color: var(--bs-success) !important;
    }
</style>