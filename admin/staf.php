<?php if (!hasRole(['Admin','Pemilik'])) redirect('../index.php'); ?>
<div class="card">
    <div class="card-header">Kelola Akun Staf
        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalStaf">+ Tambah Staf</button>
    </div>
    <div class="card-body">
        <table id="tblStaf" class="table">
            <thead><tr><th>ID</th><th>Username</th><th>Nama Lengkap</th><th>Role</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php $res = mysqli_query($conn, "SELECT * FROM staff WHERE role != 'Pelanggan'");
                while($s = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $s['id'] ?></td>
                    <td><?= $s['username'] ?></td>
                    <td><?= $s['nama_lengkap'] ?></td>
                    <td><?= $s['role'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editStaf(<?= $s['id'] ?>, '<?= $s['username'] ?>', '<?= $s['nama_lengkap'] ?>', '<?= $s['role'] ?>')">Edit</button>
                        <a href="proses/hapus_staf.php?id=<?= $s['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Modal Staf (tambah/edit) -->
<div class="modal fade" id="modalStaf" tabindex="-1">
    <div class="modal-dialog">
        <form id="formStaf" action="proses/tambah_staf.php" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Form Staf</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <!-- INPUT HIDDEN UNTUK ID (dipakai saat edit) -->
                    <input type="hidden" name="id" id="staf_id">

                    <div class="mb-2">
                        <label>Username</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Role</label>
                        <select name="role" id="role" class="form-control">
                            <option>Admin</option>
                            <option>Pemilik</option>
                            <option>Staf</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label>Password (kosongkan jika tidak diubah saat edit)</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
function editStaf(id, username, nama, role) {
    $('#staf_id').val(id);               // isi input hidden
    $('#username').val(username);
    $('#nama_lengkap').val(nama);
    $('#role').val(role);
    $('#formStaf').attr('action', 'proses/edit_staf.php');  // ubah action ke edit
    $('#modalStaf').modal('show');
}

// Reset form saat modal ditutup (kembali ke mode tambah)
$('#modalStaf').on('hidden.bs.modal', function () {
    $('#formStaf').attr('action', 'proses/tambah_staf.php');
    $('#staf_id').val('');
    $('#username').val('');
    $('#nama_lengkap').val('');
    $('#role').val('Staf');
    $('#password').val('');
});

$(document).ready(function() {
    $('#tblStaf').DataTable();
});
</script>