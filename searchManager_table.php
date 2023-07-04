<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('SearchManagerController.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();


    if(isset($_POST['searchValue']) && !empty($_POST['userId_container']) || isset($_POST['searchValue']) && empty($_POST['userId_container'])){

        $phase_of_work = $_POST['phase_of_work'];
        $service = $_POST['service'];

        $searchValue = $_POST['searchValue'];
        $userId_container = (!empty($_POST['userId_container']) ? $_POST['userId_container'] : "");

        if($service == 'Architecture') {

            if($phase_of_work == 'Conceptual'){

                $ArchConceptual = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchConceptual->searchManager();

            } elseif($phase_of_work == 'Schematic') {

                $ArchSchematic = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchSchematic->searchManager();
 
    
            } elseif($phase_of_work == 'Design Development') {

                $ArchDesignDevelopment = new SearchManagerController('production', $searchValue, $userId_container);
                $ArchDesignDevelopment->searchManager();
 
            } elseif($phase_of_work == 'Construction Drawing') {

                $ArchConstruction = new SearchManagerController('project management', $searchValue, $userId_container);
                $ArchConstruction->searchManager();
 
            }

        }

    } elseif(!empty($_POST['userId_container']) || empty($_POST['userId_container'])){

        $phase_of_work = $_POST['phase_of_work'];
        $service = $_POST['service'];

        $searchValue = !empty($_POST['searchValue']) ? $_POST['searchValue'] : "";
        $userId_container = (!empty($_POST['userId_container']) ? $_POST['userId_container'] : "");

        if($service == 'Architecture') {

            if($phase_of_work == 'Conceptual'){
                

                $ArchConceptual = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchConceptual->searchManager();

            } elseif($phase_of_work == 'Schematic') {

                $ArchSchematic = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchSchematic->searchManager();
 
    
            } elseif($phase_of_work == 'Design Development') {

                $ArchDesignDevelopment = new SearchManagerController('production', $searchValue, $userId_container);
                $ArchDesignDevelopment->searchManager();
 
            } elseif($phase_of_work == 'Construction Drawing') {

                $ArchConstruction = new SearchManagerController('project management', $searchValue, $userId_container);
                $ArchConstruction->searchManager();
 
            }

        }

    }
        
        

?>