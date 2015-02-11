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
<!DOCTYPE html>
<html lang="he-IL" xml:lang="he-IL">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<title><?php echo $hotspot_name ?></title>
	</head>
	<body dir="rtl">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<img src="http://hotspotsplashscreens.com/hotspot-splash/images/<?php echo $device_id ?>.jpg" alt="<?php echo $hotspot_name ?>"/>
				</div>
			</div>

			<div class="row">
					<div class="col-md-12 text-center">
						<p class="lead">ברוכים הבאים ל<?php echo $hotspot_name ?></p>

						<h1 class="text-primary">הספיישלים שלנו היום:</h1>
					</div>
					<div class="col-md-4 text-center">
						<h3>קפה + מאפה</h2>
						<h2><strong>16 ₪</strong></h1>
					</div>
					<div class="col-md-4 text-center">
						<h3>קפה + סנביץ׳ ביס</h2>
						<h2><strong>22 ₪</strong></h1>
					</div>
					<div class="col-md-4 text-center">
						<h3>עסקית צהריים</h2>
						<h2><strong>59 ₪</strong></h1>
					</div>
			</div>

			<hr />

			<div class="row">
				<div class="col-md-12 text-center">
					<p class="text-danger">
						<strong>בשביל להמשיך להינות מה-WIFI החינמי שלנו, נא ללחוץ על המשך.</strong>
					</p>
					<p>
						<a class="btn btn-primary" href="<?= $auth_url ?>" target="_top">המשך &lsaquo;</a>
					</p>
					<p>
						<small>לחיצה על המשך תהווה אישור כי קראת והסכמת <a href="#">לתנאי השימוש ברשת</a></small>
					</p>
				</div>
			</div>
		</div>

		<!-- scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
	</body>

</html>