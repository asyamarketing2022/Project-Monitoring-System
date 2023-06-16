<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['employeeId'])) {

    $projectId = $_POST['projectId'];
    $employeeId = $_POST['employeeId'];
    $searchEmployee_pow = $_POST['searchEmployee_pow'];
    $searchEmployee_service = $_POST['searchEmployee_service'];
    $managerId = $_SESSION['UserId'];

    $x = 'arch_conceptual_who_assigned_manager';

    $query_project = "SELECT * FROM `pms_projects` WHERE id = '$projectId'";
    $project = $con->query($query_project) or die ($con->error);


    echo $project["' . arch_conceptual_who_assigned_manager . '"];


    // $sql = "INSERT INTO `pms_projects`(`arch_conceptual_who_assigned_manager`, `arch_conceptual_assigned_employee`) VALUE ('$managerId', '$employeeId ')"

    // $updateSQL = "UPDATE `pms_projects` SET `arch_conceptual_who_assigned_manager` =  '$managerId' WHERE id = '$projectId'";

    // $con->query($sql) or die ($con->error);



}


// if (isset($_GET['tableID'])) {

//     var_dump($_GET['tableID']);


// };


// if(isset($_POST['tableID'])) {

    // echo $_POST['tableID'];
    // print_r($_POST['tableID']);

    // if(isset($_POST['submitPIC'])) {


    //    print_r($users_array);

    // };

        // if(isset($_POST['submitPIC'])) {



        // echo $_POST['tableID'];


        // if(!empty($_POST['tableID'])) {

            // if(isset($_POST['submitPIC'])) {
            //     $users_array = $_POST['users'];
            //     $users = implode(" ", $users_array);
    
            //     $assignId = $_POST['tableID'];
            
            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);
            // };

            // echo $_POST['tableID'];


            // $assignId = $_POST['tableID'];

            // echo $assignId;

            // if(!empty($_POST['tableID'])) {

            //     $_SESSION['x'] = $_POST['tableID'];

            // }

            // if(!empty($_POST['users'])) {
           
            //     // $users_array = $_POST['users'];
            //     // $users = implode(" ", $users_array);
        
            //     // $assignId = $_POST['tableID'];

            //     // echo $assignId;
                
            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);

            //     $users_array = $_POST['users'];
            //     $users = implode(" ", $users_array);

        
            //     echo $users;
            //     echo $_SESSION['x'];
            //     // echo $_POST['tableID'];
            
            //     // echo $assignId;
            //     // echo $_POST['tableID'];
            
            // }

            // if(isset($_POST['submitPIC'])) {

            //     $assignId = $_GET['tableID'];

            //     $users_array = $_GET['users'];
            //     $users = implode(" ", $users_array);


            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);

            // }

            

            // echo $_POST['tableID'];
            // $users_array = $_POST['users'];
            // $users = implode(" ", $users_array);
        
            // echo $users;
        // };
 



            // if(isset($_POST['submitPIC'])) {

            //     $users_array = $_POST['user'];
            //     $users = implode(" ", $users_array);
    
            //     $assignId = $_POST['tableID'];

            //     var_dump($users);
            
            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);
            // };
      

            // if(isset($_POST['tableID'])) {

            //     $_SESSION['id'] = $_POST['tableID'];
                // print_r($_POST['tableID']);
    
                // $users_array = $_POST['user'];
                // $users = implode(" ", $users_array);
        
                // $assignId = $_POST['tableID'];
        
                // $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
                // $con->query($sql) or die ($con->error);

            // };

            // echo $_POST['tableID'];

        // };

    // };
// };


// if(isset($_POST['submitPIC'])) { 

//     $assignId = $_POST['tableID'];

//     $users_array = $_POST['user'];
    
//     $users = implode(" ", $users_array);

//     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
//     $con->query($sql) or die ($con->error);
    
// };


// echo $GLOBALS['assignId'];

// if(isset($_POST['submitPIC'])) { 

//     $assignId = $_POST['tableID'];

//     $users_array = $_POST['user'];
    
//     $users = implode(" ", $users_array);

//     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
//     $con->query($sql) or die ($con->error);
    
// };





// if(isset($_POST['submitPIC']) && ($_POST['tableID'])){

//     echo $_POST['tableID'];

//     // $users_array = $_POST['user'];
    
//     // $users = implode(" ", $users_array);

 

//     // if (isset($_GET['tableID'])) {

//     //     $assignId = $_GET['tableID'];

//     //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = $assignId";
//     //     $con->query($sql) or die ($con->error);

//     // };

// };


    // if(isset($_POST['submitPIC'])) {

    //     $_SESSION['assignId'] = $_POST['tableID'];

    //     $assignId = $_SESSION['assignId'];
    //     $users_array = $_POST['user'];

    //     $users = implode(" ", $users_array);

    //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
    //     $con->query($sql) or die ($con->error);
    // };   


?>