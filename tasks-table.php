<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['userId'])) {

    $userId = $_POST['userId'];
    $phase_of_work = $_POST['phase_of_work'];
    $services = $_POST['services'];
    $projectId = $_POST['projectId'];
    $projectName = $_POST['projectName'];

    $query_employee_tasks = "SELECT * FROM `employees_tasks` WHERE employee_id = '$userId' AND services = '$services' AND phase_of_work = '$phase_of_work'";
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
                            <td>". $row['task_title'] ."</td>
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
                                                    <textarea name='notes' id='' cols='25' rows='5'></textarea>
                                                </div>
                                                <div class='content__info'>
                                                    <span>File Name:</span>
                                                    <input name='fileName' 'type='text' required=''>
                                                </div>
                                                <div class='content__info'>
                                                    <span>Insert File Path:</span>
                                                    <input name='filePath' type='url' required=''>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Project Id:</span>
                                                    <input name='projectId' type='hidden' value='$projectId'>
                                                </div>
                                                <div class='content__info d-none'>
                                                <span>Project Name:</span>
                                                    <input name='projectName' type='hidden' value='$projectName'>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Phase of Work:</span>
                                                    <input name='phaseOfwork' type='hidden' value='$phase_of_work'>
                                                </div>
                                                <div class='content__info d-none'>
                                                    <span>Services:</span>
                                                    <input name='services' type='hidden' value='$services'>
                                                </div>
                                                <div class='button-wrapper'>
                                                    <input class='submit-button' name='uploadfilepath' type='submit' value='Save'>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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

if(isset($_POST['userPhoto'])) {

    $fullName = $_POST['fullName'];
    $userPhoto = $_POST['userPhoto'];

    echo "<img src='". $userPhoto ."' alt='' width='200'>
        <h3>". $fullName ."</h3>";

}
?>