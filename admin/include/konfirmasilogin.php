<?php
    if(isset($_POST['login'])){
        $user=$_POST['username'];
        $pass=$_POST['password'];
        $username=mysqli_real_escape_string($koneksi,$user);
        $password=mysqli_real_escape_string($koneksi,md5($pass));

        //Cek Username dan Password
        $sql="select id_user,level from user where username='$username' and password='$password'";
        $query=mysqli_query($koneksi,$sql);
        $jumlah=mysqli_num_rows($query);
        
        if(empty($user)){
            header("Location:index.php?include=login&gagal=userKosong");
        }else if(empty($pass)){
            header("Location:index.php?include=login&gagal=passKosong");
        }else if($jumlah==0){
            header("Location:index.php?include=login&gagal=userpassSalah");
        }else{
            //Get Data
            while($data=mysqli_fetch_row($query)){
                //1
                $id_user=$data[0];
                //speradmin
                $level=$data[1];

                $_SESSION['id_user']=$id_user;
                $_SESSION['level']=$level;

                header("Location:index.php?include=profil");
            }
        }
    }
?>