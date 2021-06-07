<?php
    $id_kategori_buku=$_POST['kategori_buku'];
    $judul=$_POST['judul'];
    $pengarang=$_POST['pengarang'];
    $id_penerbit=$_POST['penerbit'];
    $tahun_terbit=$_POST['tahun_terbit'];
    $sinopsis=$_POST['sinopsis'];
    $tag=$_POST['tag'];
    $lokasi_file=$_FILES['cover']['tmp_name'];
    $nama_file=$_FILES['cover']['name'];
    $direktori='cover/'.$nama_file;

    if(empty($id_kategori_buku)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Kategori%20Buku");
    }else if(empty($judul)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Judul");
    }else if(empty($pengarang)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Pengarang");
    }else if(empty($id_penerbit)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Penerbit");
    }else if(empty($tahun_terbit)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Tahun%20Terbit");
    }else if(empty($sinopsis)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Sinopsis");
    }else if(empty($tag)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Tag");
    }else if(!move_uploaded_file($lokasi_file,$direktori)){
        header("Location:index.php?include=tambah-buku&notif=tambahkosong&jenis=Cover");
    }else{
        $sql="insert into `buku`(`id_kategori_buku`,`judul`,`pengarang`,`id_penerbit`,`tahun_terbit`,`sinopsis`,`cover`)
        values('$id_kategori_buku','$judul','$pengarang','$id_penerbit','$tahun_terbit','$sinopsis','$nama_file')";
        mysqli_query($koneksi,$sql);
        $id_buku=mysqli_insert_id($koneksi);

        if(!empty($_POST['tag'])){
            foreach($_POST['tag'] as $id_tag){
                $sql_i="insert into `tag_buku`(`id_buku`,`id_tag`) values('$id_buku','$id_tag')";
                mysqli_query($koneksi,$sql_i);
            }
        }
        header("Location:index.php?include=buku&notif=tambahberhasil");
    }
?>