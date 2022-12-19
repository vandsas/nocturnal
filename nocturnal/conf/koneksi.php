<?php

//Inisiasi nilai-nilai paramater koneksi
$namaServer = "localhost"; // isikan sesuai nama server Anda
$namaPengguna = "root"; //isikan sesuai nama pengguna Basisdata Anda
$password = ""; //isikan sesuai password Anda
$nama_db = "nocturnal";
//Membuat koneksi
$koneksi = new mysqli($namaServer, $namaPengguna, $password, $nama_db);

function upload(){

    $namafile = $_FILES['gambar']['name'];
    $ukuranfile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

   if($error === 4){
      echo " <script> 
        alert('Pilih gambar terlebih dahulu');
      </script>";
      return false;
    }

    $ekstensiGambarValid = ['jpg','jpeg','png'];
    $ekstensiGambar = explode('.',$namafile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
      echo " <script> 
        alert('Harap upload gambar');
      </script>";
      return false;
    }

    if($ukuranfile > 3000000){
      echo " <script> 
        alert('Ukuran gambar terlalu besar');
      </script>";
      return false;
    }

    $namafilebaru = uniqid();
    $namafilebaru .= '.';
    $namafilebaru .= $ekstensiGambar;

    move_uploaded_file($tmpName, '../img/'. $namafilebaru);

    return $namafilebaru;

  }

?>
