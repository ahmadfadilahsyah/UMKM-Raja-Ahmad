<?php
session_start();
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raja Ahmad - UMKM Berkualitas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <style>
        body { background: #fef9e6; font-family: 'Segoe UI', system-ui; }
        .navbar-brand { font-weight: bold; letter-spacing: 1px; }
        .card { border-radius: 1.2rem; border: none; box-shadow: 0 8px 20px rgba(0,0,0,0.05); }
        .btn-primary { background-color: #b87c2e; border-color: #a06e28; }
        .btn-primary:hover { background-color: #9a5e1f; }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-4 mb-5">
    <?php
    $menu = $_GET['menu'] ?? 'home';
    $allowed = ['home', 'dashboard', 'produk', 'staf', 'transaksi_masuk', 'laporan'];
    if (in_array($menu, $allowed)) {
        if ($menu == 'home') {
            include 'public/index.php';
        } else {
            include "admin/$menu.php";
        }
    } else {
        echo "<div class='alert alert-warning'>Halaman tidak ditemukan.</div>";
    }
    ?>
</div>
<?php include 'footer.php'; ?>
</body>
</html>