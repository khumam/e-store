<?php
session_start();
include 'database.php';

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    $sql = "DELETE FROM desain where id='$id'";
    $query = mysqli_query($koneksi, $sql);

    if (empty($query)) {
        $_SESSION['statushapusdatagagal'] = "Gagal menghapus data";
        header('location: ../pages/desain.php');
    }
    if (!empty($query)) {
        $_SESSION['statushapusdatasukses'] = "Sukses menghapus data";
        header('location: ../pages/desain.php');
    }
} else {
    header('location: ../pages/desain.php');
}