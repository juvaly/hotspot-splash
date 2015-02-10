<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

define("PARAM_DEVICE_ID", 'device_id');
define("PARAM_HOTSPOT_NAME", 'hotspot_name');
define("PARAM_SSID", 'source_ssid');
define("PARAM_SSID_PWD", 'source_ssid_pwd');
define("PARAM_REDIRECT_URL", 'redirect_url');
define("PARAM_ENABLE_SPLASH", 'is_splash_enabled');
define("PARAM_SALT", 'salt');

$server = 'localhost';
$user = 'root';
$pass = 'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

$device_id = isset($_POST[PARAM_DEVICE_ID]) ? $_POST[PARAM_DEVICE_ID] : false;
$hotspot_name = isset($_POST[PARAM_HOTSPOT_NAME]) ? $_POST[PARAM_HOTSPOT_NAME] : 'Hotspot';
$ssid = isset($_POST[PARAM_SSID]) ? $_POST[PARAM_SSID] : '';
$ssid_pwd = isset($_POST[PARAM_SSID_PWD]) ? $_POST[PARAM_SSID_PWD] : '';
$redirect_url = isset($_POST[PARAM_REDIRECT_URL]) ? $_POST[PARAM_REDIRECT_URL] : '';
$is_splash_enabled = isset($_POST[PARAM_ENABLE_SPLASH]) ? $_POST[PARAM_ENABLE_SPLASH] : 1;
$salt = isset($_POST[PARAM_SALT]) ? $_POST[PARAM_SALT] : 1;

if (!($device_id)) {
	die('device_id is required');
	http_response_code(500);
}

// test if device exists
$query = "SELECT device_id FROM devices WHERE device_id='$device_id'";
$result = mysql_query($query) or die('failed testing device exists: ' . mysql_error());
if (mysql_fetch_array($result) !== false) {
	$query = "UPDATE devices SET 
	hotspot_name = '$hotspot_name', 
	ssid = '$ssid', 
	ssid_pwd = '$ssid_pwd',
	is_splash_enabled = $is_splash_enabled,
	salt = $salt
	WHERE device_id = '$device_id'";
}
else
{
	$query = "INSERT INTO devices (device_id, hotspot_name, ssid, ssid_pwd, is_splash_enabled, redirect_url, salt) 
	VALUES ('$device_id','$hotspot_name','$ssid','$ssid_pwd', $is_splash_enabled, '$redirect_url', '$salt')";
}

// register or update device
$result = mysql_query($query) or die('insert failed: ' . mysql_error());

header('Location: http://www.hotspotsplashscreens.com/hotspot-splash/splash.php?device_id='.$device_id);
http_response_code(201);
?>
