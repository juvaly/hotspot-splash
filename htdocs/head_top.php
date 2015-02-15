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

# fail if missing

# connect to database
$server = 'localhost';
$user = 'root';
$pass =  'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);
?>

(function() {
	var link = document.createElement("link");
	link.href = "http://www.hotspotsplashscreens.com/hotspot-splash/banner-top.css";
	link.type = "text/css";
	link.rel = "stylesheet";
	document.getElementsByTagName("head")[0].appendChild(link);
})();
