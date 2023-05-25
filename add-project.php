<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");
// include_once("ProjectController.php");

$db = new DBconnection();
$con = $db->connection();

// $con = connection();

    if(isset($_POST['submit_project'])){

        $projectName = $_POST['projectName'];
        $location = $_POST['location'];
        $lotAreas = $_POST['lotAreas'];

        $serviceArch = $_POST['serviceArch'];

        $archConceptual = $_POST['arch_conceptual'];
        $manager_conceptual_array = $_POST['conceptual_design'];
        $manager_conceptual = implode(" ", $manager_conceptual_array);

        $archSchematic = $_POST['arch_schematic'];
        $manager_schematic_array = $_POST['schematic_design'];
        $manager_schematic = implode(" ", $manager_schematic_array);

        $typology = $_POST['typology'];
        $companyName = $_POST['companyName'];
        $clientName = $_POST['clientName'];
        
        $sql = "INSERT INTO `pms_projects`(`project_name`, `location`, `lot_areas`, `service_architecture`, `arch_conceptual`, `arch_conceptual_manager`, `arch_schematic`, `arch_schematic_manager`, `typology`, `company_name`, `client_name`) VALUES ('$projectName', '$location', '$lotAreas', '$serviceArch', '$archConceptual', '$manager_conceptual', '$archSchematic', '$manager_schematic', '$typology', '$companyName', '$clientName')";

        $con->query($sql) or die ($con->error);


    }


    // if(isset($_POST['submit'])){

    //     $code = $_POST['code'];
    //     $projectName = $_POST['projectName'];
    //     $qualityCheck = $_POST['qualityCheck'];
    //     $fileType = $_POST['file_type'];
    //     $projectStyle = $_POST['projectTreeStyle'];
    //     $ignoreFile = $_POST['ignoreFiles'];
    //     $stringContact = $_POST['stringErrorsContact'];
    //     $screenSearch = $_POST['screenSearch'];
        
    //     $check = mysqli_query($con, "SELECT * FROM projects WHERE code = '$code'");
    //     $checkrows = mysqli_num_rows($check);

    //     if($checkrows > 0){

    //         echo "Project code was already registered";

    //     } else {

    //         $sql = "INSERT INTO `projects`(`code`, `project_name`, `quality_check`, `file_type`, `project_tree_style`, `ignore_files`, `string_error_contact`, `screenshot_search_prefix`) VALUES ('$code', '$projectName', '$qualityCheck', '$fileType', '$projectStyle', '$ignoreFile', '$stringContact', '$screenSearch')";

    //         $con->query($sql) or die ($con->error);

    //     }

    // }


//     if(isset($_POST['submit_project']))
// {

//     $design_manager_array = $_POST['design'];
//     $design_manager = implode(" ", $design_manager_array);

//     $inputData = [
//         'projectName' => mysqli_real_escape_string($conn,$_POST['projectName']),
//         'location' => mysqli_real_escape_string($conn,$_POST['location']),
//         'lotAreas' => mysqli_real_escape_string($conn,$_POST['lotAreas']),
//         'arch_conceptual_manager' => mysqli_real_escape_string($conn,$_POST['design']),
//     ];

//     $project = new ProjectController;
//     $result = $project->create($inputData);

//     if($result)
//     {
//         $_SESSION['message'] = "Project Added Successfully";
//         header("Location: project.php");
//         exit(0);
//     }
//     else
//     {
//         $_SESSION['message'] = "Not Inserted";
//         header("Location: project.php");
//         exit(0);
//     }
// }


    

?>