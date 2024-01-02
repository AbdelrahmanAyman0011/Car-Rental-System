<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Return a Car</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</head>

<body>
  <header>
    <a href="CustomerHome.html" class="logo">Customer Page</a>
    <nav class="navigation">
      <ul>
        <li><a href="CustomerHome.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="ReserveCustomer.php"><i class="fas fa-car"></i> Reserve Car</a></li>
        <li><a href="index.html">Log OUT</a></li>
      </ul>
    </nav>
  </header>

  <section class="CustomerNav">
    <div class="Ab-cust">

      <div class="reservation-form">
        <h2>Return a Car</h2>

        <form action="Return.php" method="POST">
        <label for="cusCars">Your Cars:</label>
        <select name="cusCars" id="cusCars">
        </select>

        <div id="notation">
        $100 Penalty for Late Return.
        </div>
        <div id="priceDisplay">
        Penalty: $0.00
        </div>
        <input type="hidden" name="price" id="hiddenPrice" value="">

        </div>
        <button type="submit" name="submit" id="submit">Return</button>
        <?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "nullCar") {
        echo '<p class="alertmsg">No Car selected</p>';
    }
  }?>
        </form>
    </div>
    


  </section>

  <script>


// Fetch data from the PHP file
// Fetch data from the PHP file
fetch('displayCusCars.php')
  .then(response => response.json())
  .then(data => {
    // Get the select element
    const select = document.getElementById('cusCars');

    // Loop through the data and create options
    data.forEach(option => {
      const optionElement = document.createElement('option');
      optionElement.value = option.car_ID;
      optionElement.text = option.car_Name;
      select.add(optionElement);
    });

    // Get the selected car and fetch its end date
    document.getElementById('cusCars').addEventListener('change', function () {
      var selectedCarID = this.value;

      // Fetch the end date of the selected car from PHP
      fetch('getEndDate.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'carID=' + selectedCarID,
      })
        .then(response => response.json())
        .then(data => {
          // Assuming 'data' contains the end date of the selected car
          const endDate = new Date(data);

          // Compare the end date with today's date
          const today = new Date();
          const priceDisplay = document.getElementById('priceDisplay');
          const hiddenPrice = document.getElementById('hiddenPrice');
          const timeDifference = endDate - today;
          if (timeDifference<=0) {
            // Car has passed the end date, set price to $100
            priceDisplay.textContent = 'Penalty: $100.00';
            hiddenPrice.value = '100';
          } else {
            // Car has not passed the end date, fetch and display regular price
            var selectedCar = document.getElementById('cusCars').value;
            priceDisplay.textContent = 'Penalty: $0.00';
          }
        })
        .catch(error => console.error('Error fetching end date:', error));
    });
  })
  .catch(error => console.error('Error fetching car data:', error));



  </script>
</body>

</html>