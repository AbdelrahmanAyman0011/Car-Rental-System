<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $type = $_GET["type"];

    require_once 'connection.php';
    require_once 'phpFunctions.php';

if($type=="Car_Name"){
    $name = $_GET["value"];
    $result = searchCarsName($con,$name);

} elseif($type=="Model"){
    $model = $_GET["value"];
    $result = searchCarsModel($con,$model);

}elseif($type=="Color"){
    $color = $_GET["value"];
    $result = searchCarsColor($con,$color);

}elseif($type=="State"){
    $sState = $_GET["value"];
    if($sState=="Available"){
    $result = searchCarsState($con,true);
}else if($sState=="Unavailable" ){
    $result = searchCarsState($con,false);
}
}


    if(!empty($result)){
        $_SESSION['search_results'] = $result;

    }else{
    $_SESSION['search_results'] = [];
}

header("Location: AvailableCars.php");
exit();



}

?>