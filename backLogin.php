<?php
if (isset($_POST["submit"])) {
    
  
        $mail = $_POST["email"];
        $pass = $_POST["password"];

        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        loginUser($con,$mail,$pass);



}else{
    header("location:frontLogin.php");
}