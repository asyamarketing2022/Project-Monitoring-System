<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])) {

    $projectId = $_POST['projectId'];
    $projectTitle = $_POST['projectTitle'];
    $services = $_POST['services'];
    $phase_of_work = $_POST['phase_of_work'];
    $employeeId = $_POST['userId'];
    $employeeName = 'sample';
    $taskTitle = $_POST['taskTitle'];
    $new_task_notes = $_POST['newTask_notes'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $status = '';
    $invite_status = '3';

    $sql = "INSERT INTO `employees_tasks`(`project_id`, `project_name`, `services`, `phase_of_work`, `employee_id`, `employee_name`, `task_title`, `notes`, `date_started`, `due_date`, `status`, `invite_status`) VALUES ('$projectId', '$projectTitle', '$services', '$phase_of_work', '$employeeId', '$employeeName', '$taskTitle', '$new_task_notes', '$dateStart', '$dateEnd', '$status', '$invite_status')";

    $con->query($sql) or die ($con->error);

}


?>