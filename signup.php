<?php
echo "hi!!";
if (isset($_POST["submit"])) {
    
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $mail = $_POST["email"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];
        $country = $_POST["country"];
        $city = $_POST["country"];
        $street = $_POST["country"];
        $pass = $_POST["password"];

        require_once 'connection.php';
        require_once 'phpFunctions.php';

        

        if(emailUsed($con,$mail) !== false){
            header("location:Signup.html?error=emailUsed");
            exit();
        }

        createCustomer($con, $fname, $lname, $mail, $phone, $gender, $country, $city, $street, $pass);


        /*try {
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
        }*/


}else{
    header("location:Signup.html");
    exit();
}
