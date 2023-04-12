<?php 
if(!isset($_SESSION)){
    session_start();
}


include_once("connections/connection.php");
$con = connection();

include_once("user-record.php");

// User Record Action Login
userRecord('logout');

unset($_SESSION['UserLogin']);
echo header("Location: index.php");


?>