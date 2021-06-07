<?php
  $id_user=$_SESSION['id_user'];
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
            <h3><i class="fas fa-user-lock"></i> Ubah Password</h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item active"> Ubah Password</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <div class="card card-info">
      <div class="card-header">
        <h3 class="card-title"style="margin-top:5px;"><i class="far fa-list-alt"></i> Form Pengaturan Password</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      </br>
      <div class="col-sm-10">
          <?php if(!empty($_GET['notif'])&&(!empty($_GET['jenis']))){ ?>
            <?php if($_GET['notif']=="editgagal"){ ?>
              <div class="alert alert-danger" role="alert">Maaf
              <?php echo $_GET['jenis']; ?> Anda Berbeda</div>
            <?php } ?>
          <?php } ?>
          </div>
      <form class="form-horizontal" method="POST" action="index.php?include=konfirmasi-ubah-password">
        <div class="card-body">
          <h6>
            <i class="text-blue"><i class="fas fa-info-circle"></i> Silahkan memasukkan password lama dan password baru Anda untuk mengubah password.</i>
          </h6><br>
          
          <div class="form-group row">
            <label for="pass_lama" class="col-sm-3 col-form-label">Password Lama</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="pass_lama" name="pass_lama" value="">
              <?php if(!empty($_GET['gagal'])){ ?>
                <?php if($_GET['gagal']=='passlamabarudankonfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Lama Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passlamadanbarukosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Lama Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passlamadankonfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Lama Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passlamakosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Lama Wajib Diisi</span>
                <?php } ?>
              <?php } ?>  
            </div>
          </div>
          <div class="form-group row">
            <label for="pass_baru" class="col-sm-3 col-form-label">Password Baru</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="pass_baru" name="pass_baru" value="">
              <?php if(!empty($_GET['gagal'])){ ?>
                <?php if($_GET['gagal']=='passlamabarudankonfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Baru Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passlamadanbarukosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Baru Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passbarudankonfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Baru Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passbarukosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Password Baru Wajib Diisi</span>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
          <div class="form-group row">
            <label for="konfirmasi" class="col-sm-3 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-sm-7">
              <input type="text" class="form-control" id="konfirmasi" name="konfirmasi" value="">
              <?php if(!empty($_GET['gagal'])){ ?>
                <?php if($_GET['gagal']=='passlamabarudankonfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Konfirmasi Password Baru Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passlamadankonfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Konfirmasi Password Baru Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='passbarudankonfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Konfirmasi Wajib Diisi</span>
                <?php }else if($_GET['gagal']=='konfirkosong'){ ?>
                  <span class="text-danger">Mohon Maaf, Konfirmasi Wajib Diisi</span>
                <?php } ?>
              <?php } ?>    
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="col-sm-10">
            <button type="submit" class="btn btn-info float-right"><i class="fas fa-save"></i> Simpan</button>
          </div>  
        </div>
        <!-- /.card-footer -->
      </form>
    </div>
    <!-- /.card -->

    </section>
</html>
