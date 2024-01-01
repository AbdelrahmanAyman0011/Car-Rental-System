<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedValue = $_POST["carID"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';


    $endDate=endDate($con,$selectedValue);
    $jsCompatibleDate = date("c", strtotime($endDate));
    $optionsJson = json_encode($jsCompatibleDate);

        echo $optionsJson;

}

?>
