<?php

// Start the session
session_start();

// Check if the user is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
    header("Location: login.php"); // Redirect non-admin users to the login page
    exit();
}
?>

<!-------------------------------------------------------- HTML ---------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <!-- Additional styles or scripts can be included here -->
</head>
<body>

<!-- Header -->
<header>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <a href="logout.php">Logout</a>
</header>

<!-- Main content of the admin dashboard -->
<section class="dashboard">
    <h2>Admin Dashboard</h2>
    
    <!-- Manage Users Feature -->
    <div class="feature">
        <h3>Manage Users</h3>
        <p>Here you can manage user accounts.</p>
        <!-- Illustrative: Add a link to a user management page -->
        <a href="manage_users.php">Go to User Management</a>
    </div>

    <!-- View Reports Feature -->
    <div class="feature">
        <h3>View Reports</h3>
        <p>Access and analyze various reports.</p>
        <!-- Illustrative: Add a link to a reports page -->
        <a href="view_reports.php">Go to Reports</a>
    </div>

    <!-- Add more features as needed -->

</section>

<!-- Your existing HTML content -->

</body>
</html>