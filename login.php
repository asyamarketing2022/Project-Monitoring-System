<?php 

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if(isset($_POST['login'])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM registered_users WHERE email = '$email' AND password = '$password'";
    $user = $con->query($sql) or die ($con->error);
    $row = $user->fetch_assoc();
    $user_detail = $user->num_rows;

    if($user_detail > 0){

        $_SESSION['UserId'] = $row['ID'];
        $_SESSION['UserLogin'] = $row['first_name'];
        $_SESSION['Userlname'] = $row['last_name'];
        $_SESSION['UserEmail'] = $row['email'];
        $_SESSION['Department'] = $row['department'];
        $_SESSION['Position'] = $row['position'];
        $_SESSION['Access'] = $row['access'];
        
        echo "<p>Login success!</p>";
        header("Location: homepage.php");
 
    }  else {

        echo "<p>email or password is incorrect!</p>";

    }
}

?>