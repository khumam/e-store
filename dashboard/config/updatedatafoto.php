<?php
session_start();
include 'database.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['updatefoto'])) {
    $idfoto = mysqli_real_escape_string($koneksi, $_POST['id']);
    $pesanan = mysqli_real_escape_string($koneksi, $_POST['pesanan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $tgl = mysqli_real_escape_string($koneksi, $_POST['date']);

    $sql = "UPDATE foto SET nama_pesanan='$pesanan' , deskripsi='$deskripsi' , harga='$harga' , jenis='$jenis' , nama='$nama' , tgl='$tgl' WHERE id='$idfoto'";
    $query = mysqli_query($koneksi, $sql);

    if (empty($query)) {
        $_SESSION['statusupdatedatagagal'] = "Gagal mengupdate data";
        header('location: ../pages/foto.php');
    }
    if (!empty($query)) {
        $_SESSION['statusupdatedatasukses'] = "Sukses mengupdate data";
        header('location: ../pages/foto.php');
    }

} else {
    header('location: ../pages/foto.php');
}