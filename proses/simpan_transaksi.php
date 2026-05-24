<?php session_start();
require_once '../config/database.php';
if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) redirect('../index.php?menu=transaksi');

$total_harga = (int)$_POST['total_harga'];
$total_item = (int)$_POST['total_item'];
$created_by = $_SESSION['user_id'];
$tanggal = date('Y-m-d');

mysqli_begin_transaction($conn);
try {
    $query = "INSERT INTO transaksi_masuk (tanggal, total_item, total_harga, created_by) VALUES ('$tanggal', $total_item, $total_harga, $created_by)";
    mysqli_query($conn, $query);
    $transaksi_id = mysqli_insert_id($conn);

    foreach ($_SESSION['cart'] as $item) {
        $produk_id = $item['id'];
        $jumlah = $item['jumlah'];
        $harga_satuan = $item['harga'];
        mysqli_query($conn, "INSERT INTO detail_transaksi_masuk (transaksi_id, produk_id, jumlah, harga_satuan) VALUES ($transaksi_id, $produk_id, $jumlah, $harga_satuan)");
        // Update stok produk (stok bertambah karena barang masuk)
        mysqli_query($conn, "UPDATE produk SET stok = stok + $jumlah WHERE id=$produk_id");
    }
    mysqli_commit($conn);
    unset($_SESSION['cart']);
    $_SESSION['success'] = "Transaksi berhasil, stok diperbarui.";
} catch (Exception $e) {
    mysqli_rollback($conn);
    $_SESSION['error'] = "Gagal menyimpan transaksi.";
}
header("Location: ../index.php?menu=transaksi");