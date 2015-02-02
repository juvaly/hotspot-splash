<?php
define("PARAM_DEVICE_ID", 'device_id');
define("PARAM_HOTSPOT_NAME", 'hotspot_name');

$server = 'localhost';
$user = 'root';
$pass = 'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

$device_id = isset($_POST[PARAM_DEVICE_ID]) ? $_POST[PARAM_DEVICE_ID] : false;
$hotspot_name = sset($_POST[PARAM_HOTSPOT_NAME]) ? $_POST[PARAM_HOTSPOT_NAME] : 'Hotspot';

if (!$device_id) die('device_id is required')

$query = "INSERT INTO devices (device_id, hotspot_name) VALUES ('". $device_id. "','". $hotspot_name ."')";
mysql_query($query) or die('insert failed: ' . mysql_error());

header('Location: http://www.hotspotsplashscreens.com/hotspot-splash/splash.php?device_id'.$device_id);
http_response_code(201);
?>