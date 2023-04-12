<?php 

include_once("connections/connection.php");
$con = connection();

if(!isset($_SESSION)) 
    { 
        session_start(); 
} 

$userID = $_SESSION['UserId'];

$sql = "SELECT notif_status FROM project_history WHERE employee_id = $userID";
$project = $con->query($sql) or die ($con->error);

if (mysqli_num_rows($project) > 0){

    while($row = mysqli_fetch_assoc($project)) {

        if($row['notif_status'] == 'new') {

            $newProject_array[] = $row['notif_status'];

            $_SESSION['new_notif'] = count($newProject_array);

        }
    }

    echo $_SESSION['new_notif'];
    // echo $userID;

    // echo 'error';
    
} else {

    echo "";

}

mysqli_close($con);

?>