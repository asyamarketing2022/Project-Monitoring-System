<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['dept'])){

        $dept = $_POST['dept'];

        $sql = "SELECT * FROM registered_users WHERE department = '$dept' AND access = 'manager'";
        $manager = $con ->query($sql) or die ($con->error);
        $managerInfo = $manager->fetch_assoc();

            $output = '<span>Select Manager</span>';

        do {
            $output .= "<div class='form-check'>
                     <input class='form-check-input' name='zz' type='checkbox' value=''>
                     <label class='form-check-label' for='flexCheckDefault'>". $managerInfo['first_name'] ." " . $managerInfo['last_name'] . "</label>
                </div>";
        } while($managerInfo = $manager->fetch_assoc());

        echo $output;

    } 




?>