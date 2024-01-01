<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedValue = $_POST["carType"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';

    $priceData=displayPrice($con,$selectedValue);
    $optionsJson = json_encode($priceData);

        echo $optionsJson;

}

?>
