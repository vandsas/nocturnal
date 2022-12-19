<?php
  include "../conf/koneksi.php";

  session_start();

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
      
  }

  if( isset($_POST["btnUpdate"])) {

    if(ubah($_POST) >= 0 ){
      echo "<script>
              alert('Data user berhasil diubah'); 
              window.location.href = 'setakun.php';
            </script>";
    } else {
      echo mysqli_error($koneksi);
    }
  }

  function ubah($data){
    global $koneksi;
    $loginUsername = $_SESSION["loginUsername"];
  
    $nama = $data["nama"];
    $username = $data["username"];
    $tgl = $data["tgl"];
    $email = $data["email"];
    $no = $data["noPhone"];

    if($tgl == '30-11--0001'){
      $result = mysqli_query($koneksi, "SELECT tgl_lahir FROM users WHERE username = '$loginUsername'");
      $tgl = $data["$result"];
    }
  
    mysqli_query($koneksi,"UPDATE users SET nama = '$nama',
                                  tgl_lahir = '$tgl',
                                  no_tlpn = '$no' 
                                  WHERE username = '$loginUsername' ");

    $_SESSION["loginUsername"] = $username;
  
    return mysqli_affected_rows($koneksi);
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
    <link rel="stylesheet" href="setakun2.css" />
    <title>Setting Akun</title>
  </head>
  <body>
    <header class="header text-center">
      <div style="float: left">
        <button style="background-color: transparent; border-style: none; color: white; font-size: 30px; margin-left: 15px; width: 10px">
          <a style="text-decoration: none; color: white" href="setakun.php"><</a>
        </button>
      </div>
      <span style="color: white; font-size: 25px; margin-left: -30px">Akun Setting</span>
    </header>
    <br />

    <form method="post">
    <div class="editakun row">
      <div class="col-lg-4">
        <div class="card mb-4">
          <div class="card-body text-center">
            <img src="../img/<?= $profil; ?>"  alt="avatar" class="rounded-circle img-fluid" style="width: 150px" />
            <h5 class="my-3"><?php echo($name) ?></h5>
            <p class="text-muted mb-2"><?php echo($email) ?></p>
            <p class="text-muted mb-4"><?php echo($no) ?></p>
            <div style="height: 22px;"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-8">
        <div class="card">
          <div class="card-body">
            <div class="row mb-3">
              <div class="col-sm-3">
                <p class="mb-0">Full Name</p>
              </div>
              <div class="col-sm-9 text-secondary">
                <input name="nama" type="text" class="form-control" value="<?php echo $name ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <p class="mb-0">Username</p>
              </div>
              <div class="col-sm-9 text-secondary">
                <input name="username" type="text" class="form-control" value="<?php echo $uname ?> " readonly/>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <p class="mb-0">Email</p>
              </div>
              <div class="col-sm-9 text-secondary">
                <input name="email" type="text" class="form-control" value="<?php echo $email ?>" readonly/>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <p class="mb-0">Tgl Lahir</p>
              </div>
              <div class="col-sm-9 text-secondary">
                <input name="tgl" type="date" class="form-control" value="<?php echo date("d-m-Y", strtotime($tgl)); ?>" />
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <p class="mb-0">No telp</p>
              </div>
              <div class="col-sm-9 text-secondary">
                <input name="noPhone" type="text" class="form-control" value="<?php echo $no ?>" />
              </div>
            </div>
            <div class="row">
              <div class="col-sm-3"></div>
              <div class="col-sm-9 text-secondary">
                <button id="btnUpdate" name="btnUpdate" type="submit" class="btn btn-primary">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>
