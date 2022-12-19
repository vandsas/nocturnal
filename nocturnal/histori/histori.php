<?php
  include "../conf/koneksi.php";
  
  session_start();
  $username ="";
  $email = "";
  $no = "";

  if(isset($_SESSION["loginUsername"])){
    $loginUsername = $_SESSION["loginUsername"];
    

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$loginUsername'");
    $row = mysqli_fetch_assoc($result);
    $username = $row["nama"];
    $email = $row["email"];
    $no = $row["no_tlpn"];

    $rest = mysqli_query($koneksi, "SELECT payment.nama AS nama,galangdana.tujuan AS tujuan,payment.nominal AS nominal,metode.nama AS metode 
    FROM payment JOIN galangdana ON(payment.id_dana=galangdana.id_dana) JOIN metode ON(payment.metode=metode.id_metode)
    WHERE payment.username = '$loginUsername'");

  $re = mysqli_query($koneksi, "SELECT profil FROM profil WHERE username = '$loginUsername'");
  $rew = mysqli_fetch_assoc($re);
  $profil = $rew["profil"];
    // $rew = mysqli_fetch_assoc($rest);
    // $nama = $rew["nama"];
    // $tujuan = $rew["tujuan"];
    // $nominal = $rew["nominal"];
    // $metode = $rew["metode"];

  $total = mysqli_query($koneksi, "SELECT SUM(nominal) as total FROM payment WHERE username = '$loginUsername'");
  $tot = mysqli_fetch_assoc($total);

  $zakat = mysqli_query($koneksi, "SELECT SUM(payment.nominal) as total FROM payment JOIN galangdana on(payment.id_dana=galangdana.id_dana) 
  WHERE payment.username = '$loginUsername' AND galangdana.jenis = '3'");
  $zak = mysqli_fetch_assoc($zakat);

  $benca = mysqli_query($koneksi, "SELECT SUM(payment.nominal) as total FROM payment JOIN galangdana on(payment.id_dana=galangdana.id_dana) 
  WHERE payment.username = '$loginUsername' AND galangdana.jenis = '2'");
  $ben = mysqli_fetch_assoc($benca);

  $medis = mysqli_query($koneksi, "SELECT SUM(payment.nominal) as total FROM payment JOIN galangdana on(payment.id_dana=galangdana.id_dana) 
  WHERE payment.username = '$loginUsername' AND galangdana.jenis = '1'");
  $med = mysqli_fetch_assoc($medis);


  }else{
    header("location: ../logReg/login.php");
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Doma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="histori.css" />
  </head>
  <body>
    <header class="header text-center">
      <div style="float: left">
        <button style="background-color: transparent; border-style: none; color: white; font-size: 30px; margin-left: 15px; width: 10px">
          <a style="text-decoration: none; color: white" href="../homepage/index.php"><</a>
        </button>
      </div>
      <span style="color: white; font-size: 25px; margin-left: -30px">Dashboard</span>
    </header>
    <br />
    <div class="row d-flex flex-row">
      <div class="container col-sm-8 col-md-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="../img/<?= $profil; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 125px" />
            <h5 class="my-3"><?php echo $username ?></h5>
            <p class="mb-2"><?php echo $email ?></p>
            <p class="text-muted mb-4"><?php echo $no ?></p>
          </div>
        </div>
      </div>
      <div class="container col-md-8 col-sm-12">
        <div class="justify-content-center d-flex">
          <h1 class="h3 mb-0 text-gray-800">Tipe Donasi</h1>
        </div>
        <br />
        <!-- total donasi -->
        <div class="row container px-10 col-sm-12 mx-auto">
          <div class="col-sm-12 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Donasi</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">IDR <?= $tot["total"];  ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- bencana -->
          <div class="col-sm-12 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Bencana Alam</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">IDR <?= $ben["total"];  ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div></div>
          <!-- Zakat -->
          <div class="col-sm-12 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Zakat</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800" >IDR <?= $zak["total"];  ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Medis -->
          <div class="col-sm-12 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Medis</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">IDR <?= $med["total"];  ?></div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--tabel-->
      <div class="d-flex">
        <h2 class="h3 mb-0 text-gray-800">Riwayat Donasi</h2>
      </div>
      <div class="table-responsive">
        <table class="table table-success table-striped table-bordered" border="2">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Tujuan</th>
              <th scope="col">Nominal</th>
              <th scope="col">Metode</th>
            </tr>
          </thead>
          <tbody>
          <?php $i = 1 ?>
          <?php while ( $rew = mysqli_fetch_assoc($rest)) : ?>
            <tr>
              <th scope="row"><?= $i; ?></th>
              <td><?= $rew["nama"]; ?></td>
              <td><?= $rew["tujuan"]; ?></td>
              <td>IDR <?= $rew["nominal"]; ?></td>
              <td><?= $rew["metode"]; ?></td>
            </tr>
            <?php $i++ ?>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
