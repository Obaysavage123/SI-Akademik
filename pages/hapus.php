<?php 
session_start();
include "./../koneksi.php";
 
// menangkap data id yang di kirim dari url
$data = $_GET['id'];
 
 
// menghapus data dari database
mysqli_query($koneksi,"DELETE FROM `kkmm` WHERE id_mata_pelajaran=$data");
 
// mengalihkan halaman kembali ke index.php
header("location:nilai_kkm.php");
 
?>