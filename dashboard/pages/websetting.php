<?php
session_start();
include '../config/database.php';
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
} else {

    $query = mysqli_query($koneksi, "select * from web");
    $data = mysqli_fetch_assoc($query);

    $layanansql = mysqli_query($koneksi, "select * from weblayanan order by id desc");


    ?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - Garis Media</title>

    <!-- Bootstrap Core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/dashboard.css">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0; background: #2e2e2e">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand fontbesar" href="index.php" style="color: white">Dashboard</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">

            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Statistik<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="foto.php">Fotografi</a>
                                </li>
                                <li>
                                    <a href="desain.php">Desain</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="progress.php"><i class="fa fa-clock-o fa-fw"></i> Progress Pemesanan</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> Setting<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="usersetting.php"> User</a>
                                </li>
                                <li>
                                    <a href="websetting.php"> Web</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="../config/logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper" class="bg-indah">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Pengaturan Web</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <!-- ALert -->
                <?php if (isset($_SESSION['updategagal'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['updategagal'] . "</div>";
                }
                unset($_SESSION['updategagal']); ?>

                <?php if (isset($_SESSION['updatesukses'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['updatesukses'] . "</div>";
                }
                unset($_SESSION['updatesukses']); ?>
                
                <!--User setting -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading"><h3>Pengaturan Umum</h3></div>
                            <div class="panel-body">
                        <form action="../config/websetting.php" method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <label>Nama Web</label>
                                    <input type='text' name="namaweb" class="form-control" value="<?php echo $data['nama']; ?>" required>
                                </div>
                                <div class="col-lg-6">
                                    <label>Slogan Web</label>
                                    <input type='text' name="slogan" class="form-control" value="<?php echo $data['slogan']; ?>" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12" style="padding-top: 2rem;">
                                    <label>Tentang Web</label>
                                    <textarea name="tentang" class="form-control form-control-lg" required><?php echo $data['tentang']; ?></textarea>
                                </div>
                            </div><br>
                            <label>Contact</label><br>
                            <div class="row">
                                <div class="col-lg-4">
                                    <label>Whatsapp</label>
                                    <input type="text" class="form-control" name="wa" placeholder="Whatsapp" value="<?php echo $data['wa']; ?>" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" placeholder="Email" value="<?php echo $data['email']; ?>" required>
                                </div>
                                <div class="col-lg-4">
                                    <label>Instagram</label>
                                    <input type="text" class="form-control" name="ig" placeholder="Instagram" value="<?php echo $data['ig']; ?>" required>
                                </div>
                            </div>
                            <br>
                            <button type="submit" name="editweb" class="btn btn-lg btn-success">Simpan</button>
                        </form>
                    </div></div></div>
                </div>

                <!-- Layanan Setting -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Tambah Layanan</h3>
                            </div>
                                <div class="panel-body">
                                    <form action="../config/layanansetting.php" method="post" enctype="multipart/form-data">
                                    <label>Nama layanan</label>
                                    <input type="text" name="namalayanan" class="form-control" required><br>
                                    <label>Deskripsi layanan</label>
                                    <input type="text" name="deslayanan" class="form-control" required><br>
                                    <label>Upload gambar</label>
                                    <input type="file" name="gambar" class="form-control" required><br>
                                    <button class="btn tbn-lg btn-success" name="tambahlayanan" type="submit">Tambah Layanan</button>
                                    </form>
                                </div>
                        </div>
                    </div>
                </div>

                <!-- Daftar Layanan -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Daftar Layanan</h3>
                            </div>
                                <div class="panel-body">
                                    <table class="table table-bordered table-hovered table-striped">
                                        <thead>
                                            <th>No</th>
                                            <th>Nama</th>
                                            <th>Deskripsi</th>
                                            <th>Gambar</th>
                                            <th>Aksi</th>
                                        </thead>
                                        <?php $no = 1;
                                        while ($layanan = mysqli_fetch_assoc($layanansql)) {
                                            echo "<tr>";
                                            echo "<td>" . $no . "</td>";
                                            echo "<td>" . $layanan['namalayanan'] . "</td>";
                                            echo "<td>" . $layanan['deskripsilayanan'] . "</td>";
                                            echo "<td><a href='../../img/layanan/" . $layanan['gambar'] . "'>Lihat</a></td>";
                                            echo "<td><a class='btn btn-danger' href='../config/layanansettinghapus.php?id=" . $layanan['id'] . "'><i class='fas fa-trash-alt'></i></a></td>";
                                            echo "</tr>";
                                            $no++;
                                        } ?>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

</body>

</html>

<?php 
} ?>