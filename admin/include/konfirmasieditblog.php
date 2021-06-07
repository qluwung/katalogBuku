<?php
    if(isset($_SESSION['id_blog'])){
        $id_blog=$_SESSION['id_blog'];
        $id_kategori_blog=$_POST['kategori_blog'];
        $judul=$_POST['judul'];
        $isi=$_POST['isi'];

        if(empty($id_kategori_blog)){
            header("Location:index.php?include=edit-blog&data=".$id_blog."&notif=editkosong&jenis=Kategori%20Blog");
        }else if(empty($judul)){
            header("Location:index.php?include=edit-blog&data=".$id_blog."&notif=editkosong&jenis=Judul");
        }else if(empty($isi)){
            header("Location:index.php?include=edit-blog&data=".$id_blog."&notif=editkosong&jenis=Isi");
        }else{
            $sql="update `blog` set `id_kategori_blog`='$id_kategori_blog',`judul`='$judul',`isi`='$isi' where `id_blog`='$id_blog'";
            mysqli_query($koneksi,$sql);
            unset($_SESSION['id_blog']);
            header("Location:index.php?include=blog&notif=editberhasil");
        }
    }
?>