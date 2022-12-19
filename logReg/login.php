<?php
  include "../conf/koneksi.php";
  
  session_start();

  // if( isset($_COOKIE["login"])){
  //   if($_COOKIE["login"] == 'true'){
  //     $_SESSION["loginUsername"] = $username;
  //   }
  // }

  if(isset($_SESSION["loginUsername"])){
    header("location: ../homepage/index.php");
    exit;
  }

  if(isset($_POST["btnLogin"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $check = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");

    if(mysqli_num_rows($check) === 1 ){

      $row = mysqli_fetch_assoc($check);

      if (password_verify($password,$row["password"])){

        setcookie('login','true',time()+86400);

        $_SESSION["loginUsername"] = $username;

        header("location: ../homepage/index.php");
        exit;
      }
    }

    $error = true;
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
    <title>Login to website</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/" />

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="logReg.css"  />
  </head>
  <body class="text-center">

    <main class="form-signin">
      <form method="post">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
        </svg>

        <h1 class="h3 mb-3 fw-normal"><b>Login</b></h1>

        <div class="form-floating">
          <input type="text" class="form-control" id="username" name="username" required placeholder="username anda" />
          <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" id="password" name="password" required placeholder="password anda" />
          <label for="password">Password</label>
        </div>

      <?php if(isset($error)) : ?>
        <p style="color:red; font:italic;"> Username atau Password Salah !!!</P>
      <?php endif ; ?>
        
        <button class="w-100 btn btn-lg btn-primary " type="submit" name="btnLogin">Login</button>

        <a>Belum punya akun ?</a><br />
        <a href="regis.php" style="text-decoration: none; color: blue">Daftar disini</a>

        <br /><br />
        <hr style="border: 3px solid #ffffff" />

        <a>Atau</a><br> 
        <a> login dengan</a><br />

        <div class="logbutton">
          <a href="https://m.facebook.com/login/?locale=id_ID&refsrc=deprecated" class="loginItem bg1">
            <img src="https://www.freepnglogos.com/uploads/facebook-logo-icon/facebook-logo-icon-facebook-icon-png-images-icons-and-png-backgrounds-1.png" class="bgbutf"></i>
          </a>

          <a href="https://twitter.com/i/flow/login" class="loginItem bg2">
            <img src="https://www.freepnglogos.com/uploads/twitter-logo-png/twitter-logo-in-blue-circle-design-twitter-icon-15.png" class="bgbutf"></img>
          </a>

          <a href="https://accounts.google.com/login?hl=id" class="loginItem bg1">
            <img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-png-suite-everything-you-need-know-about-google-newest-0.png" class="bgbut"></i>
          </a>
        </div>
      </form>
    </main>
  </body>
</html>
