<?php 

include_once('connections/connection.php');
$con = connection();
session_start();

 if(isset($_POST['tableID'])) {

    $projectID = $_POST['tableID'];

    $projectSQL = "SELECT * FROM projects WHERE ID = $projectID";
    $project = $con->query($projectSQL) or die ($con->error);
    $myProject = $project->fetch_assoc();

    echo "
            <div class='content-info__wrapper'>
                <div class='content__info'> 
                    <span>Code</span>
                    <p class='input' type='text' name='update_code' id='code formControlDefault'>" . $myProject['code'] . "</p>
                </div>
                <div class='content__info'>
                    <span>Project Name</span>
                    <p class='input' type='text' name='update_projectName' id='projectName formControlDefault'>" . $myProject['project_name'] . "</p>
                </div>
                <div class='content__info'>
                    <span>Quality Check</span>
                    <p name='update_qualityCheck' id='qualityCheck' aria-label='Default'>" . $myProject['quality_check'] . "</p>
                </div>
                <div class='content__info'>
                    <span>File Type</span>
                    <p name='update_file_type' id='file_type' aria-label='Default'>" . $myProject['file_type'] . "</p>
                </div>
                <div class='content__info'>
                    <span>Project Tree Style</span>
                    <p name='update_projectTreeStyle' id='projectTreeStyle' aria-label='Default'>" . $myProject['project_tree_style'] . "</p>
                </div>
                <div class='content__info'>
                    <span>Ignore Files</span>
                    <p type='text' name='update_ignoreFiles' id='mobile_number formControlDefault'>" . $myProject['ignore_files'] . "</p>
                </div>
                <div class='content__info'>
                    <span>String Errors Contact</span>
                    <p type='text' name='update_stringErrorsContact' id='stringErrorsContact formControlDefault'>" . $myProject['string_error_contact'] . "</p>
                </div>
                <div class='content__info'>
                    <span>Screenshot Search Prefix</span>
                    <p type='text' name='update_screenSearch' id='address formControlDefault'>" . $myProject['screenshot_search_prefix'] .  "</p>
                </div>
            </div>";}

?>