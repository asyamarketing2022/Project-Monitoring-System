<?php 

include_once("connections/connection.php");
$con = connection();

$sql = "SELECT * FROM registered_users ORDER BY id ASC";
$users = $con->query($sql) or die ($con->error);
$userInfo = $users->fetch_assoc();

?>