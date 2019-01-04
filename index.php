<?php 

include 'dashboard/config/database.php';
$sql = "select * from web where id='1'";
$query = mysqli_query($koneksi, $sql);
$data = mysqli_fetch_assoc($query);
$namaweb = $data['nama'];
$slogan = $data['slogan'];
$tentang = $data['tentang'];
$wa = $data['wa'];
$email = $data['email'];
$ig = $data['ig'];

?>


<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Layanan percetakan, foto studio, dan desain grafis">
  <meta name="author" content="Khoerul Umam, Doddy Rizal Novianto, Jatmiko Amung Prasojo">

  <title><?php echo $data['nama']; ?></title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/garismedia.css">
  <link rel="stylesheet" href="vendor/animate/animate.min.css">
  <link rel="stylesheet" href="vendor/fullpage/fullpage.css">
  <!--<link href="https://fonts.googleapis.com/css?family=Righteous" rel="stylesheet">-->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css">
</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
    <div class="container">
      <b class="navbar-brand fontbesar" href="#"><?php echo $data['nama']; ?></b>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
        aria-expanded="true" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item" id="dua">
            <a class="nav-link" href="#contact"><button class="btn-danger pl-3 pr-3" style="border: none;border-radius: 10px;">Pemesanan</button></a>
          </li>
          <li class="nav-item active" id="satu">
            <a class="nav-link" href="#">Home
              <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item" id="dua">
            <a class="nav-link" href="#service">Services</a>
          </li>
          <li class="nav-item" id="tiga">
            <a class="nav-link" href="#about">About</a>
          </li>
          <li class="nav-item" id="login">
            <a class="nav-link" href="login.html">Login</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Page Content -->
  <div id="fullpage">
    <div class="section bg-home text-center">
      <h1 class="wow fadeInUp"><?php echo $data['nama']; ?></h1>
      <h4 class="wow fadeInUp" data-wow-delay="0.7s"><?php echo $slogan; ?></h4>
      <a href="#contact"><button class="wow flipInX btn btn-lg btn-danger jarakatas jarakbtnsatu ml-2 mr-2"
          data-wow-delay="1.3s" style="width:200px">Pemesanan</button></a>
      <a href="#service"><button class="wow flipInX btn btn-lg btn-outline-danger jarakatas jarakbtndua ml-2 mr-2"
          data-wow-delay="1.7s" style="width:200px; color: #fff;">Layanan</button></a>
    </div>
    <div id="service" class="section bg-service">
      <div class="container jarakbtnsatu">
        <h2 class="wow fadeInUp">Layanan Kami</h2>
        <div class="wow fadeInLeft line mb-5" data-wow-delay="0.5s"></div>
        <div class="row mt-5 rowmobile">
          <?php $delay = 1;
          $layanan = mysqli_query($koneksi, "select * from weblayanan order by id desc");
          while ($data = mysqli_fetch_assoc($layanan)) { ?>
              <div class="wow flipInY col-sm" data-wow-delay="<?php echo $delay; ?>s">
                <div class="card jarakbtnsatu ukuranlg mx-auto" style="background: rgba(0, 0, 0, 0.486)">
                  <img class="card-img-top" src="<?php echo 'img/layanan/' . $data['gambar']; ?>" alt="<?php echo $data['namalayanan']; ?>" height="200px" width="auto">
                  <div class="card-body">
                    <h5 class="card-title text-white"><?php echo $data['namalayanan']; ?></h5>
                    <p class="card-text text-white"><?php echo $data['deskripsilayanan']; ?></p>
                  </div>
                </div>
              </div>
          <?php 
          $delay++;
        } ?>
        </div>
      </div>
    </div>
    <div id="about" class="section bg-about">
      <div class="container jarakatas jarakbtnsatu">
        <div class="row rowmobile">
          <div class="wow fadeInUp col-lg-4">
            <img class="imgonmobile" src="img/layanan3.png" height="300px" />
          </div>
          <div class="col-lg-8 jarakbtnsatu jarakbawahmobile">
            <h2 class="wow fadeInUp" data-wow-delay="0.4s" style="color: #2e2e2e">Tentang Kami</h2>
            <div class="line2 wow fadeInLeft" data-wow-delay="1s" style="background: #2e2e2e"></div>
            <p class="mt-3 wow fadeInUp" data-wow-delay="1.4s"><?php echo $tentang; ?></p>
          </div>
        </div>
      </div>
    </div>
    <div id="contact" class="section bg-contact">
      <div class="container jarakbtnsatu">
        <h2 class="wow fadeInUp" style="color: #2e2e2e">Hubungi Kami</h2>
        <div class="line wow fadeInLeft" data-wow-delay="0.5s" style="background: #2e2e2e"></div>
        <p class="wow fadeInUp mt-1" data-wow-delay="0.4s">Untuk pemesanan lebih lanjut, silahkan hubungi kami.</p>
        <div class="row text-center mt-5">
          <div class="wow fadeInLeft col-lg-4" data-wow-delay="1s">
            <div class="kontak">
              <span class="kontakisi"><i class="fab fa-whatsapp"></i></span>
              <br>Whatsapp
              <br><?php echo $wa; ?>
            </div>
          </div>

          <div class="wow fadeInUp col-lg-4 jarakbtnsatu" data-wow-delay="1s">
            <div class="kontak">
              <span class="kontakisi"><i class="fas fa-envelope"></i></span>
              <br>Email
              <br><?php echo $email; ?>
            </div>
          </div>

          <div class="wow fadeInRight col-lg-4 jarakbtnsatu jarakbawahmobile" data-wow-delay="1s">
            <div class="kontak">
              <span class="kontakisi"><i class="fab fa-instagram"></i></span>
              <br>Instagram
              <br><?php echo $ig; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="navbar-dark bg-dark text-center p-3">
    <p style="color: #fff"><?php echo $namaweb; ?> &copy; 2018</p>
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/fullpage/fullpage.js"></script>
  <script src="vendor/wow/wow.js"></script>
  <script>
    new WOW().init();
  </script>
  <script>
    new fullpage('#fullpage', {

      autoScrolling: false,
      scrollHorizontally: true

    });
  </script>
</body>

</html>