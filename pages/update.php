<?php 
 
include '../koneksi.php';
$id = $_POST['id'];
$mapel = $_POST['mapel'];
$kkm = $_POST['kkm'];
 
mysqli_query($koneksi,"UPDATE kkmm SET  mata_pelajaran='$mapel', kkm='$kkm' WHERE id_mata_pelajaran='$id'") or die(mysqli_error($koneksi));
 
header("location:nilai_kkm.php");
?>