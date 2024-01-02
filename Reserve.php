<?php
if (isset($_POST["submit"])) {
    
    session_start();
    $customerId = $_SESSION["customerId"];

    if (($_POST["officeLoc"])==null){
        header("location:ReserveCustomer.php?error=nullOffice");
        exit();
    }


    if (($carId = $_POST["carType"])==null){
        header("location:ReserveCustomer.php?error=nullCar");
        exit();
    }

    $cardNum = isset($_POST["cardNum"]) ? $_POST["cardNum"] : null;
    if ($cardNum == null) {
        header("location:ReserveCustomer.php?error=nullCard");
        exit();
    }

    if (isset($_POST["startDate"]) && !empty($_POST["startDate"])) {
        $sDate = $_POST["startDate"];   
    }else{
        header("location:ReserveCustomer.php?error=nullSDate");
        exit();
    }

    if (isset($_POST["endDate"]) && !empty($_POST["endDate"])) {
        $eDate = $_POST["endDate"];   
    }else{
        header("location:ReserveCustomer.php?error=nullEDate");
        exit();
    }
        
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