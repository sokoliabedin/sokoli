<?php

session_start();

include("databasecontact.php");

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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data (sanitized)
    $name = sqlsrv_real_escape_string($yourDbConnection, $_POST["name"]);
    $email = sqlsrv_real_escape_string($yourDbConnection, $_POST["email"]);
    $number = sqlsrv_real_escape_string($yourDbConnection, $_POST["number"]);

    // Insert data into the database using prepared statement
    $query = "INSERT INTO contact_form_data (name, email, number) VALUES (?, ?, ?)";
    $params = array($name, $email, $number);
    $options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);
    $stmt = sqlsrv_query($yourDbConnection, $query, $params, $options);

    if ($stmt) {
        // Set a success message
        $successMessage = "Thank you! Your message has been submitted successfully.";
    } else {
        // Display an error message or log the error
        echo "Error: " . print_r(sqlsrv_errors(), true);
    }

    // Close the statement
    sqlsrv_free_stmt($stmt);
    // Close the SQL Server connection
    sqlsrv_close($yourDbConnection);

}

?>

<!-------------------------------------------------------- HTML ---------------------------------------------------->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
</head>
<body>
<section class="contact" id="contact"> 
      
      <div class="row"> 
         
       <form action="contact.php" method="post">
           <h3> get in touch </h3>
           <h1 class="heading"> <span> contact </span> us </h1>
           <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d681.9636301219305!2d21.146221400586107!3d42.65302560809877!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13549f47a5602081%3A0xec721f5ff5e05ca0!2sUBT%20College!5e0!3m2!1sen!2s!4v1699829392257!5m2!1sen!2s" 
           width="600" height="450" style="border:0;" allowfullscreen="" 
            loading="lazy" referrerpolicy="no-referrer-when-downgrade"> 
            </iframe>
           <div class="inputBox">
             <span class="fas fa-user"> </span>
             <input type="text" name="name" placeholder="Your Name">
           </div>
   
           <div class="inputBox">
             <span class="fas fa-envelope"> </span>
             <input type="email" name="email" placeholder="Your Email">
           </div>
   
           <div class="inputBox">
             <span class="fas fa-phone"> </span>
             <input type="number" name="number" placeholder="Your Phone Number" maxlength="20">
           </div>
         <!--
           <div class="inputBox">
             <span class="fas fa-pencil-alt"></span>
             <textarea name="message" placeholder="Your Message" maxlength="350" rows="4" cols="10" style="width: 1250px; height:50px; font-size:20px; resize: none;"></textarea>
           </div>
         -->
           <input type="submit" value="contact now" class="btn">  
   
           </form>
        
     </div>
 
   </section>

    <h1>Add DataBase</h1>

    <!-- Form for adding DataBase -->
    <form action="databasecontact.php" method="post" enctype="multipart/form-data">
        <label for="newsTitle">News Title:</label>
        <input type="text" name="newsTitle" required>

        <label for="newsContent">News Content:</label>
        <textarea name="newsContent" required></textarea>

        <label for="newsImage">Upload Image:</label>
        <input type="file" name="newsImage" accept="image/*">

        <input type="submit" value="Add DataBase">
    </form>

</body>
</html>
