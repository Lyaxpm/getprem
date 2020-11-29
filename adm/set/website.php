<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require '../../config.php';
require("../../lib/sessi.php");
require("../../lib/sessi_log.php");

 if (isset($_POST['edit'])) {
            $post_nama = rudaz($_POST['nama']);
            $post_title = $konek->real_escape_string(trim($_POST['title']));
            $post_des = $konek->real_escape_string(trim($_POST['deskripsi']));
            $post_kunci = $konek->real_escape_string(trim($_POST['kata_kunci']));

                if ($konek->query("UPDATE website SET nama = '$post_nama', title = '$post_title', deskripsi = '$post_des', kata_kunci = '$post_kunci' WHERE id = '1'") == true) {
                    $_SESSION['hasil'] = array(
                        'alert' => 'success', 
                        'judul' => 'Berhasil', 
                        'pesan' => 'Pengaturan Website Telah Berhasil Diubah <br />');                    
                } else {
                    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Sistem Error!');
                }
            }
        
    require("../../lib/headeradm.php");
?>       
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="m-t-0 header-title"><b><i class="fa fa-gears"></i>    Pengaturan Website </b></h4>                             
                                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Title Website</th>
                                        <th>Deskripsi Website</th>
                                        <th>Kata Kunci</th>
                                        <th>Aksi</th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php 
$CekData = $konek->query("SELECT * FROM website WHERE id = '1'"); // edit
while ($ShowData = $CekData->fetch_assoc()) {
?>
                                    <tr> 
                                        <td><?php echo $ShowData['nama']; ?></td>
                                        <td><?php echo $ShowData['title']; ?></td>
                                        <td><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['deskripsi']; ?></textarea></td>
                                        <td><textarea rows="5" cols="100" name="konten" class="form-control" readonly><?php echo $ShowData['kata_kunci']; ?></textarea></td>
                                        <td align="center">
                                            <a href="javascript:;" onclick="users('<?php echo $web['base']['url']; ?>adm/set/web/edit?token=1')" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil" title="Edit"></i></a>
                                        </td>                                 
                                    </tr>  
<?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <script type="text/javascript">
        function users(url) {
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
                                <h4 class="modal-title mt-0" id="myModalLabel"><i class="mdi mdi-gears"></i> Pengaturan Website</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                        <div class="modal-body" id="modal-detail-body">
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require '../../lib/footeradm.php';
?>