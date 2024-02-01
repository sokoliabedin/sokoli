<?php

// Start the session
session_start();

// Define your SQL server and connection options
$servername = "your_sql_database_server";
$connectionOptions = array(
    "Database" => "your_database_name",
    "Uid" => "your_database_username",
    "PWD" => "your_database_password"
);

// Connect to the SQL server
$conn = sqlsrv_connect($servername, $connectionOptions);

// Check if the connection is successful
if ($conn == false) {
    die(print_r(sqlsrv_errors(), true));
}

// Function to add an order to the database
function addOrderToDataBase($productName, $price){
    global $conn;

    // Define the SQL query
    $sql = "INSERT INTO orders (products_name, price) VALUES (?, ?)";
    $params = array($productName, $price);

    // Execute the query
    $stmt = sqlsrv_query($conn, $sql, $params);

    // Check if the query was successful
    if ($stmt == false) {
        return false;
    } else {
        return true;
    }
}

?>
