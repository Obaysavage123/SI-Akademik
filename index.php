<?php
include "header.php";
$ip_akses = $_SERVER['REMOTE_ADDR'];    
$ip_akses = ip_akses($ip_akses,$mysqli);

if ($ip_akses == 0)
{
header("location:absen.php");
}


$jam = time()+25200;
$jam = addslashes(gmdate("H:i:s",$jam));


$tanggalproses = date("Y-m-d",time()-3600);

echo "<table style='border:none;' width='100%'>";

$result = $mysqli->query("select * from anggota order by id_anggota ASC");
$no = 1;
// while ($hasil = $result->fetch_array())
// {
// $id_anggota = $hasil['id_anggota'];
// $nama_anggota = $hasil['nama_anggota'];

// if ($no % $jml_baris == 1)
// {
// echo "<tr><td>";
// foto($id_anggota,$tanggalproses,$mysqli);
// echo "</td>";
// }else if ($no % $jml_baris == 0)
// {
// echo "<td>";
// foto($id_anggota,$tanggalproses,$mysqli);
// echo "</td></tr>";
// }else{
// echo "<td>";
// foto($id_anggota,$tanggalproses,$mysqli);
// echo "</td>";
// }
// $no++;
// }

echo "</table>";

if (isset($_GET['absen']))
{
$ip_akses = $_SERVER['REMOTE_ADDR'];    
$ip_akses = ip_akses($ip_akses,$mysqli);
if ($ip_akses >= 0)
{
$absen = addslashes($_GET['absen']);
$jam = time()+25200;
$jam = addslashes(gmdate("H:i:s",$jam));
$tanggalproses = date("Y-m-d",time()-3600);
if($absen=="")
{
echo "<script language=\"javascript\">";
echo "window.alert(\"DATA KOSONG\")";
echo "</script>";
}else{
$cek = cekabsen($absen,$tanggalproses,$mysqli);
if($cek > 0)
{
echo "<script language=\"javascript\">";
echo "window.alert(\"SUDAH ABSEN\")";
echo "</script>";
}else{
$cekjam = 0;
$pengaturanjam = $mysqli->query("select * from jam_klik");
while ($hasilpengaturanjam = $pengaturanjam->fetch_array())
{
if (((strtotime($jam)) <= (strtotime("{$hasilpengaturanjam['jam_akhir']}"))) && ( (strtotime($jam)) >= (strtotime("{$hasilpengaturanjam['jam_awal']}"))))
{
$cekjam = $cekjam + 1;
}
}
if ($cekjam >= 1)
{
$querupdate = $mysqli->query("INSERT INTO absen (id_anggota,tanggal,jam) VALUES ('$absen','$tanggalproses','$jam')");
}

header("location:index.php");

}
}
}
}
?>