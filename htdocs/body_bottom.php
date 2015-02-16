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

# get parameters
$device_id = isset($_GET[PARAM_DEVICE_ID]) ? $_GET[PARAM_DEVICE_ID] : false;
$client_id = isset($_GET[PARAM_CLIENT_ID]) ? $_GET[PARAM_CLIENT_ID] : false;
$token = isset($_GET[PARAM_TOKEN]) ? $_GET[PARAM_TOKEN] : false;
$action = isset($_GET[PARAM_ACTION]) ? $_GET[PARAM_ACTION] : false;
$ref_url = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : '';

# exit if missing
if (!($device_id) || !($client_id) || !($token))
	exit();

# connect to database
$server = 'localhost';
$user = 'root';
$pass =  'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

# register call

?>

(function() {
	if ( self === top ) {
		var banner = document.createElement("div");
		banner.id = "hscp-banner";
		var title = document.createElement("h1");
		title.id = "hscp-banner-title";
		title.innerHTML = "<?php echo $ref_url; ?>";
		banner.appendChild(title);
		var body = document.getElementsByTagName("body")[0];
		body.insertBefore(banner, body.firstChild);
	}
})();
