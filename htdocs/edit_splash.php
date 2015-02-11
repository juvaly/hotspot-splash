<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

header('Expires: Sun, 01 Jan 2014 00:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

define("PARAM_DEVICE_ID", 'device_id');

$server = 'localhost';
$user = 'root';
$pass =  'QEVk0C4uOVln';
$dbname = 'hotspot-splash';
$con = mysql_connect($server, $user, $pass) or die("Can't connect");
mysql_select_db($dbname);

$device_id = isset($_GET[PARAM_DEVICE_ID]) ? $_GET[PARAM_DEVICE_ID] : false;
if ($device_id) {
	$query = "SELECT * FROM devices WHERE device_id='$device_id'";
	$result = mysql_query($query) or die('query failed: ' . mysql_error());
	$device = mysql_fetch_array($result);
} else {
	http_response_code(404);
	exit();
}

$hotspot_name = isset($device) ? $device['hotspot_name'] : 'Nowhere';
if (isset($_POST['specials'])) {
	$specials_sql = mysql_real_escape_string($_POST['specials']);
	$specials = json_decode($_POST['specials']);
	$query = "UPDATE devices SET specials = '$specials_sql' WHERE device_id='$device_id'";
	$result = mysql_query($query) or die('query failed: ' . mysql_error());
} else {
	$specials = isset($device) ? json_decode($device['specials']) : [];
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
				<h1>המומלצים של היום:</h1>
				<form method="POST" action="edit_splash.php?device_id=<?php echo $device_id ?>">
					<h3>ספיישל 1</h3>
					<div class="form-group col-md-9">
						<label for="special1_text">תיאור</label>
						<input type="special1_text" class="form-control" id="special1_text" placeholder="קפה + מאפה" value="<?php echo $specials[0]->text ?>">
					</div>
					<div class="form-group col-md-3">
						<label for="special1_price">מחיר</label>
						<div class="input-group">
      						<div class="input-group-addon">₪</div>
							<input type="special1_price" class="form-control" id="special1_price" placeholder="0.00" value="<?php echo $specials[0]->price ?>">
						</div>
					</div>

					<h3>ספיישל 2</h3>
					<div class="form-group col-md-9">
						<label for="special2_text">תיאור</label>
						<input type="special2_text" class="form-control" id="special2_text" placeholder="קפה + מאפה" value="<?php echo $specials[1]->text ?>">
					</div>
					<div class="form-group col-md-3">
						<label for="special2_price">מחיר</label>
						<div class="input-group">
      						<div class="input-group-addon">₪</div>
							<input type="special2_price" class="form-control" id="special2_price" placeholder="0.00" value="<?php echo $specials[1]->price ?>">
						</div>
					</div>

					<h3>ספיישל 3</h3>
					<div class="form-group col-md-9">
						<label for="special3_text">תיאור</label>
						<input type="special3_text" class="form-control" id="special3_text" placeholder="קפה + מאפה" value="<?php echo $specials[2]->text ?>">
					</div>
					<div class="form-group col-md-3">
						<label for="special3_price">מחיר</label>
						<div class="input-group">
      						<div class="input-group-addon">₪</div>
							<input type="special3_price" class="form-control" id="special3_price" placeholder="0.00" value="<?php echo $specials[2]->price ?>">
						</div>
					</div>

					<input id="specials" name="specials" type="hidden" value=""> 
					
					<button id="btnSubmit" type="submit" class="btn btn-primary">עדכן מומלצים</button>
				</form>
			</div>
		</div>

		<!-- scripts -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		
		<script>
		(function($) {
			$('#btnSubmit').click(function() {
				var specials = JSON.stringify([
					{ "text": $('#special1_text').val(), "price": $('#special1_price').val() },
					{ "text": $('#special2_text').val(), "price": $('#special2_price').val() },
					{ "text": $('#special3_text').val(), "price": $('#special3_price').val() }
				]);
				$('#specials').val(specials);
			});
		})(jQuery);
		</script>
	</body>

</html>