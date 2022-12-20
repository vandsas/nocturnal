<?php
  include "../conf/koneksi.php";

  session_start();
  $name ="";
  $email = "";
  $id = $_GET["id"];

  if( isset($_POST["btnDonasi"])) {

    if(payment($_POST) > 0 ){
      echo "<script>
              alert('Pembayaran berhasil dilakukan'); 
              window.location.href = '../homepage/index.php';
            </script>";
    } else {
      echo mysqli_error($koneksi);
    }
  }

  
  if(isset($_SESSION["loginUsername"])){
    $loginUsername = $_SESSION["loginUsername"];
    

    $result = mysqli_query($koneksi, "SELECT nama,email FROM users WHERE username = '$loginUsername'");
    $row = mysqli_fetch_assoc($result);
    $name = $row["nama"];
    $email = $row["email"];
  }else {
    header("location: ../logReg/login.php");
  }

  function payment($data){
    global $koneksi;
    $loginUsername = $_SESSION["loginUsername"];
  
    $nominal = $data["nominal"];
    $metode = $data["metode"];
    $nama = $data["nama"];
    $email = $data["email"];
    $doa = $data["doa"];
    $id = $_GET["id"];
  
    mysqli_query($koneksi,"INSERT INTO payment VALUES (NULL,'$id','$loginUsername','$nominal','$metode','$nama','$email','$doa')");
  
    return mysqli_affected_rows($koneksi);
  }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.84.0" />
    <title>Payment Gateway</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="payment.css" />
  </head>
  <body class="text-center">
    <header class="header">
        <div style="float: left;">
            <button style="background-color: transparent; border-style: none; color: white;font-size: 30px; margin-left: 15px; width: 10px;">
            <a style="text-decoration: none; color: white" href="../detail/detail.php?id=<?= $id ?>"><</a>
            </button>
        </div>
        <span style="color: white; font-size: 25px; margin-left: -30px;">Pembayaran Donasi</span>
    </header>

    <main class="mian">
      <form method="post">
        <br>
        <div >
            <p class="teks">Isi Nominal Donasi</p>
            <div class="nom">
                <span class="teks">RP</span>
                <input class="h-auto h-[52px] w-full rounded border-none border-coal bg-coal py-[7.5px] pl-[1.9em] pr-[15px] text-end text-[1.5rem] font-bold focus:outline-none nom2" id="nominal" name="nominal" placeholder="0" type="tel" required>
            </div>            
        </div>

        <div >
          <p class="teks">Pilih metode pembayaran</p>
          <div class="nom">
            <span class="teks" style="font-size: 23px;">Metode pembayaran</span>
            <?php 
              $result = mysqli_query($koneksi,"SELECT * FROM metode");
                if ($result->num_rows > 0) {
                    echo " <select type='varchar' class='h-auto h-[52px] w-full rounded border-none border-coal bg-coal py-[7.5px] pl-[1.9em] pr-[15px] text-end text-[1.5rem] font-bold focus:outline-none nom2' id='metode' name='metode'>";
                while ($row = $result->fetch_array()) {
                    echo "<option value='". $row['id_metode']. "'>". $row['nama'] . "</option>";
                }
                echo "</select>";
                } 
              ?>
          </div>
        </div>

        <div class="form-floating in">
          <input type="text" class="form-control" id="nama" name="nama" required value="<?php echo $name ?>"/>
          <label for="nama">Masukkan Nama Lengkap</label>
        </div>

        <div class="form-floating in">
          <input type="text" class="form-control" id="email" name="email" required value="<?php echo $email ?>"/>
          <label for="nama">Masukkan Email</label>
        </div>

        <div >
          <p class="teks">Berdoa melalui donasi ini</p>
          <div class="nom1">
            <span class="teks" style="padding-left: 0px;"></span>
            <textarea class="w-full rounded border-none border-coal bg-coal" style="width: 100%; height: 150px;" id="doa" name="doa" placeholder="Tuliskan doa untuk penggalang dana dan penerima donasi"></textarea>
          </div>
        </div>

        <br><br><br><br>

        <button class="w-100 btn btn-lg btn-primary btnBayar" type="submit" name="btnDonasi"> Lanjut donasi </button>
        </div>
      </form>
    </main>
  </body>
</html>
