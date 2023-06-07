<?php include_once("connections/DBconnection.php"); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['updateStatus'])){

    $projectId = $_POST['projectId'];
    $updateStatus = $_POST['updateStatus'];
    $status_db_Row = $_POST['status_db_Row'];
    
    echo $updateStatus;


}

?>
