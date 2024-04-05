<?php
include("token.php");

if ($token_status) {
    $json_data = json_decode(file_get_contents('php://input'), true);

    $name = $json_data['name'] ?? '';
    $password = $json_data['password'] ?? '';
    $mo = $json_data['mo'] ?? '';

    $msg = '';
    $isSuccess = false;
    $data = [];

    if (!empty($name) && !empty($password) && !empty($mo)) {
        $insertQuery = "INSERT INTO leads (name, password, mo) VALUES ($name,$password,$mo)";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bind_param("sss", $name, $password, $mo);
        if ($insertStmt->execute()) {
            $msg = "Data inserted successfully.";
            $isSuccess = true;
        } else {
            $msg = "Error inserting data.";
        }
    }

    if (!empty($password) && !empty($mo)) {
        $selectQuery = "SELECT * FROM leads WHERE password = ? AND mo = ?";
        $selectStmt = $conn->prepare($selectQuery);
        $selectStmt->bind_param("ss", $password, $mo);
        $selectStmt->execute();
        $result = $selectStmt->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $msg = "Login successful.";
            $isSuccess = true;
        } else {
            $msg = "Invalid number and password.";
        }
    }
} else {
    $msg = "Invalid token.";
}

$response = ['data' => $data, 'status' => 200, 'msg' => $msg, 'isSuccess' => $isSuccess];
echo json_encode($response);
?>
