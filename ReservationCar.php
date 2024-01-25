<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserve a Car</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
<header>
    <a href="adminHome.html" class="logo">Admin Page</a>
    <nav class="navigation">
        <ul>
            <li><a href="adminHome.html"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="index.html">Log OUT</a></li>
        </ul>
    </nav>
</header>

<section class="adminNav">
    <div class="admintable">
        <div class="">
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label for="customer_id">Select by Customer ID:</label>
                <select name="customer_id" id="customer_id">
                    <option value="all">All</option>
                    <?php
                    require_once 'connection.php';
                    $customerQuery = mysqli_query($con, "SELECT DISTINCT Customer_ID FROM Reserve");
                    while ($customerRow = mysqli_fetch_assoc($customerQuery)) {
                        echo "<option value='{$customerRow['Customer_ID']}'>{$customerRow['Customer_ID']}</option>";
                    }
                    ?>
                </select>

                <label for="car_id">Select by Car ID:</label>
                <select name="car_id" id="car_id">
                    <option value="all">All</option>
                    <?php
                    $carQuery = mysqli_query($con, "SELECT DISTINCT Car_ID FROM Reserve");
                    while ($carRow = mysqli_fetch_assoc($carQuery)) {
                        echo "<option value='{$carRow['Car_ID']}'>{$carRow['Car_ID']}</option>";
                    }
                    ?>
                </select>

                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date">

                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date">

                <input type="submit" class="filter-button" value="Apply Filter">
            </form>

            <table id="carTable" class="admintable">
                <thead>
                <tr>
                    <th>Customer_ID</th>
                    <th>CS_Fname</th>
                    <th>CS_Lname</th>
                    <th>CS_Gender</th>
                    <th>CS_Country</th>
                    <th>CS_City</th>
                    <th>CS_Street</th>
                    <th>CS_Phone</th>
                    <th>CS_Email</th>
                    <th>Car_ID</th>
                    <th>Car Plate ID</th>
                    <th>Car_Name</th>
                    <th>Car_Model</th>
                    <th>Car_Color</th>
                    <th>Car_Price </th>
                    <th>Car_Office ID</th>
                    <th>Reservation S_Date</th>
                    <th>Reservation End_Date</th>
                    <th>Total Price</th>
                </tr>
                </thead>
                <tbody>
                <?php
                // Initialize total price sum
                $totalPriceSum = 0;

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $filterCustomerID = $_POST['customer_id'];
                    $filterCarID = $_POST['car_id'];
                    $filterStartDate = $_POST['start_date'];
                    $filterEndDate = $_POST['end_date'];

                    $sql = "SELECT C.Customer_ID, C.Fname, C.Lname, C.Gender, C.Country, C.City, C.Street, C.PhoneNum, C.Email,
                                            R.Car_ID, Ca.Plate_ID, Ca.Car_Name, Ca.Model, Ca.Color, Ca.Price, Ca.Office_ID, R.S_Date, R.En_Date
                                            FROM Reserve R
                                            INNER JOIN Customer C ON R.Customer_ID = C.Customer_ID
                                            INNER JOIN Car Ca ON R.Car_ID = Ca.Car_ID
                                            ";

                    if ($filterCustomerID !== 'all') {
                        $sql .= " AND C.Customer_ID = '$filterCustomerID'";
                    }

                    if ($filterCarID !== 'all') {
                        $sql .= " AND R.Car_ID = '$filterCarID'";
                    }

                    if (!empty($filterStartDate) && !empty($filterEndDate)) {
                        $sql .= " AND (R.S_Date BETWEEN '$filterStartDate' AND '$filterEndDate')";
                    }

                    $result = mysqli_query($con, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>{$row['Customer_ID']}</td>";
                            echo "<td>{$row['Fname']}</td>";
                            echo "<td>{$row['Lname']}</td>";
                            echo "<td>{$row['Gender']}</td>";
                            echo "<td>{$row['Country']}</td>";
                            echo "<td>{$row['City']}</td>";
                            echo "<td>{$row['Street']}</td>";
                            echo "<td>{$row['PhoneNum']}</td>";
                            echo "<td>{$row['Email']}</td>";
                            echo "<td>{$row['Car_ID']}</td>";
                            echo "<td>{$row['Plate_ID']}</td>";
                            echo "<td>{$row['Car_Name']}</td>";
                            echo "<td>{$row['Model']}</td>";
                            echo "<td>{$row['Color']}</td>";
                            echo "<td>{$row['Price']}</td>";
                            echo "<td>{$row['Office_ID']}</td>";
                            echo "<td>{$row['S_Date']}</td>";
                            echo "<td>{$row['En_Date']}</td>";

                            // Calculate the number of days between start and end dates
                            $startDate = new DateTime($row['S_Date']);
                            $endDate = new DateTime($row['En_Date']);
                            $interval = $startDate->diff($endDate);
                            $numberOfDays = $interval->days;

                            // Calculate total price for the specific period
                            $totalPrice = $numberOfDays * $row['Price'];

                            echo "<td>{$totalPrice}</td>"; // Display the total price

                            echo "</tr>";

                            // Add total price to the sum
                            $totalPriceSum += $totalPrice;
                        }
                    } else {
                        echo "<tr><td colspan='18'>No records found</td></tr>";
                    }

                    // Display the total price sum outside the table
                }
                ?>
                </tbody>
            </table>

            <p class="total-price">Total price of this period: <?php echo $totalPriceSum; ?></p>
        </div>
        <div>
    </div>
</section>
</body>

</html>
