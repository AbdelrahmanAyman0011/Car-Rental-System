<?php
if (isset($_POST["submit"])) {
    
    session_start();
    $customerId = $_SESSION["customerId"];

    $carId = $_POST["cusCars"];

        require_once 'connection.php';
        require_once 'phpFunctions.php';

        ReturnCar($con,$carId);
        changeState($con,$carId,true);

}else{
    header("location:carRegistration.html");
}