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

            if(!empty($project_info['arch_conceptual_assigned_employee'])) {

                $archConceptualAssignedEmployee = $project_info['arch_conceptual_assigned_employee'];
                $container_assignedEmployee = array("$archConceptualAssignedEmployee", "$employeeId");
                $employeesAssigned = implode($container_assignedEmployee, " ");
    
                $archConceptualWhoAssignedManager = $project_info['arch_conceptual_who_assigned_manager'];
                $container_whoAssignedManager = array("$archConceptualWhoAssignedManager", "$managerId");
                $whoAssignedManager = implode($container_whoAssignedManager, " ");
    
                $updateSQL = "UPDATE `pms_projects` SET `arch_conceptual_assigned_employee` = '$employeesAssigned', `arch_conceptual_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `arch_conceptual_assigned_employee` = '$employeeId', `arch_conceptual_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

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


        } elseif($searchEmployee_pow == 'Design Development') {

            if(!empty($project_info['arch_designdevelopment_assigned_employee'])){

                $archDesigndevelopmentAssignedEmployee = $project_info['arch_designdevelopment_assigned_employee'];
                $container_assignedEmployee = array("$archDesigndevelopmentAssignedEmployee", "$employeeId");
                $employeesAssigned = implode(" ", $container_assignedEmployee);
    
                $archDesigndevelopmentWhoAssignedManager = $project_info['arch_designdevelopment_who_assigned_manager'];
                $container_whoAssignedManager = array("$archDesigndevelopmentWhoAssignedManager", "$managerId");
                $whoAssignedManager = implode(" ", $container_whoAssignedManager);
    
                $updateSQL = "UPDATE `pms_projects` SET `arch_designdevelopment_assigned_employee` = '$employeesAssigned', `arch_designdevelopment_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `arch_designdevelopment_assigned_employee` = '$employeeId', `arch_designdevelopment_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }
            

        } elseif($searchEmployee_pow == 'Construction Drawings') {

            if(!empty($project_info['arch_construction_assigned_employee'])){

                $archConstruction_AssignedEmployee = $project_info['arch_construction_assigned_employee'];
                $container_assignedEmployee = array("$archConstruction_AssignedEmployee", "$employeeId");
                $employeesAssigned = implode(" ", $container_assignedEmployee);
    
                $archConstructionWhoAssignedManager = $project_info['arch_construction_who_assigned_manager'];
                $container_whoAssignedManager = array("$archConstructionWhoAssignedManager", "$managerId");
                $whoAssignedManager = implode(" ", $container_whoAssignedManager);
    
                $updateSQL = "UPDATE `pms_projects` SET `arch_construction_assigned_employee` = '$employeesAssigned', `arch_construction_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `arch_construction_assigned_employee` = '$employeeId', `arch_construction_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }
            
        } elseif($searchEmployee_pow == 'Site Supervision') {

            if(!empty($project_info['arch_site_assigned_employee'])){

                $archSite_AssignedEmployee = $project_info['arch_site_assigned_employee'];
                $container_assignedEmployee = array("$archSite_AssignedEmployee", "$employeeId");
                $employeesAssigned = implode(" ", $container_assignedEmployee);
    
                $archSiteWhoAssignedManager = $project_info['arch_site_who_assigned_manager'];
                $container_whoAssignedManager = array("$archSiteWhoAssignedManager", "$managerId");
                $whoAssignedManager = implode(" ", $container_whoAssignedManager);
    
                $updateSQL = "UPDATE `pms_projects` SET `arch_site_assigned_employee` = '$employeesAssigned', `arch_site_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `arch_site_assigned_employee` = '$employeeId', `arch_site_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

        }

    }elseif($searchEmployee_service == 'Interior') {

        if($searchEmployee_pow == 'Conceptual') {

            if(!empty($project_info['int_conceptual_assigned_employee'])) {

                $assignedEmployee = $project_info['int_conceptual_assigned_employee'];
                $container_assignedEmployee = array("$assignedEmployee", "$employeeId");
                $employeesAssigned = implode($container_assignedEmployee, " ");
    
                $who_assigned_manager = $project_info['int_conceptual_who_assigned_manager'];
                $container_whoAssignedManager = array("$who_assigned_manager", "$managerId");
                $whoAssignedManager = implode($container_whoAssignedManager, " ");
    
                $updateSQL = "UPDATE `pms_projects` SET `int_conceptual_assigned_employee` = '$employeesAssigned', `int_conceptual_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `int_conceptual_assigned_employee` = '$employeeId', `int_conceptual_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

        } elseif($searchEmployee_pow == 'Design Development') {

            if(!empty($project_info['int_designdevelopment_assigned_employee'])) {

                $assignedEmployee = $project_info['int_designdevelopment_assigned_employee'];
                $container_assignedEmployee = array("$assignedEmployee", "$employeeId");
                $employeesAssigned = implode($container_assignedEmployee, " ");
    
                $who_assigned_manager = $project_info['int_designdevelopment_who_assigned_manager'];
                $container_whoAssignedManager = array("$who_assigned_manager", "$managerId");
                $whoAssignedManager = implode($container_whoAssignedManager, " ");
    
                $updateSQL = "UPDATE `pms_projects` SET `int_designdevelopment_assigned_employee` = '$employeesAssigned', `int_designdevelopment_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `int_designdevelopment_assigned_employee` = '$employeeId', `int_designdevelopment_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

        } elseif($searchEmployee_pow == 'Construction Drawing') {

            if(!empty($project_info['int_construction_assigned_employee'])) {

                $assignedEmployee = $project_info['int_construction_assigned_employee'];
                $container_assignedEmployee = array("$assignedEmployee", "$employeeId");
                $employeesAssigned = implode($container_assignedEmployee, " ");
    
                $who_assigned_manager = $project_info['int_construction_who_assigned_manager'];
                $container_whoAssignedManager = array("$who_assigned_manager", "$managerId");
                $whoAssignedManager = implode($container_whoAssignedManager, " ");
    
                $updateSQL = "UPDATE `pms_projects` SET `int_construction_assigned_employee` = '$employeesAssigned', `int_construction_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `int_construction_assigned_employee` = '$employeeId', `int_construction_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

        } elseif($searchEmployee_pow == 'Site Supervision'){

            if(!empty($project_info['int_site_assigned_employee'])) {

                $assignedEmployee = $project_info['int_site_assigned_employee'];
                $container_assignedEmployee = array("$assignedEmployee", "$employeeId");
                $employeesAssigned = implode($container_assignedEmployee, " ");
    
                $who_assigned_manager = $project_info['int_site_who_assigned_manager'];
                $container_whoAssignedManager = array("$who_assigned_manager", "$managerId");
                $whoAssignedManager = implode($container_whoAssignedManager, " ");
    
                $updateSQL = "UPDATE `pms_projects` SET `int_site_assigned_employee` = '$employeesAssigned', `int_site_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `int_site_assigned_employee` = '$employeeId', `int_site_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

        }

    } elseif($searchEmployee_service == 'Master Planning') {

        if($searchEmployee_pow == 'Conceptual') {

            if(!empty($project_info['masterplanning_conceptual_assigned_employee'])) {

                $assignedEmployee = $project_info['masterplanning_conceptual_assigned_employee'];
                $container_assignedEmployee = array("$assignedEmployee", "$employeeId");
                $employeesAssigned = implode($container_assignedEmployee, " ");
    
                $who_assigned_manager = $project_info['masterplanning_conceptual_who_assigned_manager'];
                $container_whoAssignedManager = array("$who_assigned_manager", "$managerId");
                $whoAssignedManager = implode($container_whoAssignedManager, " ");
    
                $updateSQL = "UPDATE `pms_projects` SET `masterplanning_conceptual_assigned_employee` = '$employeesAssigned', `masterplanning_conceptual_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `masterplanning_conceptual_assigned_employee` = '$employeeId', `masterplanning_conceptual_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

        } elseif($searchEmployee_pow == 'Schematic') {

            if(!empty($project_info['masterplanning_schematic_assigned_employee'])) {

                $assignedEmployee = $project_info['masterplanning_schematic_assigned_employee'];
                $container_assignedEmployee = array("$assignedEmployee", "$employeeId");
                $employeesAssigned = implode($container_assignedEmployee, " ");
    
                $who_assigned_manager = $project_info['masterplanning_schematic_who_assigned_manager'];
                $container_whoAssignedManager = array("$who_assigned_manager", "$managerId");
                $whoAssignedManager = implode($container_whoAssignedManager, " ");
    
                $updateSQL = "UPDATE `pms_projects` SET `masterplanning_schematic_assigned_employee` = '$employeesAssigned', `masterplanning_schematic_who_assigned_manager` = '$whoAssignedManager' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            } else {

                $updateSQL = "UPDATE `pms_projects` SET `masterplanning_schematic_assigned_employee` = '$employeeId', `masterplanning_schematic_who_assigned_manager` = '$managerId' WHERE id = '$projectId'";
    
                $con->query($updateSQL) or die ($con->error);

            }

        }

    }


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