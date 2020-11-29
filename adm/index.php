<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require("../config.php");

if (isset($_COOKIE['_key']) && isset($_COOKIE['_valid'])) {
        $_key = base64_decode($_COOKIE['_key']);
        $_valid = $_COOKIE['_valid'];
        
        $check_user = $konek->query("SELECT username FROM pengguna WHERE token = '$_key'");
        $data_user = $check_user->fetch_assoc();
        if ($_valid = password_verify($data_user['username'], $_valid)) {
            $_SESSION['user'] = $data_user;
        }            
    }

if (isset($_SESSION['user'])) {
	$sess_username = $_SESSION['user']['username'];
	$check_user = $konek->query("SELECT * FROM pengguna WHERE username = '$sess_username'");
	$data_user = $check_user->fetch_assoc();
	if (mysqli_num_rows($check_user) == 0) {
		header("Location: ".$web['base']['url']."adm/logout");
	} else if ($data_user['status'] == "Suspended") {
		header("Location: ".$web['base']['url']."adm/logout");
    }
    
 } else {
	header("Location: ".$web['base']['url']."adm/login");
}

include("../lib/headeradm.php");
?>

 <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Total Produk</span>
                                            <h2 class="mb-0"><?php echo $product; ?></h2>
                                        </div>
                                        <div class="align-self-center">
                                            <div id="today-revenue-chart" class="apex-charts"></div>
                                            <span class="text-success font-weight-bold font-size-13"><i class='mdi mdi-cart'></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body p-0">
                                    <div class="media p-3">
                                        <div class="media-body">
                                            <span class="text-muted text-uppercase font-size-12 font-weight-bold">Total Belanja</span>
                                            <h2 class="mb-0"><?php echo $belanja; ?></h2>
                                        </div>
                                        <div class="align-self-center">
                                            <div id="today-product-sold-chart" class="apex-charts">
                                            </div>
                                            <span class="text-danger font-weight-bold font-size-13"><i class='mdi mdi-cart'></i></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

<?php
include("../lib/footeradm.php");
?>