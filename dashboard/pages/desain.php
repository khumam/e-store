<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
} else {
    include '../config/database.php';
    $sqlpemesanan = "select count(nama_pesanan) as jumlah from desain";
    $querypemesanan = mysqli_query($koneksi, $sqlpemesanan);
    $fetchpemesanan = mysqli_fetch_array($querypemesanan);
    $jumlahpemesanan = $fetchpemesanan['jumlah'];

    $sqlpendapatan = "select sum(harga) as pendapatan from desain";
    $querypendapatan = mysqli_query($koneksi, $sqlpendapatan);
    $fetchpendapatan = mysqli_fetch_array($querypendapatan);
    $totalpendapatan = $fetchpendapatan['pendapatan'];

    //Halaman pagination
    $halaman = 5;
    $halamanpage = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
    $halamanmulai = ($halamanpage > 1) ? ($halamanpage * $halaman) - $halaman : 0;
    $halamanquery = mysqli_query($koneksi, "select * from desain order by id desc LIMIT $halamanmulai, $halaman");
    $halamansql = mysqli_query($koneksi, "select * from desain");
    $halamantotal = mysqli_num_rows($halamansql);
    $pages = ceil($halamantotal / $halaman);

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

            <!-- Judul Page -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Statistik Desain</h1>
                    </div>
                </div>
            <!-- End Judul page -->

            <!-- Kotak di atas -->
                <div class="row mx-auto">
                    <div class="col-lg-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                        <i class="fas fa-file-invoice-dollar"></i> Pendapatan
                        </div>
                        <div class="panel-body">
                            <?php echo "<h1>Rp" . $totalpendapatan . ",-</h1>"; ?>
                        </div>
                    </div>
                    </div>
                    <div class="col-lg-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                        <i class="fas fa-chart-line"></i> Total pemesanan
                        </div>
                        <div class="panel-body">
                            <?php echo "<h1>" . $jumlahpemesanan . "</h1>"; ?>
                        </div>
                    </div>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- End Kotak -->
                <!-- /.row -->

                <!-- Button Modal -->
                <div class="row mx-auto">
                    <div class="col-lg-3 mt-2">
                    <button type="button" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#tambahdesain"><i class="fas fa-plus-square"></i> Tambah Data</button>
                    </div>
                    <div class="col-lg-3 mt-2">
                    <a href="../config/printdesain.php" class="btn btn-lg btn-success"><i class="fas fa-print"></i> Cetak Data</a>
                    </div>
                </div>
<br>
                <!-- ALert -->
                <?php if (isset($_SESSION['desaingagaltambah'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['desaingagaltambah'] . "</div>";
                }
                unset($_SESSION['desaingagaltambah']); ?>

                <?php if (isset($_SESSION['statusupdatedatagagal'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['statusupdatedatagagal'] . "</div>";
                }
                unset($_SESSION['statusupdatedatagagal']); ?>

                <?php if (isset($_SESSION['statushapusdatagagal'])) {
                    echo "<div class='alert alert-danger'>" . $_SESSION['statushapusdatagagal'] . "</div>";
                }
                unset($_SESSION['statushapusdatagagal']); ?>

                <?php if (isset($_SESSION['desainsuksestambah'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['desainsuksestambah'] . "</div>";
                }
                unset($_SESSION['desainsuksestambah']); ?>

                <?php if (isset($_SESSION['statusupdatedatasukses'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['statusupdatedatasukses'] . "</div>";
                }
                unset($_SESSION['statusupdatedatasukses']); ?>

                <?php if (isset($_SESSION['statushapusdatasukses'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['statushapusdatasukses'] . "</div>";
                }
                unset($_SESSION['statushapusdatasukses']); ?>

                <!--Tabel-->
                <div class="row mx-auto">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Data Penjualan</h3></div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Pesanan</th>
                                                        <th>Jenis</th>
                                                        <th>Nama Pemesan</th>
                                                        <th>Harga</th>
                                                        <th>Waktu</th>
                                                        <th>Deskripsi</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = $halamanmulai + 1;
                                                    while ($data = mysqli_fetch_assoc($halamanquery)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $no . "</td>";
                                                        echo "<td>" . $data['nama_pesanan'] . "</td>";
                                                        echo "<td>" . $data['jenis'] . "</td>";
                                                        echo "<td>" . $data['nama'] . "</td>";
                                                        echo "<td>Rp" . $data['harga'] . "</td>";
                                                        echo "<td>" . $data['tgl'] . "</td>";
                                                        echo "<td>" . $data['deskripsi'] . "</td>";
                                                        echo "<td><button class='btn btn-danger' data-toggle='modal' data-target='#hapusdatadesain" . $data['id'] . "'><i class='fas fa-trash-alt'></i></button>";
                                                        echo " <button class='btn btn-info' data-toggle='modal' data-target='#updatedatadesain" . $data['id'] . "'><i class='fas fa-pencil-alt'></i></button>";
                                                        echo " <a class='btn btn-success' href='../config/tambahprogress.php?idpesanan=" . $data['id_pesanan'] . "'><i class='fas fa-plus'></i></a></td>";
                                                        echo "</tr>";
                                                        $no++; ?>

                                                        <!-- MOdal Update -->
                                                        <div class="modal fade" id="updatedatadesain<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="tambahdesainLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <span class="modal-title" id="tambahdesainLabel" style="font-size: 20px;">Update Data</span>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../config/updatedatadesain.php" method="post">
                                                                    <div class="form-group">
                                                                    <input type="hidden" class="form-control form-control-lg" name="id" placeholder="Nama Pesanan" value="<?php echo $data['id']; ?>" readonly>
                                                                    <input type="text" class="form-control form-control-lg" name="pesanan" placeholder="Nama Pesanan" value="<?php echo $data['nama_pesanan']; ?>" required><br>
                                                                    <input type="text" class="form-control form-control-lg" name="nama" placeholder="Nama Pemesan" value="<?php echo $data['nama']; ?>" required><br>
                                                                    <select class="form-control" name="jenis">
                                                                        <option selected hidden>Pilih Jenis</option>
                                                                        <option value="Desain Undangan">Desain Undangan</option>
                                                                        <option value="Desain Buku Yasin">Desain Buku Yasin</option>
                                                                        <option value="Lainnya">Lainnya</option>
                                                                    </select><br>
                                                                    <input type="date" class="form-control" name="date" placeholder="Waktu" min="0" value="<?php echo $data['tgl']; ?>" required><br>
                                                                    <input type="number" class="form-control" name="harga" placeholder="Harga" min="0" value="<?php echo $data['harga']; ?>" required><br>
                                                                    <textarea class="form-control form-control-lg" placeholder="Deskripsi" name="deskripsi" required><?php echo $data['deskripsi']; ?></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-success" name="updatedesain">Update</button>
                                                                </div>
                                                                    </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- MOdal Hapus -->
                                                        <div class="modal fade" id="hapusdatadesain<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="tambahdesainLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <span class="modal-title" id="tambahdesainLabel" style="font-size: 20px;">Hapus Data</span>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Apakah anda yakin ingin menghapus data ini?<br><br>
                                                                    <b>Nama Pesanan :</b> <?php echo $data['nama_pesanan']; ?><br>
                                                                    <b>Nama Pemesanan :</b> <?php echo $data['nama']; ?><br>
                                                                    <b>Deskripsi :</b> <?php echo $data['deskripsi']; ?><br>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                                    <a href="../config/hapusdatadesain.php?id=<?php echo $data['id']; ?>" class="btn btn-success">Hapus</a>
                                                                </div>                                                                
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <?php 
                                                } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <div class="panel-footer">
                                    <ul class="pagination">
                                        <?php if ($halamanpage > 1) { ?>
                                        <li><a href="desain.php?halaman=<?php echo $halamanpage - 1; ?>"><<</a></li>
                                        <?php 
                                    } ?>
                                        <?php for ($i = 1; $i <= $pages; $i++) { ?>
                                            <li><a href="desain.php?halaman=<?php echo $i; ?>"> <?php echo $i; ?> </a></li>
                                        <?php 
                                    } ?>
                                    <?php if ($halamanpage != $pages) { ?>
                                    <li><a href="desain.php?halaman=<?php echo $halamanpage + 1; ?>">>></a></li>
                                    <?php 
                                } ?>
                                    </ul>
                                </div>
                                
                        </div>
                    </div>
                </div>

                <!-- Charts -->
                <div class="row mx-auto">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Grafik Penjualan</h3></div>
                            <div class="panel-body">
                                <div id="grafikpenjualandesain"></div>
                            </div>
                        </div>
                    </div>
                </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Modal Tambah data pemesanan-->
    <div class="modal fade" id="tambahdesain" tabindex="-1" role="dialog" aria-labelledby="tambahdesainLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <span class="modal-title" id="tambahdesainLabel" style="font-size: 20px;">Tambah Data</span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
            </button>
        </div>
        <div class="modal-body">
            <form action="../config/tambahdatadesain.php" method="post">
            <div class="form-group">
            <input type="text" class="form-control form-control-lg" name="pesanan" placeholder="Nama Pesanan" required><br>
            <input type="text" class="form-control form-control-lg" name="nama" placeholder="Nama Pemesan" required><br>
            <select class="form-control" name="jenis">
                <option selected hidden>Pilih Jenis</option>
                <option value="Desain Undangan">Desain Undangan</option>
                <option value="Desain Buku Yasin">Desain Buku Yasin</option>
                <option value="Lainnya">Lainnya</option>
            </select><br>
            <input type="number" class="form-control" name="harga" placeholder="Harga" min="0" required><br>
            <textarea class="form-control form-control-lg" placeholder="Deskripsi" name="deskripsi" required></textarea>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success" name="tambahdesain">Tambah</button>
        </div>
            </form>
        </div>
        </div>
    </div>
    </div>


    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Moris js -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <script src="../vendor/morrisjs/morris.min.js"></script>

    <script>
        new Morris.Area({
            element: 'grafikpenjualandesain',
            data: [
                <?php while ($charts = mysqli_fetch_assoc($halamansql)) {
                    $tglchart = $charts['tgl'];
                    $hargacharts = $charts['harga'];
                    echo "{ date:'" . $tglchart . "',value:'" . $hargacharts . "' },";
                } ?>
            ],
            xkey: 'date',
            ykeys: ['value'],
            labels: ['Keuntungan'],
            resize: true,
        });
    </script>

    
</body>

</html>

<?php 
} ?>