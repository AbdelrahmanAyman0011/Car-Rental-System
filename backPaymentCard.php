<?php
session_start(); // Start the session to access session variables

if (isset($_POST["submit"])) {
    $cardNumber = $_POST["cardNumber"];
    $expirationDate = $_POST["expirationDate"];
    $cvv = $_POST["cvv"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';

    // Retrieve customerId from the session
    $customer_ID = $_SESSION["customerId"] ?? null; // Provide a default value if not set

    paymentCard($con, $cardNumber, $expirationDate, $cvv, $password, $customer_ID);
} else {
    header("location:carRegistration.html");
}
