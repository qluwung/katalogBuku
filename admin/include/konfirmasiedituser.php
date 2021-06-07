<?php
    $user=$_SESSION['username'];
    $lev=$_SESSION['level'];

    if(isset($_SESSION['user'])){
        $id_user=$_SESSION['user'];
        $nama=$_POST['nama'];
        $email=$_POST['email'];
        $username=$_POST['username'];
        $password=$_POST['password'];
        $level=$_POST['level'];
        
        $sql_f="select `foto` from `user` where `id_user`='$id_user'";
        $query_f=mysqli_query($koneksi,$sql_f);
        while($data_f=mysqli_fetch_row($query_f)){
            $foto=$data_f[0];
        }

        if(empty($nama)){
            header("Location:index.php?include=edit-user&data=".$id_user."&notif=editkosong&jenis=Nama");
        }else if(empty($email)){
            header("Location:index.php?include=edit-user&data=".$id_user."&notif=editkosong&jenis=Email");
        }else if(empty($username)){
            header("Location:index.php?include=edit-user&data=".$id_user."&notif=editkosong&jenis=Username");
        }else{
        $lokasi_file=$_FILES['foto']['tmp_name'];
        $nama_file=$_FILES['foto']['name'];
        $direktori='foto/'.$nama_file;
            if($user==$username){
            //Username sama dengan Data User    
                if(empty($password)){
                //Password Kosong
                    if($lev!=$level){
                    //Level Berubah
                        if(move_uploaded_file($lokasi_file,$direktori)){
                        //Password Tidak Berubah, Foto Berubah, Level Berubah
                            if(!empty($foto)){
                                unlink("foto/$foto");
                            }
                            $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                            `level`='$level',`foto`='$nama_file' where `id_user`='$id_user'";
                            mysqli_query($koneksi,$sql);
                        }else{
                        //Password Tidak Berubah, Foto Tidak Berubah, Level Berubah
                            $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                            `level`='$level' where `id_user`='$id_user'";
                            mysqli_query($koneksi,$sql);
                        }
                        session_unset();
                        header("Location:index.php");
                    }else{
                    //Level Tidak Berubah    
                        if(move_uploaded_file($lokasi_file,$direktori)){
                            //Password Tidak Berubah, Foto Berubah, Level Tidak Berubah
                                if(!empty($foto)){
                                    unlink("foto/$foto");
                                }
                                $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                                `foto`='$nama_file' where `id_user`='$id_user'";
                                mysqli_query($koneksi,$sql);
                            }else{
                            //Password Tidak Berubah, Foto Tidak Berubah, Level Tidak Berubah
                                $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username'
                                where `id_user`='$id_user'";
                                mysqli_query($koneksi,$sql);
                            }
                            header("Location:index.php?include=user&notif=editberhasil");
                    }
                }else{
                //Password Ada
                    if($lev!=$level){
                    //Level Berubah    
                        if(move_uploaded_file($lokasi_file,$direktori)){
                        //Password Berubah, Foto Berubah, Level Berubah    
                            if(!empty($foto)){
                                unlink("foto/$foto");
                            }
                            $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                            `password`=md5('$password'),`level`='$level',`foto`='$nama_file' where `id_user`='$id_user'";
                            mysqli_query($koneksi,$sql);
                        }else{
                        //Password Berubah, Foto Tidak Berubah, Level Berubah    
                            $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                            `password`=md5('$password'),`level`='$level' where `id_user`='$id_user'";
                            mysqli_query($koneksi,$sql);
                        }
                        session_unset();
                        header("Location:index.php");
                    }else{
                    //Level Tidak Berubah    
                        if(move_uploaded_file($lokasi_file,$direktori)){
                            //Password Berubah, Foto Berubah, Level Tidak Berubah    
                                if(!empty($foto)){
                                    unlink("foto/$foto");
                                }
                                $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                                `password`=md5('$password'),`foto`='$nama_file' where `id_user`='$id_user'";
                                mysqli_query($koneksi,$sql);
                            }else{
                            //Password Berubah, Foto Tidak Berubah, Level Tidak Berubah    
                                $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                                `password`=md5('$password') where `id_user`='$id_user'";
                                mysqli_query($koneksi,$sql);
                            }
                            session_unset();
                            header("Location:index.php");
                    }       
                }
            }else{
            //Username tidak sama dengan Data User    
                if(empty($password)){
                //Password Kosong    
                    if(move_uploaded_file($lokasi_file,$direktori)){
                    //Password Tidak Berubah, Foto Berubah
                        if(!empty($foto)){
                            unlink("foto/$foto");
                        }
                        $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                        `level`='$level',`foto`='$nama_file' where `id_user`='$id_user'";
                        mysqli_query($koneksi,$sql);
                    }else{
                    //Password Tidak Berubah, Foto Tidak Berubah    
                        $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                        `level`='$level' where `id_user`='$id_user'";
                        mysqli_query($koneksi,$sql);
                        }
                }else{
                //Password Ada        
                    if(move_uploaded_file($lokasi_file,$direktori)){
                    //Password Ada, Foto Berubah    
                        if(!empty($foto)){
                            unlink("foto/$foto");
                        }
                        $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                        `password`=md5('$password'),`level`='$level',`foto`='$nama_file' where `id_user`='$id_user'";
                        mysqli_query($koneksi,$sql);
                    }else{
                    //Password Ada, Foto Tidak Berubah    
                        $sql="update `user` set `nama`='$nama',`email`='$email',`username`='$username',
                        `password`=md5('$password'),`level`='$level' where `id_user`='$id_user'";
                        mysqli_query($koneksi,$sql);
                    }   
                }
                header("Location:index.php?include=user&notif=editberhasil");  
            }   
        }    
    }
?>