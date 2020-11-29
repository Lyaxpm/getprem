<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require 'config.php';

   if (isset($_POST['buy'])) {
   $type_pembayaran = rudaz($_POST['type']);
   $layanan = rudaz($_POST['produk']);
   $target = rudaz($_POST['target']);
   $reftrx = random_code(7);
   $cokie = random(20);
   $produtrx = base64_encode($cokie);
   
   $data_p  = $konek->query("SELECT * FROM produk WHERE layanan = '$layanan'");
   $produk = mysqli_fetch_assoc($data_p);
   
   $ppn = rand(1,999);
   $total = $produk['harga'] + $ppn;
  
   
   if (empty($type_pembayaran) || empty($target)) {
     $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Harap isi form yang kosong.');     
   } else {
    $insert = $konek->query("INSERT INTO pembelian VALUES ('', '$cokie', '$layanan', '$target', '$total', '".$produk['harga']."', '$ppn', '$type_pembayaran', '".$produk['rek_trx']."', 'Belum Dibayar', '$reftrx', '$date $time')");
   if ($insert == true) {   
   setcookie('_gid', base64_encode($cokie), time() + (86400 * 30), '/');
   exit(header("Location: ".$web['base']['url']."pembelian/invoice?detail=$produtrx"));
     } else {
     $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Gagal Kesalahan Syistem.'); 
       }
   }
}

require 'lib/header.php';
?>

<div class="header-area sbbs-header-area" id="home" style="background-image:url(assets/img/bg/sbbs-bg.png);">
    <div class="shape1"><img src="assets/img/bg/s1.png" alt="animate"></div>
    <div class="shape2"><img src="assets/img/bg/s2.png" alt="animate"></div>
    <div class="shape3"></div>
    <div class="shape4"></div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="header-inner text-center">
                   <!-- header inner -->
                    <h1 class="title"><?php echo $data_website['nama']; ?><span> Jasa Followers, Like, Subscribe</span></h1>
                    <div class="btn-wrapper text-center">
                        <a id="signIn-btn" class="btn btn-transparent btn-rounded" href="#produk">Beli Sekarang!</a>
                    </div>
                </div>
            </div>                      
        </div>
    </div>
</div>
<!-- header area End -->

<!-- sbbs service area start -->
<div id="service" class="service-area sbbs-service-area pd-top-112">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section-title text-center">
                    <h2 class="title">Kenapa memilih <span><?php echo $data_website['nama']; ?>?</span></h2>
                    <p>Karena kami selalu mementingkan kualitas produk dan kepuasan customer kami.</p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center no-gutters">
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-service-left">
                    <div class="media">
                        <div class="thumb media-left">
                            <img src="assets/img/icons/ff1.svg" alt="service">    
                        </div>
                        <div class="media-body">
                            <h6>Proses Order</h6>
                            <p>Hanya butuh waktu 5 menit sampai 30 menit saja.</p>
                            <a href="#">View Details<i class="la la-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-service-left">
                    <div class="media">
                        <div class="thumb media-left">
                            <img src="assets/img/icons/ff2.svg" alt="service">    
                        </div>
                        <div class="media-body">
                            <h6>Legal & Aman</h6>
                            <p>Diproses dengan metode LEGAL & Aman.</p>
                            <a href="#">View Details<i class="la la-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>                
            </div>
            <div class="col-xl-4 col-lg-4 col-md-6">
                <div class="single-service-left">
                    <div class="media">
                        <div class="thumb media-left">
                            <img src="assets/img/icons/ff3.svg" alt="service">    
                        </div>
                        <div class="media-body">
                            <h6>Team Support</h6>
                            <p>Kami siap membantu 24 jam kecuali hari libur.</p>
                            <a href="#">View Details<i class="la la-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
<!-- sbbs service area end -->

