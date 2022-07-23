
<?php 
session_start();
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/main.css">
    

    <title>Hello, world!</title>
  </head>
  <body>

    <!-- start nav-->

    <nav class="navbar navbar-expand-lg navbar-light bg-light des col-12">
      <a class="navbar-brand" href="index.php">
        <span>ONLINE</span><span>SHOP</span>
          
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">HOME <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="about.php">ABOUT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact-us.php">CONTACT</a>
          </li>
        </ul>
      
        
          
          <ul class="navbar-nav ml-auto menu">

          <li class="nav-item parent ">
              <a href="cart.php" class="nav-link" class="btn btn-primary">
                <i class="fas fa-shopping-cart ml-3"></i> 
                
               
                  
                  <span calss="cn" id="idn"><?php if(isset($_SESSION["shopping_cart"])) { echo count($_SESSION["shopping_cart"]); } else { echo '0';}?></span>
             
               
              </a>
            </li>
            <?php
          if (isset($_SESSION['id_user'])) {
            ?>
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              SETTINGS
            </a>
            <div class="dropdown-menu drd" aria-labelledby="navbarDropdown">
              
              <a class="dropdown-item" href="#">PROFILE</a>
              <?php 
              if ($_SESSION['role_id']=="1") {
                echo '<a class="dropdown-item" href="admin/index.php">PANNEL ADMIN</a>';
              }
               
              ?>
              
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="logout.php?id=<?php echo $_SESSION['id_user'] ?>">DECONNEXION</a>
            </div>
            </li>
          
            
            <?php
          }else{
            
          ?>

            <li class="nav-item ">
              <a class="nav-link" href="login.php"><i class="fa fa-sign-in-alt ml-3"></i> CONNEXION</a>
            </li>

          </ul>
        <?php
          }
          ?>
      </div>
    </nav>





    <!--  <a class="nav-link" href="login.php" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"><i class="fa fa-sign-in-alt ml-3"></i> 
            connexion
            </a> -->
