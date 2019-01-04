<?php 
session_start();
include 'database.php';

if (isset($_GET['id'])) {

    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    $sql = mysqli_query($koneksi, "delete from weblayanan where id='$id'");

    if (empty($sql)) {
        $_SESSION['updategagal'] = "Gagal menghapus data layanan";
        header('location: ../pages/websetting.php');
    }

    if (!empty($sql)) {
        $_SESSION['updatesukses'] = "Sukses menghapus data layanan";
        header('location: ../pages/websetting.php');
    }
} else {
    header('location: ../pages/websetting.php');
}