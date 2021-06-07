<?php
  $user=$_SESSION['username'];
  $lev=$_SESSION['level'];

  if(isset($_GET['data'])){
    $id_buku=$_GET['data'];

    $sql_d="select `b`.`cover`,`k`.`kategori_buku`,`b`.`judul`,`b`.`pengarang`,`b`.`tahun_terbit`,
    `p`.`penerbit`,`b`.`sinopsis` from `buku` `b`
    inner join `kategori_buku` `k` on `b`.`id_kategori_buku`=`k`.`id_kategori_buku`
    inner join `penerbit` `p` on `b`.`id_penerbit`=`p`.`id_penerbit`
    where `b`.`id_buku`='$id_buku'";
    $query_d=mysqli_query($koneksi,$sql_d);
    while($data_d=mysqli_fetch_row($query_d)){
      $cover=$data_d[0];
      $kategori_buku=$data_d[1];
      $judul=$data_d[2];
      $pengarang=$data_d[3];
      $tahun_terbit=$data_d[4];
      $penerbit=$data_d[5];
      $sinopsis=$data_d[6];
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
            <h3><i class="fas fa-user-tie"></i> Detail Data Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item"><a href="index.php?include=buku">Data Buku</a></li>
              <li class="breadcrumb-item active">Detail Data Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
            <div class="card">
              <div class="card-header">
                <div class="card-tools">
                  <a href="index.php?include=buku" class="btn btn-sm btn-warning float-right">
                  <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                    <tbody>                      
                      <tr>
                        <td><strong>Cover Buku<strong></td>
                        <td><img src="cover/<?php echo $cover ?>" class="img-fluid" width="200px;"></td>
                      </tr>               
                      <tr>
                        <td width="20%"><strong>Kategori Buku<strong></td>
                        <td width="80%"><?php echo $kategori_buku ?></td>
                      </tr>                 
                      <tr>
                        <td width="20%"><strong>Judul<strong></td>
                        <td width="80%"><?php echo $judul ?></td>
                      </tr>                 
                      <tr>
                        <td width="20%"><strong>Pengarang<strong></td>
                        <td width="80%"><?php echo $pengarang ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Penerbit<strong></td>
                        <td width="80%"><?php echo $penerbit ?></td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Tahun Terbit<strong></td>
                        <td width="80%"><?php echo $tahun_terbit ?></td>
                      </tr>
                      <tr>
                        <td><strong>Tag<strong></td>
                        <td>
                          <ul>
                              <?php
                                $sql_tag="select `t`.`tag` from `tag_buku` `tb`
                                inner join `tag` `t` on `tb`.`id_tag`=`t`.`id_tag`
                                where `tb`.`id_buku`='$id_buku'";
                                $query_tag=mysqli_query($koneksi,$sql_tag);
                                while($data_tag=mysqli_fetch_row($query_tag)){
                                  $tag=$data_tag[0];
                              ?>
                              <li><?php echo $tag; ?></li>
                              <?php } ?>
                          </ul>
                        </td>
                      </tr>
                      <tr>
                        <td width="20%"><strong>Sinopsis<strong></td>
                        <td width="80%"><?php echo $sinopsis ?></td>
                      </tr> 
                    </tbody>
                  </table>  
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">&nbsp;</div>
            </div>
            <!-- /.card -->

    </section>
</html>
