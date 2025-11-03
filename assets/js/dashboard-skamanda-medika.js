// ============================================================
// DASHBOARD SKAMANDA MEDIKA (Versi Aman - 1 Fungsi AnimateCount)
// ============================================================

// ============================================================
// 🔹 Fungsi Global: Animate Count (Easing halus & bebas bentrok)
// ============================================================
function animateCount(el, target, isRupiah = false, suffix = "") {
	if (!el) return;

	const duration = 1500;
	const start = performance.now();

	function easeOutCubic(t) {
		return 1 - Math.pow(1 - t, 3);
	}

	function update(now) {
		const progress = easeOutCubic(Math.min((now - start) / duration, 1));
		const currentValue = Math.floor(target * progress);

		el.textContent = isRupiah
			? "Rp " + currentValue.toLocaleString("id-ID")
			: currentValue.toLocaleString("id-ID") + (suffix ? " " + suffix : "");

		if (progress < 1) requestAnimationFrame(update);
	}

	requestAnimationFrame(update);
}

// ============================================================
// 🔹 Setup Umum Dashboard
// ============================================================
document.addEventListener("DOMContentLoaded", function () {
	// --- Bootstrap tooltip setup ---
	const tooltipTriggerList = [].slice.call(
		document.querySelectorAll('[data-bs-toggle="tooltip"]')
	);
	tooltipTriggerList.map((el) => new bootstrap.Tooltip(el));

	// --- Animasi elemen masuk (.animate-up) ---
	document.querySelectorAll(".animate-up").forEach((el, i) => {
		setTimeout(() => el.classList.add("visible"), i * 100);
	});

	// --- Render charts awal ---
	setTimeout(() => renderCharts(false), 600);

	// --- Render ulang chart dalam modal ---
	const modalEl = document.getElementById("modalRestockAI");
	if (modalEl) {
		modalEl.addEventListener("shown.bs.modal", function () {
			renderCharts(true);
		});

		modalEl.addEventListener("hidden.bs.modal", function () {
			const backdrops = document.querySelectorAll(".modal-backdrop");
			backdrops.forEach((b) => b.remove());
			document.body.classList.remove("modal-open");
		});
	}

	// --- Jalankan animasi counter umum (.count-up) ---
	const counters = document.querySelectorAll(".count-up");
	counters.forEach((el) => {
		const target = parseInt(el.getAttribute("data-count")) || 0;
		animateCount(el, target);
	});
});

// ============================================================
// 🔹 Fungsi Render Chart Restock AI
// ============================================================
function renderCharts(inModal = false) {
	if (typeof dataRestockAI === "undefined") return;
	const dataAI = dataRestockAI;
	if (!Array.isArray(dataAI)) return;

	dataAI.forEach((item) => {
		const stok = Number(item.stok) || 0;
		const est = Number(item.est_need_30d) || 0;
		const rec = Number(item.recommended_order) || 0;
		const id = item.id_barang;
		if (!id) return;

		const options = {
			chart: { type: "bar", sparkline: { enabled: true } },
			series: [{ data: [stok, est, rec] }],
			plotOptions: { bar: { columnWidth: "60%", distributed: true } },
			colors: ["#28a745", "#ffc107", "#dc3545"],
			tooltip: { enabled: false },
		};

		const sel = inModal ? "#chart-modal-" + id : "#chart-" + id;
		const el = document.querySelector(sel);
		if (el && !el.dataset.chartRendered) {
			new ApexCharts(el, options).render();
			el.dataset.chartRendered = "1";
		}
	});
}

// ============================================================
// 🔹 Fungsi: Open Modal Restock AI
// ============================================================
function openRestockModal(barangId) {
	const modalEl = document.getElementById("modalRestockAI");
	if (!modalEl) return;

	const modalInstance = bootstrap.Modal.getOrCreateInstance(modalEl);
	modalInstance.show();

	setTimeout(() => {
		const target = document.getElementById("barang-" + barangId);
		if (target) {
			target.scrollIntoView({
				behavior: "smooth",
				block: "center",
			});
		}
	}, 500);
}

