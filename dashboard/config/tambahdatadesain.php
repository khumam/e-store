<?php
session_start();
include 'database.php';
date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['tambahdesain'])) {
    $pesanan = mysqli_real_escape_string($koneksi, $_POST['pesanan']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $jenis = mysqli_real_escape_string($koneksi, $_POST['jenis']);
    $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);
    $tgl = date('Y-m-d');
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
    $idpesanan = "ds" . rand(1, 10000);
    $id_pesanan = "$idpesanan";

    $cekidpesanan = mysqli_query($koneksi, "select * from desain where id_pesanan='$id_pesanan'");
    $cekrow = mysqli_num_rows($cekidpesanan);

    if ($cekrow != 0) {
        $idpesanan = "ds" . rand(1, 10000);
        $id_pesanan = "$idpesanan";
        $sql = "INSERT INTO `desain` (`id`, `nama_pesanan`, `deskripsi`, `harga`, `jenis`, `nama`, `tgl`, `id_pesanan`) VALUES (NULL, ' $pesanan ',' $deskripsi ',' $harga ',' $jenis ',' $nama ',' $tgl ', '$id_pesanan')";
        $query = mysqli_query($koneksi, $sql);

        if (empty($query)) {
            $_SESSION['desaingagaltambah'] = "Gagal menambahkan data baru";
            header('location: ../pages/desain.php');
        }

        if (!empty($query)) {
            $_SESSION['desainsuksestambah'] = "Sukses menambahkan data baru";
            header('location: ../pages/desain.php');
        }
    }
    if ($cekrow == 0) {

        $sql = "INSERT INTO `desain` (`id`, `nama_pesanan`, `deskripsi`, `harga`, `jenis`, `nama`, `tgl`, `id_pesanan`) VALUES (NULL, ' $pesanan ',' $deskripsi ',' $harga ',' $jenis ',' $nama ',' $tgl ', '$id_pesanan')";
        $query = mysqli_query($koneksi, $sql);

        if (empty($query)) {
            $_SESSION['desaingagaltambah'] = "Gagal menambahkan data baru";
            header('location: ../pages/desain.php');
        }

        if (!empty($query)) {
            $_SESSION['desainsuksestambah'] = "Sukses menambahkan data baru";
            header('location: ../pages/desain.php');
        }
    }
} else {
    header('../pages/desain.php');
}