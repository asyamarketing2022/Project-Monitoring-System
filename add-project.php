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

        $design_manager_array = $_POST['design'];
        $design_manager = implode(" ", $design_manager_array);
        
        $sql = "INSERT INTO `pms_projects`(`project_name`, `location`, `lot_areas`, `arch_conceptual_manager`) VALUES ('$projectName', '$location', '$lotAreas', '$design_manager')";

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