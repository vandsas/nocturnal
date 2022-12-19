<?php

include "../conf/koneksi.php";

$username = $_GET["username"];

global $koneksi;
mysqli_query($koneksi, "DELETE FROM galangdana WHERE username = '$username'");

header("location: ../logReg/login.php");

return mysqli_affected_rows($koneksi);
?>
