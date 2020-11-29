<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require("../../config.php");
require("../../lib/sessi.php");

if (isset($_POST['update'])) {
   require("../../lib/sessi_log.php");
   
   $reftrx = rudaz($_GET['reftrx']);
   $status = rudaz($_POST['status']);

   $cek_pembelian = $konek->query("SELECT * FROM pembelian WHERE reftrx = '$reftrx'");
   $data_pembelian = $cek_pembelian->fetch_assoc();
        
if ($cek_pembelian->num_rows == 0) {
    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data pembelian tidak ditemukan');
  } else {
if ($konek->query("UPDATE pembelian SET status = '$status' WHERE reftrx = '$reftrx'") == true){
    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data pembelian berhasil di update');
  } else {
    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Gagal');
        }
    }
} else if (isset($_POST['hapus'])) {

  $reftrx = rudaz($_GET['reftrx']);
  $cek_pembelian = $konek->query("SELECT * FROM pembelian WHERE reftrx = '$reftrx'");
        
if ($cek_pembelian->num_rows == 0) {
  $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Data pembelian tidak ditemukan');
 } else {
if ($konek->query("DELETE FROM pembelian WHERE reftrx = '$reftrx'") == true) {
  $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data pembelian berhasil di hapus');
            }
        }
    }

include("../../lib/headeradm.php");
?>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="m-t-0 header-title"><b><i class="mdi mdi-database"></i> Data Pembelian</b></h4>
                                     <br />                           
                                        <form>
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label>Tampilkan Beberapa</label>
                                                    <select class="form-control" name="tampil">
                                                        <option value="10">10</option>
                                                        <option value="20">20</option>
                                                        <option value="50">50</option>
                                                        <option value="100">100</option>
                                                    </select>
                                                </div>                                             
                                                <div class="form-group col-lg-4">
                                                    <label>Cari Kata Kunci</label>
                                                    <input type="text" class="form-control" name="search" placeholder="Cari Ref Trx">
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Submit</label>
                                                    <button type="submit" class="btn btn-block btn-primary">Filter</button>
                                                </div>
                                            </div>
                                        </form>
                                        
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered nowrap m-0">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ref Trx</th>
                                        <th>Layanan</th>
                                        <th>Target</th>
                                        <th>Type Pembayaran</th>
                                        <th>Harga</th>
                                        <th>PPN</th>
                                        <th>Pembayaran</th>
                                        <th>Tanggal & Waktu</th>
                                        <th>Status</th>
                                        <th>Ubah Data</th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php 
// start paging config
if (isset($_GET['search'])) {
    $search = rudaz($_GET['search']);
    $tampil = rudaz($_GET['tampil']);

    $cek_data = "SELECT * FROM pembelian WHERE reftrx LIKE '%$search%' ORDER BY id DESC"; // edit
} else {
    $cek_data = "SELECT * FROM pembelian ORDER BY id DESC"; // edit
}
if (isset($_GET['search'])) {
$cari_urut = rudaz($_GET['tampil']);
$records_per_page = $cari_urut; // edit
} else {
    $records_per_page = 10; // edit
}

$starting_position = 0;
if(isset($_GET["halaman"])) {
    $starting_position = (rudaz($_GET["halaman"])-1) * $records_per_page;
}
$new_query = $cek_data." LIMIT $starting_position, $records_per_page";
$new_query = $konek->query($new_query);
$no = $starting_position+1;
// end paging config
while ($datanya = $new_query->fetch_assoc()) {
?>
                                    <tr>
                                        <form action="<?php echo $web['base']['url']; ?>adm/set/pembelian?reftrx=<?php echo $datanya['reftrx']; ?>" role="form" method="POST"> 
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $datanya['reftrx']; ?></td>
                                        <td><?php echo $datanya['layanan'] ?></td>
                                        <td><?php echo $datanya['target'] ?></td>
                                        <td><?php echo $datanya['type_pembayaran'] ?></td>
                                        <td><?php echo number_format($datanya['harga'],0,',','.'); ?></td>
                                        <td><?php echo number_format($datanya['ppn'],0,',','.'); ?></td>
                                        <td><?php echo number_format($datanya['pembayaran'],0,',','.'); ?></td>
                                        <td><?php echo $datanya['waktu'] ?></td>
                                        <td>
                                            <select class="form-control" style="width: 100px;" name="status">
                                            <?php if ($datanya['status'] == "") { ?>
                                                <option value="<?php echo $datanya['status']; ?>"><?php echo $datanya['status']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $datanya['status']; ?>"><?php echo $datanya['status']; ?></option>
                                                <option value="Belum Dibayar">Belum Dibayar</option>                                               
                                                <option value="Lunas">Lunas</option>
                                            <?php
                                            }
                                            ?>
                                            </select>
                                        </td>
                                        <td align="center">
                                            <button data-toggle="tooltip" title="Update" type="submit" name="update" class="btn btn-sm btn-bordred btn-info"><i class="mdi mdi-pencil"></i></button>
                                            <button data-toggle="tooltip" title="Hapus" type="submit" name="hapus" class="btn btn-sm btn-bordred btn-danger"><i class="mdi mdi-delete"></i></button>
                                        </td>                                             
                                    </tr>   
                                 </form
                             <?php } ?>
                          </tbody>
                      </table>
                   </div>
                <br>
  <ul class="pagination pagination-split">
