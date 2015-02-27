<?php

error_reporting (0);

$salt_length = 20;
$secret = "T5Vq8wx31JDjUYkDlzCJ";

$device_id = isset($_POST["device_id"]) ? $_POST["device_id"] : isset($_GET["device_id"]) ? $_GET["device_id"] : '';
$token = isset($_POST["t"]) ? $_POST["t"] : isset($_GET["t"]) ? $_GET["t"] : '';

$check = md5($secret.$device_id);

if ($check != $token)  {
    http_response_code(404);
    exit(0);
}

$files = array (
    array (
        "execute" => "ps"
    ),
    array (
        "path" => "/tmp/files/TEXT_TEST",
        "url" => "http://hotspotsplashscreens.com/hotspot-splash/files/text.txt",
        "local_path" => "/path_on_server/files/text.txt",
        "run_after" => "/bin/false",
        "mode" => "0644",
        "force" => "no"
    ),
    array (
        "path" => "/tmp/files/BIN_TEST",
        "url" => "http://http://hotspotsplashscreens.com/hotspot-splash/files/bash",
        "local_path" => "/srv/http/gssol.com/files/bash",
        "mode" => "0777"
    )
);

$cmd_arr = array();

foreach ($files as $file)  {
    if ($file['execute'])  {
        array_push($cmd_arr, array (
            "execute" => $file['execute'],
        ));
        continue;
    }

    if (! file_exists($file['local_path']))  {
        continue;
    }

    $s = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $salt_length);
    $t = md5 ($file['path'].$s.$secret);
    if ($file['mode'])  {
        $mode = $file['mode'];
    }
    else  {
        $mode = "";
    }
#    print (file_get_contents($file['path']));

#    print ("File " . $file['path'] . " MD5: " . md5_file($file['local_path']) . "\n");
  
    array_push($cmd_arr, array (
        "path" => $file['path'],
        "mode" => $mode,
        "md5sum" => md5_file($file['local_path']),
        "size" => filesize($file['local_path']),
        "url" => $file['url'],
        "run_after" => $file['run_after'],
        "s" => $s,
        "t" => $t,
        "force" => $file['force']
    ));
}

#print_r ($cmd_arr);
print json_encode($cmd_arr, JSON_UNESCAPED_SLASHES);

?>
