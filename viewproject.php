<?php $page = 'project'; include 'header.php'; ?>

<?php include_once("connections/DBconnection.php"); ?>
<?php include_once("phase-of-work_status.php"); ?>
<?php include_once("sidebar.php"); ?>
<?php include_once("upload_file_path.php"); ?>
<?/*php include_once("searchEmployee_table.php"); */?>


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

            // $conceptualManagers = (explode(" ", $row['arch_conceptual_manager']));
            // $managerCount = count($conceptualManagers);

            $ArchConceptualManagers = (explode(" ", $row['arch_conceptual_manager']));
            $ArchConceptualManagerCount = count($ArchConceptualManagers);

                for ($i = 0; $i < $ArchConceptualManagerCount; $i++) {

                    $ArchConceptualManager = $ArchConceptualManagers[$i];

                    $query_users = "SELECT * FROM registered_users WHERE ID = '$ArchConceptualManager'";
                    $ArchConceptualManager_run = $con->query($query_users) or die ($con->error);
                    $ArchConceptualManagerInfo = $ArchConceptualManager_run->fetch_assoc();

                    $arch_ConceptualManagersImage_array[] = $ArchConceptualManagerInfo['user_image'];
                    $arch_conceptualmanagersID_array[] = $ArchConceptualManagerInfo['ID'];

                }

                if(!empty($row['arch_conceptual_assigned_employee'])) {

                    $ArchConceptualAssignedEmployees = explode(" ", $row['arch_conceptual_assigned_employee']);
                    $ArchConceptualEmployeesCount = (empty($ArchConceptualAssignedEmployees) ? "" : count($ArchConceptualAssignedEmployees));

                            for($num = 0; $num < $ArchConceptualEmployeesCount; $num++) {
            
                                $ArchConceptualAssignedEmployeesId = $ArchConceptualAssignedEmployees[$num];
            
                                $query_employee = "SELECT * FROM registered_users WHERE ID = '$ArchConceptualAssignedEmployeesId'";
                                $ArchConceptualAssignedEmployees_run = $con->query($query_employee) or die ($con->error);
                                $ArchConceptualAssignedEmployeesInfo = $ArchConceptualAssignedEmployees_run->fetch_assoc();
            
                                $arch_ConceptualAssignedEmployeeImage_array[] = $ArchConceptualAssignedEmployeesInfo['user_image'];
                                $arch_ConceptualAssignedEmployeeId_array[] = $ArchConceptualAssignedEmployeesInfo['ID'];
            
                            }
    
                    } else {
    
                        $arch_ConceptualAssignedEmployeeImage_array = [];
                        $arch_ConceptualAssignedEmployeeId_array = [];
    
                    }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Conceptual</td>
                    <td><?php echo $ArchConceptualManagerInfo['department']; ?></td>
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

                $ArchSchematicManagers = (explode(" ", $row['arch_schematic_manager']));
                $ArchSchematicManagerCount = count($ArchSchematicManagers);

                    if(!empty($ArchSchematicManagers)) {

                        for ($i = 0; $i < $ArchSchematicManagerCount; $i++) {

                        $ArchSchematicManager = $ArchSchematicManagers[$i];

                            $query_users = "SELECT * FROM registered_users WHERE ID = '$ArchSchematicManager'";
                            $ArchSchematicManager_run = $con->query($query_users) or die ($con->error);
                            $ArchSchematicManagerInfo = $ArchSchematicManager_run->fetch_assoc();
        
                            $arch_SchematicManagersImage_array[] = $ArchSchematicManagerInfo['user_image'];
                            $arch_SchematicmanagersID_array[] = $ArchSchematicManagerInfo['ID'];

                        }

                    } else {

                        $arch_SchematicManagersImage_array = [];
                        $arch_SchematicmanagersID_array = [];

                    }

                if(!empty($row['arch_schematic_assigned_employee'])) {

                $ArchSchematicAssignedEmployees = explode(" ", $row['arch_schematic_assigned_employee']);
                $ArchSchematicEmployeesCount = (empty($ArchSchematicAssignedEmployees) ? "" : count($ArchSchematicAssignedEmployees));
        
                        for($num = 0; $num < $ArchSchematicEmployeesCount; $num++) {
        
                            $ArchSchematicAssignedEmployeesId = $ArchSchematicAssignedEmployees[$num];
        
                            $query_employee = "SELECT * FROM registered_users WHERE ID = '$ArchSchematicAssignedEmployeesId '";
                            $ArchSchematicAssignedEmployees_run = $con->query($query_employee) or die ($con->error);
                            $ArchSchematicAssignedEmployeesInfo = $ArchSchematicAssignedEmployees_run->fetch_assoc();
        
                            $arch_SchematicAssignedEmployeeImage_array[] = $ArchSchematicAssignedEmployeesInfo['user_image'];
                            $arch_SchematicAssignedEmployeeId_array[] = $ArchSchematicAssignedEmployeesInfo['ID'];
        
                        }

                } else {

                    $arch_SchematicAssignedEmployeeImage_array = [];
                    $arch_SchematicAssignedEmployeeId_array = [];

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Schematic</td>
                    <td><?php echo $ArchSchematicManagerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_SchematicmanagersID_array as $arch_SchematicmanagersID)echo "$arch_SchematicmanagersID ";?>">
                    <?php foreach($arch_SchematicManagersImage_array as $arch_SchematicManagersImage)
                   
                    echo "<img src='/img/userImage/" . $arch_SchematicManagersImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

                    <td class="who_assigned_manager d-none" value="<?php echo $row['arch_schematic_who_assigned_manager']; ?>"></td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge" value="<?php foreach($arch_SchematicAssignedEmployeeId_array as $arch_SchematicAssignedEmployeeId) echo "$arch_SchematicAssignedEmployeeId ";?>">

                    <?php foreach($arch_SchematicAssignedEmployeeImage_array as $arch_SchematicAssignedEmployeeImage)
                
                                echo "<img src='/img/userImage/" . $arch_SchematicAssignedEmployeeImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

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

                $ArchDesigndevelopmentManagers = (explode(" ", $row['arch_designdevelopment_manager']));
                $ArchDesigndevelopmentManagerCount = count($ArchDesigndevelopmentManagers);

                    if(!empty($ArchDesigndevelopmentManagers)) {

                        for ($i = 0; $i < $ArchDesigndevelopmentManagerCount; $i++) {

                        $ArchDesigndevelopmentManager = $ArchDesigndevelopmentManagers[$i];

                            $query_users = "SELECT * FROM registered_users WHERE ID = '$ArchDesigndevelopmentManager'";
                            $ArchDesigndevelopmentManager_run = $con->query($query_users) or die ($con->error);
                            $ArchDesigndevelopmentManagerInfo = $ArchDesigndevelopmentManager_run->fetch_assoc();
        
                            $arch_DesigndevelopmentManagersImage_array[] = $ArchDesigndevelopmentManagerInfo['user_image'];
                            $arch_DesigndevelopmentmanagersID_array[] = $ArchDesigndevelopmentManagerInfo['ID'];

                        }

                    } else {

                        $arch_DesigndevelopmentManagersImage_array = [];
                        $arch_DesigndevelopmentmanagersID_array = [];

                    }
                    
                if(!empty($row['arch_designdevelopment_assigned_employee'])) {

                    $ArchDesigndevelopmentAssignedEmployees = explode(" ", $row['arch_designdevelopment_assigned_employee']);
                    $ArchDesigndevelopmentEmployeesCount = (empty($ArchDesigndevelopmentAssignedEmployees) ? "" : count($ArchDesigndevelopmentAssignedEmployees));
            
                            for($num = 0; $num < $ArchDesigndevelopmentEmployeesCount; $num++) {
            
                                $ArchDesigndevelopmentAssignedEmployeesId = $ArchDesigndevelopmentAssignedEmployees[$num];
            
                                $query_employee = "SELECT * FROM registered_users WHERE ID = '$ArchDesigndevelopmentAssignedEmployeesId '";
                                $ArchDesigndevelopmentAssignedEmployees_run = $con->query($query_employee) or die ($con->error);
                                $ArchDesigndevelopmentAssignedEmployeesInfo = $ArchDesigndevelopmentAssignedEmployees_run->fetch_assoc();
            
                                $arch_DesigndevelopmentAssignedEmployeeImage_array[] = $ArchDesigndevelopmentAssignedEmployeesInfo['user_image'];
                                $arch_DesigndevelopmentAssignedEmployeeId_array[] = $ArchDesigndevelopmentAssignedEmployeesInfo['ID'];
            
                            }
    
                    } else {
    
                        $arch_DesigndevelopmentAssignedEmployeeImage_array = [];
                        $arch_DesigndevelopmentAssignedEmployeeId_array = [];
    
                    }


            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Design Development</td>
                    <td><?php echo $ArchDesigndevelopmentManagerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_DesigndevelopmentmanagersID_array as $arch_DesigndevelopmentmanagersID)echo "$arch_DesigndevelopmentmanagersID ";?>">
                    <?php foreach($arch_DesigndevelopmentManagersImage_array as $arch_DesigndevelopmentManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_DesigndevelopmentManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

                    <td class="who_assigned_manager d-none" value="<?php echo $row['arch_designdevelopment_who_assigned_manager']; ?>"></td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge" value="<?php foreach($arch_DesigndevelopmentAssignedEmployeeId_array as $arch_DesigndevelopmentAssignedEmployeeId) echo "$arch_DesigndevelopmentAssignedEmployeeId ";?>">

                    <?php foreach($arch_DesigndevelopmentAssignedEmployeeImage_array as $arch_DesigndevelopmentAssignedEmployeeImage)
                
                                echo "<img src='/img/userImage/" . $arch_DesigndevelopmentAssignedEmployeeImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

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

                $ArchConstructionManagers = (explode(" ", $row['arch_construction_manager']));
                $ArchDesigndevelopmentManagerCount = count($ArchConstructionManagers);

                    if(!empty($ArchConstructionManagers)) {

                        for ($i = 0; $i < $ArchDesigndevelopmentManagerCount; $i++) {

                        $ArchConstructionManager = $ArchConstructionManagers[$i];

                            $query_users = "SELECT * FROM registered_users WHERE ID = '$ArchConstructionManager'";
                            $ArchConstructionManager_run = $con->query($query_users) or die ($con->error);
                            $ArchConstructionManagerInfo = $ArchConstructionManager_run->fetch_assoc();
        
                            $arch_ConstructionManagersImage_array[] = $ArchConstructionManagerInfo['user_image'];
                            $arch_ConstructionManagersID_array[] = $ArchConstructionManagerInfo['ID'];

                        }

                    } else {

                        $arch_ConstructionManagersImage_array = [];
                        $arch_ConstructionManagersID_array= [];

                    }
            
                    if(!empty($row['arch_construction_assigned_employee'])) {

                        $ArchConstructionAssignedEmployees = explode(" ", $row['arch_construction_assigned_employee']);
                        $ArchConstructionEmployeesCount = (empty($ArchConstructionAssignedEmployees) ? "" : count($ArchConstructionAssignedEmployees));
                
                                for($num = 0; $num < $ArchConstructionEmployeesCount; $num++) {
                
                                    $ArchConstructionAssignedEmployeesId = $ArchConstructionAssignedEmployees[$num];
                
                                    $query_employee = "SELECT * FROM registered_users WHERE ID = '$ArchConstructionAssignedEmployeesId'";
                                    $ArchConstructionAssignedEmployees_run = $con->query($query_employee) or die ($con->error);
                                    $ArchConstructionAssignedEmployeesInfo = $ArchConstructionAssignedEmployees_run->fetch_assoc();
                
                                    $arch_ConstructionAssignedEmployeeImage_array[] = $ArchConstructionAssignedEmployeesInfo['user_image'];
                                    $arch_ConstructionAssignedEmployeeId_array[] = $ArchConstructionAssignedEmployeesInfo['ID'];
                
                                }
        
                        } else {
        
                            $arch_ConstructionAssignedEmployeeImage_array = [];
                            $arch_ConstructionAssignedEmployeeId_array = [];
        
                        }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Construction Drawings</td>
                    <td><?php echo $ArchConstructionManagerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_ConstructionManagersID_array as $arch_ConstructionManagersID)echo "$arch_ConstructionManagersID ";?>">
                    <?php foreach($arch_ConstructionManagersImage_array as $arch_ConstructionManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_ConstructionManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

                    <td class="who_assigned_manager d-none" value="<?php echo $row['arch_construction_who_assigned_manager']; ?>"></td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge" value="<?php foreach($arch_ConstructionAssignedEmployeeId_array as $arch_ConstructionAssignedEmployeeId) echo "$arch_ConstructionAssignedEmployeeId ";?>">

                    <?php foreach($arch_ConstructionAssignedEmployeeImage_array as $arch_ConstructionAssignedEmployeeImage)
                
                        echo "<img src='/img/userImage/" . $arch_ConstructionAssignedEmployeeImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

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

                $ArchSiteManagers = (explode(" ", $row['arch_site_manager']));
                $ArchSiteManagerCount = count($ArchSiteManagers);

                    if(!empty($ArchSiteManagers)) {

                        for ($i = 0; $i < $ArchSiteManagerCount; $i++) {

                        $ArchSiteManager = $ArchSiteManagers[$i];

                            $query_users = "SELECT * FROM registered_users WHERE ID = '$ArchSiteManager'";
                            $ArchSiteManager_run = $con->query($query_users) or die ($con->error);
                            $ArchSiteManagerInfo = $ArchSiteManager_run->fetch_assoc();
        
                            $arch_SiteManagersImage_array[] = $ArchSiteManagerInfo['user_image'];
                            $arch_SiteManagersID_array[] = $ArchSiteManagerInfo['ID'];

                        }

                    } else {

                        $arch_SiteManagersImage_array = [];
                        $arch_SiteManagersImage_array = [];

                    }

                    if(!empty($row['arch_site_assigned_employee'])) {

                        $ArchSiteAssignedEmployees = explode(" ", $row['arch_site_assigned_employee']);
                        $ArchSiteEmployeesCount = (empty($ArchSiteAssignedEmployees) ? "" : count($ArchSiteAssignedEmployees));
                
                                for($num = 0; $num < $ArchSiteEmployeesCount; $num++) {
                
                                    $ArchSiteAssignedEmployeesId = $ArchSiteAssignedEmployees[$num];
                
                                    $query_employee = "SELECT * FROM registered_users WHERE ID = '$ArchSiteAssignedEmployeesId'";
                                    $ArchSiteAssignedEmployees_run = $con->query($query_employee) or die ($con->error);
                                    $ArchSiteAssignedEmployeesInfo = $ArchSiteAssignedEmployees_run->fetch_assoc();
                
                                    $arch_SiteAssignedEmployeeImage_array[] = $ArchSiteAssignedEmployeesInfo['user_image'];
                                    $arch_SiteAssignedEmployeeId_array[] = $ArchSiteAssignedEmployeesInfo['ID'];
                
                                }
        
                        } else {
        
                            $arch_SiteAssignedEmployeeImage_array = [];
                            $arch_SiteAssignedEmployeeId_array = [];
        
                        }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td class="td_phase_of_work">Site Supervision</td>
                    <td><?php echo $ArchSiteManagerInfo['department']; ?></td>
                    <td class="manager_photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($arch_SiteManagersID_array as $arch_SiteManagersID)echo "$arch_SiteManagersID ";?>">
                    <?php foreach($arch_SiteManagersImage_array as $arch_SiteManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_SiteManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

                    <td class="who_assigned_manager d-none" value="<?php echo $row['arch_site_who_assigned_manager']; ?>"></td>
                    <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge" value="<?php foreach($arch_SiteAssignedEmployeeId_array as $arch_SiteAssignedEmployeeId) echo "$arch_SiteAssignedEmployeeId ";?>">

                    <?php foreach($arch_SiteAssignedEmployeeImage_array as $arch_SiteAssignedEmployeeImage)
                
                        echo "<img src='/img/userImage/" . $arch_SiteAssignedEmployeeImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>

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

                    $IntConceptualManagers = (explode(" ", $row['arch_construction_manager']));
                    $ArchConceptualManagerCount = count($IntConceptualManagers);
    
                        if(!empty($IntConceptualManagers)) {
    
                            for ($i = 0; $i < $ArchConceptualManagerCount; $i++) {
    
                                $IntConceptualManager = $IntConceptualManagers[$i];
    
                                $query_users = "SELECT * FROM registered_users WHERE ID = '$IntConceptualManager'";
                                $IntConceptualManager_run = $con->query($query_users) or die ($con->error);
                                $IntConceptualManagerInfo = $IntConceptualManager_run->fetch_assoc();
            
                                $Int_ConceptualManagersImage_array[] = $IntConceptualManagerInfo['user_image'];
                                $Int_ConceptualManagersID_array[] = $IntConceptualManagerInfo['ID'];
    
                            }
    
                        } else {
    
                            $Int_ConceptualManagersImage_array = [];
                            $Int_ConceptualManagersID_array = [];
    
                        }

                        if(!empty($row['int_conceptual_assigned_employee'])) {

                            $IntConceptualAssignedEmployees = explode(" ", $row['int_conceptual_assigned_employee']);
                            $IntConceptualEmployeesCount = (empty($IntConceptualAssignedEmployees) ? "" : count($IntConceptualAssignedEmployees));
                    
                                    for($num = 0; $num < $IntConceptualEmployeesCount; $num++) {
                    
                                        $IntConceptualAssignedEmployeesId = $IntConceptualAssignedEmployees[$num];
                    
                                        $query_employee = "SELECT * FROM registered_users WHERE ID = '$ArchSiteAssignedEmployeesId'";
                                        $IntConceptualAssignedEmployees_run = $con->query($query_employee) or die ($con->error);
                                        $IntConceptualAssignedEmployeesInfo = $IntConceptualAssignedEmployees_run->fetch_assoc();
                    
                                        $int_ConceptualAssignedEmployeeImage_array[] = $IntConceptualAssignedEmployeesInfo['user_image'];
                                        $int_ConceptualAssignedEmployeeId_array[] = $IntConceptualAssignedEmployeesInfo['ID'];
                    
                                    }
            
                            } else {
            
                                $int_ConceptualAssignedEmployeeImage_array = [];
                                $int_ConceptualAssignedEmployeeId_array = [];
            
                            }

                ?>

                    <tr class="table-row_projects table-form" value="">
                        <td class="td_phase_of_work">Conceptual</td>
                        <td><?php echo $IntConceptualManagerInfo['department']; ?></td>
                        <td>

                        <?php foreach($Int_ConceptualManagersImage_array as $int_ConceptualManagerImage)
                    
                        echo "<img src='/img/userImage/" . $int_ConceptualManagerImage . "' alt='' class='table_image_small'>";

                        ?> 

                        </td>


                        <td class="who_assigned_manager d-none" value="<?php echo $row['arch_site_who_assigned_manager']; ?>"></td>
                        <td class="projectIncharge_table_row" data-toggle="modal" data-target="#view_project_in_charge" value="<?php foreach($int_ConceptualAssignedEmployeeId_array as $int_ConceptualAssignedEmployeeId) echo "$int_ConceptualAssignedEmployeeId ";?>">

                        <?php foreach($int_ConceptualAssignedEmployeeImage_array as $int_ConceptualAssignedEmployeeImage)
                    
                            echo "<img src='/img/userImage/" . $int_ConceptualAssignedEmployeeImage . "' alt='' class='table_image_small'>";

                        ?> 
                        </td>
                        
                        <td class="pow_status" value="int_conceptual_status">
                            <div class='text_status'><span><?php echo $row['int_conceptual_status'] ?></span></div>
                            <div class="status_tooltip d-none">
                                <span class="orangeStatus">Working on it</span>
                                <span class="redStatus">Stuck</span>
                                <span class="greenStatus">Done</span>
                                <input type="text" pattern="[A-Za-z]{3}">
                            </div>
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
                                
                                    // do {

                                    //     echo "<div class='user_container' value='" . $employee_info['ID'] . "'>
                                    //                 <div class='user_photo'>
                                    //                     <img class='m-0' src='img/userImage/" . $employee_info['user_image'] . "' alt='' width='100'>
                                    //                     <button class='selectBtn'><a href='#'>Select Employee</a></button>
                                    //                 </div>
                                    //                 <div class='user_info'>
                                    //                     <div class='user_fullname'>
                                    //                         <label>Name:</label>
                                    //                         <span>" . $employee_info['first_name'] . " " . $employee_info['last_name'] . "</span>
                                    //                     </div>
                                            
                                    //                     <div class='user_position'>
                                    //                         <label>Position:</label>
                                    //                         <span>" . $employee_info['position'] . "</span>
                                    //                     </div>
                
                                    //                     <div class='user_department'>
                                    //                         <label>Department:</label>
                                    //                         <span>" . $employee_info['department'] . "</span>
                                    //                     </div>
                                    //                 </div>
                                    //             </div>";

                                    // } while($employee_info = $employee->fetch_assoc());
                            
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