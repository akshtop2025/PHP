<?php
$conn=mysqli_connect("localhost", "root", "", "erp");
if(mysqli_connect_errno())
{
echo "Connection Fail".mysqli_connect_error();
}



// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Connected successfully";
}


?>