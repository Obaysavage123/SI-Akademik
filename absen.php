<?php
include "header.php";

?>
</script>
<center><form action="" method="GET">
DATE : <input type="text" name="tanggalproses" id="tanggalproses"/>
 <script type="text/javascript">
 calendar.set("tanggalproses");
 </script>
 <input type="submit" name="view" value="VIEW"/>
 </form></center>
 
 <?php
if (!isset($_GET['tanggalproses']))
{
$jam = time()+25200;
$jam = addslashes(gmdate("H:i:s",$jam));
$tanggalproses = date("Y-m-d",time()-3600);
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
echo "<meta http-equiv='refresh' content='10'>";
}
}
if (isset($_GET['tanggalproses']))
{
$tanggalproses = addslashes($_GET['tanggalproses']);
}


// echo "<center><table style='border:none;' width='100%'><tr><td valign='top' width='30%'>";
// echo "<table style='border:none;' width='100%'><tr><td class='kotak2' colspan='4'>$tanggalproses</td></tr><tr><td class='kotak2'>NO</td><td class='kotak2'>NAMA</td><td class='kotak2'>TANGGAL</td><td class='kotak2'>JAM</td></tr>";
$no = 1;
$jam_absen = array();
$quera = $mysqli->query("select * from anggota order by id_anggota ASC");
while ($hasila = $quera->fetch_array())
{
$id_anggota = $hasila['id_anggota'];
$nama_[$no] = $hasila['nama_anggota'];

$quer = $mysqli->query("select * from absen where tanggal='$tanggalproses' AND id_anggota='$id_anggota'");
$hasil = $quer->fetch_array();
$jam_absen[$no] = $hasil['jam'];
$no ++;
}

for ($a=1;$a<$no;$a++){
for ($b=$a;$b<$no;$b++){
if ($jam_absen[$b] != ""){
if ($jam_absen[$b] < $jam_absen[$a] || $jam_absen[$a] == ""){
$tmp = $jam_absen[$b];
$tmp1 = $nama_anggota[$b];

$jam_absen[$b] = $jam_absen[$a];
$nama_anggota[$b] = $nama_anggota[$a];

$jam_absen[$a] = $tmp;
$nama_anggota[$a] = $tmp1;
}
}
}
}
for ($c=1;$c<$no;$c++){
if ($jam_absen[$c]  == "" || $jam_absen[$c] == "00:00:00")
{
$jam_absen[$c] = "-";
$bg = " style='color:#FFFFFF;' bgcolor='#FF4848'";
}else{
$cekjamstd = 0;
$pengaturanjamstd =$mysqli->query("select * from jam_klik");
while ($hasilpengaturanjamstd = $pengaturanjamstd->fetch_array())
{
if (((strtotime($jam_absen[$c])) <= (strtotime("{$hasilpengaturanjamstd['jam_std']}"))) && ( (strtotime($jam_absen[$c])) >= (strtotime("{$hasilpengaturanjamstd['jam_awal']}"))))
{
$cekjamstd = $cekjamstd + 1;
}
}

if ($cekjamstd >= 1)
{
$bg = "bgcolor='#51FF51'";
}else{
$bg = "bgcolor='#FFFF6C'";
}
}
// echo "<tr class='sort'><td class='kotak3'>$c</td><td class='kotak3' $bg>$nama_anggota[$c]</td><td class='kotak3'>$tanggalproses</td><td class='kotak3'>$jam_absen[$c]</td></tr>";
}
echo "</table>";


echo "</td><td valign='top' width='70%'>";


$tanggalskr = $tanggalproses;
$tgl = explode("-",$tanggalskr);
$wulan = $tgl[1];
$tgl_awal = $tgl[0]."-".$tgl[1]."-01";
$tgl_akhir = $tgl[0]."-".$tgl[1]."-31";


