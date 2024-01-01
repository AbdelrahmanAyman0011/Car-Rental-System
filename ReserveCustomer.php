<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reserve a Car</title>
  <link rel="stylesheet" href="styles.css">
  <script src="script.js"></script>
</head>

<body>
  <header>
    <a href="CustomerHome.html" class="logo">Customer Page</a>
    <nav class="navigation">
      <ul>
        <li><a href="CustomerHome.html"><i class="fas fa-home"></i> Home</a></li>
        <li><a href="AvailableCarsCust.html"><i class="fas fa-car"></i> Available Cars</a></li>
        <li><a href="#reservation"><i class="far fa-calendar-alt"></i> Log OUT</a></li>
      </ul>
    </nav>
  </header>

  <section class="CustomerNav">
    <div class="Ab-cust">

      <div class="reservation-form">
        <h2>Make a Car Reservation</h2>


        <label for="officeLoc">Office Location:</label>
        <select name="officeLoc" id="officeLoc">
        </select>
        <button onclick="search()" class="Loginbtn">Search</button>


        <label for="carType">Select Car (Available only Appears) :</label>
        <select id="carType">
        </select>

        <label for="cardNum">Select Payment-Card:</label>
        <select id="cardNum"></select>

        <script>
          // Fetch data from the PHP file
          fetch('displayOffice.php')
            .then(response => response.json())
            .then(data => {
              // Get the select element
              const select = document.getElementById('officeLoc');

              // Loop through the data and create options
              data.forEach(option => {
                const optionElement = document.createElement('option');
                //optionElement.value = option;
                optionElement.value = option.Office_ID;
                optionElement.text = option.Location;
                select.add(optionElement);
              });
            })
            .catch(error => console.error('Error fetching data:', error));

          function search() {
            // Get the selected value
            var selectedValue = document.getElementById('officeLoc').value;

            // Send the selected value to the PHP file using Fetch API
            fetch('displayCars.php', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
              },
              body: 'officeLoc=' + selectedValue, // Change to 'officeLoc' as it matches the PHP code
            })
              .then(response => response.json()) // Expecting JSON response
              .then(data => {
                const selectCarType = document.getElementById('carType');
                selectCarType.innerHTML = ""; // Clear existing options
                data.forEach(option => {
                  const optionElement = document.createElement('option');
                  optionElement.text = option;
                  selectCarType.add(optionElement);
                });
              })
              .catch(error => console.error('Error:', error));
          }


          fetch('displayCard.php')
            .then(response => response.json())
            .then(data => {
              // Get the select element
              const select = document.getElementById('cardNum');

              // Loop through the data and create options
              data.forEach(option => {
                const optionElement = document.createElement('option');
                //optionElement.value = option;
                optionElement.value = option.Card_ID;
                optionElement.text = option.Card_ID;
                select.add(optionElement);
              });
            })
            .catch(error => console.error('Error fetching data:', error));


        </script>



       

        <label for="startDate">Start Date:</label>
        <input type="date" id="startDate">

        <label for="endDate">End Date:</label>
        <input type="date" id="endDate">

        <div id="priceDisplay">Price: $0.00</div>

        <button onclick="reserveCar()">Reserve Car</button>
      </div>
    </div>
  </section>

  <script>
    function reserveCar() {
      // Add logic here to handle car reservation, update price, and initiate payment process
      alert("Car reserved! Payment process will start.");
      // You can redirect to the payment page or perform further actions as needed
    }
  </script>
</body>

</html>