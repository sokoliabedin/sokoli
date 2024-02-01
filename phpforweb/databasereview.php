<?php

// Include your database connection logic here
$serverName = "your_sql_server_name"; // Replace with your SQL Server host or IP address
$connectionOptions = array(
    "Database" => "your_database_name", // Replace with your SQL Server database name
    "Uid" => "your_sql_server_username", // Replace with your SQL Server username
    "PWD" => "your_sql_server_password"  // Replace with your SQL Server password
);

// Establishes the connection
$yourDbConnection = sqlsrv_connect($serverName, $connectionOptions);

// Check the connection
if (!$yourDbConnection) {
    die(print_r(sqlsrv_errors(), true));
}

// Fetch reviews from the database
$query = "SELECT * FROM reviews_table"; // Replace with your actual table name
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query($yourDbConnection, $query, array(), $options);

if ($stmt) {
    // Fetch and display reviews
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo "<div class='review-box'>";
        echo "<p>{$row['review_text']}</p>"; // Display the review text
        echo "<img src='{$row['user_image']}' alt='User Image'>"; // Display the user image
        echo "<h3>{$row['user_name']}</h3>"; // Display the user name
        echo "<div class='stars'>";
        for ($i = 0; $i < $row['rating']; $i++) {
            echo "<i class='fas fa-star'></i>"; // Display star rating based on the 'rating' value
        }
        echo "</div>";
        echo "</div>";
    }
} else {
    // Display an error message or log the error if fetching reviews fails
    echo "Error: " . print_r(sqlsrv_errors(), true);
}

// Close the statement
sqlsrv_free_stmt($stmt);
// Close the SQL Server connection
sqlsrv_close($yourDbConnection);

?>
