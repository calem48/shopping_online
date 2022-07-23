<?php
//include("session.php");
include("../../include/config_db.php");
/*
$img=$_FILES['file'];
$img_exe=explode('.',$img['name'] );
echo '<pre>';
print_r ( end($img_exe));echo '<pre>';*/

//echo var_dump($_post,$_FILES);
         //   echo "<pre>";
           //     print_r($_FILES);
         //   echo "<pre>";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["product"])){
            echo '<div class="alert alert-warning" role="alert"> please put name </div>';
        }elseif(empty($_POST["stock"])){
            echo '<div class="alert alert-warning" role="alert"> please put stock </div>';
        }elseif(empty($_POST["price"])){
            echo '<div class="alert alert-warning" role="alert"> please put price </div>';
        }elseif(empty($_FILES["file"]["name"])){
            echo '<div class="alert alert-warning" role="alert"> please put image </div>';
        }elseif($_POST["select-item"] == "choose categorie"){
                echo '<div class="alert alert-warning" role="alert">please chose categorie</div>';
        }else {
            
            $product_name=$_POST["product"];
            $product_stock=$_POST["stock"];
            $product_price=$_POST["price"];
            $product_select_item=$_POST["select-item"];

            $name=$_FILES["file"]["name"];
            $type=$_FILES["file"]["type"];
            $tmp_name=$_FILES["file"]["tmp_name"];
            $error=$_FILES["file"]["error"];
            $size=$_FILES["file"]["size"];

            if(isset($_FILES["file"])){

                $img_exe=explode('.',$name);
                $img_exe=end($img_exe);//or $img_exe=end($img_exe["put index the index 1 or 2 or 3 "])
                $img_exe=strtolower($img_exe);
 
                $allow=array('jpeg','jpg','png');
                
                if (in_array($img_exe,$allow)) {
                    if ($error == 0) {
                        if ($size <= 4000000) {
                            $new_name=uniqid("product_",false).".".$img_exe;
 
                            $img_dir="../../image/product/".$new_name;//.date("Ymdhis").
                            $img_dir_bdd =$new_name;
                            if (move_uploaded_file($tmp_name,$img_dir)) {
                                
                                $insert="INSERT INTO produits (name_produit,stock_qte,price,img,id_categorie) 
                                                VALUES('$product_name','$product_stock','$product_price','$img_dir_bdd','$product_select_item') ";
                                if(mysqli_query($_connexion,$insert)){
                                    echo "successfully";
                                }

                                
                            }else {
                             echo '<div class="alert alert-warning" role="alert">hppened error when upload image</div>';
                            }
                        }else {
                         echo '<div class="alert alert-warning" role="alert">must to put image size less than 4 mb</div>';
                        }
                    }else {
                     echo '<div class="alert alert-warning" role="alert">try again upload image</div>';
                    }
                }else {
                 echo '<div class="alert alert-warning" role="alert">it is not valid image</div>';
                }
              
             }
             
         }

    }
?>