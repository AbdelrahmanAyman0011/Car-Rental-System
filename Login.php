<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = $_POST["email"];
        $pass = $_POST["password"];
        try {
            // Connection to the database
            $dsn = "mysql:host=localhost;dbname=registration";
            $user = "root";
            $password = "";

            $con = new PDO($dsn, $user, $password);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $query = "SELECT * FROM user WHERE Email = :email AND password = :password";
            $stmt = $con->prepare($query);

            // Create variables for binding
            $emailValue = $email;
            $passwordValue = md5($pass);

            // Bind the values using variables
            $stmt->bindParam(":email", $emailValue, PDO::PARAM_STR);
            $stmt->bindParam(":password", $passwordValue, PDO::PARAM_STR);

            $stmt->execute();
            $user1 = $stmt->fetch();

            if ($user1) {
                // Successful login
                echo "Happy to see you again, " . $user1['Name'];
            } else {
                // Authentication failed
                echo '<script> alert("Invalid email or password.")</script>';
		echo "<script type='text/javascript'>
  		window.location = '" . $_SERVER['HTTP_REFERER'] . "';
  		</script>";
            }
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    } else {
        echo "Incomplete form data.";
    }
}
?>
