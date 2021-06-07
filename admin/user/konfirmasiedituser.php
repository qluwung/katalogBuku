<?php
session_start();
include('koneksi.php');
if (isset($_SESSION['user'])) {
    $id_user = $_SESSION['user'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $level = $_POST['level'];

    //get foto
    $sql_f = "SELECT `foto` FROM `user` WHERE `id_user`='$id_user'";
    $query_f = mysqli_query($koneksi, $sql_f);
    while ($data_f = mysqli_fetch_row($query_f)) {
        $foto = $data_f[0];
        //echo $foto;
    }

    $lokasi_file = $_FILES['foto']['tmp_name'];
    $nama_file = $_FILES['foto']['name'];
    $direktori = 'foto/' . $nama_file;

    if (empty($nama)) {
        header("Location:edituser.php?data=" . $id_user . "&notif=editkosong&jenis=nama");
    } else if (empty($email)) {
        header("Location:edituser.php?data=" . $id_user . "&notif=editkosong&jenis=email");
    } else if (empty($username)) {
        header("Location:edituser.php?data=" . $id_user . "&notif=editkosong&jenis=username");
    } else if (empty($nama_file)) {
        if (empty($password)) {
            $sql = "UPDATE `user` set `nama`='$nama', `email`='$email', `username`='$username', `level`='$level' where `id_user`= '$id_user'";
            mysqli_query($koneksi, $sql);
            header("Location:user.php?notif=editberhasil");
        } else {
            $sql = "UPDATE `user` set `nama`='$nama', `email`='$email', `username`='$username', `password`= MD5('$password'), `level`='$level' where `id_user`= '$id_user'";
            // echo $sql;
            mysqli_query($koneksi, $sql);
            header("Location:user.php?notif=editberhasil");
        }
    } else if (empty($password)) {
        if (move_uploaded_file($lokasi_file, $direktori)) {
            if (!empty($foto)) {
                unlink("foto/$foto");
            }
            $sql = "UPDATE `user` set `nama`='$nama', `email`='$email', `username`='$username', `level`='$level', `foto`='$nama_file' where `id_user`= '$id_user'";
            mysqli_query($koneksi, $sql);
            header("Location:user.php?notif=editberhasil");
        }
    } else if (empty($foto)) {
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
}
