<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require '../../../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
   if (!isset($_GET['token'])) {
    header("Location: ".$web['base']['url']);
	} 
    $post_id = rudaz($_GET['token']);
    $c_produk  = $konek->query("SELECT * FROM produk WHERE id = '$post_id'");
    $produk = mysqli_fetch_assoc($c_produk);
    if (mysqli_num_rows($c_produk) == 0) {
    header("Location: ".$web['base']['url']);
   } else {

?>
                    		<div class="col-md-12">
                                <form class="form-horizontal" role="form" method="POST">
                                <input type="hidden" name="image" class="form-control" value="<?php echo $produk['image']; ?>">
                                   <div class="form-group">
                                        <label class="col-md-2 control-label">ID</label>
                                        <div class="col-md-10">
                                            <input type="text" name="id" class="form-control" value="<?php echo $produk['id']; ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Layanan</label>
                                        <div class="col-md-10">
                                            <input type="text" name="layanan" class="form-control" value="<?php echo $produk['layanan']; ?>" readonly>
                                        </div>
                                    </div>                                                                          
                                                                                                                                           
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger btn-bordred waves-effect w-md waves-light" name="delete"><i class="mdi mdi-delete"></i> Hapus</button>
                                    </div>
                                </form>
                                </div>
                    		</div>
<?php 
    }
} else {
    header("Location: ".$web['base']['url']);
}   