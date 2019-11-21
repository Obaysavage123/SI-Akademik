<?php
function foto($id_anggota='',$tanggalproses='',$mysqli)
{

$jam = time()+25200;
$jam = addslashes(gmdate("H:i:s",$jam));

$querabsen = $mysqli->query("select * from absen where id_anggota='$id_anggota' AND tanggal='$tanggalproses'");
$hasilabsen = $querabsen->fetch_array();
$in = $hasilabsen['jam'];

$quer = $mysqli->query("select * from anggota where id_anggota='$id_anggota'");
$hasil = $quer->fetch_array();

$nama_anggota = $hasil['nama_anggota'];
if (file_exists('gbr/'.$id_anggota.'.jpg'))
{
$foto = "gbr/".$id_anggota.".jpg";
}else{
$foto = "gbr/foto.jpg";
}
if  (($in == "") || ($in == "00:00:00") || ($in == null)) 
{
echo "<center><table height='100' width='70' bgcolor='#FF4848'>";
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
echo "<tr><td class='kotak3' style='border:none;' id='a$id_anggota'>";
echo "<a href='?absen=$id_anggota'  style='text-decoration:none;color:#FFFFFF;' onclick=\"return confirm('Absen Untuk $nama_anggota ?')\">";
echo "<img src='$foto' alt='$nama_anggota' width='70' height='70'/><br/><font color='#FFFFFF'>$nama_anggota</font></a></td></tr>";
}else{
echo "<tr><td class='kotak3' style='border:none;' id='a$id_anggota'><img src='$foto' alt='$nama_anggota' width='70' height='70'/><br/><font color='#FFFFFF'>$nama_anggota</font></td></tr>";
}
echo "</table></center>";
}else{


$cekjamstd = 0;
$cekjamstdtelat = 0;
$pengaturanjamstd = $mysqli->query("select * from jam_klik");
while ($hasilpengaturanjamstd = $pengaturanjamstd->fetch_array())
{
if (((strtotime($in)) <= (strtotime("{$hasilpengaturanjamstd['jam_akhir']}"))) && ( (strtotime($in)) > (strtotime("{$hasilpengaturanjamstd['jam_std']}"))))
{
$cekjamstdtelat = $cekjamstdtelat + 1;
}else if (((strtotime($in)) <= (strtotime("{$hasilpengaturanjamstd['jam_std']}"))) && ( (strtotime($in)) >= (strtotime("{$hasilpengaturanjamstd['jam_awal']}"))))
{
$cekjamstd = $cekjamstd + 1;
}
}

if ($cekjamstd >= 1)
{
echo "<center><table height='100' width='70' bgcolor='#51FF51'>";
echo "<tr><td class='kotak3' style='border:none;'><img src='$foto'  alt='$nama_anggota' width='70' height='70'/><br/>$nama_anggota</td></tr>";
echo "</table></center>";
}else if ($cekjamstdtelat >= 1)
{
echo "<center><table height='100' width='70' bgcolor='#FFFF6C'>";
echo "<tr><td class='kotak3' style='border:none;'><img src='$foto'  alt='$nama_anggota' width='70' height='70'/><br/>$nama_anggota</td></tr>";
echo "</table></center>";
}else{
echo "<center><table height='100' width='70' bgcolor='#FFFF6C'>";
echo "<tr><td class='kotak3' style='border:none;'><img src='$foto'  alt='$nama_anggota' width='70' height='70'/><br/>$nama_anggota</td></tr>";
echo "</table></center>";
}
}

?>
<script type="text/javascript">
var aa<?php echo "$id_anggota"; ?> = function() {
t<?php echo "$id_anggota"; ?> = setInterval(function(){increment2<?php echo "$id_anggota"; ?>()},1000);
}
function increment5<?php echo "$id_anggota"; ?>() {
document.getElementById('a<?php echo "$id_anggota"; ?>').style.background = "#535353";
}setInterval('increment<?php echo "$id_anggota"; ?>()',2000);

function increment<?php echo "$id_anggota"; ?>() {
document.getElementById('a<?php echo "$id_anggota"; ?>').style.background = "#FF4848";
t=setTimeout(function(){increment5<?php echo "$id_anggota"; ?>()},1000);
}
</script>
<?php



}
function waktu_reloadindex()
{

?>
<script type="text/javascript">
<?php date_default_timezone_set('Asia/Jakarta'); ?>
	var serverTime = new Date(<?php print date('Y, m, d, H, i, s, 0'); ?>);
	var clientTime = new Date();
	var Diff = serverTime.getTime() - clientTime.getTime();	
	function displayServerTime(){
		var clientTime = new Date();
		var time = new Date(clientTime.getTime() + Diff);
		var sh = time.getHours().toString();
		var sm = time.getMinutes().toString();
		var ss = time.getSeconds().toString();
		
		document.getElementById("clock").innerHTML = (sh.length==1?"0"+sh:sh) + ":" + (sm.length==1?"0"+sm:sm) + ":" + (ss.length==1?"0"+ss:ss);
		
		
		
		
		
	}
</script>

<body onload="setInterval('displayServerTime()', 1000);">
<span id="clock"><?php print date('H:i:s'); ?></span>
<?php


}
function ip_akses($ip,$mysqli)
{
$result = $mysqli->query("select * from akses WHERE ip='$ip'");
$row = $result->num_rows;

return $row;
}

function cekabsen($absen,$tanggalproses,$mysqli)
{
$result = $mysqli->query("select * from absen WHERE id_anggota='$absen' AND tanggal='$tanggalproses'");
$row = $result->num_rows;

return $row;
}
?>