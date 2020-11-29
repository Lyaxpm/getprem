<?php
session_start();
require '../config.php';
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
   if (!isset($_GET['produk'])) {
    header("Location: ".$web['base']['url']);
	} 
    $post_layanan = $_GET['produk'];
    $get_lyanana = base64_decode($post_layanan);
    $c_produk  = $konek->query("SELECT * FROM produk WHERE layanan = '$get_lyanana'");
    $data_produk = mysqli_fetch_assoc($c_produk);
    if (mysqli_num_rows($c_produk) == 0) {
    header("Location: ".$web['base']['url']);
   } else {

?>
                    	<div class="row">
		    				<div class="col-md-12">
                                <form class="riyaqas-form-wrap" role="form" method="POST">     
                                 <input type="hidden" class="single-input" name="_token" value="<?php echo $config['_token'] ?>">
                                <div class="col-md-12">
                                    <div class="single-input-wrap">                              
                                        <input type="text" name="produk" class="single-input" value="<?php echo $data_produk['layanan']; ?>" readonly>                                      
                                    </div>
                                </div>
                                
                               <div class="col-md-12">
                                    <div class="single-input-wrap">                              
                                        <input type="email" name="target" class="single-input" placeholder="Email Aktif" required>                                      
                                    </div>
                                </div>                      
                                      
                                <div class="col-md-6">
                                    <div class="single-input-wrap">
                                        <select name="type" class="select single-select">
                                          <option value="GOPAY">Gopay</option>
                                          <option value="OVO">Ovo</option>
                                        </select>
                                    </div>
                                </div>                                  	
											 <div class="modal-footer">
                                            <button type="submit" class="btn btn-green" name="buy">Beli Sekarang</button>
                                        </div>
									</form>
                                </div>
                    		</div>    
<?php 
    }
} else {
    header("Location: ".$web['base']['url']);
}   