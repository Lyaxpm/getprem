<?php
//************************************************
// Sceipt By Rud Az ( Dilarang Ganti Copy Right )
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
//************************************************

$check_website = $konek->query("SELECT * FROM website WHERE id ='1'");
$data_website = $check_website->fetch_assoc();
require 'csrf.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta content="<?php echo $data_website['deskripsi']; ?>" name="description" />
    <meta content="<?php echo $data_website['kata_kunci']; ?>" name="keyword" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title><?php echo $data_website['title']; ?></title>
    
    <!-- favicon -->
    <link rel=icon href="<?php echo $web['base']['url']; ?>assets/img/favicon.png" sizes="20x20" type="image/png">
    <!-- animate -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/animate.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/bootstrap.min.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/magnific-popup.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/owl.carousel.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/line-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/themify-icons.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/flaticon.css">
    <!-- slick slider -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/slick.css">
    <!-- animated slider -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/animated-slider.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/css/responsive.css">  
    <!--Codingeek -->
    <link rel="stylesheet" href="<?php echo $web['base']['url']; ?>assets/codingeek-js/codingeek.css">  
</head>
<body>

<!-- navbar area start -->
<nav class="navbar navbar-area navbar-area-2 navbar-expand-lg">
    <div class="container nav-container">
        <div class="responsive-mobile-menu">
            <div class="logo-wrapper mobile-logo">
                <a href="index.html" class="logo">
                    <img class="main-logo" src="assets/img/icon.png" alt="logo">
                    <img class="sticky-logo" src="assets/img/icon.png" alt="logo">
                </a>
            </div>
            <div class="nav-right-content">
                <ul>
                    <li class="search">
                        <i class="ti-search"></i>
                    </li>

                    <li class="notification">
                        <a href="#">
                            <i class="fa fa-heart-o"></i>
                            <span class="notification-count">1</span>
                        </a>
                    </li>
                </ul>
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#riyaqas_main_menu" 
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggle-icon">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="riyaqas_main_menu">
            <div class="logo-wrapper desktop-logo">
                <a href="index.html" class="logo">
                    <img class="main-logo" src="assets/img/icon.png" alt="logo">
                    <img class="sticky-logo" src="assets/img/icon.png" alt="logo">
                </a>
            </div>
            <ul class="navbar-nav">
                <li class="menu-item-has-children">
                    <a href="#home">Home</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#service">Service</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#about"> About Me</a>
                </li>
                <li class="menu-item-has-children">
                    <a href="#price">Harga</a>

                </li>
            </ul>
        </div>
        <div class="nav-right-content">
            <ul>
                <li class="search">
                    <i class="ti-search"></i>
                </li>

                <li class="notification">
                    <a href="#">
                        <i class="fa fa-heart-o"></i>
                        <span class="notification-count">0</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
