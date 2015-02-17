<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

define("PARAM_DEVICE_ID", 'device_id');

# params for building authorization URL
$authaction = isset($_GET['authaction']) ? $_GET['authaction'] : '';
$original_redirect = isset($_GET['redir']) ? $_GET['redir'] : '';
$tok = isset($_GET['tok']) ? $_GET['tok'] : '';
$auth_url = "$authaction?redir=" . urlencode($original_redirect) . "&tok=$tok";

# connect to database
$server = 'localhost';
$user = 'root';
$pass =  'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

# check device_id exists
$device_id = isset($_GET[PARAM_DEVICE_ID]) ? $_GET[PARAM_DEVICE_ID] : false;
if ($device_id) {
	$query = "SELECT * FROM devices WHERE device_id='$device_id'";
	$result = mysql_query($query) or die('query failed: ' . mysql_error());
	$device = mysql_fetch_array($result);
}

# get device info from database
$hotspot_name = isset($device) ? $device['hotspot_name'] : 'Nowhere';
$redirect_url = isset($device) ? $device['redirect_url'] : '';
$is_splash_enabled = isset($device) ? $device['is_splash_enabled'] : 0;
$specials = isset($device) ? json_decode($device['specials']) : [];

# move on if splash page not enabled for this device
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
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<title><?php echo $hotspot_name ?></title>

		<style>
			.img-centered { margin: 0 auto; }
			.special { padding: 5px 0; }
		</style>
	</head>
	<body dir="rtl">
		<div class="container">
			<div class="row">
				<div class="col-md-12 text-center">
					<img class="img-responsive img-centered" src="http://hotspotsplashscreens.com/hotspot-splash/images/<?php echo $device_id ?>.jpg" alt="<?php echo $hotspot_name ?>"/>
				</div>
			</div>

			<div class="row">
					<div class="col-md-12 text-center">
						<h1 class="lead">ברוכים הבאים ל<?php echo $hotspot_name ?></h1>

						<h2 class="text-primary">המומלצים שלנו היום:</h2>
					</div>
					<div class="col-md-4 text-center">
						<div class="special bg-warning">
							<h3><?php echo $specials[0]->text ?></h2>
							<h2><strong><?php echo $specials[0]->price ?> ₪</strong></h1>
						</div>
					</div>
					<div class="col-md-4 text-center">
						<div class="special bg-warning">
							<h3><?php echo $specials[1]->text ?></h2>
							<h2><strong><?php echo $specials[1]->price ?> ₪</strong></h1>
						</div>
					</div>
					<div class="col-md-4 text-center">
						<div class="special bg-warning">
							<h3><?php echo $specials[2]->text ?></h2>
							<h2><strong><?php echo $specials[2]->price ?> ₪</strong></h1>
						</div>
					</div>
			</div>

			<hr />

			<div class="row">
				<div class="col-md-12 text-center">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<a class="btn btn-success btn-block btn-lg" href="<?= $auth_url ?>" target="_top">המשך בגלישה חינם &rsaquo;</a>
						</div>
					</div>
					<p>
						<small>לחיצה על המשך תהווה אישור כי קראת והסכמת <a href="#">לתנאי השימוש ברשת</a></small>
					</p>
				</div>
			</div>
		</div>

		<!-- scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</body>

</html>