<?php
  if(isset($_SESSION['id_user'])){
    $id_user=$_SESSION['id_user'];
    $sql_d="select nama,email,foto from user where id_user='$id_user'";
    $query_d=mysqli_query($koneksi,$sql_d);
    while($data_d=mysqli_fetch_row($query_d)){
      $nama=$data_d[0];
      $email=$data_d[1];
      $foto=$data_d[2];
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
            <h3><i class="fas fa-edit"></i> Edit Profil</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=profil">Profil</a></li>
              <li class="breadcrumb-item active">Edit Profil</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Profil</h3>
        <div class="card-tools">
          <a href="index.php?include=profil" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
        </div>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br>
      <div class="col-sm-10">
      <?php if(!empty($_GET['notif'])&&(!empty($_GET['jenis']))){ ?>
        <?php if($_GET['notif']=="editkosong"){ ?>
          <div class="alert alert-danger" role="alert">Maaf Data
          <?php echo $_GET['jenis']; ?> Wajib Di Isi</div>
        <?php } ?>
      <?php } ?>    
      </div>
      <form class="form-horizontal" method="POST" action="index.php?include=konfirmasi-edit-profil" enctype="multipart/form-data">
        <div class="card-body">          
          <div class="form-group row">
            <label for="foto" class="col-sm-12 col-form-label"><span class="text-info">
            <i class="fas fa-user-circle"></i> <u>PROFIL USER</u></span></label>
          </div>
          <div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Foto Pegawai</label>
            <div class="col-sm-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="foto" id="custom-file-input">
                <label class="custom-file-label" for="customFile" id="custom-file-label">
                <?php
                if(!empty($foto)){
                  echo $foto;
                }else{
                  echo "Choose File";
                }
                ?>
                </label>
              </div>  
            </div>
          </div>
          <div class="form-group row">
            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="email" id="email" value="<?php echo $email ?>">
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