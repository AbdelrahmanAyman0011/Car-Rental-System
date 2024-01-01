<?php
require_once 'connection.php';
require_once 'phpFunctions.php';
session_start();

$carData = $_SESSION['cars'];


mysqli_close($con);
$optionsJson = json_encode($carData);
echo $optionsJson;