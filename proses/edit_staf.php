<?php
session_start();
require_once '../config/database.php';

// Hanya Admin atau Pemilik yang boleh mengakses
if (!hasRole(['Admin', 'Pemilik'])) {
    redirect('../index.php?menu=home');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = (int)$_POST['id'];
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = $_POST['password']; // bisa kosong

    // Validasi: username tidak boleh kosong
    if (empty($username)) {
        $_SESSION['error'] = "Username tidak boleh kosong.";
        header("Location: ../index.php?menu=staf");
        exit;
    }

    // Cek apakah username sudah digunakan oleh staff lain (selain dirinya sendiri)
    $cek = mysqli_query($conn, "SELECT id FROM staff WHERE username = '$username' AND id != $id");
    if (mysqli_num_rows($cek) > 0) {
        $_SESSION['error'] = "Username '$username' sudah digunakan oleh staf lain.";
        header("Location: ../index.php?menu=staf");
        exit;
    }

    // Jika password diisi, hash dan update password
    if (!empty($password)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $query = "UPDATE staff SET 
                    username = '$username',
                    password = '$hashed_password',
                    role = '$role',
                    nama_lengkap = '$nama_lengkap'
                  WHERE id = $id";
    } else {
        // Password tidak diubah
        $query = "UPDATE staff SET 
                    username = '$username',
                    role = '$role',
                    nama_lengkap = '$nama_lengkap'
                  WHERE id = $id";
    }

    if (mysqli_query($conn, $query)) {
        $_SESSION['success'] = "Data staf berhasil diperbarui.";
    } else {
        $_SESSION['error'] = "Gagal mengupdate staf: " . mysqli_error($conn);
    }

    header("Location: ../index.php?menu=staf");
    exit;
} else {
    redirect("../index.php?menu=staf");
}
?>