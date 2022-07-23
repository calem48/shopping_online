<?php 
include("include/config_db.php");
include("include/header.php");


?>

<div class="cart-conf">
    <div class="container">
        <div class="row ">
            <div class="col-12 col-lg-12" id="trt">
            <?php 
                if (isset($_SESSION["shopping_cart"] ) AND $_SESSION["shopping_cart"] != null ) {
            ?>
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
                    <td ><input type="text" value="<?php echo  $value["item_quantity"]; ?>" style="width: 40px; text-align: center;" class="qte" data-product_id="<?php echo $value["id_item"]; ?>"></td>
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
                    
                    <tr colspan="" class="">
                        <td colspan="6">
                        <button type="submit" id="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            order
                        </button>
                        </td>
                    </tr>
                    <p id="h"></p>
                </tbody>
                <?php } ?>
        </table>

        <!-- Button trigger modal 
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Launch demo modal
            </button>-->

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title cart_msg" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                <form action="" method="" id="modelSubmit">
                    <!-- لازم نحي ساشن وندير روكات باه القيمة القديمة بعد تغير الفوريملار تروح ودجي الجديدة لدرتها بلاما نغلق الساشن ونفتحها خخخ -->
                    <?php 
                        if (isset($_SESSION["id_user"])) {
                           
                        
                        $res1=mysqli_query($_connexion,"SELECT * FROM  address WHERE id_user = '".$_SESSION["id_user"]."' ");
                        $array=mysqli_fetch_assoc($res1);
                    }
                    
                    ?>
                    <div class="form-group">
                        <label for="inputAddress">Number phone</label>
                        <input type="text" name="tele" class="form-control" id="tele"  value="<?php if(isset($_SESSION["id_user"])){echo $array["num_telephone"]; }else{echo "";}?>" placeholder="put your number phone">
                    </div>
                    <div class="form-group">
                        <label for="inputAddress2">Address</label>
                        <input type="text" name="address" class="form-control" id="address" value="<?php (isset($_SESSION["id_user"])) ? print $array["address"]: print ''; ?>" placeholder="Apartment, studio, or floor">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="inputCity">City</label>
                        <input type="text" class="form-control" name="inputCity" id="inputCity"  value="<?php (isset($_SESSION["id_user"])) ? print $array["city"]: print ''; ?>">
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputState">State</label>
                        <input type="text" class="form-control" name="inpuState" id="inpuState" value="<?php (isset($_SESSION["id_user"])) ? print $array["state"] : print ''; ?>" >
                        </div>
                        <div class="form-group col-md-2">
                        <label for="inputZip">Zip</label>
                        <input type="text" class="form-control" name="inputZip" id="inputZip" value="<?php (isset($_SESSION["id_user"])) ? print $array["zip"] : print ''; ?>">
                        </div>
                    </div>
                   
                    <button type="submit" name ="submit"class="btn btn-primary">Sign in</button>
                </form>
                    




                </div>
                </div>
            </div>
            </div>








        <?php }else {
         ?>

            <div class="cart-vide">
                 Votre panier est actuellement vide.
            </div>

        <?php } ?>
            </div>
        </div>
    </div>
</div>


<?php 


//session_destroy();
echo '<pre>';
print_r($_SESSION);

echo '<pre>';



include("include/footer.php");
?>

<!-- 


<form action="" method="POST" class="mt-3">
    <input type="submit" name="submit" class="btn btn-info" value="order" data-toggle="modal" data-target="#exampleModal">
</form
-->