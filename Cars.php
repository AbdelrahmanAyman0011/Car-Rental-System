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
    <a href="CustomerHome.html" class="logo">Customer Page</a>
    <nav class="navigation">
      <ul>
        <li><a href="CustomerHome.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.html">Log OUT</a></li>
      </ul>
    </nav>
  </header>
  <section class="CustomerNav">
    <div class="Ab-cust">
      <div class="reservation-form">
        <table id="carTable">
          <thead>
            <tr>
              <th>Car Photo</th>
              <th>Car ID</th>
              <th>Plate ID</th>
              <th>Make</th>
              <th>Model</th>
              <th>Color</th>
              <th>Price</th>
              <th>Office ID</th>
              <th>State</th>
            </tr>
          </thead>
          <tbody>
            <?php
            require_once 'connection.php';

            $sql = "SELECT Car_ID, Plate_ID, Car_Name, Model, Color, Price, Office_ID, State, Img_Path FROM Car";
            $result = mysqli_query($con, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                  <td><img src="<?php echo $row['Img_Path']; ?>" alt="Car Photo"></td>
                  <td><?php echo $row['Car_ID']; ?></td>
                  <td><?php echo $row['Plate_ID']; ?></td>
                  <td><?php echo $row['Car_Name']; ?></td>
                  <td><?php echo $row['Model']; ?></td>
                  <td><?php echo $row['Color']; ?></td>
                  <td><?php echo $row['Price']; ?></td>
                  <td><?php echo $row['Office_ID']; ?></td>
                  <td><?php echo $row['State']; ?></td>
                </tr>
            <?php
              }
            } else {
            ?>
              <tr><td colspan="9">No cars available</td></tr>
            <?php
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</body>
</html>
