<?php

session_start();

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

// Function to validate user credentials
function validateUser($username, $password) {
    global $conn;

    // Sanitize user input
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Query to check user credentials
    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = $conn->query($sql);

    // Check if a matching user is found
    if ($result->num_rows > 0) {
        return true; // User is valid
    } else {
        return false; // User is not valid
    }
}

// Close the database connection
$conn->close();

?>