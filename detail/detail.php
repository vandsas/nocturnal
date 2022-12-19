<?php
  include "../conf/koneksi.php";

  session_start();
  $id = $_GET["id"];

  $judul = mysqli_query($koneksi, "SELECT * FROM galangdana WHERE id_dana = $id");
  $row = mysqli_fetch_assoc($judul);
  
  $result = mysqli_query($koneksi,"SELECT * FROM galangdana ORDER BY id_dana DESC") ;
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="detail.css" />
    <title>Detail Donasi</title>
  </head>
  <body>
    
    <main  style="padding-top: -100px;">
    <header class="header text-center">
      <div style="float: left">
        <button style="background-color: transparent; border-style: none; color: white; font-size: 30px; margin-left: 15px; width: 10px">
          <a style="text-decoration: none; color: white" href="../homepage/index.php"><</a>
        </button>
      </div>
      <span style="color: white; font-size: 25px; margin-left: -30px"><?= $row["judul"]  ; ?></span>
  </header>
      <div class="container marketing">
      <br>
        <hr class="featurette-divider" />
        <div class="row featurette" >
          <div class="col-md-7" style="background-color: #D6E6F2;">
            <h2 class="featurette-heading fw-normal lh-1">Ayo Bantu Teman Kita Melalui Donasi Bersama Doma</h2>
            <br>
            <div>
            <hr>
            <p class="text-start" style="color: #5a5a5a">Tujuan : <?= $row["tujuan"]; ?></p>
            <hr>
            <p class="text-start" style="color: #5a5a5a">Penggalang : <?= $row["nama"]; ?></p>
            <hr>
            <p class="text-start" style="color: #5a5a5a">Batas Waktu Donasi : <?= date("d-m-Y", strtotime($row["waktu"])); ?></p>
            <hr>
          </div>
            <br>
            <p class="lead text-justify"><?= $row["cerita"]; ?></p>
          </div>
          <div class="col-md-5" >
            <img src="../img/<?= $row["gambar"]; ?>"  class="img-fluid" alt="Kucing" style="padding: 15px; width: 650px; height: 300px;;" />
            <div class="progress" style="height: 30px; color:#00aeef">
              <div class="progress-bar bg-info" role="progressbar" aria-label="Info example " style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100">Progress 0% / <?= $row["target"]; ?></div>
            </div>
            <p class="text-start" style="color: #5a5a5a;">Target Donasi : Rp <?= $row["target"]; ?></p>
            <svg>
              <rect style="max-width: 200px;" width="100%" height="100%" fill="#b9d7ea" />
            </svg>
            <a class="btn btn-primary ms-2" href="../payment/payment.php?id=<?= $id ?>" >Ayo Bantu</a>
          </div>
        </div>

        <hr class="featurette-divider" />
      </div>
    </main>

    <script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
