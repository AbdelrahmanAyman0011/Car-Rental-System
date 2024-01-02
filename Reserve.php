<?php
if (isset($_POST["submit"])) {
    
    session_start();
    $customerId = $_SESSION["customerId"];

    if (($carId = $_POST["carType"])==null){
        header("location:ReserveCustomer.php");
    }
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
        header("location:ReserveCustomer.php");



}else{
    header("location:ReserveCustomer.php");
}