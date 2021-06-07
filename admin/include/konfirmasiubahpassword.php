<?php
    $id_user=$_SESSION['id_user'];

    $pass_lama=$_POST['pass_lama'];
    $pass_baru=$_POST['pass_baru'];
    $konfirmasi=$_POST['konfirmasi'];

    $sql_p="select `password` from `user` where `id_user`='$id_user'";
    $query_p=mysqli_query($koneksi,$sql_p);
    while($data_p=mysqli_fetch_row($query_p)){
        $password=$data_p[0];
    }

    if((empty($pass_lama))&&(empty($pass_baru))&&(empty($konfirmasi))){
        header("Location:index.php?include=ubah-password&gagal=passlamabarudankonfirkosong");
    }else if((empty($pass_lama))&&(empty($pass_baru))){
        header("Location:index.php?include=ubah-password&gagal=passlamadanbarukosong");
    }else if((empty($pass_lama))&&(empty($konfirmasi))){
        header("Location:index.php?include=ubah-password&gagal=passlamadankonfirkosong");
    }else if((empty($pass_baru))&&(empty($konfirmasi))){
        header("Location:index.php?include=ubah-password&gagal=passbarudankonfirkosong");
    }else if(empty($pass_lama)){
        header("Location:index.php?include=ubah-password&gagal=passlamakosong");
    }else if(empty($pass_baru)){
        header("Location:index.php?include=ubah-password&gagal=passbarukosong");
    }else if(empty($konfirmasi)){
        header("Location:index.php?include=ubah-password&gagal=konfirkosong");
    }else{
        $pass_lama=md5($_POST['pass_lama']);
        $pass_baru=md5($_POST['pass_baru']);
        $konfirmasi=md5($_POST['konfirmasi']);
        if($pass_lama==$password){
            if($pass_baru==$konfirmasi){
                $sql_pa="update `user` set `password`='$pass_baru' where `id_user`='$id_user'";
                mysqli_query($koneksi,$sql_pa);
                session_unset();
                header("Location:index.php");
            }else{
                header("Location:index.php?include=ubah-password&notif=editgagal&jenis=Password%20Baru%20dan%20Konfirmasi%20Password%20Baru");
            }
        }else{
            header("Location:index.php?include=ubah-password&notif=editgagal&jenis=Password%20Lama");
        }
    }
?>