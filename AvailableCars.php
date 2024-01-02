<?php
require_once 'connection.php';
$sql = "SELECT * FROM car";
$all_product = $con->query($sql);
 

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
        <li><a href="PaymentCard.html">Payment-Card</a></li>
        <li><a href="customerProfile.php">My profile</a></li>
        <li><a href="index.html">Log OUT</a></li>

      </ul>
    </nav>
  </header>
<section class="Customer">
<main>

<?php
while($row=mysqli_fetch_assoc($all_product)){
?>
  <div class="car">
<div class ="image">
  <img src ="<?php echo $row["Img_Path"];?>" alt="">
</div>
    <div class="caption">
      <span class="product_caption">

      
<p class="product_name"><?php echo $row["Car_Name"];?></p>
<p class="product_name"><?php $state = $row["State"]; if($state==1){echo '<p class ="av">Available</p>';}else{echo '<p class = "alertmsg">Unvailable</p>';};?></p>

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