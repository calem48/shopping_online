<?php
include("include/session.php");
include("include/header.php");
include("include/aside.php");
$_msg="";
if(isset($_GET["status"]) AND isset($_GET["order"])){
    $_connexion->query(" UPDATE command SET order_status ='$_GET[status]' WHERE id_command = '$_GET[order]' ");
}

if (isset($_GET["del"])) {

    if(mysqli_query($_connexion,"DELETE FROM command WHERE id_command = '$_GET[del]'")){
        $_msg= '<div class="alert alert-success" role="alert"> deleted successfully  </div>';
    } 
}



?>

     

<div class="col-8">
<?php echo $_msg  ?>
    <div class="card">
    <div class="card-header">
        LIST ORDERS
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">DATE COMMAND</th>
                        <th scope="col">STATUS</th>
                        <th scope="col">DETAILS COMMAND</th>
                        <th scope="col">DETAILS USER</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $req="SELECT c.id_command, u.username,c.date_command,c.order_status ,u.id_user FROM command as c INNER JOIN USERS as u ON c.id_user = u.id_user";
                    $res=$_connexion -> query($req);
                    $count=1;
                    while($rows=$res->fetch_assoc()){
                ?>
                    <tr>
                        <th scope="row"><php echo $count?></th>
                        <td><?php echo $rows["username"]  ?></td>
                        <td><?php echo $rows["date_command"]  ?></td>
                        <td> <?php echo  ($rows["order_status"] == "pending" ? '<a href="order.php?status=active&order='.$rows["id_command"] .'" class="btn btn-warning btn-sm">PENDING</a>' : '<a href="order.php?status=pending&order='.$rows["id_command"] .'" class="btn btn-success btn-sm">ACTIVATED</a>') ?> </td>
                        <td><a href="order-details.php?info=<?php echo $rows["id_command"];  ?>" class="btn btn-info btn-sm order-model" data-id="<?php echo $rows["id_command"];  ?>" data-toggle="modal" data-target="#exampleModal1">DETAILS</a></td>
                        <td><a href="order-details.php?info=<?php echo $rows["id_user"]  ?>" class="btn btn-info btn-sm info-user" data-id="<?php echo $rows["id_user"];  ?>" data-toggle="modal" data-target="#exampleModal">INFO USER</a></td>
                        <td><a href="order.php?del=<?php echo $rows["id_command"] ; ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a></td>
                    </tr>
                 <?php $count++; } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    </div>    
</div>

    <!-- Modal order details -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mdal_config">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DETAILS ABOUT ORDER</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody class="res_order">
                </tbody>
            </table>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        </div>
    </div>
</div>




<!-- Modal user -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog mdal_config">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">PHONE</th>
                        <th scope="col">CITY</th>
                        <th scope="col">STATE</th>
                    </tr>
                </thead>
                <tbody class="table-info">
                    
                </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php

include("include/footer.php");

?>