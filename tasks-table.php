<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['userId'])) {

    $userId = $_POST['userId'];
    $phase_of_work = $_POST['phase_of_work'];
    $services = $_POST['services'];

}

?>