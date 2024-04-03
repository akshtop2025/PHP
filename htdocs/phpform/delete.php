<?php



$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact"; // Replace "your_database_name" with your actual database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);







if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    # code...
    
}
else {
    echo "conection  is successful! <br>";
}

$sql = " DELETE FROM `userinfo` WHERE `name` = 'kevin' LIMIT  10 ";

$result = mysqli_query($conn,$sql);

// $aff=mysqli_affected_rows($conn);
$aff=mysqli_affected_rows($conn);
echo  "Number of Rows Affected :".$aff;
if ($result) {
    # code...
    echo "Delete successfuly"."<br/>";
}
else {
    echo "Error deleting record: " . mysqli_error($conn);
}




?>