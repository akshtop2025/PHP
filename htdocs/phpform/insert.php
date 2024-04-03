<?php

// echo "aksh";

/**
 * ways to connect to a MySQL Database
 * MYSQLi extenstion
 * PDO
 */

  //MYSQLI EXTENSION
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aksh";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);


if (!$conn) {
  die("sorry we failed to connect : ".mysqli_connect_error());
}

echo "connection was successful";

?>