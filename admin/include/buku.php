<?php


  if(isset($_POST['katakunci'])){
      $katakunci_buku=$_POST['katakunci'];
      $_SESSION['katakunci_buku']=$katakunci_buku;
  }

  if(isset($_SESSION['katakunci_buku'])){
      $katakunci_buku=$_SESSION['katakunci_buku'];
  }

  if((isset($_GET['aksi']))&&(isset($_GET['data']))){
    if($_GET['aksi']=='hapus'){
      $id_buku=$_GET['data'];

      $sql_f="select `cover` from `buku` where `id_buku`='$id_buku'";
      $query_f=mysqli_query($koneksi,$sql_f);
      $jumlah_f=mysqli_num_rows($query_f);
      if($jumlah_f>0){
        while($data_f=mysqli_fetch_row($query_f)){
          $cover=$data_f[0];

          unlink("cover/$cover");
        }
      }
      $sql_dh="delete from `tag_buku` where `id_buku`='$id_buku'";
      mysqli_query($koneksi,$sql_dh);

      $sql_dm="delete from `buku` where `id_buku`='$id_buku'";
      mysqli_query($koneksi,$sql_dm);
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
<?php include("includes/head.php") ?> 
</head>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><i class="fas fa-book"></i> Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar  Buku</h3>
                <div class="card-tools">
                  <a href="index.php?include=tambah-buku" class="btn btn-sm btn-info float-right">
                  <i class="fas fa-plus"></i> Tambah  Buku</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="col-md-12">
                  <form method="POST" action="index.php?include=buku">
                    <div class="row">
                        <div class="col-md-4 bottom-10">
                          <input type="text" class="form-control" id="kata_kunci" name="katakunci">
                        </div>
                        <div class="col-md-5 bottom-10">
                          <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i>&nbsp; Search</button>
                        </div>
                    </div><!-- .row -->
                  </form>
                </div><br>
              <div class="col-sm-12">
              <?php if(!empty($_GET['notif'])){ ?>
                <?php if($_GET['notif']=="tambahberhasil"){ ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Ditambahkan</div>
                <?php }else if($_GET['notif']=="editberhasil"){ ?>  
                  <div class="alert alert-success" role="alert">Data Berhasil Diubah</div>
                <?php }else if($_GET['notif']=="hapusberhasil"){ ?>
                  <div class="alert alert-success" role="alert">Data Berhasil Dihapus</div>
                <?php } ?>  
              <?php } ?>  
              </div>
                  <table class="table table-bordered">
                    <thead>                  
                      <tr>
                        <th width="5%">No</th>
                        <th width="30%">Kategori</th>
                        <th width="30%">Judul</th>
                        <th width="20%">Penerbit</th>
                        <th width="15%"><center>Aksi</center></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      $batas=5;
                      if(!isset($_GET['halaman'])){
                        $posisi=0;
                        $halaman=1;    
                      }else{
                        $halaman=$_GET['halaman'];
                        $posisi=($halaman-1)*$batas;
                      }
                      $sql_k="select `b`.`id_buku`,`k`.`kategori_buku`,`b`.`judul`,`p`.`penerbit` 
                      from `buku` `b` inner join `kategori_buku` `k` on `b`.`id_kategori_buku`=`k`.`id_kategori_buku` 
                      inner join `penerbit` `p` on `b`.`id_penerbit`=`p`.`id_penerbit`";
                      if(!empty($katakunci_buku)){
                        $sql_k.="where `b`.`judul` LIKE '%$katakunci_buku%'";
                      }
                      $sql_k.="order by `k`.`kategori_buku`,`b`.`judul` limit $posisi,$batas";
                      $query_k=mysqli_query($koneksi,$sql_k);
                      $no=$posisi+1;

                      while($data_k=mysqli_fetch_row($query_k)){
                        $id_buku=$data_k[0];
                        $kategori_buku=$data_k[1];
                        $judul=$data_k[2];
                        $penerbit=$data_k[3];
                    ?>
                      <tr>
                      <td><?php echo $no ?></td>
                      <td><?php echo $kategori_buku ?></td>
                      <td><?php echo $judul ?></td>
                      <td><?php echo $penerbit ?></td>
                        <td align="center">
                          <a href="index.php?include=edit-buku&data=<?php echo $id_buku; ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i></a>
                          <a href="index.php?include=detail-buku&data=<?php echo $id_buku ?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i></a>
                          <a href="javascript:if(confirm('Anda yakin ingin menghapus data <?php echo $judul; ?>?'))
                            window.location.href='index.php?include=buku&aksi=hapus&data=<?php echo $id_buku; ?>&notif=hapusberhasil'" 
                            class="btn btn-xs btn-warning"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      <?php
                      $no++;
                      } ?>
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
              <?php 
                  //Hitung Jumlah Semua Data
                  $sql_jum="select `b`.`id_buku`,`k`.`kategori_buku`,`b`.`judul`,`p`.`penerbit` 
                  from `buku` `b` inner join `kategori_buku` `k` on `b`.`id_kategori_buku`=`k`.`id_kategori_buku` 
                  inner join `penerbit` `p` on `b`.`id_penerbit`=`p`.`id_penerbit`";
                  if(!empty($katakunci_buku)){
                    $sql_jum.="where `b`.`judul` LIKE '%$katakunci_buku%'";
                  }
                  $sql_jum.="order by `b`.`judul`";
                  $query_jum=mysqli_query($koneksi,$sql_jum);
                  $jum_data=mysqli_num_rows($query_jum);
                  $jum_halaman=ceil($jum_data/$batas);
                ?>
                <ul class="pagination pagination-sm m-0 float-right">
                <?php
                  if($jum_halaman==0){

                  }else if($jum_halaman==1){
                    echo "<li class='page-item'><a class='page-link'>1</a></li>";
                  }else{
                    $sebelum=$halaman-1;
                    $setelah=$halaman+1;
                  
                    if($halaman!=1){
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=buku&halaman=1'>First</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=buku&halaman=$sebelum'>&laquo;</a></li>";
                    }

                    for($i=1; $i<=$jum_halaman; $i++){
                      if($i>$halaman-5 and $i<$halaman+5){
                      if($i!=$halaman){
                        echo "<li class='page-item'><a class='page-link' href='index.php?include=buku&halaman=$i'>$i</a></li>";
                      }else{
                        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                      }
                    }

                    if($halaman!=$jum_halaman){
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=buku&halaman=$setelah'>&raquo;</a></li>";
                      echo "<li class='page-item'><a class='page-link' href='index.php?include=buku&halaman=$jum_halaman'>Last</a></li>";
                    }
                  }
                  ?>
                </ul>
              </div>
            </div>
            <!-- /.card -->

    </section>
</html>
