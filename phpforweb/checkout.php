<?php

// Start the session
session_start();

// Include the file with your database connection and function
include("databasecheckout.php");

// Check if the form has been submitted using POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Retrieve product names and prices from the submitted form
    $productNames = $_POST["productName"];
    $prices = $_POST["price"];

    // Loop through each product in the form
    for ($i = 0; $i < count($productNames); $i++) {

        // Try to add the order to the database
        if (!addOrderToDataBase($productNames[$i], $prices[$i])) {
            echo "Error placing order. Please try again.";
            exit;
        }
    }

    // Display a success message if all orders were added successfully
    echo "Order placed successfully!";
}

?>

<!-------------------------------------------------------- HTML ---------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
</head>
<body>

    <header class="header">
        <!-- Your header content -->

        <div class="cart-items-container">
            <!-- Your existing cart items -->

            <!-- Add the form to submit cart items -->
            <form action="checkout.php" method="post" id="checkout-form">
                <?php
                // Example: Loop through existing cart items and create hidden fields
                $cartItems = [
                    ['name' => 'Cappuccino', 'price' => '5.00'],
                    ['name' => 'Americano', 'price' => '5.00'],
                    // Add more items as needed
                ];

                // Loop through cart items and create hidden fields in the form
                foreach ($cartItems as $cartItem) {
                    echo '<input type="hidden" name="productName[]" value="' . $cartItem['name'] . '">';
                    echo '<input type="hidden" name="price[]" value="' . $cartItem['price'] . '">';
                }
                ?>
                <button type="submit" class="btn">Checkout Now</button>
            </form>
        </div>
    </header>

    <!-- Your existing HTML content -->

</body>
</html>