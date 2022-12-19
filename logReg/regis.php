<?php
  include "../conf/koneksi.php";

  session_start();

  if(isset($_SESSION["loginUsername"])){
    header("location: ../homepage/index.php");
    exit;
  }

  if( isset($_POST["btnDaftar"])) {

    if(registrasi($_POST) > 0 ){
      echo "<script>
              alert('user baru berhasil ditambahkan'); 
              window.location.href = 'login.php';
            </script>";
    } else {
      echo mysqli_error($koneksi);
    }
  }

  function registrasi($data){
    global $koneksi;
  
    $nama = $data["nama"];
    $username = $data["username"];
    $tgl = $data["tgl"];
    $email = $data["email"];
    $no = $data["noPhone"];
    $password = mysqli_real_escape_string($koneksi,$data["password"]);
  
    $check = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    $check2 = mysqli_query($koneksi, "SELECT email FROM users WHERE email = '$email'");
  
    if(mysqli_fetch_assoc($check)){
      echo "<script> 
        alert('Username Sudah Terdaftar')	
      </script>";
  
      return false;
    } else if(mysqli_fetch_assoc($check2)){
      echo "<script> 
        alert('Email Sudah Terdaftar')	
      </script>";
  
      return false;
    }


  
    $password = password_hash($password, PASSWORD_DEFAULT);
  
    mysqli_query($koneksi,"INSERT INTO users VALUES ('$nama','$username','$tgl','$email','$no','$password')");
    
    mysqli_query($koneksi,"INSERT INTO profil VALUES ('','$username','nophotoo.png')");
  
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
    <title>Registration to website</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="logReg.css"  />
  </head>
  <body class="text-center">
    
    <main class="form-signin">
      <form method="post">
        <h1 class="h3 mb-3 fw-normal"><b>Daftar Akun</b></h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="nama" name="nama" required />
          <label for="nama">Masukkan Nama Lengkap</label>
        </div>
        <div class="form-floating">
          <input type="text" class="form-control" id="username" name="username" required />
          <label for="username">Masukkan Username</label>
        </div>
        <div class="form-floating">
          <input type="date" class="form-control" id="tgl" name="tgl" required />
          <label for="tgl" >Masukkan Tanggal Lahir</label>
        </div>
        <div class="form-floating">
          <input type="email" class="form-control" id="email" name="email" required  />
          <label for="email">Masukkan Email</label>
        </div>
        <div class="form-floating">
          <input type="tel" class="form-control" id="noPhone" name="noPhone" required />
          <label for="noPhone">Masukkan No Telephon</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" required />
          <label for="password">Masukkan Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary " type="submit" name="btnDaftar">Daftar</button>

        <a>Sudah punya akun ?</a><br />
        <a href="login.php" style="text-decoration: none; color: blue">Login disini</a>

        </div>
      </form>
    </main>
  </body>
</html>
