<?php 
session_start();
include 'database.php';

if (isset($_POST['tambahlayanan'])) {

    $namalayanan = mysqli_real_escape_string($koneksi, $_POST['namalayanan']);
    $deskripsilayanan = mysqli_real_escape_string($koneksi, $_POST['deslayanan']);
    $namagambar = $_FILES['gambar']['name'];
    $ukurangambar = $_FILES['gambar']['size'];
    $tmpgambar = $_FILES['gambar']['tmp_name'];
    $error = $_FILES['gambar']['error'];

    if ($error === 4) {
        $_SESSION['updategagal'] = "Pilih gambar terlebih dahulu";
        header('location: ../pages/websetting.php');

    }

    $ektensigambarvalid = ['jpg', 'jpeg', 'png'];
    $ektensigambararray = explode('.', $namagambar);
    $ektensigambar = strtolower(end($ektensigambararray));

    if (!in_array($ektensigambar, $ektensigambarvalid)) {
        $_SESSION['updategagal'] = "Gambar harus berformat jpg, jpeg, atau png";
        header('location: ../pages/websetting.php');

    }

    $namagambarbaru = $ektensigambararray[0] . "." . uniqid() . "." . $ektensigambar;
    move_uploaded_file($tmpgambar, '../../img/layanan/' . $namagambarbaru);

    $sql = mysqli_query($koneksi, "insert into weblayanan (namalayanan, deskripsilayanan, gambar) values ('$namalayanan', '$deskripsilayanan', '$namagambarbaru')") or die(mysqli_error($koneksi));

    if (empty($sql)) {
        $_SESSION['updategagal'] = "Gagal menambah layanan";
        header('location: ../pages/websetting.php');
    }
    if (!empty($sql)) {
        $_SESSION['updatesukses'] = "Sukses menambah layanan";
        header('location: ../pages/websetting.php');
    }




} else {
    header('location: ../pages/websetting.php');
}