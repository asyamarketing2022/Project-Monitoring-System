<?php $page = 'project'; include 'header.php'; ?>

<?php include("connections/DBconnection.php"); ?>
<?php include("sidebar.php"); ?>


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
         <h1 class="float-start"><?php echo $row['project_name'] ?></h1>
         <p class="float-end">image info</p>
    </div>

    <?php if($row['service_architecture'] == 1) { ?>

    <div class="content-table">
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
            
            if($row['arch_conceptual'] == 1) {  

            $conceptualManagers = (explode(" ", $row['arch_conceptual_manager']));
            $managerCount = count($conceptualManagers);

                for ($i = 0; $i < $managerCount; $i++) {

                    $managerID = $conceptualManagers[$i];

                }

            $query_users = "SELECT * FROM users_record WHERE ID = '$managerID'";
            $manager = $con->query($query_users) or die ($con->error);
            $managerInfo = $manager->fetch_assoc();

            echo $managerInfo['address'];

            ?>

                <tr class="table-row_projects table-form" value="">
                    <td>Conceptual</td>
                    <td>Sample Location</td>
                    <td>Sample Lot Area</td>
                    <td>Sample Typology</td>
                    <td>Sample Company Name</td>
                    <td>Sample Client Name</td>
                    <td>Sample Client Name</td>
                    <td>Sample Client Name</td>
                    <td>Sample Client Name</td>
                 </tr>

            <?php } ?>
        </table>
    </div>

    <?php } ?>

</div>

<?php include 'footer.php'; ?>