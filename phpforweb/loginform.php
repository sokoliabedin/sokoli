<?php

session_start();

include("databaselogin.php");

$servername = "your_database_server"; // Replace with your database server name
$username = "your_username"; // Replace with your database username
$password = "your_password"; // Replace with your database password
$dbname = "coffee_shop_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize user input
function sanitize_input($data) {
    // Implement your sanitation logic here
    return $data;
}

// Handle registration form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["register"])) {
    // Sanitize user input
    $username = sanitize_input($_POST["username"]);
    $password = sanitize_input($_POST["password"]);

    // Perform SQL query to insert user into the database
    $insert_sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = $conn->query($insert_sql);

    if ($result) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login"])) {
    // Sanitize user input
    $username = sanitize_input($_POST["login_username"]);
    $password = sanitize_input($_POST["login_password"]);

    // Perform SQL query to check user credentials
    $login_sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $login_result = $conn->query($login_sql);

    if ($login_result->num_rows > 0) {
        echo "Login successful!";
    } else {
        echo "Invalid username or password.";
    }
}

// Close the database connection
$conn->close();
?>

<!-------------------------------------------------------- HTML ---------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Coffee Shop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <section class="about" id="about">
      <h1 class="heading"><span>Feeling</span> of our coffe</h1>

      <div class="row">
        <div class="image">
          <img src="images/coffeee1.jpg" />
        </div>

        <div class="content">
          <h3>What Sets Our Coffee Apart</h3>
          <p>
            At the heart of our coffee is a selection of premium, ethically
            sourced beans from the world's most renowned coffee regions. We
            meticulously choose beans that meet the highest standards, ensuring
            a rich and distinctive flavor profile.
          </p>
          <p></p>
        </div>

      </div>
    </section>
    <section class="about" id="about">
      <div class="row">
        <div class="image">
          <img src="images/coffeee2.jpg" />
        </div>

        <div class="content">
          <h3>What Elevates Our Coffee Experience</h3>
          <p>
            Indulging in your coffee is like embarking on a flavor journey. The
            richness and depth of each cup are unparalleled. From the first sip
            to the last drop, it's an exquisite experience that keeps me coming
            back for more. Your commitment to quality truly shines in every
            roast.
          </p>
          <p></p>
        </div>

      </div>
    </section>
    <section class="about" id="about">
      <div class="row">
        <div class="image">
          <img src="images/coffeee3.jpg" />
       </div>

        <div class="content">
          <h3>What Defines Our Exceptional Coffee</h3>
          <p>
            Your coffee is a masterpiece in a cup. The aroma alone is enough to
            captivate the senses, and the taste is nothing short of
            extraordinary. The attention to detail in the sourcing and roasting
            process is evident, resulting in a brew that is consistently
            satisfying. Bravo on creating such a remarkable coffee blend!
          </p>
          <p></p>
        </div>

      </div>
    </section>
    <section class="about" id="about">
      <div class="row">
        <div class="image">
          <img src="images/coffeee4.jpg" />
       </div>

        <div class="content">
          <h3>What Defines Our Exceptional Coffee</h3>
          <p>
            I can't help but marvel at the exceptional quality of your coffee.
            It's not just a beverage , it's a symphony of flavors that dance on
            the palate. The balance of notes, the smoothness, and the lingering
            aftertaste make it evident that this is coffee crafted with passion
            and expertise. Truly a connoisseur's delight!
          </p>
         <p></p>
        </div>
      </div>
    </section>

<!-- Registration Form -->
<section class="registration" id="registration">
    <h2>Register</h2>
    <form method="post" action="">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" name="register">Register</button>
    </form>
</section>

<!-- Login Form -->
<section class="login" id="login">
    <h2>Login</h2>
    <form method="post" action="">
        <label for="login_username">Username:</label>
        <input type="text" name="login_username" required>

        <label for="login_password">Password:</label>
        <input type="password" name="login_password" required>

        <button type="submit" name="login">Login</button>
    </form>
</section>

</body>
</html>