<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])) {

    $projectId = $_POST['projectId'];
    $employeeId = $_POST['employeeId'];
    $searchEmployee_pow = $_POST['searchEmployee_pow'];
    $searchEmployee_service = $_POST['searchEmployee_service'];
    $managerId = $_SESSION['UserId'];

    $query_project = "SELECT * FROM `pms_projects` WHERE id = '$projectId'";
    $project = $con->query($query_project) or die ($con->error);
    $project_info = $project->fetch_assoc();

    $employeesAssigned = "";
    $whoAssignedManager = "";

    if($searchEmployee_service == 'Architecture') {

        if($searchEmployee_pow == 'Conceptual') {

            $archConceptualAssignedEmployee = $project_info['arch_conceptual_assigned_employee'];
            $container_assignedEmployee = array("$archConceptualAssignedEmployee", "$employeeId");
            $employeesAssigned = implode($container_assignedEmployee, " ");

            $archConceptualWhoAssignedManager = $project_info['arch_conceptual_who_assigned_manager'];
            $container_whoAssignedManager = array("$archConceptualWhoAssignedManager", "$managerId");
            $whoAssignedManager = implode($container_whoAssignedManager, " ");

            $updateSQL = "UPDATE `pms_projects` SET `arch_conceptual_assigned_employee` = '$employeesAssigned', `arch_conceptual_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";

            $con->query($updateSQL) or die ($con->error);

        } elseif($searchEmployee_pow == 'Schematic') {

            if(!empty($project_info['arch_schematic_assigned_employee'])){

                $archSchamaticAssignedEmployee = $project_info['arch_schematic_assigned_employee'];
                $container_assignedEmployee = array("$archSchamaticAssignedEmployee", "$employeeId");
                $employeesAssigned = implode(" ", $container_assignedEmployee);
    
                $archSchamaticWhoAssignedManager = $project_info['arch_schematic_who_assigned_manager'];
                $container_whoAssignedManager = array("$archSchamaticWhoAssignedManager", "$managerId");
                $whoAssignedManager = implode(" ", $container_whoAssignedManager);
    
                $updateSQL = "UPDATE `pms_projects` SET `arch_schematic_assigned_employee` = '$employeesAssigned', `arch_schematic_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `arch_schematic_assigned_employee` = '$employeeId', `arch_schematic_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);


            }


        }

    }


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