<?php
if (isset($_POST["submit"])) {
    
    $capacity = $_POST["capacity"];
    $location = $_POST["location"];


        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        registerOffice($con,$capacity,$location);



}else{
    header("location:carRegistration.html");
}