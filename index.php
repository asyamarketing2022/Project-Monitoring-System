<?php 

include_once("connections/connection.php");
$con = connection();

   if(isset($_POST['submit'])){

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $mobilenumber = $_POST['mobile_number'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $access = $_POST['access'];

    $check = mysqli_query($con, "SELECT * FROM registered_users WHERE email = '$email'");
    $checkrows = mysqli_num_rows($check);

    if($checkrows > 0){

        echo "Email enter was already registered";

    } else {

        $sql = "INSERT INTO `registered_users`(`first_name`, `last_name`, `date_of_birth`, `address`, `mobile_number`, `gender`, `email`, `password`, `access`) VALUES ('$fname', '$lname', '$birthday', '$address', '$mobilenumber', '$gender', '$email', '$password', '$access')";

        $con->query($sql) or die ($con->error); 

    }

   }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form action="" method="post">

        <label for="firstname">First Name</label>
        <input class="form-control" type="text" name="firstname" id="firstname formControlDefault" required>

        <br>

        <label for="lastname">Last Name</label>
        <input class="form-control"  type="text" name="lastname" id="lastname formControlDefault" required>

        <br>

        <label for="birthday">Birthday</label>
        <input class="form-control"  type="date" name="birthday" id="birthday formControlDefault" required>

        <br>

        <label class="mt-3" for="">Gender</label>
        <select name="gender" id="gender" class="form-select" aria-label="Default select example">
            <option value="Male" selected>Male</option>
            <option value="Female">Female</option>
        </select>

        <br>

        <label class="form-label" for="address">Address</label>
        <input class="form-control" type="text" name="address" id="address formControlDefault" required>

        <br>

        <label class="form-label" for="mobile_number">Mobile Number</label>
        <input class="form-control" type="number" name="mobile_number" id="mobile_number formControlDefault">

        <br>

        <label class="form-label" for="email">Email</label>
        <input class="form-control" type="email" name="email" id="formControlDefault" required>
        
        <br>

        <label class="form-label" for="password">Password</label>
        <input class="form-control" type="password" name="password" id="formControlDefault" required>
        
        <br>

        <label class="mt-3" for="">Access</label>
        <select name="access" id="access" class="form-select" aria-label="Default select example">
            <option value="Subordinate" selected>Subordinate</option>
            <option value="Manager">Manager</option>
            <option value="IT/Admin">IT/Admin</option>
        </select>

        <input type="submit" name="submit" value="Submit Form">
    </form>


</body>
</html>