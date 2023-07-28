<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

$userID = $_SESSION['UserId'];

$sql = "SELECT * FROM employees_tasks WHERE employee_id = $userID";
$project = $con->query($sql) or die ($con->error);
$newtask_notif = $project->fetch_assoc();

// if (mysqli_num_rows($project) > 0) {

//     while($row = mysqli_fetch_assoc($project)) {

//         if($row['invite_status'] == 'new') {

//             $output .= "'" . $row['sent_by'] . "' sent a new task from '" . $row['project_name'] . "' project. '" . $row['task_title'] . "'";

//         }
//     }

//     echo $_SESSION[]

// }


?>