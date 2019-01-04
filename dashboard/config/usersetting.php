<?php
session_start();
include 'database.php';

if (isset($_POST['editadmin'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password']);
    $passbaru = mysqli_real_escape_string($koneksi, $_POST['passbaru']);
    $pass = md5($password);

    $cekpass = "select * from admin where password='$pass'";
    $query1 = mysqli_query($koneksi, $cekpass);
    $cekrow = mysqli_num_rows($query1);

    if ($cekrow == 0) {
        $_SESSION['passwordsalah'] = "Password yang anda masukkan salah";
        header('location: ../pages/usersetting.php');
    }

    if ($cekrow != 0) {

        if (empty($passbaru)) {
            $sql = "update admin set nama='$nama' , username='$username' , email='$email' where id=1";
            $query = mysqli_query($koneksi, $sql);

            if (empty(query)) {
                $_SESSION['updategagal'] = "Gagal update data";
                header('location: ../pages/usersetting.php');
            }
            if (!empty(query)) {
                $_SESSION['updatesukses'] = "Sukses update data";
                header('location: ../pages/usersetting.php');
            }
        }

        if (!empty($passbaru)) {
            $passs = md5($passbaru);
            $sql = "update admin set nama='$nama' , username='$username' , email='$email' , password='$passs' where id=1";
            $query = mysqli_query($koneksi, $sql);

            if (empty(query)) {
                $_SESSION['updategagal'] = "Gagal update data";
                header('location: ../pages/usersetting.php');
            }
            if (!empty(query)) {
                $_SESSION['updatesukses'] = "Sukses update data";
                header('location: ../pages/usersetting.php');
            }
        }

    }

} else {
    header('location: ../pages/usersetting.php');
}