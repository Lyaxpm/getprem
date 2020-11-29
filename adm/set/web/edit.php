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
    $c_web  = $konek->query("SELECT * FROM website WHERE id = '$post_id'");
    $website = mysqli_fetch_assoc($c_web);
    if (mysqli_num_rows($c_web) == 0) {
    header("Location: ".$web['base']['url']);
   } else {

?>
                    		<div class="col-md-12">
                                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST">
                                   <div class="form-group">
                                        <label class="col-md-2 control-label">Nama</label>
                                        <div class="col-md-10">
                                            <input type="text" name="nama" class="form-control" value="<?php echo $website['nama']; ?>" readonly>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Title Web</label>
                                        <div class="col-md-10">
                                            <input type="text" name="title" class="form-control" value="<?php echo $website['title']; ?>">
                                        </div>
                                    </div>                                                                          
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Deskripsi</label>
                                        <div class="col-md-10">
                                            <textarea name="deskripsi" class="form-control" rows="5"><?php echo $website['deskripsi']; ?></textarea>
                                        </div>
                                    </div> 
                                   <div class="form-group">
                                        <label class="col-md-2 control-label">Kata Kunci Web</label>
                                        <div class="col-md-10">
                                            <textarea name="kata_kunci" class="form-control" rows="5"><?php echo $website['kata_kunci']; ?></textarea>
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