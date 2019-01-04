<?php
session_start();
include 'database.php';

if (isset($_GET['idpesanan'])) {

    $idpesanan = mysqli_real_escape_string($koneksi, $_GET['idpesanan']);

    $sql = "insert into progress (id_pesanan, progress, catatan) values ('$idpesanan','0','Tambahkan catatan di sini')";
    $query = mysqli_query($koneksi, $sql);

    if (empty($query)) {
        $_SESSION['tambahprogressgagal'] = "Gagal menambahkan progress";
        header('location: ../pages/progress.php');
    }

    if (!empty($query)) {
        $_SESSION['tambahprogresssukses'] = "Sukses menambahkan progress";
        header('location: ../pages/progress.php');
    }

} else {
    header('location: ../pages/progress.php');
}