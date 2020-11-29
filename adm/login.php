<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require '../config.php';

$check_website = $konek->query("SELECT * FROM website WHERE id ='1'");
$data = $check_website->fetch_assoc();

if (isset($_SESSION['user'])) {
    header("Location: ".$web['base']['url']."adm");
} else {

if (isset($_POST['login'])) {
    
     $username = rudaz($_POST['username']);
     $password = rudaz($_POST['password']);
     
     $check_user = $konek->query("SELECT * FROM pengguna WHERE username = '$username'");
     $check_user_rows = mysqli_num_rows($check_user);
     $data_user = mysqli_fetch_assoc($check_user);
     
     $verif_pass = password_verify($password, $data_user['password']);
     
 if (empty($username) || empty($password)) {
    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Hara isi semua form.');
  } else if ($check_user_rows == 0) {
    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed!', 'pesan' => 'Rincian Masuk Salah! Silahkan coba kembali.');
  } else if ($data_user['status'] == "Tidak Aktif") {
    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed!', 'pesan' => 'Akun Not Active');
  } else {
  
if ($check_user_rows == 1) {

if ($verif_pass == true) {             
   $_SESSION['user'] = $data_user;
   $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil Masuk!', 'pesan' => 'Selamat Datang <b>'.$data_user['username'].'</b>, Semoga Hari Anda Menyenangkan');
   exit(header("Location: ".$web['base']['url']."adm"));
 } else {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Rincian Masuk Salah! Silahkan coba kembali.'); 
                    
                   }
               }
           }
       }
   }

?>  
<!DOCTYPE html>
<html lang="en">
    
   <head>
        <meta charset="utf-8" />
        <title><?php echo $data['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="<?php echo $data_website['deskripsi']; ?>" name="description" />
        <meta content="Rud Az" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo $config['web']['url']; ?>assets/images/logo.png">

        <!-- App css -->
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body class="authentication-bg">
        
        <div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-xl-10 p-5">
                                        
                                        
                                        <?php
if (isset($_SESSION['hasil'])) {
?>
<div class="alert alert-<?php echo $_SESSION['hasil']['alert'] ?> bg-<?php echo $_SESSION['hasil']['alert'] ?> text-white border-0" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <strong>Respon : </strong><?php echo $_SESSION['hasil']['judul'] ?><br /> <strong>Pesan : </strong> <?php echo $_SESSION['hasil']['pesan'] ?>
</div>
<?php
unset($_SESSION['hasil']);
}
?>

                                      <form class="authentication-form" method="POST">
                                             <div class="form-group">
                                                <label for="username" class="form-control-label">Username</label>
                                                   <div class="input-group input-group-merge">                                                    
                                                   <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                                                </div>
                                            </div>

                                             <div class="form-group mt-3">
                                                <label for="password" class="form-control-label">Password</label>
                                                    <div class="input-group input-group-merge">                                                                                                                                            
                                                    <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                                                </div>
                                            </div>

                                            <div class="form-group mb-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="remember" class="custom-control-input"
                                                        id="checkbox-signin" checked>
                                                    <label class="custom-control-label" for="checkbox-signin">Masuk Selama 30 Hari</label>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group mb-0 text-center">
                                                <button class="btn btn-primary btn-block" name="login" type="submit"> Log In
                                                </button>
                                            </div>
                                        </form>                                        
                             
                        <!-- end row -->
                    </div>
                     <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor js -->
        <script src="<?php echo $web['base']['url']; ?>adm/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo $web['base']['url']; ?>adm/assets/js/app.min.js"></script>
        
    </body>
</html>