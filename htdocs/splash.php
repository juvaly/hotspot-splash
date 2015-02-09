<?php
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

define("PARAM_DEVICE_ID", 'device_id');

$authaction = $_GET['authaction'];
$redir = $_GET['redir'];
$tok = $_GET['tok'];

$server = 'localhost';
$user = 'root';
$pass = 'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

$device_id = isset($_GET[PARAM_DEVICE_ID]) ? $_GET[PARAM_DEVICE_ID] : false;
if ($device_id) {
	$query = "SELECT * FROM devices WHERE device_id='$device_id'";
	$result = mysql_query($query) or die('query failed: ' . mysql_error());
	$device = mysql_fetch_array($result);
}

$url = "$authaction?redir=" . urlencode($redir) . "&tok=$tok";

$hotspot_name = isset($device) ? $device['hotspot_name'] : 'Nowhere';

?>

<h1>Welcome to <?php echo $hotspot_name ?></h1>
<a href="<?= $url ?>" target="_top">Accept Terms</a>
