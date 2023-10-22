<?php

header('Access-Control-Allow-origin:*'); //allows everything
header('Content-Type: application/json'); //only json format applicable
header('Access-Control-Allow-Method: GET'); //only get availalbe
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With'); //allows input

$requestMethod = $_SERVER["REQUEST_METHOD"];
include('function.php');

if ($requestMethod == "GET") {

    $userList = getuserList();
    echo $userList;
} else {

    $data = [
        'status' => 405,
        'message' => $requestMethod . 'Method Not Allowed',
    ];

    header("http/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
