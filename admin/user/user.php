<!DOCTYPE html>
<?php
session_start();
include('koneksi.php');
if ((isset($_GET['aksi'])) && (isset($_GET['data']))) {
  if ($_GET['aksi'] == 'hapus') {
    $id_user = $_GET['data'];
    //hapus kategori buku
    $sql_dh = "delete from `user`
  where `id_user` = '$id_user'";
    mysqli_query($koneksi, $sql_dh);
    header("Location:user.php?notif=hapusberhasil");
  }
}

// $sql_k = "SELECT * FROM `user` ";
// if (isset($_GET["katakunci"])) {
//   $katakunci_kategori = $_GET["katakunci"];
//   $sql_k .= " where `user` LIKE '%$katakunci_kategori%'";
// }
// $sql_k .= " ORDER BY `user`";
?>
<html>

<head>
  <?php include("includes/head.php") ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <?php include("includes/header.php") ?>

    <?php include("includes/sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h3><i class="fas fa-user-tie"></i> Data User</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item active"> Data User</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title" style="margin-top:5px;"><i class="fas fa-list-ul"></i> Daftar User</h3>
            <div class="card-tools">
              <a href="tambahuser.php" class="btn btn-sm btn-info float-right">
                <i class="fas fa-plus"></i> Tambah User</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
              <form method="" action="">
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
              <?php
              if (isset($_GET['notif'])) {
                if ($_GET['notif'] == "tambahberhasil") {
                  echo '<div class="alert alert-success" role="alert">Data berhasil ditambahkan</div>';
                } elseif ($_GET['notif'] == "editberhasil") {
                  echo '<div class="alert alert-success" role="alert">Data berhasil diubah</div>';
                } elseif ($_GET['notif'] == "hapusberhasil") {
                  echo '<div class="alert alert-success" role="alert">Data berhasil dihapus</div>';
                }
              }
              ?>
            </div>
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th width="5%">No</th>
                  <th width="30%">Nama</th>
                  <th width="30%">Email</th>
                  <th width="20%">Level</th>
                  <th width="15%">
                    <center>Aksi</center>
                  </th>
                </tr>
              </thead>
              <tbody>
                <?php
                $idUser = $_SESSION['id_user'];
                // $sql_k = "SELECT * FROM   `user` where `id_user`!='$idUser' ORDER BY `nama`";
                // $query_k = mysqli_query($koneksi, $sql_k);
                // $no = 1;
                // while ($data_k = mysqli_fetch_array($query_k)) {
                //   $id_user = $data_k['id_user'];
                //   $nama = $data_k['nama'];
                //   $email = $data_k['email'];
                //   $level = $data_k['level'];
                $batas = 2;
                if (!isset($_GET['halaman'])) {
                  $posisi = 0;
                  $halaman = 1;
                } else {
                  $halaman = $_GET['halaman'];
                  $posisi = ($halaman - 1) * $batas;
                }
                // $sql_jum = "SELECT * FROM `user` ";
                $sql_jum = "SELECT * FROM `user` ";
                if (isset($_GET["katakunci"])) {
                  $katakunci_kategori = $_GET["katakunci"];
                  $sql_jum .= " where `nama` LIKE '%$katakunci_kategori%'";
                }
                $query_jum = mysqli_query($koneksi, $sql_jum);
                $jum_data = mysqli_num_rows($query_jum);
                $jum_halaman = ceil($jum_data / $batas);

                $sql_k = "SELECT * FROM `user` ";
                if (isset($_GET["katakunci"])) {
                  $katakunci_kategori = $_GET["katakunci"];
                  $sql_k .= " where `nama` LIKE '%$katakunci_kategori%'";
                }
                $sql_k .= " ORDER BY `nama` limit $posisi, $batas ";
                $query_k = mysqli_query($koneksi, $sql_k);
                $no = $posisi + 1;

                while ($data_k = mysqli_fetch_row($query_k)) {
                  $id_user = $data_k[0];
                  $nama = $data_k[1];
                  $email = $data_k[2];
                  $level = $data_k[3];
                ?>





                  <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $level; ?></td>
                    <td align="center">



                      <a href="edituser.php?data=<?php echo $id_user; ?>" class="btn btn-xs btn-info"><i class="fas fa-edit"></i> Edit</a>
                      <a href="detailuser.php?data=<?php echo $id_user; ?>" class="btn btn-xs btn-info" title="Detail"><i class="fas fa-eye"></i>Detail</a>
                      <a href="javascript:if(confirm('Anda yakin ingin menghapus data   <?php echo $nama; ?>?'))window.location.href = 'user.php?aksi=hapus&data=<?php echo $id_user; ?>&notif=hapusberhasil'" class="btn btn-xs btn-warning"><i class="fas fa-trash"></i> Hapus</a>
                    </td>
                  </tr>
           
                <?php $no++;
                } ?>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <!-- <?php
                //hitung jumlah semua data
                //$sql_jum = "select `id_kategori_buku`, `kategori_buku` from `kategori_buku` order by `kategori_buku`";



                // if (isset($_GET["katakunci"])) {
                //   $katakunci_kategori = $_GET["katakunci"];
                //   $sql_jum .= " where `user` LIKE '%$katakunci_kategori%'";
                // }
                // $sql_jum .= " order by `user`";
                ?> -->

          <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
              <?php
              if ($jum_halaman == 0) {
                //tidak ada halaman
              } else if ($jum_halaman == 1) {
                echo "<li class='page-item'><a class='page-link'>1</a></li>";
              } else {
                $sebelum = $halaman - 1;
                $setelah = $halaman + 1;
                if (isset($_GET["katakunci"])) {
                  $katakunci_kategori = $_GET["katakunci"];
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link'href='user.php?katakunci=$katakunci_kategori&halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='user.php?katakunci=$katakunci_kategori&halaman=$sebelum'>??</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i > $halaman - 5 and $i < $halaman + 5) {
                      if ($i != $halaman) {
                        echo "<li class='page-item'><a class='page-link'href='user.php?katakunci=$katakunci_kategori&halaman=$i'>$i</a></li>";
                      } else {
                        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link'href='user.php?katakunci=$katakunci_kategori&halaman=$setelah'>??</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='user.php?katakunci=$katakunci_kategori&halaman=$jum_halaman'>Last</a></li>";
                  }
                } else {
                  if ($halaman != 1) {
                    echo "<li class='page-item'><a class='page-link'href='user.php?halaman=1'>First</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='user.php?halaman=$sebelum'>??</a></li>";
                  }
                  for ($i = 1; $i <= $jum_halaman; $i++) {
                    if ($i > $halaman - 5 and $i < $halaman + 5) {
                      if ($i != $halaman) {
                        echo "<li class='page-item'><a class='page-link'href='user.php?halaman=$i'>$i</a></li>";
                      } else {
                        echo "<li class='page-item'><a class='page-link'>$i</a></li>";
                      }
                    }
                  }
                  if ($halaman != $jum_halaman) {
                    echo "<li class='page-item'><a class='page-link'href='user.php?halaman=$setelah'>??</a></li>";
                    echo "<li class='page-item'><a class='page-link'href='user.php?halaman=$jum_halaman'>Last</a></li>";
                  }
                }
              } ?>
            </ul>
          </div>
        </div>
        <!-- /.card -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include("includes/footer.php") ?>

  </div>
  <!-- ./wrapper -->

  <?php include("includes/script.php") ?>
</body>

</html>