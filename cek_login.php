<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
 
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];
 
 
// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($koneksi,"Select * From user Where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan

$cek = mysqli_num_rows($login);
 
// cek apakah username dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai admin
	if($data['kd_level']=="1"){
 
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['kd_level'] = "1";
		// alihkan ke halaman dashboard admin
		header("location:halaman_admin.php");
 
	// cek jika user login sebagai pegawai
	}else if($data['kd_level']=="2"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['kd_level'] = "2";
		// alihkan ke halaman dashboard pegawai
		header("location:wali_kelas.php");
 
	// cek jika user login sebagai pengurus
	}else if($data['kd_level']=="3"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['kd_level'] = "3";
		// alihkan ke halaman dashboard pengurus
		header("location:wali_murid.php");

		// cek jika user login sebagai pengurus
	}else if($data['kd_level']=="4"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['kd_level'] = "4";
		// alihkan ke halaman dashboard pengurus
		header("location:kepala_sekolah.php");
 
	}else{
 
		// alihkan ke halaman login kembali
		header("location:halamanloginawal.php");
	}	
}else{
	echo"<script type='text/javascript'>alert('Password Salah')
	window.location.href ='halamanloginawal.php';</script>";
}
 
?>