<?php
include "header.php";

if(!isset($_SESSION['lasmoid_absen_username'])){
?>
<br/><br/>
<table align="center" >
<tr><td align="center" colspan="2" class="kotak1">LOGIN SYSTEM :</td></tr>
<form action="" method="post">

<tr><td class="kotak1">Username :</td><td class="kotak"> <input type="text" name="username"/> </td></tr>
<tr><td class="kotak1">Password :</td><td class="kotak"> <input type="password" name="password"/> </td></tr>
<tr><td align="center" colspan="2" class="kotak"><input type="submit" name="submit"  value="LOGIN" /> <input type="reset" name="reset"  value="CANCEL" /></td></tr>
</form>

<?php
}
if(isset($_SESSION['lasmoid_absen_username'])){
header("location:pengaturan.php");
}

if (isset($_POST['submit']))
{
$username=strip_tags($_POST['username']);
$password=strip_tags($_POST['password']);
$username = $mysqli->real_escape_string($username);
$password = $mysqli->real_escape_string($password);
if($username == "" || $password == ""){
echo "Username atau Password anda masih kosong. silahkan ulangi .";
}else{
		$query=$mysqli->query("select * from user where username='$username' and password='$password'");
		$cek=$query->num_rows;
		if($cek > 0){
		$data=$query->fetch_array();
		
		$username=$data['username'];
		$_SESSION['lasmoid_absen_username']=$username;
			
header("location:pengaturan.php");
		}else{
echo "Anda Gagal Login";
		}
	}
	}
	
?>