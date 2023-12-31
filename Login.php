<?php
if (isset($_POST["submit"])) {
    
  
        $mail = $_POST["email"];
        $pass = $_POST["password"];

        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        if(loginUser($con,$mail,$pass)!==false){
            echo '<script>alert("Login error!, try again!");</script>';
            }

}else{
    header("location:Login.html");
}