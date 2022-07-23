<?php
include("include/session.php");
include("include/header.php");
include("include/aside.php");
$_msg="";



if (isset($_GET["del"])) {

    if(mysqli_query($_connexion,"DELETE FROM users WHERE id_user = '$_GET[del]'")){
        $_msg= '<div class="alert alert-success" role="alert"> deleted successfully  </div>';
    } 
}


?>
      

<div class="col-8">
<?php echo $_msg  ?>
    <div class="card">
    <div class="card-header">
        LIST MEMEBERS
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME</th>
                        <th scope="col">PHONE</th>
                        <th scope="col">CITY</th>
                        <th scope="col">STATE</th>
                        <th scope="col">GENDER</th>
                        <th scope="col">DELETE</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $req="SELECT * FROM users as u 
                    LEFT JOIN address as a 
                    ON u.id_user=a.id_user
                    LEFT JOIN genders as g 
                    ON u.id_gender=g.id";
                    $res=$_connexion -> query($req);
                    $count=1;
                    while($rows=$res->fetch_assoc()){
                ?>
                    <tr>
                        <th scope="row"><php echo $count?></th>
                        <td><?php echo $rows["username"]  ?></td>
                        <td><?php echo $rows["num_telephone"] == "" ? '#': $rows["num_telephone"]  ?></td>
                        <td><?php echo $rows["city"] == "" ? '#': $rows["city"]  ?></td>
                        <td><?php echo $rows["state"] == "" ? '#': $rows["state"]  ?></td>
                        <td><?php  if($rows["type"] == "m"){echo '<i class="fas fa-male"></i>';}else {if($rows["type"] == "f"){ echo '<i class="fas fa-female"></i>';}else{echo '#';} } ?></td>
                        <td><a href="memebers.php?del=<?php echo $rows["id_user"]  ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a></td>
                    </tr>
                 <?php $count++; } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    </div>    
</div>

<?php

include("include/footer.php");

?>