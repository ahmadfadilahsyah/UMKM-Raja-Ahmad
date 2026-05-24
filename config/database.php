<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'umkm_raja_ahmad';

$conn = mysqli_connect($host, $user, $pass, $dbname);
if (!$conn) die("Koneksi gagal: " . mysqli_connect_error());

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function hasRole($allowedRoles) {
    if (!isLoggedIn()) return false;
    return in_array($_SESSION['role'], (array)$allowedRoles);
}

function redirect($url) {
    header("Location: $url");
    exit;
}
?>