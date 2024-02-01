<?php 

session_start();

// SQL Server database credentials
$serverName = "your_sql_server_name"; // Replace with your SQL Server host or IP address
$databaseName = "your_database_name"; // Replace with your SQL Server database name
$databaseUsername = "your_sql_server_username"; // Replace with your SQL Server username
$databasePassword = "your_sql_server_password"; // Replace with your SQL Server password

// Establishes the connection
$yourDbConnection = sqlsrv_connect($serverName, array(
    "Database" => $databaseName,
    "Uid" => $databaseUsername,
    "PWD" => $databasePassword,
));

// Check the connection
if (!$yourDbConnection) {
    die(print_r(sqlsrv_errors(), true));
}

session_start();

// Function to get the current user ID from session
function getCurrentUserId() {
    // Check if the user ID is set in the session
    if (isset($_SESSION['user_id'])) {
        // Return the user ID from the session
        return $_SESSION['user_id'];
    } else {
        // If user ID is not set, return a default value or handle accordingly
        return 0; // Default value (you can change this based on your needs)
    }
}

function loginUser($userId) {
    // Set the user ID in the session
    $_SESSION['user_id'] = $userId;
}

// Example of logging in a user (replace this with your actual login logic)
$userToLoginId = 123; // Replace with the actual user ID after successful login
loginUser($userToLoginId);

$loggedInUserId = getCurrentUserId();
echo "Current User ID: " . $loggedInUserId;

?>