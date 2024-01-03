<?php
if (isset($_POST["submit"])) {
    
    $name = $_POST["name"];
    $price = $_POST["CPrice"];
    $model = $_POST["CModel"];
    $color = $_POST["CColor"];
    $plateID = $_POST["PID"];
    $officeID = $_POST["OID"];
    $state = $_POST["state"];


    $targetDir = "imgs/Cars/";
    $targetFile = $targetDir . basename($_FILES["photo"]["name"]);
    move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile);

        require_once 'connection.php';
        require_once 'phpFunctions.php';
        

if(registerCar($con,$name,$price,$model,$color,$plateID,$officeID,$state,$targetFile)==false){
    header("location:carRegistration.php?error=invalidOffice");
    exit();
}


}else{
    header("location:carRegistration.php");
}