<?php 
session_start();

$order_table = ''; 
$_array_msg= array();
$x="";

if(isset($_POST["product_id"]))  { 
    
    
if ($_POST["action"] == "add") {

    if (isset($_SESSION["shopping_cart"])) {
        $item_array_id = array_column($_SESSION["shopping_cart"],"id_item");

        
        if (!in_array($_POST["product_id"],$item_array_id)) {
            //$count= count($_SESSION["shopping_cart"]);
            $item_array=array(

                'id_item'			=>	$_POST["product_id"],
                'item_name'			=>	$_POST["product_name"],
                'item_price'		=>	$_POST["product_price"],
                'item_quantity'		=>	$_POST["product_qte"]
                
            );
            $_SESSION["shopping_cart"][]=$item_array;
            $x=  'item added success';

        }else {
            
            $x=  'Item Already Added';
        }

        
    }else{

        $item_array = array(
            'id_item'			=>	$_POST["product_id"],
            'item_name'			=>	$_POST["product_name"],
            'item_price'		=>	$_POST["product_price"],
            'item_quantity'		=>	$_POST["product_qte"]
        );

         $_SESSION["shopping_cart"][0] = $item_array;
         $x=   'item added success';
    }

   
}

if ($_POST["action"] == "remove") {
    
    foreach ( $_SESSION["shopping_cart"] as $key => $value) {

        if ( $value["id_item"] == $_POST["product_id"] ) {
            unset($_SESSION["shopping_cart"][$key]);
            $x= "Product Removed";
            
        }
    }
     //'<meta http-equiv="refresh" content="0;URL=index.php">';
}


if ($_POST["action"] == "update_qte") {

    foreach ( $_SESSION["shopping_cart"] as $key => $value) {

        if ( $_SESSION["shopping_cart"][$key]["id_item"] == $_POST["product_id"] ) {

            $_SESSION["shopping_cart"][$key]["item_quantity"] =$_POST["qte"];
            
        }


   
    }
     //'<meta http-equiv="refresh" content="0;URL=index.php">';
}




if (!empty($_SESSION["shopping_cart"])) {
$order_table .= '
    <table class="table text-center">
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
';
}else{
    //هنا باه ميرجعليش الهيدر نتع الجدول
    $order_table .= '
    <div class="cart-vide">
        Votre panier est actuellement vide.
    </div>  
    ';

}


    if (!empty($_SESSION["shopping_cart"])) {
       
        $coun=0;
        $total = 0;
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            $coun++;
            $order_table .= '
            <tr>
            <th scope="row">'.$coun.'</th>
            <td>'.$value["item_name"].'</td>
            
            <td ><input type="text" style=" width: 40px; text-align: center;" value="'.$value["item_quantity"].'" class="qte" data-product_id="'.$value["id_item"].'" /></td>
            
            <td>'.$value["item_price"].'</td>
            <td>'.$value["item_price"]*$value["item_quantity"].'</td>

            <td><button type="button" class="btn btn-danger delete" id="'. $value["id_item"].'">Remove</button></td>
            </tr>';

                $total = $total + ($value["item_quantity"] * $value["item_price"]);  
             }
             $order_table .= '

             <tr class="table-info">
             <td colspan="4">TOTALE</td>
             <td>'.number_format($total, 2).'</td>
             <td></td>
             </tr>

                                 
             <tr colspan="" class="">
                <td colspan="6">
                <button type="submit" name="submit" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                    order
                </button>
                </td>
             </tr
             <p id="h"></p>
        </tbody>
    </table>

    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">


        <form action="order.php" method="post">
            
            <div class="form-group">
                <label for="inputAddress">Number phone</label>
                <input type="text" name="tele" class="form-control" id="inputAddress" placeholder="put your number phone">
            </div>
            <div class="form-group">
                <label for="inputAddress2">Address</label>
                <input type="text" name="address" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" name="inputCity">
                </div>
                <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" name="inputZip">
                </div>
                <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" name="inputZip">
                </div>
            </div>
           
            <button type="submit" name ="submit"class="btn btn-primary">Sign in</button>
        </form>
            




        </div>
        </div>
    </div>
    </div>
    
    
    
    
    
    ';

    }




$output = array(  
    'order_table'  => $order_table ,
    'cart_item'          =>     count($_SESSION["shopping_cart"])  ,
    'e'=> $x,
    //'see' => $_SESSION["shopping_cart"]
);

echo json_encode($output); 



}

?>