$tgl_bulanan = array();
$nohari = 1;
$jml_hari = 0;
$resultbulanan = $mysqli->query("select DISTINCT tanggal from absen where tanggal BETWEEN '$tgl_awal' AND '$tgl_akhir' order by tanggal ASC");
while ($hasiltgl = $resultbulanan->fetch_array())
{
$tgl_bulanan[$nohari] = $hasiltgl['tanggal'];
$nohari++;
$jml_hari++;
}
echo "<table style='border:none;' width='100%'>";
$jmlrow = $jml_hari + 6;
// switch ($wulan)
// {
// case 1 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>JANUARI</td></tr>";
// break;
// case 2 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>FEBRUARI</td></tr>";
// break;
// case 3 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>MARET</td></tr>";
// break;
// case 4 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>APRIL</td></tr>";
// break;
// case 5 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>MEI</td></tr>";
// break;
// case 6 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>JUNI</td></tr>";
// break;
// case 7 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>JULI</td></tr>";
// break;
// case 8 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>AGUSTUS</td></tr>";
// break;
// case 9 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>SEPTEMBER</td></tr>";
// break;
// case 10 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>OKTOBER</td></tr>";
// break;
// case 11 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>NOVEMBER</td></tr>";
// break;
// case 12 : echo "<tr><td class='kotak2' colspan='$jmlrow' style='text-align:center'>DESEMBER</td></tr>";
// break;
// }
// echo "<tr><td class='kotak2' rowspan='2'>NO</td><td class='kotak2' rowspan='2'>NAMA</td><td class='kotak2' colspan='$jml_hari - 1'>TANGGAL</td><td class='kotak2' rowspan='2' colspan='3'>JML KEHADIRAN</td></tr>";
// echo"<tr>";
for ($d = 1; $d <= $jml_hari ; $d++)
{
$tgl_harian = explode("-",$tgl_bulanan[$d]);
echo "<td class='kotak2'>$tgl_harian[2]</td>";
}
echo "</tr>";

$jumlah_anggota = 1;
$id_anggota = array();
$nama_anggota = array();
$jml_telat = array();
$jml_hadir = array();
$jml_absensi_anggota = array();
$resultid_anggota = $mysqli->query("select * from anggota order by id_anggota ASC");
while ($hasilid_anggota = $resultid_anggota->fetch_array())
{
$id_anggota[$jumlah_anggota] = $hasilid_anggota['id_anggota'];
$nama_anggota[$jumlah_anggota] = $hasilid_anggota['nama_anggota'];
$jml_telat[$jumlah_anggota] = 0;
$jml_hadir[$jumlah_anggota] = 0;
$jml_absensi_anggota[$jumlah_anggota] = 0;
for ($e = 1; $e <= $jml_hari ; $e++)
{
$resultabsensi = $mysqli->query("select * from absen WHERE id_anggota='$id_anggota[$jumlah_anggota]' AND tanggal='$tgl_bulanan[$e]' ");
$jml_jam = $resultabsensi->fetch_array();
$jmljam = $jml_jam['jam'];

$cekjamstd = 0;
$cekjamstdtelat = 0;
$pengaturanjamstd = $mysqli->query("select * from jam_klik");
while ($hasilpengaturanjamstd = $pengaturanjamstd->fetch_array())
{
if (((strtotime($jmljam)) <= (strtotime("{$hasilpengaturanjamstd['jam_akhir']}"))) && ( (strtotime($jmljam)) > (strtotime("{$hasilpengaturanjamstd['jam_std']}"))))
{
$cekjamstdtelat = $cekjamstdtelat + 1;
}else if (((strtotime($jmljam)) <= (strtotime("{$hasilpengaturanjamstd['jam_std']}"))) && ( (strtotime($jmljam)) >= (strtotime("{$hasilpengaturanjamstd['jam_awal']}"))))
{
$cekjamstd = $cekjamstd + 1;
}
}


if ($cekjamstdtelat >= 1)
{
$jml_telat[$jumlah_anggota] = $jml_telat[$jumlah_anggota] + 1;
}else if ($cekjamstd >= 1)
{
$jml_hadir[$jumlah_anggota] = $jml_hadir[$jumlah_anggota] + 1;
}
$jml_absensi_anggota[$jumlah_anggota] = $jml_absensi_anggota[$jumlah_anggota] + 1;
}
$jumlah_anggota++;
}



