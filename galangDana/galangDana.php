<?php
  include "../conf/koneksi.php";

  session_start();
  $name="";

  if(isset($_SESSION["loginUsername"])){
    $loginUsername = $_SESSION["loginUsername"];
    

    $result = mysqli_query($koneksi, "SELECT nama FROM users WHERE username = '$loginUsername'");
    $row = mysqli_fetch_assoc($result);
    $name = $row["nama"];
    }else {
    header("location: ../logReg/login.php");
  }

  if( isset($_POST["btnGalang"])) {

    if(galangDana($_POST) > 0 ){
      echo "<script>
              alert('Form Galang Dana berhasil dilakukan'); 
              window.location.href = '../homepage/index.php';
            </script>";
    } else {
      echo mysqli_error($koneksi);
    }
  }

  function galangDana($data){
    global $koneksi;
    $loginUsername = $_SESSION["loginUsername"];
  
    $judul = $data["judul"];
    $tujuan = $data["tujuan"];
    $penggalang = $data["penggalang"];
    $waktu = $data["waktu"];
    $jenis = $data["jenis"];
    $target = $data["target"];
    $cerita = $data["cerita"];

    $gambar = upload();
    if( !$gambar ){
      return false;
    }
  
    mysqli_query($koneksi,"INSERT INTO galangdana VALUES  ('','$loginUsername','$judul','$tujuan','$penggalang','$waktu','$jenis','$target','$cerita','$gambar')");

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
    <title>Galang Dana</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="galangDana.css"  />
  </head>
  <body class="text-center">
    <header class="header">
        <div style="float: left;">
            <button style="background-color: transparent; border-style: none; color: white;font-size: 30px; margin-left: 15px; width: 10px;">
                <a style="text-decoration:none; color:white" href="../homepage/index.php"><</a>
            </button>
        </div>
        <span style="color: white; font-size: 25px; margin-left: -30px;">Galang Dana</span>
    </header>

    <main class="mian">
      
      <form method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal"><b>Form Galang Dana</b></h1>

        <div class="form-floating in">
          <input type="text" class="form-control" id="judul" name="judul" required />
          <label for="nama"> Judul Galang Dana</label>
        </div>
        <div class="form-floating in">
          <input type="text" class="form-control" id="tujuan" name="tujuan" required />
          <label for="tujuan">Tujuan Donasi</label>
        </div>
        <div class="form-floating in">
          <input type="varchar" class="form-control" id="penggalang" name="penggalang" required value="<?php echo $name ?>"/>
          <label for="penggalang" > Nama Penggalang </label>
        </div>
        <div class="form-floating in">
          <input type="date" class="form-control" id="waktu" name="waktu" required  />
          <label for="waktu"> Batas Waktu Donasi</label>
        </div>
        <div class="form-floating in">
          <?php 
            $result = mysqli_query($koneksi,"SELECT * FROM jenis_donasi");
            if ($result->num_rows > 0) {
              echo " <select type='varchar' class='form-control' id='jenis' name='jenis' required>";
              while ($row = $result->fetch_array()) {
                       echo "<option value='". $row['id_jenis']. "'>". $row['nama'] . "</option>";
               }
              echo "</select>";
            } 
          ?>
          <label for="jenis">Jenis Donasi</label>
        </div>
        <div class="form-floating in">
          <input type="tel" class="form-control" id="target" name="target" required  />
          <label for="target"> Dana Akan Yang Dikumpulkan</label>
        </div>
        <div class="form-floating in">
          <input type="file" class="form-control" id="gambar" name="gambar" required  />
          <label for="gambar"> Upload Gambar</label>
        </div>
        <div class="form-floating in">
          <textarea class="w-full rounded border-none border-coal bg-coal form-control" style="width: 100%; height: 150px;" id="cerita" name="cerita"></textarea>
          <label for="cerita">Cerita</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary btnBayar" type="submit" name="btnGalang"> Lanjut Galang Dana </button>

        </div>
      </form>
    </main>
  </body>
</html>
