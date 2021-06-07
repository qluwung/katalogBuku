<?php
  if(isset($_GET['data'])){
    $id_blog=$_GET['data'];
    $_SESSION['id_blog']=$id_blog;

    $sql_m="select `id_kategori_blog`,`judul`,`isi` from `blog` where `id_blog`='$id_blog'";
    $query_m=mysqli_query($koneksi,$sql_m);
    while($data_m=mysqli_fetch_row($query_m)){
      $id_kategori_blog=$data_m[0];
      $judul=$data_m[1];
      $isi=$data_m[2];
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
            <h3><i class="fas fa-edit"></i> Edit Data Blog</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=blog">Data Blog</a></li>
              <li class="breadcrumb-item active">Edit Data Blog</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Blog</h3>
        <div class="card-tools">
          <a href="index.php?include=blog" class="btn btn-sm btn-warning float-right">
          <i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br></br>
      <div class="col-sm-10">
      <?php if((!empty($_GET['notif']))&&(!empty($_GET['jenis']))){ ?>
          <?php if($_GET['notif']=='editkosong') ?>
          <div class="alert alert-danger" role="alert">Maaf Data 
          <?php echo $_GET['jenis'] ?> Wajib Di Isi</div>
          <?php } ?>
      </div>
      <form class="form-horizontal" method="POST" action="index.php?include=konfirmasi-edit-blog">
        <div class="card-body">
          
        <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Kategori Blog</label>
            <div class="col-sm-7">
              <select class="form-control" id="kategori" name="kategori_blog">
                <option value="">- Pilih Kategori -</option>
                <?php
                  $sql_bl="select `id_kategori_blog`,`kategori_blog` from `kategori_blog` order by `kategori_blog`";
                  $query_bl=mysqli_query($koneksi,$sql_bl);
                  while($data_bl=mysqli_fetch_row($query_bl)){
                    $id_bl=$data_bl[0];
                    $bl=$data_bl[1];
                ?>
                <option value="<?php echo $id_bl; ?>" 
                <?php if($id_bl==$id_kategori_blog){ ?>
                selected <?php } ?> ><?php echo $bl; ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $judul; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="isi" class="col-sm-3 col-form-label">Isi</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="isi" id="editor1" rows="12"><?php echo $isi; ?></textarea>
            </div>
          </div>

          </div>
        </div>

      </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-12">
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
          </div>  
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->

    </section>
</html>
