<?php
define("PARAM_DEVICE_ID", 'd_id');
define("PARAM_CLIENT_ID", 'c_id');
define("PARAM_TOKEN", 't');

$device_id = isset($_GET[PARAM_DEVICE_ID]) ? $_GET[PARAM_DEVICE_ID] : false;
$client_id = isset($_GET[PARAM_CLIENT_ID]) ? $_GET[PARAM_CLIENT_ID] : false;
$token = isset($_GET[PARAM_TOKEN]) ? $_GET[PARAM_TOKEN] : false;

?>

<html>
<head>
	<script src="head_top.php?d_id=<?php echo $device_id ?>&c_id=<?php echo $client_id ?>&t=<?php echo $token ?>"></script>
</head>
<body>
	is your test working?

	<script src="body_bottom.php?d_id=<?php echo $device_id ?>&c_id=<?php echo $client_id ?>&t=<?php echo $token ?>"></script>
</body>
</html>