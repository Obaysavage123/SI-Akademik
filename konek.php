<?php
$mysqli = new mysqli("localhost","root","","lasmoid_absen");
if ($mysqli->connect_error)
{
die('error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>
