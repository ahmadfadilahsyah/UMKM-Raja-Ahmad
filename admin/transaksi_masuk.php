<?php if (!hasRole(['Admin','Pemilik','Staf'])) redirect('../index.php');
// Inisialisasi keranjang
if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
?>
<div class="card mb-3">
    <div class="card-header bg-white"><b>🛒 Keranjang Belanja (Barang Masuk)</b></div>
    <div class="card-body">
        <form method="POST" action="proses/keranjang_ajax.php">
            <div class="row g-2">
                <div class="col-md-4"><select name="produk_id" class="form-select" required>
                    <option value="">Pilih Produk</option>
                    <?php $res = mysqli_query($conn, "SELECT id, nama_produk, harga FROM produk"); while($pr=mysqli_fetch_assoc($res)): ?>
                    <option value="<?= $pr['id'] ?>" data-harga="<?= $pr['harga'] ?>"><?= $pr['nama_produk'] ?> - Rp <?= number_format($pr['harga']) ?></option>
                    <?php endwhile; ?>
                </select></div>
                <div class="col-md-2"><input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required></div>
                <div class="col-md-2"><button type="submit" name="action" value="add" class="btn btn-primary">Tambah ke Keranjang</button></div>
            </div>
        </form>
        <hr>
        <table class="table table-sm">
            <thead><tr><th>Produk</th><th>Harga</th><th>Jumlah</th><th>Subtotal</th><th>Aksi</th></tr></thead>
            <tbody>
                <?php $total_akhir = 0; $total_item = 0;
                foreach($_SESSION['cart'] as $key => $item): 
                    $sub = $item['harga'] * $item['jumlah'];
                    $total_akhir += $sub; $total_item += $item['jumlah']; ?>
                <tr>
                    <td><?= $item['nama'] ?></td>
                    <td>Rp <?= number_format($item['harga']) ?></td>
                    <td><?= $item['jumlah'] ?></td>
                    <td>Rp <?= number_format($sub) ?></td>
                    <td><a href="proses/keranjang_ajax.php?action=remove&key=<?= $key ?>" class="btn btn-sm btn-danger">Hapus</a></td>
                </tr>
                <?php endforeach; ?>
                <?php if(empty($_SESSION['cart'])): ?><tr><td colspan="5" class="text-center">Keranjang kosong</td></tr><?php endif; ?>
            </tbody>
            <tfoot><tr><th colspan="3">Total</th><th>Rp <?= number_format($total_akhir) ?></th><th><?= $total_item ?> item</th></tr></tfoot>
        </table>
        <form action="proses/simpan_transaksi.php" method="POST">
            <input type="hidden" name="total_harga" value="<?= $total_akhir ?>">
            <input type="hidden" name="total_item" value="<?= $total_item ?>">
            <button type="submit" class="btn btn-success" <?= empty($_SESSION['cart'])?'disabled':'' ?>>Simpan Transaksi & Update Stok</button>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header">Riwayat Transaksi Masuk</div>
    <div class="card-body">
        <table id="riwayatTable" class="table">
            <thead><tr><th>ID</th><th>Tanggal</th><th>Total Item</th><th>Total Harga</th><th>Diinput oleh</th></tr></thead>
            <tbody>
                <?php $query = "SELECT tm.*, s.username FROM transaksi_masuk tm LEFT JOIN staff s ON tm.created_by=s.id ORDER BY tm.tanggal DESC";
                $res = mysqli_query($conn, $query);
                while($row = mysqli_fetch_assoc($res)): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['tanggal'] ?></td>
                    <td><?= $row['total_item'] ?></td>
                    <td>Rp <?= number_format($row['total_harga']) ?></td>
                    <td><?= $row['username'] ?? '-' ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
<script>$(document).ready(()=>$('#riwayatTable').DataTable());</script>