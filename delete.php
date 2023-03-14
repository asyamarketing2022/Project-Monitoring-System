<?php 

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['submit'])){

    if(!empty($_POST['lang'])) {

        foreach($_POST['lang'] as $value ) {

            $sql = "DELETE FROM registered_users WHERE ID = '$value'";
            $con->query($sql) or die ($con->error);
            echo header("Location: admin.php");

        }

    } else {

         echo header("Location: admin.php");
         
    }

}


?>