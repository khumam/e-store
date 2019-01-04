<?php
session_start();
include 'database.php';

if (isset($_POST['editweb'])) {

    $nama = mysqli_real_escape_string($koneksi, $_POST['namaweb']);
    $slogan = mysqli_real_escape_string($koneksi, $_POST['slogan']);
    $tentang = mysqli_real_escape_string($koneksi, $_POST['tentang']);
    $wa = mysqli_real_escape_string($koneksi, $_POST['wa']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $ig = mysqli_real_escape_string($koneksi, $_POST['ig']);

    $query = mysqli_query($koneksi, "update web set nama='$nama', slogan='$slogan', tentang='$tentang', wa='$wa', email='$email', ig='$ig' where id='1'");

    if (empty($query)) {
        $_SESSION['updategagal'] = "Gagal update data";
        header('location: ../pages/websetting.php');
    }
    if (!empty($query)) {
        $_SESSION['updatesukses'] = "Sukses update data";
        header('location: ../pages/websetting.php');
    }
} else {
    header('location: ../pages/websetting.php');
}