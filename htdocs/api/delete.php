
<?php

include("token.php");

if ($token_status) {
    // date_default_timezone_set("Asia/Kolkata");
    // $today = date('Y-m-d');
    $name="";
    // $name = $json_data['name'];
    // $mo = $json_data['mo'];



    $sqlRes = mysqli_query($conn, "DELETE FROM leads WHERE name = '$name'");

    $sqlRes = mysqli_query($conn, "SELECT * FROM leads");

   


    $data = [];
    if (mysqli_num_rows($sqlRes) > 0) {
        while ($row = mysqli_fetch_assoc($sqlRes)) {
            $data[] = $row;
        }
        $msg = "successfully verified";
        $isSuccess = true;
    } else {
        $msg = "invalid username and password";
        $isSuccess = false;
    }
    $total_Leads = mysqli_num_rows($sqlRes);
}

echo json_encode(['data' => $data, 'status' => 200, 'msg' => $msg, 'isSuccess' => $isSuccess, 'total_lead' => $total_Leads]);