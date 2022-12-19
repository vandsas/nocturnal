<?php

include "../conf/koneksi.php";

  session_start();
  $name = ""; 
  $uname = "";
  $email = "";
  $tgl = "";
  $no = "";
  $code = $_SESSION["loginUsername"];

  if(isset($_SESSION["loginUsername"])){
  $loginUsername = $_SESSION["loginUsername"];
    

  $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$loginUsername'");
  $row = mysqli_fetch_assoc($result);
  $name = $row["nama"];
  $uname = $row["username"];
  $email = $row["email"];
  $tgl = $row["tgl_lahir"];
  $no = $row["no_tlpn"];

  $re = mysqli_query($koneksi, "SELECT profil FROM profil WHERE username = '$loginUsername'");
  $rew = mysqli_fetch_assoc($re);
  $profil = $rew["profil"];

    }else {
    header("location: ../logReg/login.php");
  }

  if( isset($_POST["upload"])) {

    if(upProf($_POST) > 0 ){
      echo "<script>
              alert('Upload foto profile berhasil dilakukan');
              window.location.href = '../homepage/index.php';
            </script>";
    } else {
      echo mysqli_error($koneksi);
    }
  }

  function upProf($data){
    global $koneksi;
    $loginUsername = $_SESSION["loginUsername"];

    $gambar = upload();
    if( !$gambar ){
      return false;
    }
  
    mysqli_query($koneksi,"UPDATE profil SET username = '$loginUsername',profil = '$gambar'");

    return mysqli_affected_rows($koneksi);
  }
  function upProfi(){
    global $koneksi;
    $loginUsername = $_SESSION["loginUsername"];

    $gambar = upload();
    if( !$gambar ){
      return false;
    }
  
    mysqli_query($koneksi,"UPDATE profil SET username = '$loginUsername',profil = '$gambar'");

    return mysqli_affected_rows($koneksi);
  }


?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Setting Akun</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="setakunstyle.css" />
  </head>
  <body>
    <header class="header text-center">
      <div style="float: left">
        <button style="background-color: transparent; border-style: none; color: white; font-size: 30px; margin-left: 15px; width: 10px">
        <a style="text-decoration: none; color: white" href="../homepage/index.php"><</a>
        </button>
      </div>
      <span style="color: white; font-size: 25px; margin-left: -30px">Akun Setting</span>
    </header>
    <br />
    <div class="akun row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <form method="post" enctype="multipart/form-data">
            <div style="width: 125px;position: relative;margin: auto;">
            <img src="../img/<?= $profil; ?>"  alt="avatar" class="rounded-circle img-fluid" style="width: 150px" />
            <div style="position: absolute;bottom: 0;right: 0;background: #00b4ff;width: 32px;height: 32px;line-height: 33px;text-align: center;border-radius: 50%;overflow: hidden;">
              <input type="file" name="gambar" id = "gambar" style="position: absolute;transform: scale(2);opacity: 0;">
              <i class = "fa fa-camera-primary" style = "color: white;"><svg xmlns="http://www.w3.org/2000/svg" style="margin-bottom:5px" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                  <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1v6zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4H2z"/>
                  <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5zm0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7zM3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0z"/>
              </svg></i>
            </div>
            </div>
            <h5 class="my-3"><?php echo($name) ?></h5>
            <p class="text-muted mb-2"><?php echo($email) ?></p>
            <p class="text-muted mb-4"><?php echo($no) ?></p>
            <div style="height: 16px;"></div>
            <div class="help d-flex justify-content-center mb-2">
              <button name="upload" class="btn btn-primary ms-2">Upload Foto</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card mb-4">
          <div class="card-body">
            <div class="row">
              <div class="col-sm-3">
                <p class="fullname mb-0">Full Name</p>
              </div>
              <div class="col-sm-9">
                <p class="isiannama mb-0"><?php echo($name) ?></p>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <p class="email mb-0">Username</p>
              </div>
              <div class="col-sm-9">
                <p class="emailnya mb-0"><?php echo($uname) ?></p>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9">
                <p class="nohp mb-0"><?php echo($email) ?></p>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">Tanggal lahir</p>
              </div>
              <div class="col-sm-9">
                <p class="nohp mb-0"><?php echo date("d-m-Y", strtotime($tgl)); ?></p>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-3">
                <p class="mb-0">No telp</p>
              </div>
              <div class="col-sm-9">
                <p class="mb-0"><?php echo($no) ?></p>
              </div>
            </div>
            <hr />
            <div class="row">
              <div class="col-sm-12">
                <a class="btn btn-primary" target="__blank" href="setakun2.php?<?= $row["username"] ?>">Edit</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="help d-flex justify-content-center mb-2">
        <a class="btn btn-primary ms-2" target="__blank">About Us</a>
        <a name="hapus" type="button" class="btn btn-outline-primary ms-2" href="hapus.php?username=<?= $code ?>">Hapus Galang Dana</a>
        <a class="btn btn-outline-primary ms-2" target="__blank" href="logout.php">Logout</a>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    </div>
  </body>
</html>
