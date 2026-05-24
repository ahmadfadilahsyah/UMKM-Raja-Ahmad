<?php
session_start();
require_once '../config/database.php';

// Hanya Admin atau Pemilik yang boleh mengakses
if (!hasRole(['Admin', 'Pemilik'])) {
    redirect('../index.php?menu=home');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = $_POST['password'];

    // Validasi: username tidak boleh kosong dan password minimal 4 karakter
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username dan password wajib diisi.";
        header("Location: ../index.php?menu=staf");
        exit;
    }

    // Cek apakah username sudah ada
    $cek = mysqli_query($conn, "SELECT id FROM staff WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['error'] = "Username '$username' sudah terdaftar. Gunakan username lain.";
        header("Location: ../index.php?menu=staf");
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $query = "INSERT INTO staff (username, password, role, nama_lengkap) 
              VALUES ('$username', '$hashed_password', '$role', '$nama_lengkap')";

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Staf baru berhasil ditambahkan.";
    } else {
        $_SESSION['error'] = "Gagal menambahkan staf: " . mysqli_error($conn);
    }

    header("Location: ../index.php?menu=staf");
    exit;
} else {
    // Jika bukan POST, redirect ke halaman staf
    redirect("../index.php?menu=staf");
}
?>