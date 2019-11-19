<?php 
include '../koneksi.php';
$mapel = $_POST['mapel'];
$kkm = $_POST['kkm'];
 
mysqli_query($koneksi,"INSERT INTO kkmm VALUES('','$mapel','$kkm')");
 
header("location:nilai_kkm.php");
?>