<?php $page = 'project'; include 'header.php'; ?>

<?php include_once("connections/DBconnection.php"); ?>
<?php include_once("phase-of-work_status.php"); ?>
<?php include_once("sidebar.php"); ?>
<?php include_once("upload_file_path.php"); ?>
<?php include_once("ViewProjectController.php"); ?>
<?php include_once("SearchManagerController.php"); ?>

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

                $archConceptual = new ViewProjectController('arch_conceptual', 'arch_conceptual_manager', 'arch_conceptual_assigned_employee', 'Conceptual', 'arch_conceptual_who_assigned_manager', 'arch_conceptual_status', 'arch_conceptual_duedate');
                $archConceptual->view_phase_of_work_status();

             } ?> 
         

            <?php 
            
            // Architecture Schematic Phase Of Work
            if($row['arch_schematic'] == 1) {  

                $archSchematic = new ViewProjectController('arch_schematic', 'arch_schematic_manager', 'arch_schematic_assigned_employee', 'Schematic', 'arch_schematic_who_assigned_manager', 'arch_schematic_status', 'arch_schematic_duedate');
                $archSchematic->view_phase_of_work_status();

             } ?>


            <?php 
            
            // Architecture Design Development Phase Of Work
            if($row['arch_designdevelopment'] == 1) {  

                $archDesignDevelopment = new ViewProjectController('arch_designdevelopment', 'arch_designdevelopment_manager', 'arch_designdevelopment_assigned_employee', 'Design Development', 'arch_designdevelopment_who_assigned_manager', 'arch_designdevelopment_status', 'arch_designdevelopment_duedate');
                $archDesignDevelopment->view_phase_of_work_status();

            } ?>


            <?php 
            
            // Architecture Construction Phase Of Work
            if($row['arch_construction'] == 1) {  

                $archConstructionDrawing = new ViewProjectController('arch_construction', 'arch_construction_manager', 'arch_construction_assigned_employee', 'Construction Drawing', 'arch_construction_who_assigned_manager', 'arch_construction_status', 'arch_construction_duedate');
                $archConstructionDrawing->view_phase_of_work_status();

            } ?>


            <?php 
            
            // Architecture Site Supervision Phase Of Work
            if($row['arch_site'] == 1) {  

                $archSite = new ViewProjectController('arch_site', 'arch_site_manager', 'arch_site_assigned_employee', 'Site Supervision', 'arch_site_who_assigned_manager', 'arch_site_status', 'arch_site_duedate');
                $archSite->view_phase_of_work_status();

             } ?>
            
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
                
                // Interior Conceptual Phase of Work
                if($row['int_conceptual'] == 1) {  

                    $intConceptual = new ViewProjectController('int_conceptual', 'int_conceptual_manager', 'int_conceptual_assigned_employee', 'Conceptual', 'int_conceptual_who_assigned_manager', 'int_conceptual_status', 'int_conceptual_duedate');
                    $intConceptual->view_phase_of_work_status();

                } ?>


                <?php  
                
                // Interior Design Development Phase of Work
                if($row['int_designdevelopment'] == 1) {  
                
                    $intDesignDevelopment = new ViewProjectController('int_designdevelopment', 'int_designdevelopment_manager', 'int_designdevelopment_assigned_employee', 'Design Development', 'int_designdevelopment_who_assigned_manager', 'int_designdevelopment_status', 'int_designdevelopment_duedate');
                    $intDesignDevelopment->view_phase_of_work_status();
                
                } ?>

                <?php 
                
                 // Interior Construction Development Phase of Work
                 if($row['int_construction'] == 1) {  

                    $intConstruction = new ViewProjectController('int_construction', 'int_construction_manager', 'int_construction_assigned_employee', 'Construction Drawing', 'int_construction_who_assigned_manager', 'int_construction_status', 'int_construction_duedate');
                    $intConstruction->view_phase_of_work_status();
                
                } ?>

                <?php 
                
                // Interior Site Supervision Phase of Work
                if($row['int_site'] == 1) {  

                    $intSite = new ViewProjectController('int_site', 'int_site_manager', 'int_site_assigned_employee', 'Site Supervision', 'int_site_who_assigned_manager', 'int_site_status', 'int_site_duedate');
                    $intSite->view_phase_of_work_status();
                
                } ?>

            </table>
        </div>

    <?php } ?>


    <!-- Master Planning table  -->
    <?php if($row['service_masterplanning'] == 1) { ?>

        <div class="content-table project_services_table">
            <table>
                <tr>
                    <th class="th_services">Master Planning</th>
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
                
                // Master Planning Conceptual Phase of Work
                if($row['masterplanning_conceptual'] == 1) {  

                    $masterplanningConceptual = new ViewProjectController('masterplanning_conceptual', 'masterplanning_conceptual_manager', 'masterplanning_conceptual_assigned_employee', 'Conceptual', 'masterplanning_conceptual_who_assigned_manager', 'masterplanning_conceptual_status', 'masterplanning_conceptual_duedate');
                    $masterplanningConceptual->view_phase_of_work_status();

                } ?>


                <?php 
                
                // Master Planning Schematic Phase of Work
                if($row['masterplanning_schematic'] == 1) {  

                    $masterplanningSchematic = new ViewProjectController('masterplanning_schematic', 'masterplanning_schematic_manager', 'masterplanning_schematic_assigned_employee', 'Schematic', 'masterplanning_schematic_who_assigned_manager', 'masterplanning_schematic_status', 'masterplanning_schematic_duedate');
                    $masterplanningSchematic->view_phase_of_work_status();

                } ?>

            </table>
        </div>

    <?php } ?>

</div>

<!-- View My Managers - Modal -->
<div class="modal fade pop-up__modal" id="view_managers" tabindex="-1" role="dialog" aria-labelledby="viewManagers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content" style="height: 500px; overflow-y: auto;">
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
            <img class="addManagerBtn" data-toggle="modal" data-target="#addManager" src="img/add-icon.png" alt="" width="50">

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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Manager - Modal -->
<div class="modal fade pop-up__modal" id="addManager" tabindex="-1" role="dialog" aria-labelledby="addManager" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="max-width: 750px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Add Manager</span>
            <div class="_container">
                <!-- view-Filepath_in_modal.php -->
                <div class="search-manager_container content-info__wrapper tab-position_right">
                    <div class="content__info">
                        <span>Search Manager:</span>
                        <div class="search_wrapper" style="max-width: 500px;">
                            <input class="searchManager w-100" name="search" value="" type="text" placeholder="Manager Lastname">
                            <!-- <button type="submit" class="search-button submitFilter">Search</button> -->
                            <div class="search_manager_wrapper">

                                <!-- searchEmployee_table.php -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>