<?php 
include("include/config_db.php");
include("include/header.php");

?>

<div class="login-conf">
    <div class="container">
      <div class="row justify-content-md-center">
          <div class="col-lg-6">

          <?php 
          if (empty(isset($_SESSION["id_user"]))) {
          
            if (isset($_GET['id'])) {
              echo '<div class="alert alert-warning " role="alert ">
                        you must to login to continue shopping
                    </div>';
              }

        
        
        ?>
        <div class="card">
          <div class="card-header header-conf">
            Login
          </div>
          <div class="card-body">
              <form action="" method="post" id="form_login">
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
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
          </div>
          <div class="card-footer text-muted">
            2 days ago
          </div>
      </div>
          <?php 
            }else {
              echo header("location:index.php");
            }
          ?>
          </div>
      </div>
    </div>
</div>






<?php 

include("include/footer.php");
?>

<!-- 


  -->