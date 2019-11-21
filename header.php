<?php ob_start();
//error_reporting(0);
session_start();
include "konek.php";
include "func.php";
echo "<link rel='stylesheet' type='text/css' href='lasmoid.css'>";
echo "<script type='text/javascript' src='calendar.js'></script>";
echo "<title>ABSENSI</title>";
echo "<body>";
if (file_exists('gbr/background.jpg'))
{
?>
<style type="text/css">
body { 
  background: url(gbr/background.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
</style>
<?php
}

$style = $mysqli->query("select * from style where deskripsi='warnatext'");
$datastyle = $style->fetch_array();
$warna = $datastyle['nilai'];
if ($warna !="")
{
?>

<?php
}

// $pengaturan = $mysqli->query("select jml_baris from pengaturan where id_pengaturan='1'");
// $hasilpengaturan = $pengaturan->fetch_array();
// $jml_baris = $hasilpengaturan['jml_baris'];

echo "<table bgcolor='#645DB5' width='100%' cellpadding='0' cellspacing='0' ><tr><td>
<ul class='lasmoid'>
  <li class='lasmoid'><a href='absen.php'>DATA ABSENSI</a></li>
 ";
 if(!isset($_SESSION['lasmoid_absen_username'])){
 echo "<li class='lasmoid'><a href='admin.php'>ADMIN</a></li>";
 }
 if(isset($_SESSION['lasmoid_absen_username'])){
echo "<li class='lasmoid'><a href='anggota.php'>DATABASE SISWA</a></li><li class='lasmoid'><a href='dataabsen.php'>DATABASE ABSEN</a></li><li class='lasmoid'><a href='pengaturan.php'>PENGATURAN</a></li><li class='lasmoid'><a href='logout.php'>LOGOUT</a></li>";
}
echo "</ul></table>";
echo "<center>";
waktu_reloadindex();
echo "</center>";
?>