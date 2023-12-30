
<?php

$sname = "localhost";
$uname = "root";
$password = "";
$db = "car-rental-system";
$con = mysqli_connect($sname, $uname, $password, $db);

if (!$con) {
    echo "Connection Failed!";
    exit();
}
?>
