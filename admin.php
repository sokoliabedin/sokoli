<?php
include("database.php");
session_start();

include("Addproducts.php");




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    $aboutUsHeading = mysqli_real_escape_string($conn, $_POST["aboutUsHeading"]);
    $aboutUsContent = mysqli_real_escape_string($conn, $_POST["aboutUsContent"]);
    $addedBy = mysqli_real_escape_string($conn, $_POST["added_by"]); // Added line

    $targetDir = "images/";  // Specify the directory where you want to store images
    $targetFile = $targetDir . basename($_FILES["aboutUsImage"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if the file is a valid image
    $check = getimagesize($_FILES["aboutUsImage"]["tmp_name"]);
    if ($check === false) {
        echo "File is not a valid image.";
        $uploadOk = 0;
    }

    // Check if the file already exists
    if (file_exists($targetFile)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["aboutUsImage"]["size"] > 50000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedFormats = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1 && move_uploaded_file($_FILES["aboutUsImage"]["tmp_name"], $targetFile)) {
        // Insert data into the database with added_by information
        $query = "INSERT INTO about_us_content (heading, content, image_path, added_by) VALUES ('$aboutUsHeading', '$aboutUsContent', '$targetFile', '$addedBy')";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "About Us content added successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styleofadmin.css">

</head>
<body>
<div class="container">
 <a href="index3.php" class="logout-button">Logout</a>
</div>
<div>
    <?php
   include("Clientsfeeds.php")
    ?>
</div>


    <h1>Welcome, Administrator!</h1>
    <p>This is your dashboard. Add your content and features here.</p>
    
    <form action="admin.php" method="post" enctype="multipart/form-data">
    <label for="productName">Product Name:</label>
    <input type="text" name="productName" required>
    <br>
    
    <label for="productPrice">Product Price:</label>
    <input type="number" step="0.01" name="productPrice" required>
    <br>
    
    <label for="productImage">Product Image:</label>
    <input type="file" name="productImage" accept="image/*" required>
    <br>
    
    <input type="submit" value="Add Product">
</form>
   



    <form action="admin.php" method="post" enctype="multipart/form-data">
        <label for="menuItemName">Menu Item Name:</label>
        <input type="text" name="menuItemName" required>
        <br>

        <label for="menuItemPrice">Menu Item Price:</label>
        <input type="number" step="0.01" name="menuItemPrice" required>
        <br>

        <label for="menuItemImage">Menu Item Image:</label>
        <input type="file" name="menuItemImage" accept="image/*" required>
        <br>

        <input type="submit" value="Add Menu Item">
    </form>
    


    <!-- About Us Content Form -->
    <form action="admin.php" method="post" enctype="multipart/form-data">
    <label for="aboutUsHeading">About Us Heading:</label>
    <input type="text" name="aboutUsHeading" required>
    <br>

    <label for="aboutUsContent">About Us Content:</label>
    <textarea name="aboutUsContent" rows="4" required></textarea>
    <br>

    <label for="aboutUsImage">About Us Image:</label>
    <input type="file" name="aboutUsImage" accept="image/*" required>
    <br>

    <label>Select Admin:</label>
    <br>

    <?php
    // Fetch admin users from the database
    $query = "SELECT * FROM users WHERE role = 'admin'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($admin = mysqli_fetch_assoc($result)) {
            echo '<input type="radio" name="added_by" value="' . $admin['username'] . '" required> ' . $admin['username'];
        }
    }
    ?>
    <br>

    <input type="submit" value="Add About Us Content">
</form>




</body>

</html>