for ($f=1;$f<$jumlah_anggota;$f++){
for ($g=$f;$g<$jumlah_anggota;$g++){
if ($jml_absensi_anggota[$g] > $jml_absensi_anggota[$f]){
$tmp = $jml_absensi_anggota[$g];
$tmp1 = $id_anggota[$g];
$tmp2 = $nama_anggota[$g];
$tmp3 = $jml_hadir[$g];
$tmp4 = $jml_telat[$g];

$jml_absensi_anggota[$g] = $jml_absensi_anggota[$f];
$id_anggota[$g] = $id_anggota[$f];
$nama_anggota[$g] = $nama_anggota[$f];
$jml_hadir[$g] = $jml_hadir[$f];
$jml_telat[$g] = $jml_telat[$f];

$jml_absensi_anggota[$f] = $tmp;
$id_anggota[$f] = $tmp1;
$nama_anggota[$f] = $tmp2;
$jml_hadir[$f] = $tmp3;
$jml_telat[$f] = $tmp4;
}else if ($jml_absensi_anggota[$g] == $jml_absensi_anggota[$f]){
if ($jml_hadir[$g] > $jml_hadir[$f]){
$tmp = $jml_absensi_anggota[$g];
$tmp1 = $id_anggota[$g];
$tmp2 = $nama_anggota[$g];
$tmp3 = $jml_hadir[$g];
$tmp4 = $jml_telat[$g];

$jml_absensi_anggota[$g] = $jml_absensi_anggota[$f];
$id_anggota[$g] = $id_anggota[$f];
$nama_anggota[$g] = $nama_anggota[$f];
$jml_hadir[$g] = $jml_hadir[$f];
$jml_telat[$g] = $jml_telat[$f];

$jml_absensi_anggota[$f] = $tmp;
$id_anggota[$f] = $tmp1;
$nama_anggota[$f] = $tmp2;
$jml_hadir[$f] = $tmp3;
$jml_telat[$f] = $tmp4;
}else if ($jml_hadir[$g] == $jml_hadir[$f]){
if ($jml_telat[$g] > $jml_telat[$f]){
$tmp = $jml_absensi_anggota[$g];
$tmp1 = $id_anggota[$g];
$tmp2 = $nama_anggota[$g];
$tmp3 = $jml_hadir[$g];
$tmp4 = $jml_telat[$g];

$jml_absensi_anggota[$g] = $jml_absensi_anggota[$f];
$id_anggota[$g] = $id_anggota[$f];
$nama_anggota[$g] = $nama_anggota[$f];
$jml_hadir[$g] = $jml_hadir[$f];
$jml_telat[$g] = $jml_telat[$f];

$jml_absensi_anggota[$f] = $tmp;
$id_anggota[$f] = $tmp1;
$nama_anggota[$f] = $tmp2;
$jml_hadir[$f] = $tmp3;
$jml_telat[$f] = $tmp4;
}
}
}
}
}
for ($h=1;$h<$jumlah_anggota;$h++){
// echo "<tr class='sort'><td class='kotak3' rowspan='2'>$h</td><td class='kotak3' rowspan='2'>$nama_anggota[$h]</td>";
$jml_absen = 0;
$hadir = 0;
$telat = 0;
$tidakhadir = 0;
for ($i = 1; $i <= $jml_hari ; $i++)
{
$result_absen_anggota = $mysqli->query("select * from absen WHERE id_anggota='$id_anggota[$h]' AND tanggal='$tgl_bulanan[$i]'");
$jml_absen_harian = $result_absen_anggota->num_rows;
$jml_jam_anggota = $result_absen_anggota->fetch_array();
$jam2 = $jml_jam_anggota['jam'];

$cekjamstd = 0;
$cekjamstdtelat = 0;
$pengaturanjamstd = $mysqli->query("select * from jam_klik");
while ($hasilpengaturanjamstd = $pengaturanjamstd->fetch_array())
{
if (((strtotime($jam2)) <= (strtotime("{$hasilpengaturanjamstd['jam_akhir']}"))) && ( (strtotime($jam2)) > (strtotime("{$hasilpengaturanjamstd['jam_std']}"))))
{
$cekjamstdtelat = $cekjamstdtelat + 1;
}else if (((strtotime($jam2)) <= (strtotime("{$hasilpengaturanjamstd['jam_std']}"))) && ( (strtotime($jam2)) >= (strtotime("{$hasilpengaturanjamstd['jam_awal']}"))))
{
$cekjamstd = $cekjamstd + 1;
}
}

if ($jam2  == "" || $jam2 == "00:00:00")
{
$jam2 = "-";
$bg = " style='color:#FFFFFF;' bgcolor='#FF4848'";
$tidakhadir = $tidakhadir + 1;
}else{


 if ($cekjamstd >= 1)
{
$bg = "bgcolor='#51FF51'";
$hadir = $hadir + 1;
}else if ($cekjamstdtelat >= 1) {
$bg = "bgcolor='#FFFF6C'";
$telat = $telat + 1;
}
}
// echo "<td class='kotak3' $bg rowspan='2'>$jam2</td>";
$jml_absen = $jml_absen + $jml_absen_harian;
}
// echo "<td class='kotak3' colspan='3'>$jml_absen</td></tr><tr><td class='kotak3' bgcolor='#51FF51'>$hadir</td><td class='kotak3' bgcolor='#FFFF6C'>$telat</td><td class='kotak3' style='color:#FFFFFF;' bgcolor='#FF4848'>$tidakhadir</td></tr>";
}

echo "</td></tr></table>";



?>