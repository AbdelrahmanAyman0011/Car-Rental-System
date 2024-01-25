<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedValue = $_POST["officeLoc"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';

    $carData=displayCars($con,$selectedValue);
    $optionsJson = json_encode($carData);

        echo $optionsJson;

}

?>
