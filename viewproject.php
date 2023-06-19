<?php $page = 'project'; include 'header.php'; ?>

<?php include_once("connections/DBconnection.php"); ?>
<?php include_once("phase-of-work_status.php"); ?>
<?php include_once("sidebar.php"); ?>
<?php include_once("upload_file_path.php"); ?>
<?php include_once("searchEmployee_table.php"); ?>


<?php 

//Get Project ID 
$projectID = $_GET['ID'];

//Database connection
$db = new DBconnection();
$con = $db->connection();

$query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
$project = $con->query($query_projects) or die ($con->error);
$row = $project->fetch_assoc();

// $archConceptualStatus = str_replace(' ', '', $row['arch_conceptual_status']);
// $archConceptualStatus = ltrim($row['arch_conceptual_status'], " ");

?>

<div class="grid-right__content">
    <div class="project-title mt-4">
         <h1 class="float-start" id="projectTitle" value='<?php echo $projectID ?>'><?php echo $row['project_name'] ?></h1>
         <div class="float-end info-icon" data-toggle="modal" data-target="#projectInfo"><img src="img/info-icon.png" alt="" width="30"></div>
    </div>

    <!-- Architecture table  -->
    <?php if($row['service_architecture'] == 1) { ?>

    <div class="content-table project_services_table">
        <table>
            <tr>
                <th class="th_services">Architecture</th>
                <th>Department</th>
                <th>Manager</th>
                <th>Project In Charge</th>
                <th>Status</th>
                <th>Date Receive</th>
                <th>Due Date</th>
                <th>File Upload</th>
                <th>File Lists</th>
            </tr>

            <?php 
            
            // Architecture Conceptual Phase Of Work
            if($row['arch_conceptual'] == 1) {  

            $conceptualManagers = (explode(" ", $row['arch_conceptual_manager']));
            $managerCount = count($conceptualManagers);

                for ($i = 0; $i < $managerCount; $i++) {

                    $managerID = $conceptualManagers[$i];

                    $query_users = "SELECT * FROM registered_users WHERE ID = '$managerID'";
                    $manager = $con->query($query_users) or die ($con->error);
                    $managerInfo = $manager->fetch_assoc();

                    $arch_ConceptualManagersImage_array[] = $managerInfo['user_image'];
                    $arch_conceptualmanagersID_array[] = $managerInfo['ID'];
    

                }

            $assignedEmployees = (explode(" ", $row['arch_conceptual_assigned_employee']));
            $employeesCount = count($assignedEmployees);

                for($num = 0; $num < $employeesCount; $num++) {

                    $assignedEmployeeId = $assignedEmployees[$num];

                    $query_employee = "SELECT * FROM registered_users WHERE ID = '$assignedEmployeeId'";
                    $assignedEmployee = $con->query($query_employee) or die ($con->error);
                    $assignedEmployeeInfo = $assignedEmployee->fetch_assoc();

                    $arch_ConceptualAssignedEmployeeImage_array[] = $assignedEmployeeInfo['user_image'];
                    $arch_ConceptualAssignedEmployeeId_array[] = $assignedEmployeeInfo['ID'];

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Conceptual</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_conceptualmanagersID_array as $arch_conceptualmanagersID)echo "$arch_conceptualmanagersID ";?>">
                    <?php foreach($arch_ConceptualManagersImage_array as $arch_ConceptualManagersImage)
                   
                    echo "<img src='/img/userImage/" . $arch_ConceptualManagersImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td class="who_assigned_manager d-none" value="<?php echo $row['arch_conceptual_who_assigned_manager']; ?>"></td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge" value="<?php foreach($arch_ConceptualAssignedEmployeeId_array as $arch_ConceptualAssignedEmployeeId)echo "$arch_ConceptualAssignedEmployeeId ";?>">
                    <?php foreach($arch_ConceptualAssignedEmployeeImage_array as $arch_ConceptualAssignedEmployeeImage)
                   
                    echo "<img src='/img/userImage/" . $arch_ConceptualAssignedEmployeeImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td class="pow_status" value="arch_conceptual_status">
                        <div class='text_status'><span><?php echo $row['arch_conceptual_status'] ?></span></div>
                        <div class="status_tooltip d-none">
                            <span class="status orangeStatus">Working on it</span>
                            <span class="status redStatus">Stuck</span>
                            <span class="status greenStatus">Done</span>
                           <input type="text" onkeypress="return /[ A-Za-z0-9]/i.test(event.key)" onpaste="return false;" ondrop="return false;" autocomplete="off" >
                            
                        </div>
                    </td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button class="uploadPathBtn" data-toggle="modal" data-target="#uploadPath">Upload File Path</button></td>
                    <td><button class="viewfilepathBtn" data-toggle="modal" data-target="#viewfilepath">Check Files</button></td>
                 </tr>

            <?php } ?>


            <?php 
            
            // Architecture Schematic Phase Of Work
            if($row['arch_schematic'] == 1) {  

            $schematicManagers = (explode(" ", $row['arch_schematic_manager']));
            $managerCount = count($schematicManagers);

                for ($i = 0; $i < $managerCount; $i++) {

                    $managerID = $schematicManagers[$i];

                    $query_users = "SELECT * FROM registered_users WHERE ID = '$managerID'";
                    $manager = $con->query($query_users) or die ($con->error);
                    $managerInfo = $manager->fetch_assoc();

                    $arch_SchematicManagersImage_array[] = $managerInfo['user_image'];
                    $arch_SchematicmanagersID_array[] = $managerInfo['ID'];
                  

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Schematic</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_SchematicmanagersID_array as $arch_SchematicmanagersID)echo "$arch_SchematicmanagersID ";?>">
                    <?php foreach($arch_SchematicManagersImage_array as $arch_SchematicManagersImage)
                   
                    echo "<img src='/img/userImage/" . $arch_SchematicManagersImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge">Project In Charge</td>
                    <td class="pow_status" value="arch_schematic_status">
                        <div class='text_status'><span><?php echo $row['arch_schematic_status'] ?></span></div>
                        <div class="status_tooltip d-none">
                            <span class="orangeStatus">Working on it</span>
                            <span class="redStatus">Stuck</span>
                            <span class="greenStatus">Done</span>
                            <input type="text" pattern="[A-Za-z]{3}">
                        </div>
                    </td>
                    </td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button class="uploadPathBtn" data-toggle="modal" data-target="#uploadPath">Upload File Path</button></td>
                    <td><button class="viewfilepathBtn" data-toggle="modal" data-target="#viewfilepath">Check Files</button></td>
                 </tr>

            <?php } ?>


            <?php 
            
            // Architecture Design Development Phase Of Work
            if($row['arch_designdevelopment'] == 1) {  

            $designdevelopmentManagers = (explode(" ", $row['arch_designdevelopment_manager']));
            $managerCount = count($designdevelopmentManagers);

                for ($i = 0; $i < $managerCount; $i++) {

                    $managerID = $designdevelopmentManagers[$i];

                    $query_users = "SELECT * FROM registered_users WHERE ID = '$managerID'";
                    $manager = $con->query($query_users) or die ($con->error);
                    $managerInfo = $manager->fetch_assoc();

                    $arch_DesigndevelopmentManagersImage_array[] = $managerInfo['user_image'];
                    $arch_DesigndevelopmentManagersID_array[] = $managerInfo['ID'];

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Design Development</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_DesigndevelopmentManagersID_array as $arch_DesigndevelopmentManagersID)echo "$arch_DesigndevelopmentManagersID ";?>">
                    <?php foreach($arch_DesigndevelopmentManagersImage_array as $arch_DesigndevelopmentManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_DesigndevelopmentManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge">Project In Charge</td>
                    <td class="pow_status" value="arch_designdevelopment_status">
                        <div class='text_status'><span><?php echo $row['arch_designdevelopment_status'] ?></span></div>
                        <div class="status_tooltip d-none">
                            <span class="orangeStatus">Working on it</span>
                            <span class="redStatus">Stuck</span>
                            <span class="greenStatus">Done</span>
                            <input type="text" pattern="[A-Za-z]{3}">
                        </div>
                    </td>
                    </td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button class="uploadPathBtn" data-toggle="modal" data-target="#uploadPath">Upload File Path</button></td>
                    <td><button class="viewfilepathBtn" data-toggle="modal" data-target="#viewfilepath">Check Files</button></td>
                 </tr>

            <?php } ?>


            <?php 
            
            // Architecture Construction Phase Of Work
            if($row['arch_construction'] == 1) {  

            $constructionManagers = (explode(" ", $row['arch_construction_manager']));
            $managerCount = count($constructionManagers);

                for ($i = 0; $i < $managerCount; $i++) {

                    $managerID = $constructionManagers[$i];

                    $query_users = "SELECT * FROM registered_users WHERE ID = '$managerID'";
                    $manager = $con->query($query_users) or die ($con->error);
                    $managerInfo = $manager->fetch_assoc();

                    $arch_ConstructionManagersImage_array[] = $managerInfo['user_image'];
                    $arch_ConstructionManagersID_array[] = $managerInfo['ID'];

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Construction Drawings</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_ConstructionManagersID_array as $arch_ConstructionManagersID)echo "$arch_ConstructionManagersID ";?>">
                    <?php foreach($arch_ConstructionManagersImage_array as $arch_ConstructionManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_ConstructionManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge">Project In Charge</td>
                    <td class="pow_status" value="arch_construction_status">
                        <div class='text_status'><span><?php echo $row['arch_construction_status'] ?></span></div>
                        <div class="status_tooltip d-none">
                            <span class="orangeStatus">Working on it</span>
                            <span class="redStatus">Stuck</span>
                            <span class="greenStatus">Done</span>
                            <input type="text" pattern="[A-Za-z]{3}">
                        </div>
                    </td>
                    </td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button class="uploadPathBtn" data-toggle="modal" data-target="#uploadPath">Upload File Path</button></td>
                    <td><button class="viewfilepathBtn" data-toggle="modal" data-target="#viewfilepath">Check Files</button></td>
                 </tr>

            <?php } ?>


            <?php 
            
            // Architecture Site Supervision Phase Of Work
            if($row['arch_site'] == 1) {  

            $siteManagers = (explode(" ", $row['arch_site_manager']));
            $managerCount = count($siteManagers);

                for ($i = 0; $i < $managerCount; $i++) {

                    $managerID = $siteManagers[$i];

                    $query_users = "SELECT * FROM registered_users WHERE ID = '$managerID'";
                    $manager = $con->query($query_users) or die ($con->error);
                    $managerInfo = $manager->fetch_assoc();

                    $arch_SiteManagersImage_array[] = $managerInfo['user_image'];
                    $arch_SiteManagersID_array[] = $managerInfo['ID'];

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td>Site Supervision</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_SiteManagersID_array as $arch_SiteManagersID)echo "$arch_SiteManagersID ";?>">
                    <?php foreach($arch_SiteManagersImage_array as $arch_SiteManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_SiteManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge">Project In Charge</td>
                    <td class="pow_status" value="arch_site_status">
                        <div class='text_status'><span><?php echo $row['arch_site_status'] ?></span></div>
                        <div class="status_tooltip d-none">
                            <span class="orangeStatus">Working on it</span>
                            <span class="redStatus">Stuck</span>
                            <span class="greenStatus">Done</span>
                            <input type="text" pattern="[A-Za-z]{3}">
                        </div>
                    </td>
                    </td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button class="uploadPathBtn" data-toggle="modal" data-target="#uploadPath">Upload File Path</button></td>
                    <td><button class="viewfilepathBtn" data-toggle="modal" data-target="#viewfilepath">Check Files</button></td>
                 </tr>

            <?php } ?>
            
        </table>
    </div>

    <?php } ?>


    <!-- Interior table  -->
    <?php if($row['service_interior'] == 1) { ?>

        <div class="content-table project_services_table">
            <table>
                <tr>
                    <th class="th_services">Interior</th>
                    <th>Department</th>
                    <th>Manager</th>
                    <th>Project In Charge</th>
                    <th>Status</th>
                    <th>Date Receive</th>
                    <th>Due Date</th>
                    <th>File Upload</th>
                    <th>File Lists</th>
                </tr>

                <?php 
                
                if($row['int_conceptual'] == 1) {  

                $conceptualManagers = (explode(" ", $row['int_conceptual_manager']));
                $managerCount = count($conceptualManagers);

                    for ($i = 0; $i < $managerCount; $i++) {

                        $managerID = $conceptualManagers[$i];

                        $query_users = "SELECT * FROM registered_users WHERE ID = '$managerID'";
                        $manager = $con->query($query_users) or die ($con->error);
                        $managerInfo = $manager->fetch_assoc();

                        $Int_ConceptualManagersImage_array[] = $managerInfo['user_image'];

                    }

                ?>

                    <tr class="table-row_projects table-form" value="">
                        <td class="td_phase_of_work">Conceptual</td>
                        <td><?php echo $managerInfo['department']; ?></td>
                        <td>
                        <?php foreach($Int_ConceptualManagersImage_array as $Int_ConceptualManagerImage)
                    
                        echo "<img src='/img/userImage/" . $Int_ConceptualManagerImage . "' alt='' class='table_image_small'>";

                        ?> 
                        </td>
                        <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge">Project In Charge</td>
                        <td><?php echo $row['arch_conceptual_status'] ?></td>
                        <td><?php echo $row['added_at'] ?></td>
                        <td></td>
                        <td><button class="uploadPathBtn" data-toggle="modal" data-target="#uploadPath">Upload File Path</button></td>
                        <td><button class="viewfilepathBtn" data-toggle="modal" data-target="#viewfilepath">Check Files</button></td>
                    </tr>

                <?php } ?>
            </table>
        </div>

    <?php } ?>

</div>

<!-- View My Managers - Modal -->
<div class="modal fade pop-up__modal" id="view_managers" tabindex="-1" role="dialog" aria-labelledby="viewManagers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Managers</span>
            <div class="managers_container">
                    <!-- postUsersManager_in_modal.php -->

            </div>
        </div>
    </div>
</div>

<!-- View My Project In Charge - Modal -->
<div class="modal fade pop-up__modal" id="view_project_in_charge" tabindex="-1" role="dialog" aria-labelledby="viewPIC" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content" style="height: 500px; overflow-y: auto;">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Project In Charge</span>
            <div class="project_in_charge_container">
                <!-- postUsersProjectInCharge_in_modal.php -->

            </div>
            <img class="addProjectInChargeBtn" data-toggle="modal" data-target="#addProjectInCharge" src="img/add-icon.png" alt="" width="50">

        </div>
    </div>
</div>

<!-- View Project Info - Modal -->
<div class="modal fade pop-up__modal" id="projectInfo" tabindex="-1" role="dialog" aria-labelledby="viewProjectInfo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Project Info</span>
            <div class="projectInfo_container">
                <!-- postProjectInfo_in_modal.php -->

            </div>
        </div>
    </div>
</div>

<!-- Upload file path - Modal -->
<div class="modal fade pop-up__modal" id="uploadPath" tabindex="-1" role="dialog" aria-labelledby="uploadPath" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Upload File Path</span>
            <div class="uploadFilePath_container">
                <!-- postUpload_file_path_modal.php -->

            </div>
        </div>
    </div>
</div>

<!-- View file path - Modal -->
<div class="modal fade pop-up__modal" id="viewfilepath" tabindex="-1" role="dialog" aria-labelledby="viewfilepath" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">View File Paths</span>
            <div class="viewFilePath_container">
                <!-- view-Filepath_in_modal.php -->

            </div>
        </div>
    </div>
</div>

<!-- Add Project In Charge - Modal -->
<div class="modal fade pop-up__modal" id="addProjectInCharge" tabindex="-1" role="dialog" aria-labelledby="addProjectInCharge" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="max-width: 750px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Add Project In Charge</span>
            <div class="_container">
                <!-- view-Filepath_in_modal.php -->
                <div class="search-employee_container content-info__wrapper tab-position_right">
                    <div class="content__info">
                        <span>Search Employee:</span>
                        <div class="search_wrapper" style="max-width: 500px;">
                            <input class="searchFilter w-100" name="search" value="" type="text" placeholder="Employee Lastname">
                            <!-- <button type="submit" class="search-button submitFilter">Search</button> -->
                            <div class="search_employee_wrapper">

                                <!-- searchEmployee_table.php -->

                                <?php 
                                
                                    do {

                                        echo "<div class='user_container' value='" . $employee_info['ID'] . "'>
                                                    <div class='user_photo'>
                                                        <img class='m-0' src='img/userImage/" . $employee_info['user_image'] . "' alt='' width='100'>
                                                        <button class='selectBtn'><a href='#'>Select Employee</a></button>
                                                    </div>
                                                    <div class='user_info'>
                                                        <div class='user_fullname'>
                                                            <label>Name:</label>
                                                            <span>" . $employee_info['first_name'] . " " . $employee_info['last_name'] . "</span>
                                                        </div>
                                            
                                                        <div class='user_position'>
                                                            <label>Position:</label>
                                                            <span>" . $employee_info['position'] . "</span>
                                                        </div>
                
                                                        <div class='user_department'>
                                                            <label>Department:</label>
                                                            <span>" . $employee_info['department'] . "</span>
                                                        </div>
                                                    </div>
                                                </div>";

                                    } while($employee_info = $employee->fetch_assoc());
                            
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>