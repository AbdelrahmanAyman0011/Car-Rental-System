<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment-Card</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var cardNumberInput = document.getElementById("cardNumber");
            var expirationMonthInput = document.getElementById("expirationMonth");
            var expirationYearInput = document.getElementById("expirationYear");
            var cvvInput = document.getElementById("cvv");

            cardNumberInput.addEventListener("input", function () {
                validateCardNumberInput(cardNumberInput);
            });

            expirationMonthInput.addEventListener("input", function () {
                validateExpirationMonthInput(expirationMonthInput);
            });

            expirationYearInput.addEventListener("input", function () {
                validateExpirationYearInput(expirationYearInput);
            });

            cvvInput.addEventListener("input", function () {
                validateNumericInput(cvvInput);
            });

            function validateCardNumberInput(inputElement) {
                var inputValue = inputElement.value;
                inputElement.setCustomValidity("");

                if (!/^[0-9]{16}$/.test(inputValue)) {
                    inputElement.setCustomValidity("Please enter a 16-digit card number");
                }
            }

            function validateExpirationMonthInput(inputElement) {
                var inputValue = inputElement.value;
                inputElement.setCustomValidity("");

                if (!/^(0?[1-9]|1[0-2])$/.test(inputValue)) {
                    inputElement.setCustomValidity("Please enter a valid month (1-12)");
                } else {
                    // If a single-digit month is entered, convert it to two digits (e.g., 1 -> 01)
                    inputElement.value = inputValue.padStart(2, '0');
                }
            }

            function validateExpirationYearInput(inputElement) {
                var inputValue = inputElement.value;
                inputElement.setCustomValidity("");

                if (!/^(2[4-9]|2[4-9]\d|[3-9]\d{2})$/.test(inputValue)) {
                    inputElement.setCustomValidity("Please enter a valid 2-digit year (24 or greater)");
                }
            }

            function validateNumericInput(inputElement) {
                var inputValue = inputElement.value;
                inputElement.setCustomValidity("");

                if (!/^[0-9]*$/.test(inputValue)) {
                    inputElement.setCustomValidity("Please enter only numeric characters (0-9)");
                }
            }
        });
    </script>
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
            <h1>Add Payment-Card</h1>

            <form method="POST" action="backPaymentCard.php" id="paymentForm">
                <div id="payment" class="payment-form">
                    <label for="cardNumber">Card Number:</label>
                    <input type="text" name="cardNumber" id="cardNumber" placeholder="1234 5678 9012 3456"
                        maxlength="16" required pattern="[0-9]{16}" title="Please enter only numeric characters (0-9)">

                    <label for="expirationMonth">Expiration Month:</label>
                    <input type="text" name="expirationMonth" id="expirationMonth" placeholder="e.g., 01"
                        maxlength="2" required pattern="[0-9]{2}" title="Please enter only numeric characters (0-9)">

                    <label for="expirationYear">Expiration Year:</label>
                    <input type="text" name="expirationYear" id="expirationYear" placeholder="e.g., 24"
                        maxlength="2" required pattern="[0-9]{2}" title="Please enter only numeric characters (0-9)">

                    <label for="cvv">CVV:</label>
                    <input type="text" name="cvv" id="cvv" placeholder="123" maxlength="3" required pattern="[0-9]{3}" title="Please enter only numeric characters (0-9)">
                    <?php
                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "redundantCard") {
                                echo '<p class="alertmsg">You have entered this card already!</p>';
                            }
                        }
                    ?>
                    
                    <div>
                        <button type="submit" name="submit" id="submit">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
</body>

</html>
