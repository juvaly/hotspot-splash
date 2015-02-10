<?php

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

define("PARAM_DEVICE_ID", 'device_id');

$authaction = $_GET['authaction'];
$original_redirect = $_GET['redir'];
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

$auth_url = "$authaction?redir=" . urlencode($original_redirect) . "&tok=$tok";

$hotspot_name = isset($device) ? $device['hotspot_name'] : 'Nowhere';
$redirect_url = isset($device) ? $device['redirect_url'] : '';
$is_splash_enabled = isset($device) ? $device['is_splash_enabled'] : 0;

// don't display any splash page
if (!($is_splash_enabled)) {
	header('Location: ' . $auth_url, true, 302);
	exit();
}

?>

<!-- page output -->
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-offset-3 col-md-6">
					<div class="text-center">
						<h1><?php echo $hotspot_name ?></h1>
						<a class="btn btn-primary" href="<?= $auth_url ?>" target="_top">Continue &rsaquo;</a>
						<p><small>By clicking Continue you are agreeing to our network <a href="#">terms of use</a> and <a href="#">privacy policy</a></small></p>
					</div>
				</div>
			</div>
		</div>

		<!-- scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	</body>

</html>