<?php
// start paging link
if (isset($_GET['search'])) {
$cari_urut = rudaz($_GET['search']);
} else {
$cari_urut =  10;
}  
if (isset($_GET['search'])) {
    $search = rudaz($_GET['search']);
    $tampil = rudaz($_GET['tampil']);
} else {
    $self = $_SERVER['PHP_SELF'];
}
$cek_data = $konek->query($cek_data);
$total_records = mysqli_num_rows($cek_data);
echo "<li class='disabled page-item'><a class='page-link' href='#'>Total Data : ".$total_records."</a></li>";
if($total_records > 0) {
    $total_pages = ceil($total_records/$records_per_page);
    $current_page = 1;
    if(isset($_GET["halaman"])) {
        $current_page = rudaz($_GET["halaman"]);
        if ($current_page < 1) {
            $current_page = 1;
        }
    }
    if($current_page > 1) {
        $previous = $current_page-1;
if (isset($_GET['search'])) {
    $search = rudaz($_GET['search']);

        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1&tampil=".$tampil."&search=".$search."'><<</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."&tampil=".$tampil."&search=".$search."'><</a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=1'><<</a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$previous."'><</a></li>";
}
}
    // limit page
    $limit_page = $current_page+3;
    $limit_show_link = $total_pages-$limit_page;
    if ($limit_show_link < 0) {
        $limit_show_link2 = $limit_show_link*2;
        $limit_link = $limit_show_link - $limit_show_link2;
        $limit_link = 3 - $limit_link;
    } else {
        $limit_link = 3;
    }
    $limit_page = $current_page+$limit_link;
    // end limit page
    // start page
    if ($current_page == 1) {
        $start_page = 1;
    } else if ($current_page > 1) {
        if ($current_page < 4) {
            $min_page  = $current_page-1;
        } else {
            $min_page  = 3;
        }
        $start_page = $current_page-$min_page;
    } else {
        $start_page = $current_page;
    }
    // end start page
    for($i=$start_page; $i<=$limit_page; $i++) {
if (isset($_GET['search'])) {
    $search = rudaz($_GET['search']);
    $tampil = rudaz($_GET['tampil']);
        if($i==$current_page) {
            echo "<li class='active page-item'><a class='page-link' href='#'>".$i."</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$i."&tampil=".$cari_urut."&status=".$cari_status."&cari=".$cari_oid."'>".$i."</a></li>";
        }
    } else {
        if($i==$current_page) {
            echo "<li class='active page-item'><a class='page-link' href='#'>".$i."</a></li>";
        } else {
            echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$i."'>".$i."</a></li>";
        }        
    }
    }
    if($current_page!=$total_pages) {
        $next = $current_page+1;
if (isset($_GET['search'])) {
    $search = rudaz($_GET['search']);
    $tampil = rudaz($_GET['tampil']);

        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."&tampil=".$tampil."&search=".$search."'>></a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."&tampil=".$tampil."&search=".$search."'>>></a></li>";
} else {
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$next."'>></a></li>";
        echo "<li class='page-item'><a class='page-link' href='".$self."?halaman=".$total_pages."'>>></a></li>";
    }
}
}
// end paging link
?>
                                        </ul>
                        </div>
                    </div>
                </div>
            </div>     
            
<script type="text/javascript">
function copy_to_clipboard(element) {
    var copyText = document.getElementById(element);
    copyText.select();
    document.execCommand("copy");
}
</script>    

<?php
include("../../lib/footeradm.php");
?>