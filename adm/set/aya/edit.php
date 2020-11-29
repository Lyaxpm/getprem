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
                                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST">
                                <input type="hidden" name="foto_lama" class="form-control" value="<?php echo $produk['image']; ?>">
                                   <div class="form-group">
                                        <label class="col-md-2 control-label">ID</label>
                                        <div class="col-md-10">
                                            <input type="text" name="id" class="form-control" value="<?php echo $produk['id']; ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Layanan</label>
                                        <div class="col-md-10">
                                            <input type="text" name="layanan" class="form-control" value="<?php echo $produk['layanan']; ?>">
                                        </div>
                                    </div>                                                                          
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Deskripsi</label>
                                        <div class="col-md-10">
                                            <textarea name="deskripsi" class="form-control" rows="5"><?php echo $produk['deskripsi']; ?></textarea>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tujuan Trx</label>
                                        <div class="col-md-10">
                                            <input type="text" name="rek_trx" class="form-control" value="<?php echo $produk['rek_trx']; ?>">
                                        </div>
                                    </div>    
                                    <div class="form-group">
                                        <label class="col-md-10 control-label">Harga</label>
                                        <div class="col-md-10">
                                            <input type="number" name="harga" class="form-control" value="<?php echo $produk['harga']; ?>">
                                        </div>
                                    </div> 
                                     <div class="form-group">
                                        <label class="col-md-2 control-label">Type Pembayaran</label>
                                        <div class="col-md-10">
                                            <select name="type" class="form-control">
                                              <option value="<?php echo $produk['type_pembayaran']; ?>"><?php echo $produk['type_pembayaran']; ?></option>
                                              <option value="OVO">Ovo</option>
                                              <option value="GOPAY">Gopay</option>
                                            </select>
                                         </div>
                                     </div>    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Gambar</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control">
                                              <small><font color="red">Max size 1mb. <br> Image size 600x201.</small>
                                        </div>
                                    </div>
                                                                                                                                          
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning btn-bordred waves-effect w-md waves-light" name="edit"><i class="mdi mdi-pencil"></i> Update</button>
                                    </div>
                                </form>
                                </div>
                    		</div>
<?php 
    }
} else {
    header("Location: ".$web['base']['url']);
}   