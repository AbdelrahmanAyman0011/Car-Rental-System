<?php
if (isset($_POST["submit"])) {
    
    session_start();
    $customerId = $_SESSION["customerId"];

    $carId = $_POST["carType"];
    $cardNum = $_POST["cardNum"];
    $sDate = $_POST["startDate"];
    $eDate = $_POST["endDate"];
    $price = $_POST["price"];

    $state = false;
    
        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        reserve($con,$customerId,$carId,$sDate,$eDate);
        changeState($con,$carId,$state);
        paymentOperation($con,$sDate,$cardNum,$customerId,$price);



}else{
    header("location:carRegistration.html");
}