<?php 
$_host="localhost";
$_username="root";
$_password="";
$_dbName="gestionstock";

$_connexion=mysqli_connect($_host,$_username,$_password,$_dbName);

if (!$_connexion) {
    die("connexion failed ". mysqli_connect_error());
}




 
function close_db(){
    global $_connexion;
    mysqli_close($_connexion);
}


?>