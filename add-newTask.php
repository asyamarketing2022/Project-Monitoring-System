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

    $query_employee_tasks = "SELECT * FROM `employees_tasks` WHERE employee_id = '$employeeId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
    $employee_tasks = $con->query($query_employee_tasks) or die ($con->error);
    $row = $employee_tasks->fetch_assoc();

    $output = '';

    if($employee_tasks->num_rows != 0){

        $output .= "<h3>Tasks</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <th>Task Title</th>
                                    <th>Notes</th>
                                    <th>Date Started</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Upload File Path</th>
                                    <th>File Lists</th>
                                </tr>";

        do {

            $output .= "<tr>
                            <td>". $row['task_title'] ."</td>
                            <td>". $row['notes'] ."</td>
                            <td>". $row['date_started'] ."</td>
                            <td>". $row['due_date'] ."</td>
                            <td class='pow_status'>
                                <div class='text_status'>
                                    <span>" . $row['status'] . "</span> 
                                </div>
                                <div class='status_tooltip' style='display: none'>
                                    <span class='status orangeStatus'>Working On It</span>
                                    <span class='status redStatus'>Stuck</span>
                                    <span class='status greenStatus'>Done</span>
                                    <input onkeypress='return /[ A-Za-z0-9]/i.test(event.key)' onpaste='return false;' ondrop='return false;' autocomplete='off'>
                                </div>
                            </td>
                            <td><button class='uploadPathBtn'>Upload File Path</button></td>
                            <td><button class='viewfilepathBtn'>Check Files</button></td>
                        </tr>";

        } while($row = $employee_tasks->fetch_assoc());

        echo $output;

    } else {

        echo "
        <h3>Tasks</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Task Title</th>
                        <th>Notes</th>
                        <th>Date Started</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Upload File Path</th>
                        <th>File Lists</th>
                    </tr>
                </tbody>
            </table>
       ";

    }

}


?>