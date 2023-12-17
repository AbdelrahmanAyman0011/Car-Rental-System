<?php
 try {
            // Connection to the database
            $dsn = "mysql:host=localhost;dbname=registration";
            $user = "root";
            $password = "";

            $con = new PDO($dsn, $user, $password);
            if (!$conn) {
	echo "Connection Failed!";
	exit();
}
?>