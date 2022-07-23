<?php
include("include/session.php");
include("include/header.php");
include("include/aside.php");



?>
      

<div class="col-8">
<div id="msg"></div>
    <div class="card">
    <div class="card-header">
        ADD ITEMS
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">

            <form id="itemadd" enctype="multipart/form-data">

                <div class="form-group row">
                    <label class="col-sm-2" for="exampleInputEmail1">Name</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" name="product" id="product" aria-describedby="emailHelp">
                    </div>    
                </div>

                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">STOCK</label>
                    <div class="col-sm-2">
                      <input type="text" name="stock" class="form-control" id="stock">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">PRICE</label>
                    <div class="col-sm-2">
                      <input type="text" name="price" class="form-control" id="price" >
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">IMAGE</label>
                    <div class="col-sm-10">
                         <input type="file" name="file" id="file">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label">CATEGORIE</label>
                    <div  class="col-sm-4">
                        <select class="form-control" name="select-item" id="select-item">
                        <option>choose categorie</option>
                        <?php 
                            $req=$_connexion->query("SELECT * FROM categorie");
                            while ($arr=$req->fetch_assoc()) { 
                        ?>
                        <option value="<?php echo $arr["id_categorie"];?>"><?php echo $arr["type"];?></option>

                        <?php }?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label"></label>
                    <div class="col-sm-10">
                        <button type="submit" name="submit" id="add-item" class="btn btn-primary">Submit</button>
                    </div>
                </div> 
            </form>

            </div>
        </div>
    </div>
    </div>    
</div>

<?php

include("include/footer.php");

?>