<?php
require_once 'connection.php';
require_once 'phpFunctions.php';



session_start();
$customerId = $_SESSION["customerId"];

$cardData = displayCard($con,$customerId);
mysqli_close($con);
$optionsJson = json_encode($cardData);
echo $optionsJson;