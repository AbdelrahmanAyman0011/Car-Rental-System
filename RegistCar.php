<?php
if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $price = $_POST["CPrice"];
    $model = $_POST["CModel"];
    $color = $_POST["CColor"];
    $plateID = $_POST["PID"];
    $officeID = $_POST["OID"];
    $state = $_POST["state"];

        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        registerCar($con,$name,$price,$model,$color,$plateID,$officeID,$state);



}else{
    header("location:carRegistration.html");
}