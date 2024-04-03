<?php

include("token.php");

if ($token_status) {
    
    if(isset($json_data['name']) && isset($json_data['mo'])) {
        $name = $json_data['name'];
        $mo = $json_data['mo'];

        $sqlRes = mysqli_query($conn, "UPDATE leads SET mo = '$mo' WHERE name = '$name'");

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
    } else {
        $msg = "Name and mo are required fields";
        $isSuccess = false;
        $total_Leads = 0;
    }
}

echo json_encode(['data' => $data, 'status' => 200, 'msg' => $msg, 'isSuccess' => $isSuccess, 'total_lead' => $total_Leads]);
?>
