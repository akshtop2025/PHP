<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "contact";


$conn=mysqli_connect($servername, $username, $password,$database);   //Est

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    # code...
}
else {
    echo "<h3>Connected successfully</h3>";
}




$sql=  "SELECT * FROM userinfo ";
$result=mysqli_query($conn,$sql);

// find the number of rows  in result set
if ($result) {
    // Check if there are any rows returned
    $row_count = mysqli_num_rows($result);
    
    if ($row_count > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Process each row
            
// we cn fetch in a better way the while loop
            echo var_dump($row);
           echo "<br />\n";
        }
    } else {
        echo "No records found";
    }
} else {
    // Handle query error
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close connection
mysqli_close($conn);







?>