<?php 

include_once('connections/connection.php');
$con = connection();
 
    if(isset($_POST['submitAssign'])) {

        $code = $_POST['update_code'];
        $projectName = $_POST['update_projectName'];
        // $dateStart = $_POST['dateStart'];
        $dateEnd = $_POST['dateEnd'];
        $employessId = $_POST['employees_id'];
        $manager = $_POST['manager'];
        $projectInvolve = $_POST['project_involve'];
        $status = $_POST['status'];

        //Convert the array to String ($_POST['pickEmployee'] is an array)
        $employees = implode(" ", $projectInvolve);

        $sql = "INSERT INTO `assign_project` (`project_code`, `project_name`, `date_end`, `employees_id`, `manager`, `project_involve`, `status`) VALUES ('$code', '$projectName', '$dateEnd', '$employessId', '$manager', '$employees', '$status')";

        $con->query($sql) or die ($con->error);
        
    }

?>