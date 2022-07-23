<?php


    if (isset($_POST["id"])) {
        
        include("include/session.php");
        $table1='';
        $table = '';
        if($_POST["action"] == "order-dteails"){
            
            $total=0;
                
            $req1=$_connexion->query("SELECT  cd.produit_name , cd.qte ,cd.prix FROM command_details  as cd WHERE cd.id_command = '".$_POST["id"]."' ");
            
                
                while ($res1=$req1->fetch_assoc()) {
                    $table .='

                    <tr>
                        <th scope="row">1</th>
                        <td>'.$res1["produit_name"].'</td>
                        <td>'.$res1["qte"].'</td>
                        <td>'.$res1["prix"].'</td>
                        <td>'.$res1["prix"]*$res1["qte"].'</td>
                    </tr>
                    
                    ';
                    $total =$total+$res1["prix"]*$res1["qte"];
                }

                $table .= '

                <tr class="table-primary">
                    <td colspan="3"></td>
                    <td colspan="">TOTAL</td>
                    <td>'.$total.'</td>
                </tr>
                
                ';

               
               

    }


    if($_POST["action"] == "info-user"){

        $req3="SELECT * FROM users as u LEFT JOIN address as a ON u.id_user=a.id_user LEFT JOIN genders as g ON u.id_gender=g.id WHERE u.id_user='$_POST[id]'";
                        $res2=$_connexion -> query($req3);
                        $count=1;
                        while ($rows=$res2->fetch_assoc()){
                            
                            $table .='

                            <tr>
                                <th scope="row">'.$count.'</th>
                                <td>'.$rows["username"].'</td>
                                <td>'.($rows["num_telephone"] == "" ? '#' : $rows["num_telephone"] ). '</td>
                                <td>'.($rows["city"]  == "" ? '#' : $rows["city"] ).'</td>
                                <td>'.($rows["state"]  == "" ? '#' : $rows["state"] ).'</td>
                                
                            </tr>
                            
                            ';
                            $count++;
                        }

                      
    }

    $output = array(

        'table'     =>     $table
        //'table1'     =>     $table1

);  
echo json_encode($output);  


}







?>
