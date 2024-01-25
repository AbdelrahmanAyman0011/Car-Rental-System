<?php
require_once 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['customer_id'])) {
    $customerID = $_POST['customer_id'];

    // Delete customer query
    $deleteQuery = "DELETE FROM Customer WHERE Customer_ID = $customerID";
    $result = mysqli_query($con, $deleteQuery);

    if ($result) {
        header("Location: customer_list.php");
        exit;
    } else {
        echo "Error deleting customer.";
    }
}
?>
