<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['deleteText'])){

   $deleteText = $_POST['deleteText'];
   $taskId = $_POST['taskId'];

   $sql = "UPDATE `employees_tasks` SET `invite_status` = '$deleteText' WHERE id = '$taskId'";

   $con->query($sql) or die ($con->error);

}

if(isset($_POST['newText'])){

    $newText = $_POST['newText'];
    $taskId = $_POST['taskId'];
    $taskTitle = $_POST['taskTitle'];
    $taskNotes = $_POST['taskNotes'];
    $dateStart = $_POST['dateStart'];
    $dueDate = $_POST['dueDate'];

    $sql = "UPDATE `employees_tasks` SET `invite_status` = '$newText', `task_title` = '$taskTitle', `notes` = '$taskNotes', `date_started` = '$dateStart', `due_date` = '$dueDate' WHERE id = '$taskId'";

    $con->query($sql) or die ($con->error);

};

?>