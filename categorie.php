

<?php 
include("include/config_db.php");
include("include/header.php");

//end $_SERVER["REQUEST_METHOD"] == "POST"


?>


<div id="tb">
<!-- كان خاص بتجريب استراجع الجدول بواسطة جيكوري من خلال صفحة
cart_confing 


            <table class="table text-center" >
                <thead  class="thead-color">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                
                    <?php 
                    if (!empty($_SESSION["shopping_cart"])) {
                        $coun=0;
                        $total = 0;
                        foreach ($_SESSION["shopping_cart"] as $key => $value) {
                            $coun++;
                    ?>

                    <tr>
                    <th scope="row"><?php echo $coun; ?></th>
                    <td><?php echo  $value["item_name"]; ?></td>
                    <td ><input type="text" value="<?php echo  $value["item_quantity"]; ?>" style=" width: 15%; text-align: center;" class="qte" data-product_id="<?php echo $value["id_item"]; ?>"></td>
                    <td><?php echo $value["item_price"]; ?></td>
                    <td><?php echo $value["item_price"]*$value["item_quantity"] ; ?></td>

                    <td><button type="button" class="btn btn-danger delete" id="<?php echo  $value["id_item"]; ?>">Remove</button></td>
                    </tr>
                    <?php 

                        $total = $total + ($value["item_quantity"] * $value["item_price"]);  
                     }
                    ?>

                    <tr class="table-info">
                    <td colspan="4">TOTALE</td>
                    <td><?php echo number_format($total, 2); ?></td>
                    <td></td>
                    </tr>
                    
                    <tr class="">
                    <td colspan="6"><button type="button" class="btn btn-info">order</button></td>
                    </tr>
                    <p id="h"></p>
                </tbody>
                <?php } ?>
        </table>-->
       
</div>

<div class="aside">
    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 asid-4 mb-4">
                <ul class="list-group">
                    <?php

                    $_query1="SELECT * FROM `categorie` ";
                    
                    $_sql_query1=mysqli_query($_connexion,$_query1);
                   
                    
                   
                    if (mysqli_num_rows($_sql_query1) > 0) {
                        
                          
                        
                        
                    while ($_array1=mysqli_fetch_assoc($_sql_query1)) {
                        $_query2="SELECT COUNT(*) FROM `produits` WHERE `id_categorie` ='$_array1[id_categorie]' ";
                        $_sql_query2=mysqli_query($_connexion,$_query2);
                            $num_prod=mysqli_fetch_assoc($_sql_query2);
                            foreach ($num_prod as $key => $value) {

                    ?>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="categorie.php?cate=<?php echo $_array1["id_categorie"]; ?>"><?php echo $_array1["type"]; ?></a>
                        <span class="badge badge-primary badge-pill"><?php echo $value  ?></span>
                    </li>

                    <?php
                    }
                        }
                        
                    }
                    ?>  

                </ul>
            </div>

            <div class="col-md-9 text-center">
              <div class="asid-9-con">
                  <div class="row">
                        
                  <?php
                        if (isset($_GET["cate"])) {

                        $_query="SELECT * FROM `produits` WHERE `id_categorie`= '$_GET[cate]' ";
                        
                        $_sql_query=mysqli_query($_connexion,$_query);
                        //$_array=mysqli_fetch_assoc($_sql_query);
                       // print_r($_array);
                       if (mysqli_num_rows($_sql_query) > 0) {
                        while ($_array=mysqli_fetch_assoc($_sql_query)) {
                    ?>
                    
                    <div class="col-12 col-md-4 conf">
                    <div><!-- start-->
                        <div class="card">
                            <div>
                                <img src="image/product/<?php echo $_array['img'];?>" class="img-fluid" style="max-height: 152px">
                            </div>
                            
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $_array['name_produit'];?></h5>
                                <p class="card-text"><?php echo $_array["price"]; ?></p>

                                <input type="text" name="qte" id="qte<?php echo $_array["id_produit"]; ?>" value="1" class="form-control .qte" data-product_id="<?php echo $_array["id_produit"]; ?>" />
                                <input type="hidden" name="hidden_name"  id="name<?php echo $_array["id_produit"]; ?>" value="<?php echo $_array["name_produit"]; ?>" />
                                <input type="hidden" name="hidden_price" id="price<?php echo $_array["id_produit"]; ?>" value="<?php echo $_array["price"]; ?>" />    
                                <input type="button" name="add_to_cart"  id="<?php echo $_array["id_produit"]; ?>" class="btn btn-primary add_to_cart mt-2" value="Add to Cart">
                                
                            </div>
                        </div>
                    </div><!-- fin -->
                    </div>
                    
                   <?php
                        }                   
                    }
                }
                   ?><!-- <p id="msg"></p> تاع تاست-->
                  </div><!-- fin row-->
              </div><!-- asid-9-con-->
            </div><!-- fin col-md-9 text-center-->




        </div><!-- fin row-->
    </div><!-- fin container-->
</div><!-- fin aside-->



<?php
/*
                //session_destroy();
    echo '<pre>';
    print_r($_SESSION);

    echo '<pre>';*/

include("include/footer.php");

?>


