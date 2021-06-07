<?php
    $id_user=$_SESSION['id_user'];
    $id_kategori_blog=$_POST['kategori_blog'];
    $judul=$_POST['judul'];
    $isi=$_POST['isi'];
    $tanggal=date("Y-m-d");

    if(empty($id_kategori_blog)){
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=Kategori%20Blog");
    }else if(empty($judul)){
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=Judul");
    }else if(empty($isi)){
        header("Location:index.php?include=tambah-blog&notif=tambahkosong&jenis=Isi");
    }else{
        $sql="insert into `blog`(`id_user`,`id_kategori_blog`,`judul`,`isi`,`tanggal`) values('$id_user','$id_kategori_blog','$judul','$isi','$tanggal')";
        mysqli_query($koneksi,$sql);
        header("Location:index.php?include=blog&notif=tambahberhasil");
    }
   
?>