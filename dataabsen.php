<?php
include "header.php";
if(!isset($_SESSION['lasmoid_absen_username'])){
header("location:index.php");
}
echo "<br/><center>";
if ((!isset($_GET['delete'])) && (!isset($_GET['edit'])))
{
echo "<form action='' method='post'>";
echo "<table><tr><td class='kotak1' colspan='2'>TAMBAH ABSEN</td></tr>";
echo "<tr><td class='kotak1'>NIS SISWA</td><td class='kotak'><input type='text' name='id_anggota' /></td></tr>";
echo "<tr><td class='kotak1'>TANGGAL</td><td class='kotak'><input type='text' name='tanggal' id='tanggal'/></td></tr>";
//echo "<tr><td class='kotak1'>JAM</td><td class='kotak'><input type='text' name='jam' /></td></tr>";
echo "<tr><td class='kotak' colspan='2'><input type='submit' name='tambah' value='TAMBAH' /></td></tr>";
echo "</table>";
echo "</form>";
?>
<script type="text/javascript">
 calendar.set("tanggal");
 </script>
 <?php
echo "<table width='100%'>";
$result = $mysqli->query("select * from absen INNER JOIN anggota ON anggota.id_anggota = absen.id_anggota order by absen.id_absen DESC");
$row = $result->num_rows;
	if($row > 0){
	$limit = 50;
	$result = $mysqli->query("select count(*) from absen INNER JOIN anggota ON anggota.id_anggota = absen.id_anggota");
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
echo "<tr><td class='kotak1'>NIS SISWA</td><td class='kotak1'>NAMA SISWA</td><td class='kotak1'>TANGGAL</td><td class='kotak1'>OPTION</td></tr>";
	$result = $mysqli->query("select * from absen INNER JOIN anggota ON anggota.id_anggota = absen.id_anggota order by absen.id_absen DESC limit {$start}, {$limit}");
	while($data = $result->fetch_array()){
$id_anggota = $data['id_anggota'];
$id_absen = $data['id_absen'];
$nama_anggota = strtoupper($data['nama_anggota']);
$tanggal = strtoupper($data['tanggal']);
//$jam = strtoupper($data['jam']);

echo "<tr><td class='kotak'>$id_anggota</td><td class='kotak'>$nama_anggota</td><td class='kotak'>$tanggal<td class='kotak'><a href='?delete=$id_absen' onclick=\"return confirm('Apakah Anda Yakin Untuk Menghapus $nama_anggota ?')\">Delete</a> | <a href='?edit=$id_absen' onclick=\"return confirm('Apakah Anda Yakin Untuk Mengubah $nama_anggota ?')\">Edit</a></td></tr>";

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
	

	if (isset($_POST['tambah']))
{
$id_anggota = addslashes($_POST['id_anggota']);
$tanggal = addslashes($_POST['tanggal']);
//$jam = addslashes($_POST['jam']);

if ($id_anggota=="" || $tanggal=="" )
	{
echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{
$result = $mysqli->query("select id_anggota from anggota WHERE id_anggota='$id_anggota'");
 $row = $result->num_rows;
 $data = $result->fetch_array();
 if ($row > 0)
 {
 $absen = $data['id_anggota'];
$cek = cekabsen($absen,$tanggal,$mysqli);
if($cek > 0)
{
echo "<script language=\"javascript\">";
echo "window.alert(\"SUDAH ABSEN\")";
echo "</script>";
}else{
$querupdate = $mysqli->query("INSERT INTO absen (id_anggota,tanggal,jam) VALUES ('$absen','$tanggal','$jam')");
header("location:dataabsen.php");
}
}else{
echo "<script language=\"javascript\">";
echo "window.alert(\"ID Tidak Terdaftar\")";
echo "</script>";
}
}
}

	if ((isset($_GET['edit'])) && (!isset($_GET['delete'])))
{
	$id = addslashes($_GET['edit']);
	$result = $mysqli->query("select * from absen INNER JOIN anggota ON anggota.id_anggota = absen.id_anggota WHERE absen.id_absen='$id'");
	$data = $result->fetch_array();
	echo "<form action='' method='post'>";
	echo "<input type='hidden' name='id_absen' value='{$data['id_absen']}' /><input type='hidden' name='id_anggota' value='{$data['id_anggota']}' />";
echo "<table><tr><td class='kotak1' colspan='2'>EDIT ABSEN ( {$data['nama_anggota']} )</td></tr>";
echo "<tr><td class='kotak1'>TANGGAL</td><td class='kotak'><input type='text' name='tanggal' value='".htmlentities($data['tanggal'],ENT_QUOTES)."' id='tanggaledit'/></td></tr>";
//echo "<tr><td class='kotak1'>JAM</td><td class='kotak'><input type='text' name='jam' value='".htmlentities($data['jam'],ENT_QUOTES)."'/></td></tr>";
echo "<tr><td class='kotak' colspan='2'><input type='submit' name='editmember' value='EDIT' /></td></tr>";
echo "</table>";
echo "</form>";
	?>
<script type="text/javascript">
 calendar.set("tanggaledit");
 </script>
 <?php
	}

if (isset($_POST['editmember']))
{
$tanggal = addslashes($_POST['tanggal']);
// $jam = addslashes($_POST['jam']);
$id_absen = addslashes($_POST['id_absen']);
$id_anggota = addslashes($_POST['id_anggota']);
if ($tanggal=="" || $jam=="" || $id_absen=="")
	{
echo "<script language=\"javascript\">";
echo "window.alert(\"Masih Ada Data Yang Kosong, Silahkan Ulangi Lagi\")";
echo "</script>";
}else{
$result = $mysqli->query("select id_absen from absen WHERE tanggal='$tanggal' AND id_anggota='$id_anggota' AND id_absen <> '$id_absen'");
 $row = $result->num_rows;
 $data = $result->fetch_array();
 if ($row > 0)
 {
 echo "<script language=\"javascript\">";
echo "window.alert(\"$tanggal SUDAH ABSEN\")";
echo "</script>";
 }else{
$quer = $mysqli->query("UPDATE absen SET tanggal='$tanggal',jam='$jam' WHERE id_absen='$id_absen'");
header("location:dataabsen.php");
}
}
}
	
	if ((isset($_GET['delete'])) && (!isset($_GET['edit'])))
{
	$id = addslashes($_GET['delete']);
	$quer = $mysqli->query("DELETE FROM absen WHERE id_absen = '$id'");
	header("location:dataabsen.php");
}
	
	?>