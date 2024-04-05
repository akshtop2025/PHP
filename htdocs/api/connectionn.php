<?php
// Database credentials
$host = 'localhost'; 
$username = 'root';
$password = '';
$dbname = 'imageget';

// Attempt to connect to the database
$conn =  mysqli_connect($host, $username, $password,$dbname );

// Check connection   yes    and no 
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";
?>
