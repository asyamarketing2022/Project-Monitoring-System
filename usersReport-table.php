<?php 

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM user_record ORDER BY id ASC";
$userRecord = $con->query($sql) or die ($con->error);
$userRecord_info = $userRecord->fetch_assoc();

?>