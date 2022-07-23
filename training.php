<?php 

include("include/header.php");
$insert="";
$order_id = ""; 
if (isset($_POST["submit"])) {
    
    
    $username=$_POST['username'];

	$password=$_POST['password'];

    $insert .=" INSERT INTO users ( username,  `password`,`role_id`) VALUES ('kayou', '1234','4');";
    $insert .=" INSERT INTO users ( username,  `password`,`role_id`) VALUES ('kayou1', '1234','4');";

    if(mysqli_multi_query($_connexion, $insert))  
    {  
        unset($_SESSION["shopping_cart"]);  
         
    }  

    print_r($insert);

    $insert_sql=mysqli_multi_query($_connexion,$insert);

    
    $order_id = mysqli_insert_id($_connexion);  
    $_SESSION["order_id"] = $order_id;  

}


?>

<div class="login-conf">
    <div class="container">
      <div class="row justify-content-md-center">
          <div class="col-lg-6">

        


        <div class="card">
          <div class="card-header header-conf">
            Login
          </div>
          <div class="card-body">
              <form action="" method="post">
                <div class="form-group">
                  <label for="exampleInputEmail1"></label>
                  <input type="username" class="form-control" id="username" name="username" placeholder="username or email address">
                  
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"></label>
                  <input type="password" class="form-control" id="password" name="password"placeholder="password">
                </div>
                
                <div id="msg"></div>
                <div class="submit-conf">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
          </div>
          <div class="card-footer text-muted">
            2 days ago
          </div>
      </div>

          </div>
      </div>
    </div>
</div>






<?php 

include("include/footer.php");
?>