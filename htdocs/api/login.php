<?php

include("token.php");


        $password =$json_data['password'];
        $mo =  $json_data['mo'];

        $sqlQuery = "SELECT * FROM leads WHERE password = '$password' AND mo = '$mo'";

        $result = mysqli_query($conn, $sqlQuery);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[] = $row;
                    // echo "Name: " . $row["mo"] . " - MO: " . $row["password"] . "<br> Data is already in the database<br><br>";
                    echo "number: " . $row["mo"] . " password: " . $row["password"] . "\nData is already in the database\n\n";

                }
                $msg = "Login successful.";
                $isSuccess = true;
            } else {
                $msg = "invalid number and password.";
                $isSuccess = false;
            }
            mysqli_free_result($result); 
        } 
 

$response = [
    'data' => [],
    'mo'=>$mo,
    'password'=>$password,
    'msg' => $msg,
    'isSuccess' => $isSuccess,
];

echo json_encode($response);

?>
