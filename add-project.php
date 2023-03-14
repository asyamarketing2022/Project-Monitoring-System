<?php 

include_once("connections/connection.php");
$con = connection();

    if(isset($_POST['submit'])){

        $code = $_POST['code'];
        $projectName = $_POST['projectName'];
        $qualityCheck = $_POST['qualityCheck'];
        $fileType = $_POST['file_type'];
        $projectStyle = $_POST['projectTreeStyle'];
        $ignoreFile = $_POST['ignoreFiles'];
        $stringContact = $_POST['stringErrorsContact'];
        $screenSearch = $_POST['screenSearch'];
        
        $check = mysqli_query($con, "SELECT * FROM projects WHERE code = '$code'");
        $checkrows = mysqli_num_rows($check);

        if($checkrows > 0){

            echo "Project code was already registered";

        } else {

            $sql = "INSERT INTO `projects`(`code`, `project_name`, `quality_check`, `file_type`, `project_tree_style`, `ignore_files`, `string_error_contact`, `screenshot_search_prefix`) VALUES ('$code', '$projectName', '$qualityCheck', '$fileType', '$projectStyle', '$ignoreFile', '$stringContact', '$screenSearch')";

            $con->query($sql) or die ($con->error);

        }

    }


?>