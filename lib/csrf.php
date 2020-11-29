<?php
/**
 * Penulis Kode - SMM Panel script
 * Domain: http://penuliskode.com/
 * Documentation: http://penuliskode.com/smm/script/version-n1/documentation.html
 */

if (empty($_SESSION['token'])) {
	if (function_exists('mcrypt_create_iv')) {
		$_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
	} else {
		$_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
	}
}
$config['_token'] = $_SESSION['token'];

if ($_POST AND !isset($_POST['_token'])) {
	exit("Permintaan tidak diterima.");
} elseif ($_POST AND isset($_POST['_token'])) {
	if (hash_equals($_SESSION['token'], $_POST['_token']) == false) {
		exit("Permintaan tidak diterima.");
	}
}