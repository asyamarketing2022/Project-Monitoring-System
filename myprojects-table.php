<?php include("login.php"); ?>

<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();


// $sql = "SELECT * FROM assign_project ORDER BY id ASC"

// $userID = $_SESSION['UserId'];

// $sql = "SELECT * FROM assign_project WHERE employees_id = '$userID'";
// $sql = "SELECT * FROM assign_project ORDER BY id ASC";
// $allProjects = $con->query($sql) or die ($con->error);
// $project = $allProjects->fetch_assoc();

$userID = $_SESSION['UserId'];
    
$sql = "SELECT * FROM employees_tasks WHERE employee_id = '$userID'";
$myProjects = $con->query($sql) or die ($con->error);
$userProject = $myProjects->fetch_assoc();


?>