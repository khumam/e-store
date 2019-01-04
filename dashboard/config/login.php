<?php
session_start();
include 'database.php';

if (isset($_POST['loginadmin'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = md5(mysqli_real_escape_string($koneksi, $_POST['password']));
    $validasi = "select * from admin where username='$username' and password='$password'";
    $eksekusi = mysqli_query($koneksi, $validasi);
    $found = mysqli_num_rows($eksekusi);
    $data = mysqli_fetch_assoc($eksekusi);
    $nama = $data['nama'];

    if ($found == 0) {
        header('location: ../pages/login.php?status=gagal');
    } elseif ($found != 0) {
        $_SESSION['admin'] = 'true';
        $_SESSION['username'] = "$username";
        $_SESSION['nama'] = "$nama";

        header('location: ../pages/index.php');
    }
}