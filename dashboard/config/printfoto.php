<?php

include 'database.php';
date_default_timezone_set('Asia/Jakarta');
$halamanquery = mysqli_query($koneksi, "select * from foto order by id desc");
$halamansql = mysqli_query($koneksi, "select * from foto");

$sqlpendapatan = "select sum(harga) as pendapatan from foto";
$querypendapatan = mysqli_query($koneksi, $sqlpendapatan);
$fetchpendapatan = mysqli_fetch_array($querypendapatan);
$totalpendapatan = $fetchpendapatan['pendapatan'];
?>

<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Statistik Jasa Foto - Garis Media</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../vendor/bootstrap/css/bootstrapv4.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
        html {font-family: 'Noto Sans', sans-serif;}
    </style>
</head>
<body>
<div class="container">
<h1 style="margin-top: 20px;text-align: center">Statistik Jasa Foto</h1>
<h1 style="text-align: center">Garis Media</h1>
<hr>
<p class="text-center">Per <?php echo date('d-m-Y , H:i:s'); ?> WIB </p>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>No</th>
            <th>Pesanan</th>
            <th>Jenis</th>
            <th>Nama Pemesan</th>
            <th>Harga</th>
            <th>Waktu</th>
            <th>Deskripsi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 1;
        while ($data = mysqli_fetch_assoc($halamanquery)) {
            echo "<tr>";
            echo "<td>" . $no . "</td>";
            echo "<td>" . $data['nama_pesanan'] . "</td>";
            echo "<td>" . $data['jenis'] . "</td>";
            echo "<td>" . $data['nama'] . "</td>";
            echo "<td>Rp" . $data['harga'] . "</td>";
            echo "<td>" . $data['tgl'] . "</td>";
            echo "<td>" . $data['deskripsi'] . "</td>";
            echo "</tr>";
            $no++;
        } ?>
        <tr>
            <td colspan="4">Jumlah Pendapatan</td>
            <td>Rp<?php echo $totalpendapatan; ?></td>
        <tr>
    </tbody>
</table>
<br><br>
<div class="card">
<div class="card-body">
    <div class="card-title">
        <h3>Grafik Penjualan</h3>
    </div>
        
           <div id="grafikpenjualanfoto"></div>
        </div>
</div>
</div>

<script>window.print();</script>

<!-- Moris js -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>

    <script>
        new Morris.Area({
            element: 'grafikpenjualanfoto',
            data: [
                <?php while ($charts = mysqli_fetch_assoc($halamansql)) {
                    $tglchart = $charts['tgl'];
                    $hargacharts = $charts['harga'];
                    echo "{ date:'" . $tglchart . "',value:'" . $hargacharts . "' },";
                } ?>
            ],
            xkey: 'date',
            ykeys: ['value'],
            resize: true,
        });
    </script>
    
</body>
</html>