// ============================================================
// 🔹 Chart Prediksi Kunjungan Bulanan
// ============================================================
document.addEventListener("DOMContentLoaded", function () {
	if (
		typeof dataKunjunganBulanan === "undefined" ||
		typeof prediksiKunjungan === "undefined"
	)
		return;

	const dataKunjungan = dataKunjunganBulanan;
	const prediksi = prediksiKunjungan;

	// Daftar nama bulan singkat
	const namaBulan = [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Agu",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	];

	// Konversi format "2025-11" → "Nov 2025"
	const bulan = dataKunjungan
		.map((d) => {
			let b = d.bulan;
			if (/^\d{4}-\d{2}$/.test(b)) {
				const [tahun, bulanNum] = b.split("-");
				return `${namaBulan[parseInt(bulanNum) - 1]} ${tahun}`;
			}
			return b;
		})
		.reverse();

	const total = dataKunjungan.map((d) => Number(d.total_kunjungan)).reverse();

	bulan.push("Prediksi");
	total.push(prediksi);

	const optionsPrediksi = {
		chart: {
			type: "line",
			height: 260,
			toolbar: { show: false },
			animations: { easing: "easeinout", speed: 800 },
		},
		series: [{ name: "Kunjungan", data: total }],
		xaxis: {
			categories: bulan,
			labels: { style: { fontSize: "12px" } },
		},
		yaxis: {
			labels: {
				formatter: (val) => Math.round(val), // tampilkan angka bulat
				style: { fontSize: "12px" },
			},
		},
		stroke: { curve: "smooth", width: 3 },
		colors: ["#0dcaf0"],
		markers: { size: 5 },
		tooltip: { y: { formatter: (val) => Math.round(val) + " pasien" } },
		responsive: [
			{
				breakpoint: 768,
				options: {
					chart: { height: 220 },
					stroke: { width: 2 },
					markers: { size: 4 },
				},
			},
		],
	};

	const chartEl = document.querySelector("#chartPrediksiKunjungan");
	if (chartEl) new ApexCharts(chartEl, optionsPrediksi).render();
});

// ============================================================
// 🔹 Chart Kunjungan & Keuangan + Counter Total
// ============================================================
document.addEventListener("DOMContentLoaded", function () {
	if (
		typeof config === "undefined" ||
		typeof dataKunjunganDashboard === "undefined"
	)
		return;

	// Warna tema
	config.colors = {
		primary: "#118B63",
		success: "#0A6C4D",
		info: "#23A97B",
		warning: "#F2B705",
		danger: "#D9534F",
		textMuted: "#8A8A8A",
		headingColor: "#052D20",
		borderColor: "#E0E6E3",
		white: "#FFFFFF",
	};

	const cardColor = config.colors.white;
	const headingColor = config.colors.headingColor;
	const labelColor = config.colors.textMuted;
	const borderColor = config.colors.borderColor;
	const primaryColor = config.colors.primary;
	const namaBulan = [
		"Jan",
		"Feb",
		"Mar",
		"Apr",
		"Mei",
		"Jun",
		"Jul",
		"Agu",
		"Sep",
		"Okt",
		"Nov",
		"Des",
	];

	const labels = dataKunjunganDashboard.map((d) => d.bulan);
	const dataKunjungan = dataKunjunganDashboard.map((d) => d.total);
	const labelsFormatted = labels.map((b) => namaBulan[b - 1]);

	const bulanKeuangan = dataKeuanganDashboard.map((d) => d.bulan);
	const dataPembelian = dataKeuanganDashboard.map((d) => d.total_pembelian);
	const dataPenjualan = dataKeuanganDashboard.map((d) => d.total_penjualan);
	const bulanLabel = bulanKeuangan.map((b) => namaBulan[b - 1]);

	const totalKunjunganBulanIni = dataKunjungan.slice(-1)[0] || 0;
	const totalPembelianBulanIni = dataPembelian.slice(-1)[0] || 0;
	const totalPenjualanBulanIni = dataPenjualan.slice(-1)[0] || 0;

	const formatRupiah = (num) => "Rp " + Number(num).toLocaleString("id-ID");

	// Jalankan animasi counter total (pakai fungsi global)
	setTimeout(() => {
		animateCount(
			document.getElementById("totalKunjunganBulanIni"),
			totalKunjunganBulanIni,
			false,
			"Pasien"
		);
		animateCount(
			document.getElementById("totalPembelianBulanIni"),
			totalPembelianBulanIni,
			true
		);
		animateCount(
			document.getElementById("totalPenjualanBulanIni"),
			totalPenjualanBulanIni,
			true
		);
	}, 300);

	// Chart Kunjungan
	const chartKunjunganEl = document.querySelector("#chartKunjungan");
	if (chartKunjunganEl) {
		new ApexCharts(chartKunjunganEl, {
			chart: { type: "area", height: 320, toolbar: { show: false } },
			series: [{ name: "Kunjungan", data: dataKunjungan }],
			xaxis: {
				categories: labelsFormatted,
				labels: { style: { colors: labelColor } },
			},
			yaxis: {
				labels: {
					formatter: (val) => Math.round(val),
					style: { colors: labelColor },
				},
			},
			colors: [primaryColor],
			stroke: { curve: "smooth", width: 3 },
			fill: {
				type: "gradient",
				gradient: { shadeIntensity: 0.5, opacityFrom: 0.5, opacityTo: 0.2 },
			},
			grid: { borderColor, strokeDashArray: 4 },
			markers: { size: 4, colors: [cardColor], strokeColors: primaryColor },
			tooltip: { y: { formatter: (val) => Math.round(val) + " pasien" } },
			dataLabels: { enabled: false },
		}).render();
	}

	// Chart Keuangan
	const chartKeuanganEl = document.querySelector("#chartKeuangan");
	if (chartKeuanganEl) {
		new ApexCharts(chartKeuanganEl, {
			chart: { type: "bar", height: 320, toolbar: { show: false } },
			series: [
				{ name: "Pembelian", data: dataPembelian },
				{ name: "Penjualan", data: dataPenjualan },
			],
			xaxis: {
				categories: bulanLabel,
				labels: { style: { colors: labelColor } },
			},
			yaxis: {
				labels: {
					formatter: (val) => formatRupiah(val),
					style: { colors: labelColor },
				},
			},
			colors: [config.colors.danger, config.colors.success],
			plotOptions: {
				bar: {
					columnWidth: "45%",
					borderRadius: 6,
					dataLabels: { position: "top" },
				},
			},
			grid: { borderColor, strokeDashArray: 4 },
			legend: { labels: { colors: headingColor } },
			tooltip: { y: { formatter: (val) => formatRupiah(val) } },
			dataLabels: { enabled: false },
		}).render();
	}
});
