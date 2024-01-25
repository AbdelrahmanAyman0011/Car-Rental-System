<?php
session_start(); // Start the session to access session variables

if (isset($_POST["submit"])) {

    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $mail = $_POST["email"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $country = $_POST["country"];
    $city = $_POST["city"]; // Updated to use 'city' from the form
    $street = $_POST["street"]; // Updated to use 'street' from the form
    $pass = $_POST["password"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';

    // Check if email is already used
    if (emailUsed($con, $mail) !== false) {
        $_SESSION["signupError"] = "Email is already in use. Please use a different email.";
        header("location:frontSignup.php");
        exit();
    }

    // Attempt to create the customer
    if (createCustomer($con, $fname, $lname, $mail, $phone, $gender, $country, $city, $street, $pass)) {
        header("location:frontLogin.php");
        exit();
    } else {
        $_SESSION["signupError"] = "Registration failed. Please try again.";
        header("location:frontSignup.php");
        exit();
    }
} else {
    header("location:frontSignup.php");
    exit();
}
