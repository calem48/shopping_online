<?php 
include("config_db.php");
session_start();
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_username=$_POST["username"];
    $_password=$_POST["password"];

    if (empty($_username)) {
        echo '<div class="alert alert-danger" role="alert">must to put your username</div>';
    }elseif(empty($_password)){
        echo '<div class="alert alert-danger" role="alert">must to put your password</div>';
    }else{

        $_query=" SELECT * FROM `users` WHERE `username` ='$_username' AND `password` ='$_password' ";
        $_sql_query=mysqli_query($_connexion,$_query);
       
            
        if (mysqli_num_rows($_sql_query)!=1) {
            echo '<div class="alert alert-danger" role="alert">username or password incorrect</div>';
        }else {

           
            $_array=mysqli_fetch_assoc($_sql_query);
            $_SESSION['id_user']=$_array['id_user'];
            $_SESSION['username']=$_array['username'];
            $_SESSION['password']=$_array['password'];
            $_SESSION['email']=$_array['email'];
            $_SESSION['role_id']=$_array['role_id'];
            $_SESSION['id_gender']=$_array['id_gender'];

            $req="SELECT * FROM `address` WHERE address.id_user= '".$_array['id_user']."' ";
            $res=mysqli_query($_connexion,$req);
            
            if (mysqli_num_rows($res) > 0) {
                
                $array1=mysqli_fetch_assoc($res);
                
                $item_address= array(
                    'num_telephone' =>$array1["num_telephone"] , 
                    'address' =>$array1["address"] , 
                    'city' =>$array1["city"] , 
                    'state' =>$array1["state"] , 
                    'zip' =>$array1["zip"] , 
                    );
        
                    $_SESSION["address"][]=$item_address;
                    
              
            }

 
            echo '<div class="alert alert-success" role="alert">login successfully wait just second ...</div>';
            echo '<meta http-equiv="refresh" content="1;URL=index.php">';

        }


    }
    
}

?>

