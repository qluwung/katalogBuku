<?php
  if(isset($_GET['data'])){
    $id_buku=$_GET['data'];
    $_SESSION['id_buku']=$id_buku;

    $sql_m="select `id_kategori_buku`,`judul`,`pengarang`,`id_penerbit`,`tahun_terbit`,`sinopsis`,`cover` 
    from `buku` where `id_buku`='$id_buku'";
    $query_m=mysqli_query($koneksi,$sql_m);
    while($data_m=mysqli_fetch_row($query_m)){
      $id_kategori_buku=$data_m[0];
      $judul=$data_m[1];
      $pengarang=$data_m[2];
      $id_penerbit=$data_m[3];
      $tahun_terbit=$data_m[4];
      $sinopsis=$data_m[5];
      $cover=$data_m[6];
    }

      $sql_h="select `id_tag` from `tag_buku` where `id_buku`='$id_buku'";
      $query_h=mysqli_query($koneksi,$sql_h);
      $array_tag=array();
      while($data_h=mysqli_fetch_row($query_h)){
        $id_tag=$data_h[0];
        $array_tag[]=$id_tag;
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
            <h3><i class="fas fa-edit"></i> Edit Data Buku</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=buku">Data Buku</a></li>
              <li class="breadcrumb-item active">Edit Data Buku</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data Buku</h3>
        <div class="card-tools">
          <a href="index.php?include=buku" class="btn btn-sm btn-warning float-right">
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
      <form class="form-horizontal" method="POST" action="index.php?include=konfirmasi-edit-buku" enctype="multipart/form-data">
        <div class="card-body">
          
        <div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Cover Buku </label>
            <div class="col-sm-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="cover" id="custom-file-input">
                <label class="custom-file-label" for="customFile" id="custom-file-label">
                <?php
                if(!empty($cover)){
                  echo $cover;
                }else{
                  echo "Choose File";
                }
                ?>
                </label>
              </div>  
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Kategori Buku</label>
            <div class="col-sm-7">
              <select class="form-control" id="kategori" name="kategori_buku">
                <option value="">- Pilih Kategori -</option>
                <?php
                  $sql_kat="select `id_kategori_buku`,`kategori_buku` from `kategori_buku` order by `kategori_buku`";
                  $query_kat=mysqli_query($koneksi,$sql_kat);
                  while($data_kat=mysqli_fetch_row($query_kat)){
                    $id_kat=$data_kat[0];
                    $kat=$data_kat[1];
                  
                ?>
                <option value="<?php echo $id_kat ?>"
                <?php if($id_kat==$id_kategori_buku){ ?>
                 selected <?php } ?> ><?php echo $kat ?></option>                 
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">Judul</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="judul" id="judul" value="<?php echo $judul ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="pengarang" class="col-sm-3 col-form-label">Pengarang</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?php echo $pengarang ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="kategori" class="col-sm-3 col-form-label">Penerbit</label>
            <div class="col-sm-7">
              <select class="form-control" id="kategori" name="penerbit">
                <option value="">- Pilih penerbit -</option>
                <?php
                  $sql_pen="select `id_penerbit`,`penerbit` from `penerbit` order by `penerbit`";
                  $query_pen=mysqli_query($koneksi,$sql_pen);
                  while($data_pen=mysqli_fetch_row($query_pen)){
                    $id_pen=$data_pen[0];
                    $pen=$data_pen[1];
                ?>
                <option value="<?php echo $id_penerbit ?>" 
                <?php if($id_pen==$id_penerbit){ ?>
                selected <?php } ?> ><?php echo $pen ?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="tanggal" class="col-sm-3 col-form-label">Tahun Terbit</label>
            <div class="col-sm-7">
              <div class="input-group date">
                <input type="text" class="form-control" name="tahun_terbit" id="datepicker-year"  autocomplete="off"
                value="<?php echo $tahun_terbit ?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                  </div>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-7">
              <textarea class="form-control" name="sinopsis" id="editor1" rows="12"><?php echo $sinopsis ?></textarea>
            </div>
          </div>          
          <div class="form-group row">
            <label for="hobi" class="col-sm-3 col-form-label">Tag</label>
            <div class="col-sm-7">
            <?php
              $sql_tag="select `id_tag`,`tag` from `tag` order by `tag`";
              $query_tag=mysqli_query($koneksi,$sql_tag);
              while($data_tag=mysqli_fetch_row($query_tag)){
                $id_tg=$data_tag[0];
                $tg=$data_tag[1];
            ?>
              <input type="checkbox" name="tag[]" value="<?php echo $id_tg ?>"
              <?php if(in_array($id_tg,$array_tag)){ ?>checked="checked"<?php } ?>>
              <?php echo $tg ?></br>
              <?php } ?>
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
<script>
var input = document.getElementById( 'custom-file-input' );
var infoArea = document.getElementById( 'custom-file-label' );

input.addEventListener( 'change', showFileName );

function showFileName( event ) {
  
  // the change event gives us the input it occurred in 
  var input = event.srcElement;
  
  // the input has an array of files in the `files` property, each one has a name that you can use. We're just using the name here.
  var fileName = input.files[0].name;
  
  // use fileName however fits your app best, i.e. add it into a div
  infoArea.textContent = fileName;
}
</script>