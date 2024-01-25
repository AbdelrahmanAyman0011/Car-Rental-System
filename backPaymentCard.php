<?php
session_start(); // Start the session to access session variables

if (isset($_POST["submit"])) {
    
    $cardNumber = $_POST["cardNumber"];
    $expirationMonth = $_POST["expirationMonth"];
    $expirationYear = $_POST["expirationYear"];
    $cvv = $_POST["cvv"];
    $customer_ID = $_SESSION["customerId"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';


    if (cardCusUsed($con, $cardNumber,$cvv,$customer_ID) !== false) {
        header("location:PaymentCard.php?error=redundantCard");
        exit();
    }


    // Retrieve customerId from the session
    $customer_ID = $_SESSION["customerId"] ?? null; // Provide a default value if not set

    // Combine month and year into a date string
    $expirationDate = "20{$expirationYear}-{$expirationMonth}-01";

    paymentCard($con, $cardNumber, $expirationMonth, $expirationYear, $cvv, $customer_ID);
    header("location:PaymentCard.php");
} else {
    header("location:PaymentCard.php");}
?>
