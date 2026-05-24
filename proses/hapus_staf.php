<?php
session_start();
require_once '../config/database.php';

if (!hasRole(['Admin', 'Pemilik'])) {
    redirect('../index.php?menu=home');
}

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    // Cegah menghapus diri sendiri jika sedang login
    if ($id == $_SESSION['user_id']) {
        $_SESSION['error'] = "Anda tidak dapat menghapus akun sendiri.";
    } else {
        $query = "DELETE FROM staff WHERE id = $id";
        if (mysqli_query($conn, $query)) {
            $_SESSION['success'] = "Staf berhasil dihapus.";
        } else {
            $_SESSION['error'] = "Gagal menghapus staf.";
        }
    }
}
header("Location: ../index.php?menu=staf");
exit;
?>