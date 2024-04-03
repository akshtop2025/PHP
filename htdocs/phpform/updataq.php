
<!-- bake che update ne query  -->


<?php
// Establish connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact"; // Replace "your_database_name" with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Your SQL query
$sql = "DELETE FROM userinfo WHERE NAME = 'ronak patel'";



// Execute the query
$result = mysqli_query($conn, $sql);

// Check if query executed successfully
$no=1;
if ($result !== false) { // Check if $result is not false
    // Check if there are any rows returned
    $row_count = mysqli_num_rows($result);
    
    if ($row_count > 0) {
        // Process results
        while ($row = mysqli_fetch_assoc($result)) {
            // Process each row
            echo "yes this is a data\n";
            echo var_dump($row);
            echo $no.": Name - ".$row['NAME']."welcome to ".$row['name'];
            echo "<br />\n";
            $no = $no+1;
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
