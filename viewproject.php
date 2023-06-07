<?php $page = 'project'; include 'header.php'; ?>

<?php include_once("connections/DBconnection.php"); ?>
<?php include_once("phase-of-work_status.php"); ?>
<?php include_once("sidebar.php"); ?>


<?php 

//Get Project ID 
$projectID = $_GET['ID'];

//Database connection
$db = new DBconnection();
$con = $db->connection();

$query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
$project = $con->query($query_projects) or die ($con->error);
$row = $project->fetch_assoc();

?>

<div class="grid-right__content">
    <div class="project-title mt-4">
         <h1 class="float-start" id="projectTitle" value='<?php echo $projectID ?>'><?php echo $row['project_name'] ?></h1>
         <p class="float-end">image info</p>
    </div>

    <!-- Architecture table  -->
    <?php if($row['service_architecture'] == 1) { ?>

    <div class="content-table project_services_table">
        <table>
            <tr>
                <th>Architecture</th>
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

                    $managersImage_array[] = $managerInfo['user_image'];
                    $managersID_array[] = $managerInfo['ID'];

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td>Conceptual</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td class="photo_id" data-toggle="modal" data-target="#view_managers" value="<?php foreach($managersID_array as $managersID)echo "$managersID ";?>">
                    <?php foreach($managersImage_array as $managerImage)
                   
                    echo "<img src='/img/userImage/" . $managerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td>Sample Typology</td>
                    <td class="pow_status" value="arch_conceptual_status">
                        <span class='text_status'><?php echo $row['arch_conceptual_status'] ?></span>
                        <div class="status_tooltip d-none">
                            <span class="orangeStatus">Working on it</span>
                            <span class="redStatus">Stuck</span>
                            <span clas="greenStatus">Done</span>
                           <input type="text">
                            
                        </div>
                    </td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button>Choose File</button></td>
                    <td><button>Check Files</button></td>
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

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td>Schematic</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td>
                    <?php foreach($arch_SchematicManagersImage_array as $arch_SchematicManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_SchematicManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td>Sample Typology</td>
                    <td class="pow_status">
                        <?php echo $row['arch_conceptual_status'] ?>
                        <div class="status_tooltip d-none">
                            <span class="orangeStatus">Working on it</span>
                            <span class="redStatus">Stuck</span>
                            <span clas="greenStatus">Done</span>
                            <input type="text">
                        </div>
                    </td>
                    </td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button>Choose File</button></td>
                    <td><button>Check Files</button></td>
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

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td>Design Development</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td>
                    <?php foreach($arch_DesigndevelopmentManagersImage_array as $arch_DesigndevelopmentManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_DesigndevelopmentManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td>Sample Typology</td>
                    <td><?php echo $row['arch_conceptual_status'] ?></td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button>Choose File</button></td>
                    <td><button>Check Files</button></td>
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

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td>Construction Drawings</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td>
                    <?php foreach($arch_ConstructionManagersImage_array as $arch_ConstructionManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_ConstructionManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td>Sample Typology</td>
                    <td><?php echo $row['arch_conceptual_status'] ?></td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button>Choose File</button></td>
                    <td><button>Check Files</button></td>
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

                }

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td>Site Supervision</td>
                    <td><?php echo $managerInfo['department']; ?></td>
                    <td>
                    <?php foreach($arch_SiteManagersImage_array as $arch_SiteManagerImage)
                   
                    echo "<img src='/img/userImage/" . $arch_SiteManagerImage . "' alt='' class='table_image_small'>";

                    ?> 
                    </td>
                    <td>Sample Typology</td>
                    <td><?php echo $row['arch_conceptual_status'] ?></td>
                    <td><?php echo $row['added_at'] ?></td>
                    <td></td>
                    <td><button>Choose File</button></td>
                    <td><button>Check Files</button></td>
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
                    <th>Interior</th>
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
                        <td>Conceptual</td>
                        <td><?php echo $managerInfo['department']; ?></td>
                        <td>
                        <?php foreach($Int_ConceptualManagersImage_array as $Int_ConceptualManagerImage)
                    
                        echo "<img src='/img/userImage/" . $Int_ConceptualManagerImage . "' alt='' class='table_image_small'>";

                        ?> 
                        </td>
                        <td>Sample Typology</td>
                        <td><?php echo $row['arch_conceptual_status'] ?></td>
                        <td><?php echo $row['added_at'] ?></td>
                        <td></td>
                        <td><button>Choose File</button></td>
                        <td><button>Check Files</button></td>
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
            <div class="viewManagers_container">

            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>