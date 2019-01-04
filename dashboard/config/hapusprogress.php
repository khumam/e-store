<?php
session_start();
include 'database.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $idpesanan = mysqli_real_escape_string($koneksi, $_GET['idpesanan']);

    $sql = "delete from progress where id='$id' and id_pesanan='$id_pesanan'";
    $query = mysqli_query($koneksi, $sql);

    if (empty($query)) {
        $_SESSION['tambahprogressgagal'] = "Gagal menghapus progress";
        header('location: ../pages/progress.php');
    }

    if (!empty($query)) {
        $_SESSION['tambahprogresssukses'] = "Sukses menghapus progress";
        header('location: ../pages/progress.php');
    }
} else {
    header('location: ../pages/progress.php');
}