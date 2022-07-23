<?php 
include("include/config_db.php");
session_start();

date_default_timezone_set('Europe/Paris');
$date=date('Y-m-d');

$msg="";
$array = array();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_SESSION["id_user"])) {

        $tele =$_POST["tele"];
        $address =$_POST["address"];
        $inputCity =$_POST["inputCity"];
        $inpuState =$_POST["inpuState"];
        $inputZip =$_POST["inputZip"];

      ///////////////////////////////////////////////// 
      /* هذا الجزء درتو باه ميسيزيش عنوان تع مستخدم واحد اكثر من مرة */

        if(isset($_SESSION["address"])){
            $req="SELECT * FROM `address` WHERE address.id_user= '".$_SESSION['id_user']."' ";
                    $res=mysqli_query($_connexion,$req);
                    $info=mysqli_fetch_assoc($res);
                    

            if(empty($_POST["tele"])){
                echo '<div class="alert alert-warning" role="alert">must to put number phone</div>';
                exit;

            }elseif (empty($_POST["address"])) {
                echo '<div class="alert alert-warning" role="alert">must to put address</div>';
                exit;
                
            }elseif (empty($_POST["inputCity"])) {
                echo '<div class="alert alert-warning" role="alert">must to put city</div>';
                exit;
                
            }elseif (empty($_POST["inpuState"])) {
                echo '<div class="alert alert-warning" role="alert">must to put state</div>';
                exit;
                
            }else {

                if ($_POST["tele"]==$info["num_telephone"] AND $_POST["inputCity"]==$info["city"]  AND $_POST["inpuState"]==$info["state"]) {

                    $req1=" UPDATE `address` SET `address` = '".$_POST["address"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);
                    

                }elseif ($_POST["tele"]!=$info["num_telephone"] AND $_POST["inputCity"]==$info["city"]  AND $_POST["inpuState"]==$info["state"]) {

                    $req1=" UPDATE `address` SET `num_telephone` = '".$_POST["tele"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);
                    
                }elseif ($_POST["tele"]==$info["num_telephone"] AND $_POST["inputCity"]!=$info["city"]  AND $_POST["inpuState"]==$info["state"]) {

                    $req1=" UPDATE `address` SET `city` = '".$_POST["inputCity"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);

                }elseif ($_POST["tele"]==$info["num_telephone"] AND $_POST["inputCity"]==$info["city"]  AND $_POST["inpuState"]!=$info["state"]) {

                    $req1=" UPDATE `address` SET `state` = '".$_POST["inpuState"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);
                    
                }elseif ($_POST["tele"]!=$info["num_telephone"] AND $_POST["inputCity"]!=$info["city"]  AND $_POST["inpuState"]==$info["state"]) {

                    $req1=" UPDATE `address` SET `num_telephone` = '".$_POST["tele"]."' , `city` = '".$_POST["inputCity"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);

                }elseif ($_POST["tele"]!=$info["num_telephone"] AND $_POST["inputCity"]==$info["city"]  AND $_POST["inpuState"]!=$info["state"]) {

                    $req1=" UPDATE `address` SET `num_telephone` = '".$_POST["tele"]."' , `state` = '".$_POST["inpuState"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);
                    
                }elseif ($_POST["tele"]==$info["num_telephone"] AND $_POST["inputCity"]!=$info["city"]  AND $_POST["inpuState"]!=$info["state"]) {

                    $req1=" UPDATE `address` SET `city` = '".$_POST["inputCity"]."' , `state` = '".$_POST["inpuState"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);

                    echo "city and state changed successflly";
                    exit;
                    
                }else {

                    $req1=" UPDATE `address` SET `zip` = '".$_POST["inputZip"]."'  , `city` = '".$_POST["inputCity"]."' , `state` = '".$_POST["inpuState"]."',`num_telephone` = '".$_POST["tele"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                    mysqli_query($_connexion,$req1);

                }


            }

            
        }else {


        
    
        $req=" INSERT INTO `address` (`num_telephone` , `address` , `city` , `state` , `zip` , `id_user` )
     VALUES(
    
        '".$tele."' , '".$address."' , '".$inputCity."' , '".$inpuState."' , '".$inputZip."' , '".$_SESSION["id_user"]."'); ";
      
    
        $exc=mysqli_query($_connexion,$req);

        $item_address= array(
            'num_telephone' =>$tele , 
            'address' =>$address , 
            'city' =>$inputCity , 
            'state' =>$inpuState , 
            'zip' =>$inputZip , 
            );

            $_SESSION["address"][]=$item_address;

        

    
        if (!$exc) {
            echo "happened error when you try to put your address please try again";
        }

            
        }
        


       
    ///////////////////////////////////////////////////////////

            $user_id=$_SESSION['id_user'];

        
            
            $_insertOrder ="INSERT INTO  command (
                    date_command,order_status,id_user
                )VALUES (
                    '$date','pending','$user_id') ";

            $order_id="";

            if(mysqli_query($_connexion,$_insertOrder)){

                $order_id=mysqli_insert_id($_connexion);
            }

            $_SESSION["order_id"]=$order_id;

            $oder_details="";

            foreach ($_SESSION["shopping_cart"] as $key => $value) {

                $oder_details .="INSERT INTO command_details (
                    id_command,id_produit,produit_name,prix,qte
                ) VALUES(
                    '$order_id', '$value[id_item]' , '".$value["item_name"]."' , '".$value["item_price"]."' , '".$value["item_quantity"]."'
                );
                
                ";


                
            }

            if(mysqli_multi_query($_connexion, $oder_details))  
                {  
                    unset($_SESSION["shopping_cart"]);  
                    //echo '<script>alert("You have successfully place an order...Thank you")</script>';  
                    
                    echo '<div class="alert alert-success" role="alert">You have successfully place an order...Thank you</div>';
                    echo '<meta http-equiv="refresh" content="1;URL=oder_details.php">';
                   // echo '<script>window.location.href="oder_details.php"</script>'; 

                }


      


        }else {

            echo '<meta http-equiv="refresh" content="0;URL=login.php?id=cart">';
        }


}


