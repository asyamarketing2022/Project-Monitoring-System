<?php 

include_once('connections/connection.php');
$con = connection();
session_start();

 if(isset($_POST['tableID'])) {

    $projectID = $_POST['tableID'];

    $projectSQL = "SELECT * FROM projects WHERE ID = $projectID";
    $project = $con->query($projectSQL) or die ($con->error);
    $myProject = $project->fetch_assoc();

    echo "<div class='content-info__wrapper'>
        <div class='content__info'> 
            <span>Code</span>
            <input class='input' type='text' name='update_code' id='code formControlDefault' value=" . $myProject['code'] . " required>
        </div>
        <div class='content__info'>
            <span>Project Name</span>
            <input class='input' type='text' name='update_projectName' id='projectName formControlDefault' value=" . $myProject['project_name'] . " required>
        </div>
        <div class='content__info'>
            <span>Quality Check</span>
            <select name='update_qualityCheck' id='qualityCheck' aria-label='Default' value=" . $myProject['quality_check'] . ">
                <option value='Standard' selected>Standard</option>
                <option value='Standard'>Standard</option>
            </select>
        </div>
        <div class='content__info'>
            <span>File Type</span>
            <select name='update_file_type' id='file_type' aria-label='Default' value=" . $myProject['file_type'] . ">
                <option value='Gettext PO' selected>Gettext PO</option>
                <option value='Gettext PO'>Gettext PO</option>
            </select>
        </div>
        <div class='content__info'>
            <span>Project Tree Style</span>
            <select name='update_projectTreeStyle' id='projectTreeStyle' aria-label='Default' value=" . $myProject['project_tree_style'] . ">
                <option value='Gettext PO' selected>Gettext PO</option>
                <option value='Gettext PO'>Gettext PO</option>
            </select>
        </div>
        <div class='content__info'>
            <span>Ignore Files</span>
            <input type='text' name='update_ignoreFiles' id='mobile_number formControlDefault' value=" . $myProject['ignore_files'] . ">
        </div>
        <div class='content__info'>
            <span>String Errors Contact</span>
            <input type='text' name='update_stringErrorsContact' id='stringErrorsContact formControlDefault' value=" . $myProject['string_error_contact'] . " required>
        </div>
        <div class='content__info'>
            <span>Screenshot Search Prefix</span>
            <input type='text' name='update_screenSearch' id='address formControlDefault' value=" . $myProject['screenshot_search_prefix'] .  " required>
        </div>
        <div class='content__info d-none'>
            <span>Status</span>
            <input type='text' name='status' id='address formControlDefault' value='waiting' required>
        </div>
    </div>";}

?>