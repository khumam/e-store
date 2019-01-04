<?php
session_start();
include '../config/database.php';
if (!isset($_SESSION['admin'])) {
    header('location: login.php');
} else {

    $sqlprogress = mysqli_query($koneksi, "select * from progress order by id desc");


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
                        <h1 class="page-header">Progress Pesanan</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <!--Alert -->
                <?php if (isset($_SESSION['tambahprogresssukses'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['tambahprogresssukses'] . "</div>";
                }
                unset($_SESSION['tambahprogresssukses']); ?>

                <?php if (isset($_SESSION['tambahprogressgagal'])) {
                    echo "<div class='alert alert-success'>" . $_SESSION['tambahprogressgagal'] . "</div>";
                }
                unset($_SESSION['tambahprogressgagal']); ?>

                <!--Tabel-->
                <div class="row mx-auto">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3>Progress Pesanan</h3></div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-hover table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>ID Pesanan</th>
                                                        <th>Progress</th>
                                                        <th>Catatan</th>
                                                        <th>Ubah Progress</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $no = 1;
                                                    while ($data = mysqli_fetch_assoc($sqlprogress)) {
                                                        echo "<tr>";
                                                        echo "<td>" . $no . "</td>";
                                                        echo "<td>" . $data['id_pesanan'] . "</td>";
                                                        echo "<td><div class='progress'><div class='progress-bar' role='progressbar' aria-valuenow='" . $data['progress'] . "' aria-valuemin='0' aria-valuemax='100' style='width:" . $data['progress'] . "%'>" . $data['progress'] . "%</div></div></td>";
                                                        echo "<td>" . $data['catatan'] . "</td>";
                                                        echo "<td><button class='btn btn-success' data-toggle='modal' data-target='#ubahprogress" . $data['id'] . "'>Ubah</button></td>";
                                                        echo "<td><button class='btn btn-danger' data-toggle='modal' data-target='#hapusprogress" . $data['id'] . "'><i class='fas fa-trash-alt'></i></button></td>";
                                                        echo "</tr>";
                                                        $no++;
                                                        ?>

                                                    <!-- MOdal Update -->
                                                    <div class="modal fade" id="ubahprogress<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="tambahdesainLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <span class="modal-title" id="tambahdesainLabel" style="font-size: 20px;">Ubah Progress</span>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form action="../config/ubahprogress.php" method="post">
                                                                    <div class="form-group">
                                                                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                                                                    Geser sejauh mana progressnya (dalam %)<br>
                                                                    <input type="range" class="form-control-range" id="formControlRange" min="0" max="100" onchange='updateTextInput(this.value);'><br>
                                                                    <input type="text" name="progress" id="textInput" class="form-control" value="<?php echo $data['progress']; ?>"><br>
                                                                    <textarea class="form-control form-control-lg" name="catatan" placeholder="Masukkan catatan disini"><?php echo $data['catatan']; ?></textarea>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                                    <button type="submit" class="btn btn-success" name="ubahprogress">Ubah Progress</button>
                                                                </div>
                                                                    </form>
                                                                </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    <!-- MOdal hapus -->
                                                    <div class="modal fade" id="hapusprogress<?php echo $data['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="tambahdesainLabel" aria-hidden="true">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <span class="modal-title" id="tambahdesainLabel" style="font-size: 20px;">Hapus Progress</span>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true"><i class="fas fa-times-circle"></i></span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Dengan menghapus progress ini, artinya pesanan dibatalkan atau selesai dikerjakan.<br>
                                                                    Hapus progress?
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
                                                                    <a href="../config/hapusprogress?id=<?php echo $data['id']; ?>&idpesanan=<?php echo $data['id_pesanan']; ?>" class="btn btn-success" name="ubahprogress">Hapus Progress</a>
                                                                </div>
                                                                    </form>
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

    <script>
        function updateTextInput(val) {
          document.getElementById('textInput').value=val; 
        }
    </script>

</body>

</html>

<?php 
} ?>