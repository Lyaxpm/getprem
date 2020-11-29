<?php
session_start();
require '../config.php';
   if (!isset($_GET['detail'])) {
      header("Location: ".$web['base']['url']);
   } else {
    $post_detail = rudaz($_GET['detail']);
    $getdetail = base64_decode($post_detail);
    $c_detail  = $konek->query("SELECT * FROM pembelian WHERE cookie = '$getdetail'");
    $detail = $c_detail->fetch_assoc();
    
   if ($detail['status'] == "Belum Dibayar") {
       $label = "danger";
       $pesan = "Unpaid";
   } else if ($detail['status'] == "Lunas") {
       $label = "success";
       $pesan = "Paid";   
 }
    $chat = "*Detail pesanan*%0A%0A*Reftrx:* ".$detail['reftrx']."%0A*Invoice Date:* ".$detail['waktu']."%0A*Status:* $pesan%0A%0A*Layanan:* ".$detail['layanan']."%0A*Harga:* ".number_format($detail['pembayaran'],0,',','.')."%0A*Type Pembayaran:* ".$detail['type_pembayaran']."%0A%0A*Tujuan TF:* ".$detail['trx']."%0A*Target:* ".$detail['target']."%0A%0A*Link Invoice:* ".$web['base']['url']."pembelian/invoice?detail=$post_detail";
    
    if (mysqli_num_rows($c_detail) == 0) {
    header("Location: ".$web['base']['url']);         
      } 
  }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Shreyu - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?php echo $web['base']['url']; ?>adm/assets/images/favicon.ico">

        <!-- App css -->
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $web['base']['url']; ?>adm/assets/css/app.min.css" rel="stylesheet" type="text/css" />

    </head>

    <body>

            <div class="content-page">
                <div class="content">                    
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <!-- Logo & title -->
                                        <div class="clearfix">
                                            <div class="float-sm-light">
                                                <h4 class="m-0 d-inline align-middle"><b>Get Premium</b></h4>
                                            </div><br>
                                            <div class="float-sm-left">
                                                <h4 class="m-0 d-print-none">Invoice</h4>
                                                <dl class="row mb-2 mt-3">
                                                    <dt class="col-sm-3 font-weight-normal">Reftrx :</dt>
                                                    <dd class="col-sm-9 font-weight-normal">#<?php echo $detail['reftrx']; ?></dd>

                                                    <dt class="col-sm-3 font-weight-normal">Invoice Date :</dt>
                                                    <dd class="col-sm-9 font-weight-normal"><?php echo $detail['waktu']; ?></dd>

                                                    <dt class="col-sm-3 font-weight-normal">Status :</dt>
                                                    <dd class="col-sm-9 font-weight-normal"><b class="text-<?php echo $label; ?>"><?php echo $pesan; ?></b></dd>
                                                </dl>
                                            </div>
                                            
                                        </div>

                                        <div class="row">
                                            <div class="col-12">
                                                <div class="table-responsive">
                                                    <table class="table mt-4 table-centered">
                                                        <thead>
                                                            <tr>
                                                                <th>Layanan</th>
                                                                <th>Type Pembayaran</th>
                                                                <th>Tujuan</th>
                                                                <th style="width: 10%">Harga</th>
                                                                <th style="width: 10%">PPN</th>
                                                                <th style="width: 10%" class="text-right">Total</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                  <?php echo $detail['layanan']; ?>                                                                
                                                                </td>
                                                                <td>
                                                                  <?php echo $detail['type_pembayaran']; ?>
                                                                </td>  
                                                                <td>
                                                                  <?php echo $detail['trx']; ?>
                                                                </td>                                                              
                                                                <td class="text-right">
                                                                  <?php echo number_format($detail['harga'],0,',','.'); ?>
                                                                </td>
                                                                 <td class="text-right">
                                                                  <?php echo number_format($detail['ppn'],0,',','.'); ?>
                                                                </td>
                                                                 <td class="text-right">
                                                                  <?php echo number_format($detail['pembayaran'],0,',','.'); ?>
                                                                </td>
                                                            </tr>                                                         
                                                        </tbody>
                                                    </table>
                                                </div> <!-- end table-responsive -->
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="clearfix pt-5">
                                                    <h6 class="text-muted">Catatan:</h6>

                                                    <small class="text-muted">
                                                        Silahkan transfer ke nomor <b><?php echo $detail['trx']; ?></b> dengan type pembayaran <?php echo $detail['type_pembayaran']; ?>, tunggu sekitar
                                                        10 menit maka orderan otomatis terproses, untuk pengecekan akun silahkan cek email anda.<br><br>                                                        
                                                        Kamu juga bisa konfirmasi pembayaran lewat whatsapp dengan klik tombol yang sudah disediakan.
                                                    </small>
                                                    <br><br>
                                                    <small class="text-muted">
                                                       <font class="text-danger">Penting : </font> Jika transfer sertakan <b>Reftrx</b> di kolom catatan yang sudah disediakan oleh pihak  <?php echo $detail['type_pembayaran']; ?><br>
                                                       <b>Contoh : <font class="text-warning">Reftrx : #<?php echo $detail['reftrx']; ?></font></b>
                                                    </small>
                                                    
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-sm-6">
                                                <div class="float-right mt-4">
                                                    <p><span class="font-weight-medium"><b>Sub-total:</b></span>                                                
                                                    <h3>Rp  <?php echo number_format($detail['pembayaran'],0,',','.'); ?></h3>
                                                    <hr>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="mt-5 mb-1">
                                            <div class="text-right d-print-none">
                                                <a href="javascript:window.print()" class="btn btn-primary"><i class="uil uil-print mr-1"></i> Print</a>
                                                <a href="https://api.whatsapp.com/send?phone=6285730882379&text=<?= $chat; ?>" class="btn btn-warning"><i class="uil uil-whatsapp mr-1"></i>Konfirmasi</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        <!-- Vendor js -->
        <script src="<?php echo $web['base']['url']; ?>adm/assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="<?php echo $web['base']['url']; ?>adm/assets/js/app.min.js"></script>
        
    </body>
</html>