?>


<!-- 

<div class="order-config">


<div class="container">
    <div class="row">

        
            <div class="col-md-12">
                <table class="table">
                    <thead class="text-center">
                        <tr class="table-active">
                        <th colspan="3" scope="col">Order Summary</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td colspan="3">
                        <p><?php  ?></p>
                        <p><?php ?></p>
                        <p>gergerg</p>
                        </td>
                        </tr>

                        <tr class="table-primary">
                           <td> Order Details</td>
                        </tr>

                    </tbody>
                </table>
            </div>

    </div>
</div>

</div>



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "kiw";

    if (isset($_SESSION["id_user"])) {

        $tele =$_POST["tele"];
        $address =$_POST["address"];
        $inputCity =$_POST["inputCity"];
        $inpuState =$_POST["inpuState"];
        $inputZip =$_POST["inputZip"];

      ///////////////////////////////////////////////// 
      /* هذا الجزء درتو باه ميسيزيش عنوان تع مستخدم واحد اكثر من مرة */

        if(isset($_SESSION["address"])){
            $req="SELECT * FROM `address` WHERE address.id_user= '".$_SESSION['id_user']."' ";
                    $res=mysqli_query($_connexion,$req);
                    $info=mysqli_fetch_assoc($res);
                    

            if(empty($_POST["tele"])){
                echo '<div class="alert alert-warning" role="alert">must to put number phone</div>';

            }elseif (empty($_POST["address"])) {
                echo '<div class="alert alert-warning" role="alert">must to put address</div>';
                
            }elseif (empty($_POST["inputCity"])) {
                echo '<div class="alert alert-warning" role="alert">must to put city</div>';
                
            }elseif (empty($_POST["inpuState"])) {
                echo '<div class="alert alert-warning" role="alert">must to put state</div>';
                
            }else {

                if ($_POST["tele"]==$info["num_telephone"]) {
                    if ($_POST["address"] != $info["address"]) {
                        $req1=" UPDATE `address` SET `address` = '".$_POST["address"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                        mysqli_query($_connexion,$req1);
                        
                    }
                }


            }

            
        }else {


        
    
        $req=" INSERT INTO `address` (`num_telephone` , `address` , `city` , `state` , `zip` , `id_user` )
     VALUES(
    
        '".$tele."' , '".$address."' , '".$inputCity."' , '".$inpuState."' , '".$inputZip."' , '".$_SESSION["id_user"]."'); ";
      
    
        $exc=mysqli_query($_connexion,$req);

        $item_address= array(
            'num_telephone' =>$tele , 
            'address' =>$address , 
            'city' =>$inputCity , 
            'state' =>$inpuState , 
            'zip' =>$inputZip , 
            );

            $_SESSION["address"][]=$item_address;

        

    
        if (!$exc) {
            echo "happened error when you try to put your address please try again";
        }

            
        }
        


       
    ///////////////////////////////////////////////////////////

            $user_id=$_SESSION['id_user'];

        
            
            $_insertOrder ="INSERT INTO  command (
                    date_command,order_status,id_user
                )VALUES (
                    '$date','pending','$user_id') ";

            $order_id="";

            if(mysqli_query($_connexion,$_insertOrder)){

                $order_id=mysqli_insert_id($_connexion);
            }

            $_SESSION["order_id"]=$order_id;

            $oder_details="";

            foreach ($_SESSION["shopping_cart"] as $key => $value) {

                $oder_details .="INSERT INTO command_details (
                    id_command,id_produit,produit_name,prix,qte
                ) VALUES(
                    '$order_id', '$value[id_item]' , '".$value["item_name"]."' , '".$value["item_price"]."' , '".$value["item_quantity"]."'
                );
                
                ";


                
            }

            if(mysqli_multi_query($_connexion, $oder_details))  
                {  
                    unset($_SESSION["shopping_cart"]);  
                    echo '<script>alert("You have successfully place an order...Thank you")</script>';  
                   // echo '<script>window.location.href="order.php"</script>'; 

                }


      


        }else {

            echo '<meta http-equiv="refresh" content="0;URL=login.php?id=cart">';
        }


}





                    if ($_POST["address"] != $info["address"]) {
                        $req1=" UPDATE `address` SET `address` = '".$_POST["address"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                        mysqli_query($_connexion,$req1);
                        
                    }else {


                        if ($_POST["inputCity"] != $info["city"]) {
                            
                            $req1=" UPDATE `address` SET `city` = '".$_POST["inputCity"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                            mysqli_query($_connexion,$req1);
                            
                        }else {

                            if ($_POST["inpuState"] != $info["state"]) {
                            
                                $req1=" UPDATE `address` SET `state` = '".$_POST["inpuState"]."' WHERE address.id_address = '".$info["id_address"]."' ";
                                mysqli_query($_connexion,$req1);
                            }


                        }

                        
                        
                    }


-->




