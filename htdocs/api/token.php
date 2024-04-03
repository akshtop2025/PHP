<?php

include("connection.php");
header('Content-Type:application/json');
$json_data = json_decode(file_get_contents('php://input'), true);
$all_headers = getallheaders();
$checkTokenRes = "agdftGTDFDYK5468.UR887535644747";
$token_status = true;
if (isset($all_headers['token'])) {
    $token = $all_headers['token'];

    if ($checkTokenRes == $token) {
        $token_status = true;
    } else {
        $isSuccess = false;
        $msg  = "Please provide valid API token";
    }
} else {
    $isSuccess = false;
    $msg  = "Please provide API token";
}