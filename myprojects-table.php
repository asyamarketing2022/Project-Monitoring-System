<?php include("login.php"); ?>

<?php 

include_once("connections/connection.php");
$con = connection();

$userID = $_SESSION['UserId'];

$sql = "SELECT * FROM assign_project WHERE employees_id = '$userID'";
$user = $con->query($sql) or die ($con->error);
$userProject = $user->fetch_assoc();

?>