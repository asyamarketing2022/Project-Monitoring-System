<?php 

include_once('connections/connection.php');
$con = connection();
 
    if(isset($_POST['submitAssign'])) {

        $code = $_POST['update_code'];
        $projectName = $_POST['update_projectName'];
        $dateStart = $_POST['dateStart'];
        $dateEnd = $_POST['dateEnd'];
        $manager = $_POST['manager'];
        $employeesWrapper = $_POST['pickEmployee'];

        //Convert the array to String ($_POST['pickEmployee'] is an array)
        $employees = implode(" ", $employeesWrapper);

        $sql = "INSERT INTO `assign_project` (`project_code`, `project_name`, `date_start`, `date_end`, `manager`, `assign_employee`) VALUES ('$code', '$projectName', '$dateStart', '$dateEnd', '$manager', ' $employees ')";

        $con->query($sql) or die ($con->error);
        
    }

?>