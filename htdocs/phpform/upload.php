<?php
// upload.php

// Database connection details
$servername = "localhost";
$username = "root";
$email = " "; // Your email address here
$image = "root"; 
$dbname = "image_uploads";

// Create database connection
$conn = new mysqli($servername , $username, $email,$image,$dbname);

// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $username = $_POST['username'];
    $email = $_POST['email'];
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    // Move uploaded file to target directory
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    // Insert data into database
    $sql = "INSERT INTO image_uploads (username, email, image, upload_date) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $email, $image);

    if ($stmt->execute()) {
        echo "Data has been successfully inserted into the database.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close database connection
    $stmt->close();
    $conn->close();
}
?>