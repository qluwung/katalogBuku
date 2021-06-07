<?php
    $foto=$_POST['foto'];
    $nama=$_POST['nama'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $level=$_POST['level'];
    
    if(empty($nama)){
        header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=Nama");
    }else if(empty($email)){
        header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=Email");
    }else if(empty($username)){
        header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=Username");
    }else if(empty($password)){
        header("Location:index.php?include=tambah-user&notif=tambahkosong&jenis=Password");
    }else{
        $lokasi_file=$_FILES['foto']['tmp_name'];
        $nama_file=$_FILES['foto']['name'];
        $direktori='foto/'.$nama_file;
        if(move_uploaded_file($lokasi_file,$direktori)){
            $sql="insert into `user`(`nama`,`email`,`username`,`password`,`level`,`foto`) 
            values('$nama','$email','$username',md5('$password'),'$level','$nama_file')";
            mysqli_query($koneksi,$sql);
        }else{
            $sql="insert into `user`(`nama`,`email`,`username`,`password`,`level`) 
            values('$nama','$email','$username',md5('$password'),'$level')";
            mysqli_query($koneksi,$sql);
        }
        header("Location:index.php?include=user&notif=tambahberhasil");
    }
?>