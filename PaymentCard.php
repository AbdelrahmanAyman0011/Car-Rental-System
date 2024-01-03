<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment-Card</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js"></script>
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

            <form method="POST" action="backPaymentCard.php">
                <div id="payment" class="payment-form">
                    <form id="paymentForm">
                        <label for="cardNumber">Card Number:</label>
                        <input type="text" name="cardNumber" id="cardNumber" placeholder="1234 5678 9012 3456"
                            maxlength="16" required>

                        <label for="expirationMonth">Expiration Month:</label>
                        <input type="text" name="expirationMonth" id="expirationMonth" placeholder="e.g., 01"
                            maxlength="2" required>

                        <label for="expirationYear">Expiration Year:</label>
                        <input type="text" name="expirationYear" id="expirationYear" placeholder="e.g., 24"
                            maxlength="2" required>


                        <label for="cvv">CVV:</label>
                        <input type="text" name="cvv" id="cvv" placeholder="123" maxlength="3" required>
                        <?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "redundantCard") {
        echo '<p class="alertmsg">You have entered this card already!</p>';
    }
}

?>
                    </form>
                    <div> <!-- Added missing div tag -->
                        <button type="submit" name="submit" id="submit">Add</button>
                    </div>
                </div>
            </form>

        </div>
    </section>
</body>

</html>