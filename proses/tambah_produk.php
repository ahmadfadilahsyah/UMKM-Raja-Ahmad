<?php session_start(); require_once '../config/database.php';
$id = $_POST['id'] ?? 0;
$nama = mysqli_real_escape_string($conn, $_POST['nama']);
$harga = (int)$_POST['harga'];
$stok = (int)$_POST['stok'];
$gambar = '';
if ($_FILES['gambar']['error'] == 0) {
    $target = "../assets/uploads/";
    if (!is_dir($target)) mkdir($target, 0777, true);
    $ext = pathinfo($_FILES['gambar']['name'], PATHINFO_EXTENSION);
    $gambar = time() . '_' . uniqid() . '.' . $ext;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $target . $gambar);
}
if ($id > 0) {
    if ($gambar) $query = "UPDATE produk SET nama_produk='$nama', harga=$harga, stok=$stok, gambar='$gambar' WHERE id=$id";
    else $query = "UPDATE produk SET nama_produk='$nama', harga=$harga, stok=$stok WHERE id=$id";
} else {
    $query = "INSERT INTO produk (nama_produk, harga, stok, gambar) VALUES ('$nama', $harga, $stok, '$gambar')";
}
mysqli_query($conn, $query);
header("Location: ../index.php?menu=produk");