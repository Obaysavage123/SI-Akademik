a' WHERE id_style='1'");
header("location:pengaturan.php");
}
?><?php
include "header.php";
if(!isset($_SESSION['lasmoid_absen_username'])){
header("location:index.php");
}

echo "<table style='border:none;' width='100%'>";
echo "<tr><td align='center' valign='top'>";

echo "<table style='border:none;'>";
echo "<tr><td align='center' valign='top'>";
echo "<form action='' method='post'>";
echo "<table style='border:none;'>";
echo "<tr><td align='center' valign='top'>";
echo "<table style='border:none;'><tr><td class='kotak1' colspan='2'>WAKTU ABSEN</td></tr>";
echo "<tr><td class='kotak1'>JAM BUKA ABSEN</td><td class='kotak'><input type='text' name='jambuka' /></td></tr>";
echo "<tr><td class='kotak1'>JAM STANDARD ABSEN</td><td class='kotak'><input type='text' name='jamstandard' /></td></tr>";
echo "<tr><td class='kotak1'>JAM TUTUP ABSEN</td><td class='kotak'><input type='text' name='jamtutup' /></td></tr>";
echo "<tr><td class='kotak' colspan='2'><input type='submit' name='tambahwaktu' value='TAMBAH' /></td></tr>";
echo "</table>";
echo "</form>";
echo "</td></tr>";
echo "<tr><td align='center' valign='top'>";
echo "<table style='border:none;'><tr><td class='kotak1'>JAM BUKA ABSEN</td><td class='kotak1'>JAM STANDARD ABSEN</td><td class='kotak1'>JAM TUTUP ABSEN</td><td class='kotak1'>OPTION</td></tr>";
$result = $mysqli->query("select * from jam_klik order by id_jam_klik DESC");
	while($data = $result->fetch_array()){
	echo "<tr><td class='kotak'>{$data['jam_awal']}</td><td class='kotak'>{$data['jam_std']}</td><td class='kotak'>{$data['jam_akhir']}</td><td class='kotak'><a href='?deletewaktu={$data['id_jam_klik']}' onclick=\"return confirm('Apakah Anda Yakin Untuk Menghapus ?')\">Delete</a></td></tr>";
	}
