<?php
// Sript By Rud Az
// [ fb.me/rud.az.9 ] Jan lup add
// [ wa : 085730882379 ]
session_start();
require("../../config.php");
require("../../lib/sessi.php");

if (isset($_POST['edit'])) {
   require("../../lib/sessi_log.php");
   
  $get_id = rudaz($_POST['id']);
  $layanan = rudaz($_POST['layanan']);
  $deskripsi = $konek->real_escape_string($_POST['deskripsi']);
  $rek_trx = rudaz($_POST['rek_trx']);
  $harga = rudaz($_POST['harga']);
  $type_pembayaran = rudaz($_POST['type']);
  $image = rudaz($_POST['image']);
  $image_lama = rudaz($_POST['foto_lama']);
  
  $exts = array('image/jpg','image/jpeg','image/pjpeg','image/png','image/x-png');
  $gambar = rudaz($_FILES['image']['name']);
  $size = rudaz($_FILES['image']['size']); 
  $type = rudaz($_FILES['image']['type']); 
  $tmp_name = rudaz($_FILES['image']['tmp_name']);
  $error = rudaz($_FILES['image']['error']);
  $nama = random(12)."_".$gambar;
  
if (empty($layanan) || empty($deskripsi) || empty($rek_trx) || empty($harga)) {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Harap isi form yang kosong.'); 
  } else if (!$error AND $size > 1024000) {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Size Gambar Maxsimal 1mb.'); 
  } else if (!$error AND !in_array(($type),$exts)) {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Ektensi file tidak diizinkan.'); 
  } else { 
if ($error === "4") {
if ($konek->query("UPDATE produk SET layanan = '$layanan', harga = '$harga', deskripsi = '$deskripsi', rek_trx = '$rek_trx', type_pembayaran = '$type_pembayaran' WHERE id = '$get_id'") == true) {
   $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data produk berhasil diperbaruhi.');
  } else {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Kesalahan Syistem.');
  } 
  } else if (!$error) {
if (!$image_lama) {
    move_uploaded_file($tmp_name, "../../assets/img/produk/".$nama);
} else {
    unlink("../../assets/img/produk//".$image_lama);
    move_uploaded_file($tmp_name, "../../assets/img/produk/".$nama);
if ($konek->query("UPDATE produk SET layanan = '$layanan', harga = '$harga', deskripsi = '$deskripsi', image = '$nama', rek_trx = '$rek_trx', type_pembayaran = '$type_pembayaran' WHERE id = '$get_id'") == true) {
   $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Data produk berhasil diperbaruhi.');
  } else {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Kesalahan Syistem.');
      } 
    }
  } else {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Kesalahan Syistem(1).');
    }
  }
} else if (isset($_POST['delete'])) {
  $getid = rudaz($_POST['id']);
  $image = rudaz($_POST['image']);
  
  $cek_produk = $konek->query("SELECT * FROM produk WHERE id = '$getid'");
if ($cek_produk->num_rows == 0) {
    $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Gagal', 'pesan' => 'Produk tidak ditemukan');
  } else {
if ($konek->query("DELETE FROM produk WHERE id = '$getid'") == true) {
    unlink("../../assets/img/produk//".$image);
    $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Produk berhasil dihapus.');
      }
   }
} else if (isset($_POST['tambah'])) {
  $layanan = rudaz($_POST['layanan']);
  $deskripsi = $konek->real_escape_string($_POST['deskripsi']);
  $rek_trx = rudaz($_POST['rek_trx']);
  $harga = rudaz($_POST['harga']);
  $image = rudaz($_POST['image']);
  $type_pembayaran = rudaz($_POST['type']);
  
  $exts = array('image/jpg','image/jpeg','image/pjpeg','image/png','image/x-png');
  $gambar = rudaz($_FILES['image']['name']);
  $size = rudaz($_FILES['image']['size']); 
  $type = rudaz($_FILES['image']['type']); 
  $tmp_name = rudaz($_FILES['image']['tmp_name']);
  $error = rudaz($_FILES['image']['error']);
  $nama = random(12)."_".$gambar;
  
  if (empty($layanan) || empty($deskripsi) || empty($rek_trx) || empty($harga)) {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Harap isi form yang kosong.'); 
  } else if (!$error AND $size > 1024000) {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Size Gambar Maxsimal 1mb.'); 
  } else if (!$error AND !in_array(($type),$exts)) {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Ektensi file tidak diizinkan.'); 
  } else if ($error === "4") {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Harap upload gambar.'); 
  } else { 
   move_uploaded_file($tmp_name, "../../assets/img/produk/".$nama);
if ($konek->query("INSERT INTO produk VALUES ('','$layanan' ,'$harga' ,'$deskripsi' ,'$nama', '$rek_trx', '$type_pembayaran')") == true) {
   $_SESSION['hasil'] = array('alert' => 'success', 'judul' => 'Berhasil', 'pesan' => 'Produk baru berhasil ditambah.');
  } else {
   $_SESSION['hasil'] = array('alert' => 'danger', 'judul' => 'Failed', 'pesan' => 'Kesalahan sistem.'); 
     }
  }
}
include("../../lib/headeradm.php");
?>

     <div class="row">
            <div class="col-md-12">
                <div class="modal fade bs-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title m-t-0"><i class="mdi mdi-database"></i> Tambah Produk</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                            <div class="modal-body">
                                <form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nama Layanan</label>
                                        <div class="col-md-10">
                                            <input type="text" name="layanan" class="form-control" placeholder="Nama Layanan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Deskripsi</label>
                                        <div class="col-md-10">
                                            <textarea name="deskripsi" class="form-control" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Tujuan Trx</label>
                                        <div class="col-md-10">
                                            <input type="text" name="rek_trx" class="form-control" placeholder="Tujuan Trx">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Harga Layanan</label>
                                        <div class="col-md-10">
                                            <input type="number" name="harga" class="form-control" placeholder="Harga Layanan">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Type Pembayaran</label>
                                        <div class="col-md-10">
                                           <select name="type" class="form-control">                                              
                                              <option value="OVO">Ovo</option>
                                              <option value="GOPAY">Gopay</option>
                                            </select>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Gambar</label>
                                        <div class="col-md-10">
                                            <input type="file" name="image" class="form-control">
                                        </div>
                                    </div>                              

                                    <div class="modal-footer">
                                        <button type="reset" class="btn btn-danger btn-bordred waves-effect" data-dismiss="modal"><i class="mdi mdi-refresh"></i> Reset</button>
                                        <button type="submit" class="btn btn-info btn-bordred waves-effect w-md waves-light" name="tambah"><i class="mdi mdi-plus"></i> Tambah</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="m-t-0 header-title"><b><i class="mdi mdi-database"></i> Produk Aktif</b></h4>
                                   <button data-toggle="modal" data-target="#addModal" class="btn btn-info form-control"><i class="mdi mdi-plus"></i> Tambah Produk</button> 
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
                                                    <input type="text" class="form-control" name="search" placeholder="Cari Kata Code">
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
                                        <th>Layanan</th>
                                        <th>Deskripsi</th>
                                        <th>Harga</th>
                                        <th>Rek Trx</th>
                                        <th>Type Pembayaran</th>
                                        <th>Gambar</th>
                                        <th>Setting</th>
                                    </tr>
                                    </thead>
                                    <tbody>
