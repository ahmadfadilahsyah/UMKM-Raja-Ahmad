<?php session_start(); require_once '../config/database.php';
$id = (int)$_GET['id'];
mysqli_query($conn, "DELETE FROM produk WHERE id=$id");
header("Location: ../index.php?menu=produk");