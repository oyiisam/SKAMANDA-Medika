<div class="card shadow p-4">
    <h4><?= $judul; ?></h4>
    <hr>
    <?= form_open('rekammedik_detail'); ?>
    <div class="mb-3">
        <label for="nomor_rm" class="form-label">Nomor Rekam Medik</label>
        <input type="text" class="form-control" id="nomor_rm" name="nomor_rm" placeholder="Masukkan Nomor RM (contoh: RM-080925/0001)" required>
        <?= form_error('nomor_rm', '<small class="text-danger">', '</small>'); ?>
    </div>
    <button type="submit" class="btn btn-primary">Lihat Detail</button>
    <?= form_close(); ?>
</div>