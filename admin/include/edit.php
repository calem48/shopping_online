<?php 

include("../../include/config_db.php");

if (isset($_POST["id"])) {
    
    
    if ($_POST["action"] =="edit") {
        //$res=mysqli_query($_connexion,"SELECT * FROM categorie WHERE id_categorie = '$_GET[edit]'");

        if(empty($_POST["enameCate"])){
            echo '<div class="alert alert-warning" role="alert">put name categorie</div>';
            exit;
        }else {

            if($_POST["etag"] != "" ){
                $res=mysqli_query($_connexion," UPDATE  categorie SET type ='".$_POST["enameCate"]."', tag = '".$_POST["etag"]."' WHERE id_categorie = '".$_POST["id"]."' ");
                echo '<div class="alert alert-success" role="alert">edited successfully</div>';
                //header("location:categorie.php");
            }else {

                $res=mysqli_query($_connexion," UPDATE  categorie SET type ='".$_POST["enameCate"]."' WHERE id_categorie = '".$_POST["id"]."' ");
                echo '<div class="alert alert-success" role="alert">edited successfully</div>';
            }

        }

        //$res=mysqli_query($_connexion," UPDATE  categorie SET type ='".$_POST["enameCate"]."' WHERE id_categorie = '".$_POST["id"]."' ");

        //header("location:categorie.php");
        
    }

    
}


?>