<div class="card">
    <div class="card-header">
        <h5>Cari Data Rekam Medik</h5>
    </div>
    <div class="card-body">
        <div class="form-inline mb-3">
            <input type="text" id="nomor_rm" class="form-control mr-2" placeholder="Masukkan Nomor RM (contoh: RM-080925/0001)">
            <button id="btnCari" class="btn btn-primary">Cari</button>
        </div>
        <div id="hasil_rekammedik"></div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#btnCari').click(function() {
            const nomor_rm = $('#nomor_rm').val().trim();
            if (nomor_rm === '') {
                alert('Masukkan Nomor RM terlebih dahulu!');
                return;
            }

            $.ajax({
                url: "<?= base_url('rekammedik_detail/getData'); ?>",
                type: "POST",
                data: {
                    nomor_rm: nomor_rm
                },
                dataType: "json",
                beforeSend: function() {
                    $('#hasil_rekammedik').html('<div class="text-muted">Memuat data...</div>');
                },
                success: function(res) {
                    if (res.error) {
                        $('#hasil_rekammedik').html('<div class="alert alert-danger">' + res.error + '</div>');
                    } else if (res.success) {
                        let html = `
                        <h5>${res.pasien.nama_pasien}</h5>
                        <p><strong>Nomor RM:</strong> ${res.pasien.nomor_rm}</p>
                        <p><strong>Tanggal Lahir:</strong> ${res.pasien.tanggal_lahir}</p>
                        <p><strong>Kunjungan Terakhir:</strong> ${res.rekam.tanggal_kunjungan}</p>
                    `;
                        $('#hasil_rekammedik').html(html);
                    }
                },
                error: function() {
                    $('#hasil_rekammedik').html('<div class="alert alert-danger">Terjadi kesalahan server!</div>');
                }
            });
        });
    });
</script>