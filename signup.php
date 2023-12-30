<?php
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

        if (emailUsed($con, $mail) !== false) {
            echo '<script>alert("Email is already in use. Please enter a different email.");</script>';
        } else {
            createCustomer($con, $fname, $lname, $mail, $phone, $gender, $country, $city, $street, $pass);
            echo '<script>alert("User successfully registered!");</script>';
        }

}else{
    header("location:Signup.html");
    exit();
}
