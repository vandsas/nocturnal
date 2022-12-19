<?php

include "../conf/koneksi.php";

session_start();
$profil = "";

$result = mysqli_query($koneksi,"SELECT * FROM galangdana ORDER BY id_dana DESC") ;

if(isset($_SESSION["loginUsername"])){
  $loginUsername = $_SESSION["loginUsername"];

  $re = mysqli_query($koneksi, "SELECT profil FROM profil WHERE username = '$loginUsername'");
  $rew = mysqli_fetch_assoc($re);
  $profil = $rew["profil"];
  }else {
  $profil = "nophotoo.png";
}

if( isset($_POST["btnHome"])) {
  $result = mysqli_query($koneksi,"SELECT * FROM galangdana WHERE ORDER BY id_dana DESC") ;
}

if( isset($_POST["btnMedis"])) {
  $result = mysqli_query($koneksi,"SELECT * FROM galangdana WHERE jenis = 1 ORDER BY id_dana DESC") ;
}


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Homepage</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body style="background-color: #b9d7ea;">
    <div class="header">
      <nav class="navbar navbar-expand-lg" style="background-color: #4682b4">
        <div class="container-fluid">
          <form class="d-flex" role="search" method="post">
            <input class="form-control me-2" type="search" name="keyword" placeholder="Search" aria-label="Search" autofocus autocomplete="off"/>
            <button class="btn btn-outline-success" type="submit" name="search">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16" style="color: azure">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
              </svg>
            </button>
          </form>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"> </span>
          </button>
          <div class="collapse navbar-collapse text-end" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link" href="#"></a>
              </li>
              <li class="nav-item" style="padding-top: 10px">
                <a type="button" class="btn btn-primary btn-sm" href="../galangDana/galangDana.php">Galang Dana</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"></a>
              </li>
              <li class="nav-item" style="padding-top: 10px">
              <a type="button" class="btn btn-primary btn-sm" href="../histori/histori.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"></a>
              </li>
              <li class="nav-item">
              <a class="nav-link" width="50" class="rounded-circle" href="../akunset/setakun.php"><img src="../img/<?= $profil; ?>" width="45" class="rounded-circle" /></a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </div>

    <br />

    <div class="container">
      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
            <img src="1.jpg" class="d-block w-100" />
            </div>
            <div class="carousel-item">
            <img src="2.jpg" class="d-block w-100" />
            </div>
            <div class="carousel-item">
            <img src="3.png" class="d-block w-100" />
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next" autofocus>
        </button>
      </div>
    </div>
    <br />
    <section id="project">
      <div class="container">
        <div class="row text-center" style="max-width: 110%; background-color: #b0c4de">
          <div class="col-3" style="margin-top:5px">
            <button style="background: none; border:none" name="btnHome">
              <img src="5.png"  style="width: 100%; max-width: 90px" /><br>
              <a style="color:white"> Semua </a>
            </button>
          </div>
          <div class="col-3" style="margin-top:6px">
            <button style="background: none; border:none" name="btnMedis">
              <img src="6.png"  style="width: 100%; max-width: 90px" /><br>
              <a style="color:white"> Medis </a>
            </button>
          </div>
          <div class="col-3">
            <button style="background: none; border:none" name="btnBencana">
              <img src="bencana.png"  style="width: 100%; max-width: 95px; margin-top:-5px" /><br>
              <a style="color:white"> Bencana Alam </a>
            </button>
          </div>
          <div class="col-3">
            <button style="background: none; border:none" name="btnZakat">
              <img src="zakat.png"  style="width: 100%; max-width: 100px" /><br>
              <a style="color:white"> Zakat </a>
            </button>
          </div>
        </div>
      </div>
    </section>
    <?php while ( $row = mysqli_fetch_assoc($result)) : ?>
    <br />
    <div class="card mb-4 m-auto" style="max-width: 90%">
      <div class="row g-0"  style="background-color:#D6E6F2">
        <div class="col-md-4">
          <img src= "../img/<?= $row["gambar"]; ?>" class="img-fluid rounded-start" style="max-width: 350px; height:200px" />
        </div>
        <div class="col-md-8">
          <div class="card-body">
            <h5 class="card-title"> <?= $row["judul"]; ?> </h5>
            <p class="card-text"> <?= $row["tujuan"]; ?> </p>
            <div class="progress">
              <div class="progress-bar" style="width: 0%"></div>
            </div>
            <div class="row">
              <div class="col-6">
                <p class="card-text"><small class="text-muted">Target Donasi : Rp <?= $row["target"]; ?> </small></p>
              </div>
              <div class="col-6">
                <p class="card-text text-end"><small class="text-muted">Batas Akhir Donasi : <?= date("d-m-Y", strtotime($row["waktu"])); ?> </small></p>
              </div>
            </div>
            <br>
            <a style="text-decoration:none; color:green" href="../detail/detail.php?id=<?= $row["id_dana"] ?>"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle" viewBox="0 0 16 16" style="margin-bottom:3px">
              <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
            </svg> Donasi</a>
          </div>
        </div>
      </div>
    </div>
    <hr style="color: aliceblue; height: 3px;"/>
    <?php endwhile; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
