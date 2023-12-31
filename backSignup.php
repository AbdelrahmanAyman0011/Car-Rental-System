<?php
echo "hi!!";
if (isset($_POST["submit"])) {
    
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mail = $_POST["email"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];
        $country = $_POST["country"];
        $city = $_POST["country"];
        $street = $_POST["country"];
        $pass = $_POST["password"];

        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        if(emailUsed($con,$mail) !== false){
            header("location:frontSignup.php?error=emailUsed");
            exit();
        }

        createCustomer($con, $fname, $lname, $mail, $phone, $gender, $country, $city, $street, $pass);


}else{
    header("location:frontSignup.php");
    exit();
}