<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Customer</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</head>

<body>
  <header>
    <a href="CustomerHome.html" class="logo">Customer Page</a>
    <nav class="navigation">
      <ul>
        <li><a href="CustomerHome.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="index.html"><i class="far fa-calendar-alt"></i> Log OUT</a></li>
      </ul>
    </nav>
  </header>

  <section class="CustomerNav">
    <div class="Ab-cust">
      <h1>About Customer</h1>

      <div class="Ab-cust">
        <h2>Name</h2>
         <p><?php echo isset($_SESSION['customerName']) ? $_SESSION['customerName'] : 'Customer'; ?></p>
        <h2>ID</h2>
         <p><?php echo isset($_SESSION['customerId']) ? $_SESSION['customerId'] : 'N/A'; ?></p>
      </div>

      <div class="Ab-cust">
        <h2>Reserved Cars</h2>
          <?php
    if (isset($_SESSION['cars']) && !empty($_SESSION['cars'])) {
        foreach ($_SESSION['cars'] as $car) {
            echo "<p>{$car['car_Name']} (ID: {$car['car_ID']})</p>";
        }
    } else {
        echo "<p>N/A</p>";
    }
    ?>
      </div>

    </div>
    </div>
  </section>
</body>

</html>
