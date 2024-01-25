<?php
require_once 'connection.php';
require_once 'phpFunctions.php';

$officeData = displayOffices($con);
mysqli_close($con);
$optionsJson = json_encode($officeData);
echo $optionsJson;