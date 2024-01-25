<?php
require_once 'connection.php';
session_start();
if (isset($_SESSION['search_results'])) {
  $search_results  = $_SESSION['search_results'];
} else {

  $sql = "SELECT * FROM car";
  $all_product = $con->query($sql);

  // Fetch all rows into an array for later use
  $search_results = mysqli_fetch_all($all_product, MYSQLI_ASSOC);;
}

unset($_SESSION['search_results']);

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Available Cars</title>
  <link rel="stylesheet" href="cars.css">
  <script src="script.js"></script>

</head>

<body>
  <header>
    <a href="CustomerHome.html" class="logo">Home</a>

    <nav class="navigation">
      <ul>
        <li><a href="ReserveCustomer.php"><i class="far fa-calendar-alt"></i> Reserve Car</a></li>
        <li><a href="ReturnCustomer.php"><i class="far fa-calendar-alt"></i> Return Car</a></li>
        <li><a href="PaymentCard.php">Payment-Card</a></li>
        <li><a href="customerProfile.php">My profile</a></li>
        <li><a href="index.html">Log OUT</a></li>

      </ul>
    </nav>
  </header>
<section class="Customer">
<form action="searchCar.php">
  <div class="search">
  <label for="type">Filter by:</label>
  <select name="type" id="type">
<option value="Car_Name">Name</option>
<option value="Model">Model</option>
<option value="Color">Color</option>
<option value="State">State</option>
  </select>
  <label for="value">Value:</label>
  <input type="text" name="value" id="value" placeholder="What are you looking for?" required>
<button type="submit" name="submit" id="submit">Search</button>
  </div>
   

</form>
  
<main>

<?php

foreach ($search_results as $row) {
  ?>
  <div class="car">
<div class ="image">
  <img src ="<?php echo $row["Img_Path"];?>" alt="">
</div>
    <div class="caption">
      <span class="product_caption">

      
<p class="product_name"><?php echo $row["Car_Name"];?></p>
<p class="product_name"><?php $state = $row["State"]; if($state==1){echo '<p class ="av">Available</p>';}else{echo '<p class = "alertmsg">Unavailable</p>';};?></p>

<p class="price"> <b>$<?php echo $row["Price"];?></b></p>
    </div>
<button class="add" onclick="reservePage()">Make Payment</button>
</div>


<?php
}

?>
</main>

</section>


<script>
  function reservePage(){
    window.location.href = "ReserveCustomer.php";
  }





  </script>

</body>

</html>