echo "</table>";
echo "</td></tr></table>";
echo "</td></tr></table>";
	if (isset($_POST['tambahwaktu']))
{
$jambuka = addslashes($_POST['jambuka']);
$jamstandard = addslashes($_POST['jamstandard']);
$jamtutup = addslashes($_POST['jamtutup']);
if ($jambuka=="" || $jamstandard=="" || $jamtutup=="")
	{
	echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{

$quer = $mysqli->query("INSERT INTO jam_klik (jam_awal,jam_std,jam_akhir) VALUES ('$jambuka','$jamstandard','$jamtutup')");
header("location:pengaturan.php");

}
}
if (isset($_GET['deletewaktu']))
{
	$id = addslashes($_GET['deletewaktu']);
	$quer = $mysqli->query("DELETE FROM jam_klik WHERE id_jam_klik = '$id'");
	header("location:pengaturan.php");
}

echo "</td><td align='center' valign='top'>";
// ip akses
echo "<table style='border:none;'>";
echo "<tr><td align='center' valign='top'>";
echo "<form action='' method='post'>";
echo "<table style='border:none;'>";
echo "<tr><td align='center' valign='top'>";
echo "<table style='border:none;'><tr><td class='kotak1' colspan='2'>IP AKSES ABSEN</td></tr>";
echo "<tr><td class='kotak1'>IP</td><td class='kotak'><input type='text' name='ip' /></td></tr>";
echo "<tr><td class='kotak' colspan='2'><input type='submit' name='tambahip' value='TAMBAH' /></td></tr>";
echo "</table>";
echo "</form>";
echo "</td></tr>";
echo "<tr><td align='center' valign='top'>";
echo "<table style='border:none;'><tr><td class='kotak1'>IP</td><td class='kotak1'>OPTION</td></tr>";
$result = $mysqli->query("select * from akses order by id_akses DESC");
	while($data = $result->fetch_array()){
	echo "<tr><td class='kotak'>{$data['ip']}</td><td class='kotak'><a href='?deleteip={$data['id_akses']}' onclick=\"return confirm('Apakah Anda Yakin Untuk Menghapus {$data['ip']} ?')\">Delete</a></td></tr>";
	}
echo "</table>";

echo "</td></tr></table>";
	if (isset($_POST['tambahip']))
{
$ip = addslashes($_POST['ip']);
if ($ip=="")
	{
	echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{

$quer = $mysqli->query("INSERT INTO akses (ip) VALUES ('$ip')");
header("location:pengaturan.php");

}
}
if (isset($_GET['deleteip']))
{
	$id = addslashes($_GET['deleteip']);
	$quer = $mysqli->query("DELETE FROM akses WHERE id_akses = '$id'");
	header("location:pengaturan.php");
}

echo "</td><td align='center' valign='top'>";


// jumlah baris
echo "<table style='border:none;'>";
echo "<tr><td align='center' valign='top'>";

$result = $mysqli->query("select * from pengaturan WHERE id_pengaturan='1'");
	$data = $result->fetch_array();
echo "<form action='' method='post'>";
echo "<table style='border:none;'><tr><td class='kotak1' colspan='2'>BARIS FOTO DI ABSENSI</td></tr>";
echo "<tr><td class='kotak1'>JUMLAH</td><td class='kotak'><input type='text' name='jumlahbaris' value='".htmlentities($data['jml_baris'],ENT_QUOTES)."'/></td></tr>";
echo "<tr><td class='kotak' colspan='2'><input type='submit' name='editjumlahbaris' value='SET' /></td></tr>";
echo "</table>";
echo "</form>";
echo "</td></tr></table>";
	if (isset($_POST['editjumlahbaris']))
{
$jumlahbaris = addslashes($_POST['jumlahbaris']);
if ($jumlahbaris=="")
	{
	echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{
if ($jumlahbaris < 1)
	{
	echo "<script language=\"javascript\">";
echo "window.alert(\"Jumlah Tidak Boleh Diisi Dengan 0\")";
echo "</script>";
}else{
$quer = $mysqli->query("UPDATE pengaturan SET jml_baris='$jumlahbaris' WHERE id_pengaturan='1'");
header("location:pengaturan.php");
}
}
}

echo "</td></tr><tr><td align='center' valign='top' colspan='2'>";
if (file_exists('gbr/background.jpg'))
{
$background = "gbr/background.jpg";
}else{
$background = "gbr/foto.jpg";
}
echo "<table style='border:none;'>";
echo "<tr><td class='kotak1' colspan='3'>BACKGROUND</td></tr>";
echo "<tr><td class='kotak'><img src='$background' width='100' height='100'/></td><td class='kotak'><form action='' method='post' enctype='multipart/form-data' style='padding:0;margin:0;'><input type='file' name='file' /><input type='submit' name='uploadbackground' value='UPLOAD' /></form></td><td class='kotak'><a href='?deletebackground=' onclick=\"return confirm('Apakah Anda Yakin Untuk Menghapus Background ?')\">Delete</a></td></tr>";
echo "</table>";

//text
echo "</td></tr><tr><td align='center' valign='top' colspan='2'>";
$result = $mysqli->query("select * from style WHERE id_style='1'");
	$data = $result->fetch_array();
echo "<form action='' method='post'>";
echo "<table style='border:none;'>";
echo "<tr><td class='kotak1' colspan='2'>WARNA TEXT</td></tr>";
echo "<tr><td class='kotak'><input type='text' name='warna' value='".htmlentities($data['nilai'],ENT_QUOTES)."'/></td><td class='kotak'><input type='submit' name='setwarnatext' value='SET' /></td></tr>";
echo "</table>";
echo "</form>";
echo "</td></tr></table>";

echo "</td></tr></table>";


// background


if (isset($_POST['uploadbackground']))
{
$image =$_FILES["file"]["name"];
$file_size = $_FILES['file']['size'];

if ($image=="")
	{
	echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{

 function getExtension($str) {
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
$image =$_FILES["file"]["name"];
$uploadedfile = $_FILES['file']['tmp_name'];
$filename = stripslashes($_FILES['file']['name']);
$extension = getExtension($filename);
$extension = strtolower($extension);

$newfilename = 'background.jpg';

if ( ($extension == "jpg") || ($extension == "png")){
if($extension == "png")
{
$src = imagecreatefrompng($uploadedfile);
}else{
$src = imagecreatefromjpeg($uploadedfile);
}
list($width,$height)=getimagesize($uploadedfile);
if ($width > $height) {
$newwidth=1500;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);
}else{
$newheight=700;
$newwidth=($width/$height)*$newheight;
$tmp=imagecreatetruecolor($newwidth,$newheight);
}
imagefilledrectangle($tmp, 0, 0, $newwidth, $newheight, imagecolorallocate($tmp, 255, 255, 255));
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = "gbr/". $newfilename;

imagejpeg($tmp,$filename,100);
imagedestroy($src);
imagedestroy($tmp);

header("location:pengaturan.php");
}else{
echo "<script language=\"javascript\">";
echo "window.alert(\"EXTENSION FILE SALAH\")";
echo "</script>";
}
}
}

if (isset($_GET['deletebackground']))
{
	unlink("gbr/background.jpg");
	header("location:pengaturan.php");
}

if (isset($_POST['setwarnatext']))
{
$warna = addslashes($_POST['warna']);
$quer = $mysqli->query("UPDATE style SET nilai='$warna'");