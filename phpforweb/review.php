<?php

session_start();

include("databasereview.php");

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
$query = "SELECT * FROM reviews";
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
$stmt = sqlsrv_query($yourDbConnection, $query, array(), $options);

if ($stmt) {
    $reviews = array();
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        $reviews[] = $row;
    }
} else {
    // Display an error message or log the error
    echo "Error: " . print_r(sqlsrv_errors(), true);
}

// Close the statement
sqlsrv_free_stmt($stmt);

// Close the SQL Server connection
sqlsrv_close($yourDbConnection);

?>

<!-------------------------------------------------------- HTML ---------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reviews</title>
</head>
<body>

    <h1>Customer Reviews</h1>

    <?php if (isset($reviews) && !empty($reviews)) : ?>
        <div class="reviews-container">
            <?php foreach ($reviews as $review) : ?>
                <div class="review-box">
                    <p><?php echo $review['content']; ?></p>
                    <p>By: <?php echo $review['customer_name']; ?></p>
                    <p>Rating: <?php echo $review['rating']; ?> stars</p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <p>No reviews available.</p>
    <?php endif; ?>

</body>
</html>