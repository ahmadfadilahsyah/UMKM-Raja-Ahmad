<?php
session_start();
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];
    $captcha_input = $_POST['captcha_input'] ?? '';

    // Cek CAPTCHA
    if (!isset($_SESSION['captcha']) || $captcha_input != $_SESSION['captcha']) {
        $_SESSION['error'] = "Kode CAPTCHA salah!";
        header("Location: ../index.php?menu=home");
        exit;
    }

    $query = "SELECT * FROM staff WHERE username = '$username'";
    $result = mysqli_query($conn, $query);
    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
            header("Location: ../index.php?menu=dashboard");
            exit;
        } else {
            $_SESSION['error'] = "Password salah!";
        }
    } else {
        $_SESSION['error'] = "Username tidak ditemukan!";
    }
    header("Location: ../index.php?menu=home");
    exit;
}
?>