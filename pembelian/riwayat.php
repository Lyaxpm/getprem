<?php
session_start();
require '../config.php';

   if (isset($_COOKIE['_gid'])) {
        $_gid = base64_decode($_COOKIE['_gid']);
        
        $check_odr = $konek->query("SELECT * FROM pembelian WHERE cookie = '$_gid'");
        $data_odr = $check_odr->fetch_assoc();
   if (mysqli_num_rows($check_odr) == 0) {
        header("Location: ".$web['base']['url']);
    }
 }