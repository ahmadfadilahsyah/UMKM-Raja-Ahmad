<?php if (!hasRole(['Admin','Pemilik','Staf'])) redirect('index.php'); ?>
<div class="card">
    <div class="card-header bg-white fw-bold">Daftar Produk Raja Ahmad
        <button class="btn btn-sm btn-primary float-end" data-bs-toggle="modal" data-bs-target="#modalProduk">+ Tambah Produk</button>
    </div>
    <div class="card-body">
        <table id="tblProduk" class="table table-bordered table-hover">
            <thead><tr><th>ID</th><th>Gambar</th><th>Nama</th><th>Harga</th><th>Stok</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php $res = mysqli_query($conn, "SELECT * FROM produk ORDER BY id DESC");
                while($p = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td><img src="assets/uploads/<?= $p['gambar'] ?>" width="50" height="50" style="object-fit:cover" onerror="this.src='https://placehold.co/50x50?text=No+Image'"></td>
                    <td><?= htmlspecialchars($p['nama_produk']) ?></td>
                    <td>Rp <?= number_format($p['harga'],0,',','.') ?></td>
                    <td><?= $p['stok'] ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editProduk(<?= $p['id'] ?>, '<?= addslashes($p['nama_produk']) ?>', <?= $p['harga'] ?>, <?= $p['stok'] ?>)">Edit</button>
                        <a href="proses/hapus_produk.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Produk -->
<div class="modal fade" id="modalProduk" tabindex="-1">
    <div class="modal-dialog">
        <form action="proses/tambah_produk.php" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header"><h5>Form Produk</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="produk_id">
                    <div class="mb-2"><label>Nama Produk</label><input type="text" name="nama" id="nama" class="form-control" required></div>
                    <div class="mb-2"><label>Harga</label><input type="number" name="harga" id="harga" class="form-control" required></div>
                    <div class="mb-2"><label>Stok</label><input type="number" name="stok" id="stok" class="form-control" required></div>
                    <div class="mb-2"><label>Gambar</label><input type="file" name="gambar" class="form-control"></div>
                </div>
                <div class="modal-footer"><button type="submit" class="btn btn-primary">Simpan</button></div>
            </div>
        </form>
    </div>
</div>
<script>
function editProduk(id, nama, harga, stok) {
    $('#produk_id').val(id); $('#nama').val(nama); $('#harga').val(harga); $('#stok').val(stok);
    $('#modalProduk').modal('show');
}
$(document).ready(function() { $('#tblProduk').DataTable(); });
</script>