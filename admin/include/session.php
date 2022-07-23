<?php 

include("../include/config_db.php");
session_start();

if (isset($_SESSION['id_user'])) {

    $res=mysqli_query($_connexion," SELECT * FROM users INNER JOIN role ON users.role_id = role.role_id WHERE role.type= 'admin' AND users.id_user='".$_SESSION["id_user"]."' ");
    

    if (mysqli_num_rows($res)>0) {

    }else {
        header("location:../index.php");
    }
    
}else {
    header("location:../index.php");
}


?>