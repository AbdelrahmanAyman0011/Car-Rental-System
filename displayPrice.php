<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $selectedValue = $_POST["carType"];
    if (isset($_POST["startDate"]) && !empty($_POST["startDate"])) {
        if (isset($_POST["endDate"]) && !empty($_POST["endDate"])) {
            require_once 'connection.php';
            require_once 'phpFunctions.php';
        $sDate = $_POST["startDate"];   
        $eDate = $_POST["endDate"];   
        $startDate = new DateTime($sDate);
        $endDate = new DateTime($eDate);
        $interval = $startDate->diff($endDate);
        $numberOfDays = $interval->days;
        $priceData=displayPrice($con,$selectedValue);

        $totalPrice = $numberOfDays * $priceData;
        $optionsJson = json_encode($totalPrice);

        echo $optionsJson;
        exit();
    }
    }
 

        

        // Calculate total price for the specific period
    
    require_once 'connection.php';
    require_once 'phpFunctions.php';

    $priceData=displayPrice($con,$selectedValue);
    $optionsJson = json_encode($priceData);

        echo $optionsJson;

}

?>
