<?php
if (!isLoggedIn()) redirect('../index.php?menu=home');
$total_produk = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM produk"))['total'];
$total_staf = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM staff WHERE role != 'Pelanggan'"))['total'];
$query_chart = "SELECT MONTH(tanggal) as bulan, SUM(total_harga) as total FROM transaksi_masuk WHERE YEAR(tanggal)=YEAR(CURDATE()) GROUP BY bulan";
$res_chart = mysqli_query($conn, $query_chart);
$data_bulan = array_fill(1,12,0);
while($row = mysqli_fetch_assoc($res_chart)) $data_bulan[$row['bulan']] = $row['total'];
?>
<div class="row">
    <div class="col-md-4 mb-3"><div class="card text-center p-3"><h3><?= $total_produk ?></h3><p>Total Produk</p></div></div>
    <div class="col-md-4 mb-3"><div class="card text-center p-3"><h3><?= $total_staf ?></h3><p>Staf Aktif</p></div></div>
    <div class="col-md-4 mb-3"><div class="card text-center p-3"><h3>Raja Ahmad</h3><p>UMKM Berkah</p></div></div>
</div>
<div class="card p-3">
    <h5>Grafik Pembelian Barang Masuk per Bulan (Tahun <?= date('Y') ?>)</h5>
    <canvas id="grafikBulanan" height="100"></canvas>
</div>
<script>
new Chart(document.getElementById('grafikBulanan'), {
    type: 'bar',
    data: {
        labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
        datasets: [{ label: 'Total Pembelian (Rp)', data: <?= json_encode(array_values($data_bulan)) ?>, backgroundColor: '#b87c2e' }]
    }
});
</script>