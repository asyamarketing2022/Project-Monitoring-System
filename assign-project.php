<?php 

include_once('connections/connection.php');
$con = connection();



if(isset($_POST['tableID'])) {

    $projectID = $_POST['tableID'];

    $projectSQL = "SELECT * FROM projects WHERE ID = $projectID";
    $project = $con->query($projectSQL) or die ($con->error);
    $updateProject = $project->fetch_assoc();

    $_SESSION['Update_projectID'] = $updateProject['id'];

        echo "
                <div class='content-info__wrapper'>
                    <div class='content__info'> 
                        <span>Project ID</span>
                        <input class='input' type='text' name='projectId' id='code formControlDefault' value=" . $updateProject['id'] . " required>
                    </div>
                    <div class='content__info'> 
                        <span>Code</span>
                        <input class='input' type='text' name='code' id='code formControlDefault' value=" . $updateProject['code'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Project Name</span>
                        <input class='input' type='text' name='projectName' id='projectName formControlDefault' value=" . $updateProject['project_name'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Quality Check</span>
                        <select name='update_qualityCheck' id='qualityCheck' aria-label='Default' value=" . $updateProject['quality_check'] . ">
                            <option value='Standard' selected>Standard</option>
                            <option value='Standard'>Standard</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>File Type</span>
                        <select name='update_file_type' id='file_type' aria-label='Default' value=" . $updateProject['file_type'] . ">
                            <option value='Gettext PO' selected>Gettext PO</option>
                            <option value='Gettext PO'>Gettext PO</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>Project Tree Style</span>
                        <select name='update_projectTreeStyle' id='projectTreeStyle' aria-label='Default' value=" . $updateProject['project_tree_style'] . ">
                            <option value='Gettext PO' selected>Gettext PO</option>
                            <option value='Gettext PO'>Gettext PO</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>Ignore Files</span>
                        <input type='text' name='update_ignoreFiles' id='mobile_number formControlDefault' value=" . $updateProject['ignore_files'] . ">
                    </div>
                    <div class='content__info'>
                        <span>String Errors Contact</span>
                        <input type='text' name='update_stringErrorsContact' id='stringErrorsContact formControlDefault' value=" . $updateProject['string_error_contact'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Screenshot Search Prefix</span>
                        <input type='text' name='update_screenSearch' id='address formControlDefault' value=" . $updateProject['screenshot_search_prefix'] .  " required>
                    </div>
                    <div class='content__info d-none'>
                        <span>Status</span>
                        <input type='text' name='status' id='address formControlDefault' value='waiting' required>
                    </div>
                    </div>";}

    if(isset($_POST['submitAssign'])) {

        $projectId = $_POST['projectId'];
        $code = $_POST['code'];
        $projectName = $_POST['projectName'];
        $dateEnd = $_POST['dateEnd'];
        // $employessId = $_POST['employees_id'];
        // $manager = $_POST['manager'];
        $managerId_array = $_POST['managerID'];
        $projectManager_array = $_POST['project_manager'];
        $status = $_POST['status'];

        // $managersId = implode(" ", $managersId_array);
        // $managers = implode(" ", $projectManager_array);

        foreach(array_combine($managerId_array, $projectManager_array) as $managerId => $projectManager) {
            $sql = "INSERT INTO `assign_project` (`project_id`, `project_code`, `project_name`, `date_end`,`manager_id`, `manager`, `status`) VALUES ('$projectId', '$code', '$projectName', '$dateEnd', '$managerId', '$projectManager', '$status')";
            $con->query($sql) or die ($con->error);
        }


        
    }



    //////// This code for Manager page ///////////
    // if(isset($_POST['submitAssign'])) {

    //     $code = $_POST['update_code'];
    //     $projectName = $_POST['update_projectName'];
    //     $dateEnd = $_POST['dateEnd'];
    //     $employessId = $_POST['employees_id'];
    //     $manager = $_POST['manager'];
    //     $projectInvolve = $_POST['project_involve'];
    //     $status = $_POST['status'];

    //     //Convert the array to String ($_POST['pickEmployee'] is an array)
    //     $employees = implode(" ", $projectInvolve);

    //     $sql = "INSERT INTO `assign_project` (`project_code`, `project_name`, `date_end`, `employees_id`, `manager`, `project_involve`, `status`) VALUES ('$code', '$projectName', '$dateEnd', '$employessId', '$manager', '$employees', '$status')";

    //     $con->query($sql) or die ($con->error);
        
    //     }

?>