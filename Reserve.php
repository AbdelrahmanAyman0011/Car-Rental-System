<?php
if (isset($_POST["submit"])) {
    
    session_start();
    $customerId = $_SESSION["customerId"];

    $carId = $_POST["carType"];
    $sDate = $_POST["startDate"];
    $eDate = $_POST["endDate"];
    $state = false;
        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        reserve($con,$customerId,$carId,$sDate,$eDate);
        changeState($con,$carId,$state);

}else{
    header("location:carRegistration.html");
}