<?php
//************************************************
// Sceipt By Rud Az ( Dilarang Ganti Copy Right )
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
//************************************************
date_default_timezone_set('Asia/Jakarta');
error_reporting(0);
$maintenance = 0; // Maintenance? 1 = ya 0 = tidak
if($maintenance == 1) {
    die("Server Error.");
}

//database
$config['database'] = array(
	'host' => 'localhost',
	'name' => 'rudaz',
	'username' => 'root',
	'password' => ''
);

$konek = mysqli_connect($config['database']['host'], $config['database']['username'], $config['database']['password'], $config['database']['name']);
if(!$konek) {
	die("Koneksi Gagal : ".mysqli_connect_error());
	}

$web['base'] = array(
	'url' => 'http://localhost:8080/premium/' // Setting Url Masing Masing!
	
);	

function rudaz($input) {
    global $konek;
        $result = mysqli_real_escape_string($konek,stripslashes(strip_tags(htmlspecialchars($input,ENT_QUOTES))));
    return $result;
} 

// date & time
$date = date("Y-m-d");
$time = date("H:i:s");

require("lib/function.php");
?>