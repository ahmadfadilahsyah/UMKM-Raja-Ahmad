<?php
require_once 'config/database.php';

$password_plain = 'raja123';
$hash = password_hash($password_plain, PASSWORD_DEFAULT);

// Update semua akun
mysqli_query($conn, "UPDATE staff SET password = '$hash' WHERE username IN ('admin', 'pemilik', 'staf')");

echo "Password untuk admin, pemilik, staf telah diubah menjadi hash dari 'raja123'. <br>";
echo "Hash yang digunakan: " . $hash . "<br>";
echo "Silakan <a href='index.php'>kembali ke website</a> dan login.";
?>