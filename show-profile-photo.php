<?php 

include_once("connections/DBconnection.php");
include_once("login.php");

$db = new DBconnection();
$con = $db->connection();

$userID = $_SESSION['UserId'];

$sql = "SELECT * FROM registered_users WHERE ID = '$userID'";
$users = $con->query($sql) or die ($con->error);
$userInfo = $users->fetch_assoc()

?>