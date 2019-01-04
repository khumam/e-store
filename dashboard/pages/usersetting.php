<?php
session_start();
include '../config/database.php';
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
} else {

    $user = mysqli_query($koneksi, "select * from admin where id='1'");
    $data = mysqli_fetch_assoc($user);

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
    <link href="../vendor/bootstrap/css/bootstrapv4.css" rel="stylesheet">

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
                        <h1 class="page-header">Pengaturan User</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <!-- ALert -->
                <?php if (isset($_SESSION['passwordsalah'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['passwordsalah'] . "</div>";
                }
                unset($_SESSION['passwordsalah']); ?>

                <?php if (isset($_SESSION['updategagal'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['updategagal'] . "</div>";
                }
                unset($_SESSION['updategagal']); ?>

                <?php if (isset($_SESSION['updatesukses'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['updatesukses'] . "</div>";
                }
                unset($_SESSION['updatesukses']); ?>

            <div class="row mb-5">
                <div class="col-lg-12">
                    <div class="panel">
                        <div class="panel-body">
                            <form action="../config/usersetting.php" method="post">
                            <div class="row">
                            <div class="col-lg-6">
                            <label>Nama</label><br>
                            <input type="text" name="nama" class="form-control" value="<?php echo $data['nama']; ?>" placeholder="Nama anda"><br></div>
                            <div class="col-lg-6">
                            <label>Username</label><br>
                            <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" placeholder="Username Anda" required><br></div>
                            </div>
                            <div class="row">
                            <div class="col-lg-6">
                            <label>Email</label><br>
                            <input type="email" name="email" class="form-control" value="<?php echo $data['email']; ?>" placeholder="Email Anda"><br></div>
                            <div class="col-lg-6">
                            <label>Password baru</label><br>
                            <input type="text" name="passbaru" class="form-control" value="" placeholder="Password baru Anda"><br></div>
                            </div><br>
                            <label>Masukkan password saat ini untuk menyimpan</label>
                            <input type="password" name="password" class="form-control" placeholder="Masukkan Password" required><br>
                            <button class="btn btn-lg btn-success" style="margin-bottom: 2rem;" type="submit" name="editadmin">Simpan</button>
                            </form>
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