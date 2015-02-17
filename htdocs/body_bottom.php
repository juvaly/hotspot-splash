<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

header('Content-Type: text/javascript');
header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

define("PARAM_DEVICE_ID", 'd_id');
define("PARAM_CLIENT_ID", 'c_id');
define("PARAM_TOKEN", 't');
define("PARAM_ACTION", 'a');

define("COOKIE_CLIENT_INFO", 'cci');

# get parameters
$device_id = isset($_GET[PARAM_DEVICE_ID]) ? $_GET[PARAM_DEVICE_ID] : false;
$client_id = isset($_GET[PARAM_CLIENT_ID]) ? $_GET[PARAM_CLIENT_ID] : false;
$token = isset($_GET[PARAM_TOKEN]) ? $_GET[PARAM_TOKEN] : false;
$action = isset($_GET[PARAM_ACTION]) ? $_GET[PARAM_ACTION] : false;
$ref_url = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';

# exit if missing
if (!($device_id) || !($client_id) || !($token)) {
#	exit();
}

# connect to database
$server = 'localhost';
$user = 'root';
$pass =  'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

# check for cookie
$show_banner = false;
if (!isset($_COOKIE[COOKIE_CLIENT_INFO])) {
	setcookie(COOKIE_CLIENT_INFO, '1', time() + 1800, "/"); // expire in 30 minutes
	$show_banner = true;
}

# register call
$query = "INSERT INTO client_visits (client_id, device_id, url) VALUES ('$client_id', '$device_id', '$ref_url')";
mysql_query($query) or die('insert failed: ' . mysql_error());
?>

<?php if ($show_banner) { ?>

(function() {
	if ( self === top ) {
		var frame = document.createElement("div");
		frame.id = "hscp-banner";
		var img = document.createElement("img");
		img.id = "hscp-banner-image";
		img.src = "http://www.hotspotsplashscreens.com/hotspot-splash/images/<?php echo $device_id; ?>_banner.jpg";
		frame.appendChild(img);
		var close = document.createElement("div");
		close.id = "hscp-banner-close";
		close.innerHTML = "X";
		frame.appendChild(close);
		var body = document.getElementsByTagName("body")[0];
		body.insertBefore(frame, body.firstChild);
	}
})();

<?php } ?>