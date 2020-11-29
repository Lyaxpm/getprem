<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require("../../config.php");
require("../../lib/sessi.php");
require("../../lib/sessi_log.php");
$check_pengguna = $konek->query("SELECT * FROM pengguna WHERE username = '".$_SESSION['user']['username']."'");
$data_pengguna = $check_pengguna->fetch_assoc();

if (isset($_POST['update'])) {
$pengguna = rudaz($_POST['pengguna']);
$password = rudaz($_POST['password']);
$verif = password_hash($password, PASSWORD_DEFAULT);

if (empty($pengguna)) {
  $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Harap isi form yang kosong.'); 
 } else {

if (empty($password)) {
if ($konek->query("UPDATE pengguna SET username = '$pengguna' WHERE username = '".$_SESSION['user']['username']."'") == true) {
  $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Update Akun Berhasil.'); 
  } else {
  $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Syistem Error!!.');     
  }
  } else {
if ($konek->query("UPDATE pengguna SET username = '$pengguna', password = '$verif' WHERE username = '".$_SESSION['user']['username']."'") == true) {
  $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Update Akun Berhasil.'); 
  } else {
  $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Syistem Error!!.');     
       }
     }
   }
 }  
include("../../lib/headeradm.php");
?>
  <div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
						<h4 class="m-t-0 header-title"> Settings Akun</b></h4>
						<hr/>
						<form class="form-horizontal" method="POST">
							<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
							<div class="form-group">
								<label class="col-md-12 control-label">pengguna</label>
								<div class="col-md-12">
									<input type="text" name="pengguna" class="form-control" value="<?php echo $data_pengguna['username']; ?>">
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-md-12 control-label">Password</label>
								<div class="col-md-12">
									<input type="password" name="password" class="form-control">
									<span class="text-danger">Kosongkan Bila Tidak Di Rubah</span>
								</div>								
							</div>
					        <div class="col-md-12">
							<button type="submit" class="pull-right btn btn-block btn--md btn-primary waves-effect waves-light" name="update"><i class="mdi mdi-pencile"></i> Update Akun</button>
							   </div> 
					            </div>
					 </form>					
			    </div>
		  </div>
    </div>

<?php
include("../../lib/footeradm.php");
?>