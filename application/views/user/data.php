<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row d-flex justify-content-center">
            <div class="col-lg-12 mb-4">
                <div class="card shadow-sm border-0">
                    <div
                        class="card-header d-flex flex-column flex-md-row justify-content-md-between align-items-center text-center text-md-start bg-white border-bottom-0 pb-0">
                        <h5 class="mb-2 mb-md-0 text-primary text-uppercase fw-bold">
                            <i class="bx bx-group"></i> Data User
                        </h5>

                        <?php if (is_admin()) : ?>
                            <a href="<?= base_url('user/add') ?>" class="btn btn-sm btn-primary d-flex align-items-center gap-1">
                                <i class='bx bx-user-plus'></i>
                                <span>Tambah</span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="card-body pt-3">
                        <?= $this->session->flashdata('pesan'); ?>

                        <div class="table-responsive">
                            <table class="table table-hover align-middle nowrap" id="dataTable_user" style="width:100%;">
                                <thead class="table-light">
                                    <tr class="text-center text-uppercase small text-secondary">
                                        <th width="30">No.</th>
                                        <?php if (is_admin()) : ?>
                                            <th>Status</th>
                                        <?php endif; ?>
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>No. Telp</th>
                                        <th>Role</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php $no = 1;
                                    if ($users) :
                                        foreach ($users as $u) : ?>
                                            <tr>
                                                <td class="text-center"><?= $no++; ?></td>



                                                <!-- Status -->
                                                <?php if (is_admin()) : ?>
                                                    <td class="text-center">
                                                        <a href="<?= base_url('user/toggle/') . $u['id_user'] ?>"
                                                            class="btn btn-sm rounded-circle <?= $u['is_active'] ? 'btn-success' : 'btn-secondary' ?>"
                                                            title="<?= $u['is_active'] ? 'Nonaktifkan User' : 'Aktifkan User' ?>">
                                                            <i class="bx bx-power-off"></i>
                                                        </a>
                                                    </td>
                                                <?php endif; ?>

                                                <!-- Foto -->
                                                <td class="text-center">
                                                    <img width="36" height="36"
                                                        src="<?= base_url() ?>assets/img/avatars/<?= $u['foto'] ?>"
                                                        alt="<?= $u['nama']; ?>"
                                                        class="img-thumbnail rounded-circle border-0 shadow-sm">
                                                </td>

                                                <td class="fw-semibold"><?= htmlspecialchars($u['nama']); ?></td>
                                                <td><?= htmlspecialchars($u['username']); ?></td>
                                                <td><?= htmlspecialchars($u['password2']); ?></td>
                                                <td><?= htmlspecialchars($u['no_telp']); ?></td>
                                                <td class="text-uppercase fw-semibold"><?= htmlspecialchars($u['role']); ?></td>
                                                <!-- Aksi -->
                                                <td class="text-center">
                                                    <a href="<?= base_url('user/edit/') . $u['id_user'] ?>"
                                                        class="btn btn-sm btn-warning" title="Edit User">
                                                        <i class="bx bx-edit"></i>
                                                    </a>

                                                    <?php if (is_admin()) : ?>
                                                        <a onclick="return confirm('Yakin ingin menghapus data?')"
                                                            href="<?= base_url('user/delete/') . $u['id_user'] ?>"
                                                            class="btn btn-sm btn-danger" title="Hapus User">
                                                            <i class="bx bx-trash"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    else : ?>
                                        <tr>
                                            <td colspan="15" class="text-center text-muted py-4">Silakan tambahkan user baru!</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>