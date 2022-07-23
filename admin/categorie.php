<?php
include("include/session.php");
include("include/header.php");
include("include/aside.php");

$_msg="";

//"UPDATE  categorie SET type ='$_POST[enameCate]' WHERE id_categorie = '$_GET[edit]'"
if (isset($_GET["del"])) {

    if(mysqli_query($_connexion,"DELETE FROM categorie WHERE id_categorie = '$_GET[del]'")){
        $_msg= '<div class="alert alert-success" role="alert"> deleted successfully  </div>';
    } 
}





if(isset($_POST["submit"])){
    $nameCate = $_POST["nameCate"];
    $tag      = $_POST["tag"];

    if (empty($nameCate)) {
        $_msg= '<div class="alert alert-warning" role="alert">put name categorie</div>';
        
    }else{
        if($tag != ""){

            $req=mysqli_query($_connexion,"INSERT INTO categorie (type ,tag) VALUES ('$nameCate' ,'$tag')");
            $_msg= '<div class="alert alert-success" role="alert">Added successfully</div>';
        }else {
            $req=mysqli_query($_connexion,"INSERT INTO categorie (type ) VALUES ('$nameCate')");
        }

        }
        
}

?>




<div class="col-9">
    <div class="row">
        <div class="col-md-8">
        <?php echo $_msg ;?>
            <div class="card">
                <div class="card-header">
                    CATEGORIE
                </div>
                <div class="card-body">
                <table class="table">
                    <thead class="">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">NAME CATEGORIE</th>
                        <th scope="col">TAG</th>
                        <th scope="col">EDIT</th>
                        <th scope="col">DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query=mysqli_query($_connexion,"SELECT * FROM categorie ");
                            $count=1;
                            while ($array=mysqli_fetch_assoc($query)) {
                        ?>
                        <tr>
                        
                            <th scope="row"><?php echo $count ?></th>
                            <td><?php echo $array["type"] ?></td>
                            <td><?php echo $array["tag"] ?></td>
                            <td><a href="categorie.php?ed=<?php echo $array["id_categorie"] ?>" class="btn btn-warning btn-sm edit" data-id="<?php echo $array["id_categorie"] ?>" data-toggle="modal" data-target="#exampleModal"><i class="bi bi-pencil-square"></i></a></td>
                            <td><a href="categorie.php?del=<?php echo $array["id_categorie"] ?>" class="btn btn-danger btn-sm"><i class="bi bi-trash-fill"></i></a></td>
                            
                        </tr>
                        <?php $count++; }?>

                    </tbody>
                </table>
                </div>
            </div>  
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    ADD NEW CATEGORIE
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="nameCate" id="exampleInputEmail1" placeholder="put name of categotie">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="tag" id="exampleInputPassword1" placeholder="put tag categorie">
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>  
        </div>
    
    </div>  
</div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" >Edit categorie</h5>
        <!--
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>-->
      </div>
      <form id="cat_edit" method="">
        <div class="modal-body">
            <div class="form-group" id="msg"></div>
            <div class="form-group">
                <input type="text" class="form-control" name="enameCate" id="enameCate" placeholder="put name of categotie">
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="etag" id="etag" placeholder="put tag categorie">
            </div>                     
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary cl" data-dismiss="modal">Close</button>
            <input type="submit" name="edit" class="btn btn-primary" value="Save changes">
        </div>
      </form>
    </div>
  </div>
</div>


<?php

include("include/footer.php");

?>