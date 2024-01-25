<?php 
include("database.php");
 $query = "SELECT * FROM contact_submissions ORDER BY submission_date DESC";
 $result = mysqli_query($conn, $query);

 if ($result) {
     echo "<div class='submissions'><h1>Contact Form Submissions</h1>";
     while ($row = mysqli_fetch_assoc($result)) {
         echo "<div class='submission'>";
         echo "<h2>Name: " . htmlspecialchars($row['name']) . "</h2>";
         echo "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
         echo "<p><strong>Message:</strong> " . htmlspecialchars($row['message']) . "</p>";
         echo "<p><strong>Submission Date:</strong> " . htmlspecialchars($row['submission_date']) . "</p>";
         echo "</div>";
     }
     echo "</div>";
 } else {
     echo "Error: " . mysqli_error($conn);
 }



?>