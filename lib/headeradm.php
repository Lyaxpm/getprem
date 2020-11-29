<?php
$check_website = $konek->query("SELECT * FROM website WHERE id ='1'");
$data_website = $check_website->fetch_assoc();

$belanja = mysqli_num_rows($konek->query("SELECT * FROM pembelian"));
$product = mysqli_num_rows($konek->query("SELECT * FROM produk"));
?>
//************************************************
// Sceipt By Rud Az ( Dilarang Ganti Copy Right )
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
//************************************************
<!DOCTYPE html>
<html lang="en">
    
<head>
        <meta charset="utf-8" />
        <title><?php echo $data_website['title']; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="description" content="<?php echo $data_website['deskripsi']; ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo $config['web']['url']; ?>assets/icon/logo.png">
        
         <!-- Plugins css -->
        <link href="<?php echo $config['web']['url']; ?>assets/libs/flatpickr/flatpickr.min.css" rel="stylesheet" type="text/css" />

        <!-- App css -->
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/app.min.css" rel="stylesheet" type="text/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        
        <!--Morris Chart CSS -->
        <script src="<?php echo $web['base']['url']; ?>adm/assets/morris.min.js"></script>
        <script src="<?php echo $web['base']['url']; ?>adm/assets/raphael-min.js"></script> 
        
        <!-- plugin css -->
        <link href="<?php echo $web['base']['url']; ?>adm/assets/libs/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/libs/datatables/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/libs/datatables/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/libs/datatables/select.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        
        <link href="https://cdn.materialdesignicons.com/5.3.45/css/materialdesignicons.min.css" rel="stylesheet" type="text/css">
        <link href="https://printjs-4de6.kxcdn.com/print.min.css" rel="stylesheet" type="text/css">        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css" rel="stylesheet" type="text/css">

    </head>

    <body data-layout="topnav">   
        <!-- Begin page -->
        <div class="wrapper">
        <!-- Topbar Start -->
         <div class="navbar navbar-expand flex-column flex-md-row navbar-custom">
    <div class="container-fluid">
        <ul class="navbar-nav bd-navbar-nav flex-row list-unstyled menu-left mb-0">
            <li class="">
                <button class="button-menu-mobile open-left disable-btn">
                    <i data-feather="menu" class="menu-icon"></i>
                    <i data-feather="x" class="close-icon"></i>
                </button>
            </li>
        </ul>
        
<?php
if (isset($_SESSION['user'])) {
?>  
            <li class="dropdown notification-list align-self-center profile-dropdown">
                <a class="nav-link dropdown-toggle nav-user mr-0" data-toggle="dropdown" href="#" role="button"aria-haspopup="false" aria-expanded="false">
                    <div class="media user-profile ">
                        <img src="<?php echo $web['base']['url']; ?>/assets/img/client/4.png" alt="user-image" class="rounded-circle align-self-center" />
                        <div class="media-body text-left">
                            <h6 class="pro-user-name ml-2 my-0">
                                <span><?php echo $data_website['title']; ?></span>
                                <span class="pro-user-desc text-muted d-block mt-1">Rudi Ganteng THX.</span>
                            </h6>
                        </div>
                        <span data-feather="chevron-down" class="ml-2 align-self-center"></span>
                    </div>
                </a>
                <div class="dropdown-menu profile-dropdown-items dropdown-menu-right">
                    <a href="<?php echo $web['base']['url']; ?>adm/set/akun" class="dropdown-item notify-item">
                        <i data-feather="user" class="icon-dual icon-xs mr-2"></i>
                        <span>My Account</span>
                    </a>
                    
                    <div class="dropdown-divider"></div>

                    <a href="<?php echo $web['base']['url']; ?>adm/logout" class="dropdown-item notify-item">
                        <i data-feather="log-out" class="icon-dual icon-xs mr-2"></i>
                        <span>Logout</span>
                    </a>
                </div>
            </li>
             <?php } ?>
        </ul>
    </div>
</div>
            <div class="topnav shadow-sm">
                <div class="container-fluid">
                    <nav class="navbar navbar-light navbar-expand-lg topbar-nav">
                        <div class="collapse navbar-collapse" id="topnav-menu-content">
                            <ul class="metismenu" id="menu-bar">
                                <li class="menu-title">Navigation</li>
                            <?php if (isset($_SESSION['user'])) { ?>

                                <li>
                                    <a href="<?php echo $web['base']['url']; ?>adm">
                                        <i data-feather="home"></i>
                                      <span> Dashboard </span>
                                    </a>
                                </li>                                                        
                                                           
                               <li>
                                  <a href="<?php echo $web['base']['url']; ?>adm/set/produk">
                                     <i data-feather="database"></i>
                                     <span> Produk </span>
                                  </a>          
                              </li>
                              
                               <li>
                                  <a href="<?php echo $web['base']['url']; ?>adm/set/pembelian">
                                     <i data-feather="shopping-cart"></i>
                                     <span> Pembelian </span>
                                  </a>          
                              </li>
                              
                               <li>
                                  <a href="<?php echo $web['base']['url']; ?>adm/set/website">
                                     <i data-feather="settings"></i>
                                     <span> Setting Web </span>
                                  </a>          
                              </li>
                                 <?php } ?>                                                                                                     
                                      </ul>                              
                            </div>
                     </nav>
               </div>
        </div>
            
          <div class="content-page">
              <div class="content">
                 <div class="container-fluid">
                    
              <!-- start page title -->
                <div class="row">
                    <div class="col-12">                                                
                            <br />
                        </div>
                    </div>
                    


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
<?php
$time = microtime();
$time = explode(' ', $time);
$time = $time[1] + $time[0];
$start = $time;
?>
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
        