<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("sorry we failed to connect : ".mysqli_connect_error());

}   else {
    echo "connection was successful";
} 

$name="me";
$role="idar";





$sql= "INSERT INTO `userinfo` ( `name`, `email`, `concern`, `dt`) VALUES ( '$name', '$email', '','2024-03-25 17:04:17')";

$result=mysqli_query($conn,$sql);

if ($result) {
    # code...
    echo "the recode been inserted   successfuly";

}else{
    echo "the recode not inserted  ".mysqli_error($conn);
}
?>
