<?php
  $user=$_SESSION['username'];
  $lev=$_SESSION['level'];

  if(isset($_GET['data'])){
    $id_user=$_GET['data'];
    $_SESSION['user']=$id_user;
    
    $sql_d="select `nama`,`email`,`username`,`level`,`foto` from `user` where `id_user`='$id_user'";
    $query_d=mysqli_query($koneksi,$sql_d);
    while($data_d=mysqli_fetch_row($query_d)){
      $nama=$data_d[0];
      $email=$data_d[1];
      $username=$data_d[2];
      $level=$data_d[3];
      $foto=$data_d[4];
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
            <h3><i class="fas fa-edit"></i> Edit Data User</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php?include=user">Data User</a></li>
              <li class="breadcrumb-item active">Edit Data User</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Edit Data User</h3>
        <div class="card-tools">
          <a href="index.php?include=user" class="btn btn-sm btn-warning float-right"><i class="fas fa-arrow-alt-circle-left"></i> Kembali</a>
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
      <form class="form-horizontal" method="POST" action="index.php?include=konfirmasi-edit-user" enctype="multipart/form-data">
      <div class="card-body">
          <div class="form-group row">
            <label for="foto" class="col-sm-12 col-form-label"><span class="text-info"><i class="fas fa-user-circle"></i> <u>Data User</u></span></label>
          </div>
          
          <div class="form-group row">
            <label for="foto" class="col-sm-3 col-form-label">Foto </label>
            <div class="col-sm-7">
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="foto" id="custom-file-input">
                <label class="custom-file-label" id="custom-file-label" for="custom-file-label">
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
              <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $nama; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-sm-3 col-form-label">Email</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="email" id="email" value="<?php echo $email; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="username" class="col-sm-3 col-form-label">Username</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="username" id="username" value="<?php echo $username; ?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-sm-3 col-form-label">Password</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" name="password" id="password" value="">
              <span class="text-danger" style="font-weight:lighter;font-size:12px">
               *Jangan diisi jika tidak ingin mengubah password</span>
            </div>
          </div>
          <div class="form-group row">
            <label for="level" class="col-sm-3 col-form-label">Level</label>
            <div class="col-sm-7">
              <select class="form-control" id="level" name="level">
              <?php if($level=='Superadmin'){ ?>  
                <option selected value="Superadmin">Superadmin</option>
                <option value="Admin">Admin</option>
              <?php }else{ ?>
                <option value="Superadmin">Superadmin</option>
                <option selected value="Admin">Admin</option>
              <?php } ?>
              </select>
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
