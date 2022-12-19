<?php
session_start();
$_SESSION = [];
session_unset();
session_destroy();

// setcookie('login','',time()-86500);

header("location: ../homepage/index.php");
return mysqli_affected_rows($koneksi);

?>
