<?php
include "header.php";
if(!isset($_SESSION['lasmoid_absen_username'])){
header("location:index.php");
}
echo "<br/><center>";
if ((!isset($_GET['delete'])) && (!isset($_GET['edit'])))
{
echo "<form action='' method='post'>";
echo "<table><tr><td class='kotak1' colspan='2'>TAMBAH SISWA</td></tr>";
echo "<tr><td class='kotak1'>NAMA</td><td class='kotak'><input type='text' name='nama_anggota' /></td></tr>";
echo "<tr><td class='kotak' colspan='2'><input type='submit' name='tambah' value='TAMBAH' /></td></tr>";
echo "</table>";
echo "</form>";
echo "<table width='100%'>";
$result = $mysqli->query("select * from anggota order by id_anggota ASC");
$row = $result->num_rows;
	if($row > 0){
	$limit = 50;
	$result = $mysqli->query("select count(*) from anggota");
	$row = $result->fetch_array();
	$totalrecord = $row[0];
	
	$totalpage = $totalrecord/$limit;
	if((int)$totalpage < $totalpage) $totalpage = (int)$totalpage+1;
	
	if(!isset($_GET['page'])){ 
		$page = 1;
		$start = 0;
	}else{
		if($_GET['page'] > $totalpage){
			$page = $totalpage;
		}else{
			$page = $_GET['page'];
		}
		$start = $limit * ($page-1);
	}
echo "<tr><td class='kotak1'>NIS SISWA</td><td class='kotak1'>NAMA SISWA</td><td class='kotak1'>FOTO</td><td class='kotak1'>UPLOAD FOTO</td><td class='kotak1'>OPTION</td></tr>";
	$result = $mysqli->query("select * from anggota order by id_anggota DESC limit {$start}, {$limit}");
	while($data = $result->fetch_array()){
$id_anggota = $data['id_anggota'];
$nama_anggota = strtoupper($data['nama_anggota']);
if (file_exists('gbr/'.$id_anggota.'.jpg'))
{
$foto = "gbr/".$id_anggota.".jpg";
}else{
$foto = "gbr/foto.jpg";
}
echo "<tr><td class='kotak'>$id_anggota</td><td class='kotak'>$nama_anggota</td><td class='kotak'><img src='$foto' alt='$nama_anggota' width='70' height='70'/></td><td class='kotak'><form action='' method='post' enctype='multipart/form-data' style='padding:0;margin:0;'><input type='hidden' name='id_anggota' value='$id_anggota'/><input type='file' name='file' /><input type='submit' name='submit' value='UPLOAD' /></form></td><td class='kotak'><a href='?delete=$id_anggota' onclick=\"return confirm('Apakah Anda Yakin Untuk Menghapus $nama_anggota ?')\">Delete</a> | <a href='?edit=$id_anggota' onclick=\"return confirm('Apakah Anda Yakin Untuk Mengubah $nama_anggota ?')\">Edit</a></td></tr>";

}

echo "</table></center>";
echo("<center>");
$bilangan = 1;
while ($bilangan <= $totalpage)
{
echo("<a href='?page=$bilangan'><font color='red'>$bilangan</font></a> ");
$bilangan++;
}
echo("<br/>");
	if($page<=1){
		echo("&lt;&lt;Prev | ");
	}else{
		$prev = $page-1;
		echo("<a href='?page={$prev}'><font color='red'>&lt;&lt;Prev</font></a> | ");
	}
	
	
	if($page>=$totalpage){
		echo("Next&gt;&gt;");
	}else{
		$next = $page+1;
		echo("<a href='?page={$next}'><font color='red'>Next&gt;&gt;</font></a>");
	}
	echo("</center>");
	}
	}
	
	if ((isset($_GET['edit'])) && (!isset($_GET['delete'])))
{
	$id = addslashes($_GET['edit']);
	$result = $mysqli->query("select * from anggota WHERE id_anggota='$id'");
	$data = $result->fetch_array();
	echo "<form action='' method='post'>";
	echo "<input type='hidden' name='id_anggota' value='{$data['id_anggota']}' />";
echo "<table><tr><td class='kotak1' colspan='2'>EDIT MEMBER</td></tr>";
echo "<tr><td class='kotak1'>NAMA</td><td class='kotak'><input type='text' name='nama_anggota' value='".htmlentities($data['nama_anggota'],ENT_QUOTES)."'/></td></tr>";
echo "<tr><td class='kotak' colspan='2'><input type='submit' name='editmember' value='EDIT' /></td></tr>";
echo "</table>";
echo "</form>";
	
	}
	
	
	if (isset($_POST['submit']))
{
$id_anggota = addslashes($_POST['id_anggota']);
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

$newfilename = $id_anggota . '.jpg';

if ( ($extension == "jpg") || ($extension == "png")){
if($extension == "png")
{
$src = imagecreatefrompng($uploadedfile);
}else{
$src = imagecreatefromjpeg($uploadedfile);
}
list($width,$height)=getimagesize($uploadedfile);
if ($width > $height) {
$newwidth=100;
$newheight=($height/$width)*$newwidth;
$tmp=imagecreatetruecolor($newwidth,$newheight);
}else{
$newheight=133;
$newwidth=($width/$height)*$newheight;
$tmp=imagecreatetruecolor($newwidth,$newheight);
}
imagefilledrectangle($tmp, 0, 0, $newwidth, $newheight, imagecolorallocate($tmp, 255, 255, 255));
imagecopyresampled($tmp,$src,0,0,0,0,$newwidth,$newheight,$width,$height);
$filename = "gbr/". $newfilename;

imagejpeg($tmp,$filename,100);
imagedestroy($src);
imagedestroy($tmp);

header("location:anggota.php");
}else{
echo "<script language=\"javascript\">";
echo "window.alert(\"EXTENSION FILE SALAH\")";
echo "</script>";
}
}
}
	
	
	if (isset($_POST['tambah']))
{
$nama_anggota = addslashes($_POST['nama_anggota']);
if ($nama_anggota=="")
	{
	echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{
$quer = $mysqli->query("INSERT INTO anggota (nama_anggota) VALUES ('$nama_anggota')");
header("location:anggota.php");

}
}

if (isset($_POST['editmember']))
{
$nama_anggota = addslashes($_POST['nama_anggota']);
$id_anggota = addslashes($_POST['id_anggota']);
if ($nama_anggota=="" || $id_anggota=="")
	{
	echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{

$quer = $mysqli->query("UPDATE anggota SET nama_anggota='$nama_anggota' WHERE id_anggota='$id_anggota'");
header("location:anggota.php");

}
}
	
	if ((isset($_GET['delete'])) && (!isset($_GET['edit'])))
{
	$id = addslashes($_GET['delete']);
	$quer = $mysqli->query("DELETE FROM anggota WHERE id_anggota = '$id'");
	header("location:anggota.php");
}
	
	?>