<?php
if (isset($_POST["submit"])) {
    
    session_start();
    $customerId = $_SESSION["customerId"];

    if (($carId=$_POST["cusCars"])==null){
        header("location:ReturnCustomer.php?error=nullCar");
        exit();
    }
        require_once 'connection.php';
        require_once 'phpFunctions.php';

        ReturnCar($con,$carId);
        changeState($con,$carId,true);
        header("location:ReturnCustomer.php");

}else{
    header("location:ReturnCustomer.php");
}