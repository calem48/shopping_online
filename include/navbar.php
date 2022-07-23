     
  <?php 
          $_res=mysqli_query($_connexion,"SELECT * FROM `categorie` ");
    ?>
    
    <!-- start upper Bar -->
      <div class="upper-bar">
        <div class="container-fluid">
        <ul class="nav ">
          <?php 
          while ($_row=mysqli_fetch_assoc($_res)) {
            ?>
            <li class="nav-item">
              <a class="nav-link" href="categorie.php?cate=<?php echo $_row["id_categorie"] ?>">
               <?php echo $_row["tag"] ." ".$_row["type"]?>
            </a>
            </li>

            <?php 
            }
            ?>
        </ul>
        </div>
      </div>



