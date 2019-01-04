<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
} else {
    include '../config/database.php';
    $sqlpemesananfoto = "select count(nama_pesanan) as jumlah from foto";
    $querypemesananfoto = mysqli_query($koneksi, $sqlpemesananfoto);
    $fetchpemesananfoto = mysqli_fetch_array($querypemesananfoto);
    $jumlahpemesananfoto = $fetchpemesananfoto['jumlah'];

    $sqlpendapatanfoto = "select sum(harga) as pendapatan from foto";
    $querypendapatanfoto = mysqli_query($koneksi, $sqlpendapatanfoto);
    $fetchpendapatanfoto = mysqli_fetch_array($querypendapatanfoto);
    $totalpendapatanfoto = $fetchpendapatanfoto['pendapatan'];

    $sqlpemesanandesain = "select count(nama_pesanan) as jumlah from desain";
    $querypemesanandesain = mysqli_query($koneksi, $sqlpemesanandesain);
    $fetchpemesanandesain = mysqli_fetch_array($querypemesanandesain);
    $jumlahpemesanandesain = $fetchpemesanandesain['jumlah'];

    $sqlpendapatandesain = "select sum(harga) as pendapatan from desain";
    $querypendapatandesain = mysqli_query($koneksi, $sqlpendapatandesain);
    $fetchpendapatandesain = mysqli_fetch_array($querypendapatandesain);
    $totalpendapatandesain = $fetchpendapatandesain['pendapatan'];

    $pendapatan = $totalpendapatanfoto + $totalpendapatandesain;
    $pemesanan = $jumlahpemesananfoto + $jumlahpemesanandesain;

    $datasqlfoto = mysqli_query($koneksi, "select * from foto");
    $datasqldesain = mysqli_query($koneksi, "select * from desain");

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
    <link href="../vendor/bootstrap/css/bootstrapv4.css" rel="stylesheet">
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
                        <h1 class="page-header">Dashboard</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <!-- Kotak di atas -->
                <div class="row mx-auto">
                    <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <i class="fas fa-file-invoice-dollar"></i> Pendapatan
                        </div>
                        <div class="panel-body">
                            <?php echo "<h1>Rp" . $pendapatan . ",-</h1>"; ?>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <i class="fas fa-chart-line"></i> Total pemesanan
                        </div>
                        <div class="panel-body">
                            <?php echo "<h1>" . $pemesanan . "</h1>"; ?>
                        </div>
                    </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

                <!-- Tombol-tombol shortcut -->
                <div class="row text-center mx-auto">
                <div class="col-lg-1"></div>
                    <div class="col-lg-2" style="padding-top: 10px;">
                        <a class="btn btn-primary" href="foto.php">Statistik<br>Fotografi</a>
                    </div>
                    <div class="col-lg-2" style="padding-top: 10px;">
                        <a class="btn btn-success" href="../config/printfoto.php">Cetak Statistik<br>Fotografi</a>
                    </div>
                    <div class="col-lg-2" style="padding-top: 10px">
                        <a class="btn btn-warning" href="desain.php">Statistik<br>Desain</a>
                    </div>
                    <div class="col-lg-2" style="padding-top: 10px">
                        <a class="btn btn-success" href="../config/printdesain.php">Cetak Statistik<br>Desain</a>
                    </div>
                    <div class="col-lg-2" style="padding-top: 10px">
                        <a class="btn btn-info" href="progress.php">Progress<br>Pesanan</a>
                    </div>
                    <div class="col-lg-1"></div>

                </div>
                <br><br>

                <!-- Charts -->
                <div class="row mx-auto">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Grafik Penjualan Foto</h3></div>
                            <div class="panel-body">
                                <div id="grafikpenjualanfoto"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Grafik Penjualan Desain</h3></div>
                            <div class="panel-body">
                                <div id="grafikpenjualandesain"></div>
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

    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>

    <script>
        new Morris.Area({
            element: 'grafikpenjualanfoto',
            data: [
                <?php while ($charts = mysqli_fetch_assoc($datasqlfoto)) {
                    $tglchart = $charts['tgl'];
                    $hargacharts = $charts['harga'];
                    echo "{ date:'" . $tglchart . "',foto:'" . $hargacharts . "' },";
                } ?>
            ],
            xkey: 'date',
            ykeys: ['foto'],
            labels: ['Keuntungan'],
            resize: true,
        });

        new Morris.Area({
            element: 'grafikpenjualandesain',
            data: [
                <?php while ($charts = mysqli_fetch_assoc($datasqldesain)) {
                    $tglchart = $charts['tgl'];
                    $hargacharts = $charts['harga'];
                    echo "{ date:'" . $tglchart . "',desain:'" . $hargacharts . "' },";
                } ?>
            ],
            xkey: 'date',
            ykeys: ['desain'],
            labels: ['Keuntungan'],
            resize: true,
        });
    </script>

</body>

</html>

<?php 
} ?>