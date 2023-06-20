<?php include_once('connections/DBconnection.php'); ?>


<?php 

$db = new DBconnection();
$con = $db->connection();



    if(isset($_POST['searchValue'])){

        $searchValue = $_POST['searchValue'];

        $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%$searchValue%' AND access = 'employee'";
        $query_run = mysqli_query($con, $sql);
        
        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $employee_info)
            {

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

            }
        } else {

            echo "No Search Found";

        }

    } 
    
    // else {

    //     $sql = "SELECT * FROM registered_users WHERE access = 'employee'";
    //     $employee = $con->query($sql) or die ($con->error);
    //     $employee_info = $employee->fetch_assoc();

    // }

    if(isset($_POST['userId_container'])){

        $sql = "SELECT * FROM registered_users WHERE access = 'employee'";
        $query_run = mysqli_query($con, $sql);
        // $employee_info = $employee->fetch_assoc();

        $assignedEmployee = $_POST['userId_container'];
        $length = count($assignedEmployee);
        $output = "";
        $num = 0;
        $loop = 0;
      

        if(mysqli_num_rows($query_run) > 0)
        {

            foreach($query_run as $query_employee)
            {

                for ($i = 0; $i < $length; $i++)
                {

                    if($loop != $length){

                        $loop++;
                        
                        if($assignedEmployee[$i] == $query_employee['ID']){

                            $num = 1;
                                
                        } 

                    } else {

                        if($num == 1){

                            $output .= "<div class='user_container' value='" . $query_employee['ID'] . "'>
                                <div class='user_photo'>
                                    <img class='m-0' src='img/userImage/" . $query_employee['user_image'] . "' alt='' width='100'>
                                    <button class='selectBtn'><a href='#'>Select Employee</a></button>
                                </div>
                                    <div class='user_info'>
                                        <div class='user_fullname'>
                                            <label>Name:</label>
                                            <span>" . $query_employee['first_name'] . " " . $query_employee['last_name'] . "</span>
                                        </div>
        
                                        <div class='user_position'>
                                            <label>Position:</label>
                                            <span>" . $query_employee['position'] . "</span>
                                        </div>
        
                                        <div class='user_department'>
                                            <label>Department:</label>
                                            <span>" . $query_employee['department'] . "</span>
                                        </div>
                                    </div>
                                </div>";

                            $num = 0;
                            $loop = 0;

                        } 

                    }
              
                }
                // echo $output;

            }

        }
        

    }


    // $output ."<div class='user_container' value='" . $query_employee['ID'] . "'>
    // <div class='user_photo'>
    //     <img class='m-0' src='img/userImage/" . $query_employee['user_image'] . "' alt='' width='100'>
    //     <button class='selectBtn'><a href='#'>Select Employee</a></button>
    // </div>
    //     <div class='user_info'>
    //         <div class='user_fullname'>
    //             <label>Name:</label>
    //             <span>" . $query_employee['first_name'] . " " . $query_employee['last_name'] . "</span>
    //         </div>

    //         <div class='user_position'>
    //             <label>Position:</label>
    //             <span>" . $query_employee['position'] . "</span>
    //         </div>

    //         <div class='user_department'>
    //             <label>Department:</label>
    //             <span>" . $query_employee['department'] . "</span>
    //         </div>
    //     </div>
    // </div>";

?>