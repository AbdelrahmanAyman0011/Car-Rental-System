<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        $name = $_POST["name"];
        $mail = $_POST["email"];
        $pass = md5($_POST["password"]);

        try {
            // Connection to the database
            $dsn = "mysql:host=localhost;dbname=registration";
            $user = "root";
            $password = "";

            $con = new PDO($dsn, $user, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // my SQL query
            $q = "INSERT INTO user(Name, Email, password) VALUES (?, ?, ?)";

            $stmt = $con->prepare($q);

            if ($stmt->execute([$name, $mail, $pass])) {
                echo "Hello, $name";
            } else {
                echo "Error executing the query.";
            }

            $con = null;
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    } else {
        echo "Incomplete form data.";
    }
} else {
    header("Location: Login.html");
}