<!-- business manage area start -->
<div id="about" class="sbbs-business-manage-area mg-top-75">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-6 order-lg-12 desktop-center-item">
                <div class="text-lg-left text-center">
                    <div class="section-title style-two">
                        <h2 class="title">Apa itu <span><?php echo $data_website['nama']; ?>?</span> <br></h2>
                        <p><?php echo $data_website['nama']; ?> adalah platform premium akun seperti akun premium Spotify, Netflix, YouTube, Dll. Berikut beberapa produk aktif yang kami sediakan.</p>
                    </div>
                    <div class="riyaqas-check-list">
                        <img src="assets/img/icons/check.svg" alt="check">
                        <span>Akun YouTube Premium</span>
                    </div>
                    <div class="riyaqas-check-list">
                        <img src="assets/img/icons/check.svg" alt="check">
                        <span>Akun Netflix Premium</span>
                    </div>
                    <div class="riyaqas-check-list">
                        <img src="assets/img/icons/check.svg" alt="check">
                        <span>Akun Spotify Premium</span>
                    </div>
                    <div class="riyaqas-check-list">
                        <img src="assets/img/icons/check.svg" alt="check">
                        <span>Akun Canva Premium</span>
                    </div>
                </div>
            </div>    
        </div>
    </div>
</div>
<!-- business manage area End -->

<!-- pricing area start -->
<div id="produk" class="sbbs-pricing-area mg-top-75">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section-title text-center">
                    <h2 class="title">Harga <span>Produk</span></h2>
                    <p>Our support team will get assistance from AI-powered suggestions, making it quicker than ever to handle support requests. Our support team will get assistance from AI-powered suggestions.</p>
                </div>
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
        <div class="row no-gutters justify-content-center">
        <?php
	        $check_produk = $konek->query("SELECT * FROM produk ORDER BY id DESC");
			while ($data_produk = $check_produk->fetch_assoc()) {
		?>
            <div class="col-xl-3 col-lg-4 col-sm-6">
                <div class="single-pricing text-center">
                    <h6 class="title"><?php echo $data_produk['layanan']; ?></h6>
                    <div class="thumb">
                        <img src="assets/img/produk/<?php echo $data_produk['image']; ?>" alt="pricing">
                    </div>
                    <h3 class="price">Rp <?php echo number_format($data_produk['harga'],0,',','.'); ?>,-</h3>
                    <ul>
                        <?php echo $data_produk['deskripsi']; ?>
                    </ul>
                    <a href="javascript:;" onclick="Pembelian('<?php echo $web['base']['url']; ?>pembelian/baru?produk=<?php echo base64_encode($data_produk['layanan']); ?>')" class="btn btn-white btn-rounded">Beli Sekarang</a>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</div>

    <script type="text/javascript">
        function Pembelian(url) {
            $.ajax({
                type: "GET",
                url: url,
                beforeSend: function() {
                    $('#modal-detail-body').html('Sedang memuat...');
                },
                success: function(result) {
                    $('#modal-detail-body').html(result);
                },
                error: function() {
                    $('#modal-detail-body').html('Terjadi kesalahan.');
                }
            });
            $('#modal-detail').modal();
        }
    </script> 
         <div class="row">
            <div class="col-md-12">     
                <div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title mt-0" id="myModalLabel"><i class="mdi mdi-cart"></i> Pembelian</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <div class="modal-body" id="modal-detail-body">
                        </div>                       
                </div>
            </div>
        </div>
    </div>
</div>      

<!-- pricing area End -->

<!-- testimonial area start -->
<div class="sbba-testimonial-area mg-top-110 pd-bottom-120">
    <div class="container">
        <div class="testimonial-slider2-bg">
            <div class="row justify-content-center">
                <div class="col-xl-10">
                    <div class="testimonial-slider-2">
                        <div class="testimonial-slider-2-item">
                            <div class="media text-center">
                                <div class="media-left">
                                    <img src="assets/img/business/testimonial/2.png" alt="client">
                                </div>
                                <div class="media-body">
                                    <p>Our support team will get assistance from AI-powered suggestions, making it quicker than ever to handle support requests.</p>
                                    <h6>Madeniko Mojika</h6>
                                    <span>Branding Idendity</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-slider-2-item">
                            <div class="media text-center">
                                <div class="media-left">
                                    <img src="assets/img/business/testimonial/3.png" alt="client">
                                </div>
                                <div class="media-body">
                                    <p>Our support team will get assistance from AI-powered suggestions, making it quicker than ever to handle support requests.</p>
                                    <h6>Madeniko Mojika</h6>
                                    <span>Branding Idendity</span>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-slider-2-item">
                            <div class="media text-center">
                                <div class="media-left">
                                    <img src="assets/img/business/testimonial/4.png" alt="client">
                                </div>
                                <div class="media-body">
                                    <p>Our support team will get assistance from AI-powered suggestions, making it quicker than ever to handle support requests.</p>
                                    <h6>Madeniko Mojika</h6>
                                    <span>Branding Idendity</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require 'lib/footer.php';
?>