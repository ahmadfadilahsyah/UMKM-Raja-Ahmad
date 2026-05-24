<?php if (!hasRole(['Admin','Pemilik','Staf'])) redirect('../index.php');
$filter = $_GET['bulan'] ?? date('m');
$tahun = $_GET['tahun'] ?? date('Y');
$res = mysqli_query($conn, "SELECT tm.*, s.username FROM transaksi_masuk tm LEFT JOIN staff s ON tm.created_by=s.id WHERE MONTH(tm.tanggal)=$filter AND YEAR(tm.tanggal)=$tahun");
?>
<div class="card">
    <div class="card-header">Laporan Transaksi Masuk</div>
    <div class="card-body">
        <form class="row g-2 mb-3">
            <div class="col-auto"><select name="bulan" class="form-select"><?php for($m=1;$m<=12;$m++) echo "<option value='$m'".($m==$filter?' selected':'').">".date('F', mktime(0,0,0,$m,1))."</option>"; ?></select></div>
            <div class="col-auto"><input type="number" name="tahun" value="<?= $tahun ?>" class="form-control"></div>
            <div class="col-auto"><button class="btn btn-primary">Filter</button></div>
        </form>
        <table class="table" id="laporanTable">
            <thead><tr><th>Tanggal</th><th>Total Item</th><th>Total Harga</th><th>Petugas</th></tr></thead>
            <tbody><?php while($row=mysqli_fetch_assoc($res)): ?>
                <tr><td><?= $row['tanggal'] ?></td><td><?= $row['total_item'] ?></td><td>Rp <?= number_format($row['total_harga']) ?></td><td><?= $row['username'] ?></td></tr>
            <?php endwhile; ?></tbody>
        </table>
    </div>
</div>
<script>$(document).ready(()=>$('#laporanTable').DataTable());</script>