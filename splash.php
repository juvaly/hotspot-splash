<?php
define("PARAM_DEVICE_ID", 'device_id');

$server = 'localhost';
$user = 'root';
$pass = 'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

$device_id = isset($_GET[PARAM_DEVICE_ID]) ? $_GET[PARAM_DEVICE_ID] : false;
if ($device_id) {
	$query = 'SELECT * FROM devices WHERE device_id=\''. $device_id. '\'';
	$result = mysql_query($query) or die('query failed: ' . mysql_error());
	$device = mysql_fetch_array($result);
}

?>

<h1>Welcome to </h1><?php echo $device['hotspot_name'] ?>