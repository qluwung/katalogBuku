<?php
session_start();
include('koneksi.php');
$id_user = $_SESSION['id_user'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$level = $_POST['level'];

$lokasi_file = $_FILES['foto']['tmp_name'];
$nama_file = $_FILES['foto']['name'];
$direktori = 'foto/' . $nama_file;

if (empty($_POST['nama'])) {
    header("Location:tambahUser.php?notif=tambahkosong&jenis=nama");
} elseif (empty($_POST['email'])) {
    header("Location:tambahUser.php?notif=tambahkosong&jenis=email");
} elseif (empty($_POST['username'])) {
    header("Location:tambahUser.php?notif=tambahkosong&jenis=username");
} elseif (empty($_POST['password'])) {
    header("Location:tambahUser.php?notif=tambahkosong&jenis=password");
} elseif (empty($_POST['level'])) {
    header("Location:tambahUser.php?notif=tambahkosong&jenis=level");
}
elseif (empty($nama_file)) {
    header("Location:tambahUser.php?notif=tambahkosong&jenis=foto");
} 
elseif (move_uploaded_file($lokasi_file, $direktori)) {
    $sql = "INSERT into `user` values ('', '$nama', '$email', '$username', md5('$password'), '$level', '$nama_file')";
    mysqli_query($koneksi, $sql);
    header("Location:user.php?notif=tambahberhasil");
}else if (empty($foto)) {
    if (move_uploaded_file($lokasi_file, $direktori)) {
        if (empty($password)) {
            $sql = "UPDATE `user` set `nama`='$nama', `email`='$email', `username`='$username', `level`='$level',`foto`='$nama_file' where `id_user`= '$id_user'";
            mysqli_query($koneksi, $sql);
            header("Location:user.php?notif=editberhasil");
        } else {
            $sql = "UPDATE `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`= MD5('$password'), `level`='$level',`foto`='$nama_file' where `id_user`= '$id_user'";
            // echo $sql;
            mysqli_query($koneksi, $sql);
            header("Location:user.php?notif=editberhasil");
        }
    }
}
// }
// } else if (!empty($nama_file)) {
//     $sql = "INSERT into `user` values ('', '$nama', '$email', '$username', md5('$password'), '$level', '$nama_file')";
//     mysqli_query($koneksi, $sql);
//     header("Location:user.php?notif=tambahberhasil");
// }
