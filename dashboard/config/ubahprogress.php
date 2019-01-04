<?php
session_start();
include 'database.php';

if (isset($_POST['ubahprogress'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $progress = mysqli_real_escape_string($koneksi, $_POST['progress']);
    $catatan = mysqli_real_escape_string($koneksi, $_POST['catatan']);

    $sql = "update progress SET progress='$progress' , catatan ='$catatan' where id='$id'";
    $query = mysqli_query($koneksi, $sql);

    if (empty($query)) {
        $_SESSION['tambahprogressgagal'] = "Gagal merubah progress";
        header('location: ../pages/progress.php');
    }

    if (!empty($query)) {
        $_SESSION['tambahprogresssukses'] = "Sukses merubah progress";
        header('location: ../pages/progress.php');
    }
} else {
    header('location: ../pages/progress.php');
}