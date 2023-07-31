<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['taskId'])) {

    echo $_POST['taskId'];

}

if(isset($_POST['taskTitle'])) {

    echo $_POST['taskTitle'];

}

if(isset($_POST['employee-name'])) {

    echo $_POST['employee-name'];

}

if(isset($_POST['userId'])) {

    $userId = $_POST['userId'];
    $phase_of_work = $_POST['phase_of_work'];
    $services = $_POST['services'];
    $projectId = $_POST['projectId'];
    $projectName = $_POST['projectName'];

    $query_employee_tasks = "SELECT * FROM `employees_tasks` WHERE employee_id = '$userId' AND services = '$services' AND phase_of_work = '$phase_of_work' ORDER BY id DESC";
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
                            <td class='taskId d-none' value='". $row['id'] ."'>". $row['id'] ."</td>
                            <td class='taskTitle'>". $row['task_title'] ."</td>
                            <td>". $row['notes'] ."</td>
                            <td>". $row['date_started'] ."</td>
                            <td>". $row['due_date'] ."</td>
                            <td class='pow_status'>
                                <div class='text_status'>
                                    <span>" . $row['status'] . "</span> 
                                </div>
                                <div class='status_tooltip d-none'>
                                    <span class='status orangeStatus'>Working on it</span>
                                    <span class='status redStatus'>Stuck</span>
                                    <span class='status greenStatus'>Done</span>
                                    <input onkeypress='return /[ A-Za-z0-9]/i.test(event.key)' onpaste='return false;' ondrop='return false;' autocomplete='off'>
                                </div>
                            </td>
                            <td class='upload_filepath_td'>
                                <button class='uploadPathBtn'>Upload File Path</button>
                                <div class='upload_filepath_tooltip d-none'>
                                    <div class='upload_filepath_wrapper'>
                                        <span>Upload File Path</span>
                                        <div class='upload_filepath_form'>
                                            <div class='content-info__wrapper'>
                                                <div class='content__info'>
                                                    <span>Notes:</span>
                                                    <textarea class='new-task-notes' name='notes' id='' cols='25' rows='5'></textarea>
                                                </div>
                                                <div class='content__info'>
                                                    <span>File Name:</span>
                                                    <input class='file-name' name='fileName' 'type='text' required=''>
                                                </div>
                                                <div class='content__info'>
                                                    <span>Insert File Path:</span>
                                                    <input class='file-path' name='filePath' type='url' required=''>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Employee Name:</span>
                                                    <span class='employee-name'></span>
                                                </div>
                                                    <div class='content__info d-none'>
                                                    <span>Task Id:</span>
                                                    <span class='task-id'></span>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Task Title:</span>
                                                    <span class='task-title'></span>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Project Id:</span>
                                                    <input class='project-Id' name='projectId' type='hidden' value='$projectId'>
                                                </div>
                                                <div class='content__info d-none'>
                                                <span>Project Name:</span>
                                                    <input class='project-name' name='projectName' type='hidden' value='$projectName'>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Phase of Work:</span>
                                                    <input class='phase-of-work' name='phaseOfwork' type='hidden' value='$phase_of_work'>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Services:</span>
                                                    <input class='services' name='services' type='hidden' value='$services'>
                                                </div>
                                                <div class='button-wrapper'>
                                                    <input class='submit-button submit-file-path' name='' type='submit' value='Submit'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class='check_filepath_td'>
                                <button class='checkfilepathBtn'>Check Files</button>
                                <div class='check_filepath_tooltip d-none'>
                                  <div class='check_filepath_wrapper'>
                                      <span>Check File Path</span>
                                      <div class='content-table'>
         
                                      </div>
                                  </div>
                                </div>
                            </td>
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

if(isset($_POST['userPhoto'])) {

    $fullName = $_POST['fullName'];
    $userPhoto = $_POST['userPhoto'];
    $employeeId = $_POST['employeeId'];
    
    echo "<img src='$userPhoto' alt='' width='200'>
        <h3>$fullName</h3>
        <span class='employeeId d-none' value='$employeeId'><strong>Employee Id:</strong> $employeeId</span>";

}
?>