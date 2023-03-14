<?php 

include_once("connections/connection.php");
$con = connection();

   if(isset($_POST['addSubmit'])){

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $mobilenumber = $_POST['mobile_number'];
    $address = $_POST['address'];

    $email = $_POST['email'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $password = $_POST['password'];
    $access = $_POST['access'];

    $check = mysqli_query($con, "SELECT * FROM registered_users WHERE email = '$email'");
    $checkrows = mysqli_num_rows($check);

    if($checkrows > 0){

        echo "Email enter was already registered";

    } else {

        $sql = "INSERT INTO `registered_users`(`first_name`, `last_name`, `gender`, `date_of_birth`, `mobile_number`, `address`, `email`, `department`, `position`, `password`, `access`) VALUES ('$fname', '$lname', '$gender', '$birthday', '$mobilenumber', '$address','$email', '$department', '$position', '$password', '$access')";

        $con->query($sql) or die ($con->error); 

    }

   }

?>


   