<?php 
// start paging config
if (isset($_GET['search'])) {
    $search = rudaz($_GET['search']);
    $tampil = rudaz($_GET['tampil']);

    $cek_data = "SELECT * FROM produk WHERE layanan LIKE '%$search%' ORDER BY id DESC"; // edit
} else {
    $cek_data = "SELECT * FROM produk ORDER BY id DESC"; // edit
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
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $datanya['layanan'] ?></td>
                                        <td><?php echo $datanya['deskripsi'] ?></td>
                                        <td><?php echo number_format($datanya['harga'],0,',','.'); ?></td>
                                        <td><?php echo $datanya['rek_trx']; ?></td>
                                        <td><?php echo $datanya['type_pembayaran']; ?></td>
                                        <td><?php echo $datanya['image']; ?></td>
                                        <td align="center">
                                          <a href="javascript:;" onclick="produk('Settings','<?php echo $web['base']['url']; ?>adm/set/aya/edit?token=<?php echo $datanya['id']; ?>')" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil" title="Edit"></i></a>
                                          <a href="javascript:;" onclick="produk('Hapus','<?php echo $web['base']['url']; ?>adm/set/aya/delete?token=<?php echo $datanya['id']; ?>')" class="btn btn-sm btn-danger"><i class="mdi mdi-delete" title="Hapus"></i></a>
                                        </td>                                        
                                    </tr>   
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
function produk(name,link) {
    $('#produk-detail').modal();
    $.ajax({
        type: "GET",
        data: {
            "ajax": "modal"
        },
        url: link,
        beforeSend: function() {
            $('#produk-detail-title').html(name);
            $('#produk-detail-body').html('Loading...');
        },
        success: function(result) {
            $('#produk-detail-title').html(name);
            $('#produk-detail-body').html(result);
        },
        error: function() {
            $('#produk-detail-title').html(name);
            $('#produk-detail-body').html('There is an error...');
        }
    });
}
</script>
 <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" id="produk-detail">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="produk-detail-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="produk-detail-body"></div>
        </div>
    </div>
</div>

<?php
include("../../lib/footeradm.php");
?>