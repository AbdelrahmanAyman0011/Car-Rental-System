<?php
try {
    // Connection to the database
    $dsn = "mysql:host=localhost;dbname=registration";
    $user = "root";
    $password = "";

    $con = new PDO($dsn, $user, $password);
    // Check connection
    if (!$con) {
        echo "Connection Failed!";
        exit();
    }
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
