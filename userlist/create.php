<?php

// error_reporting(0);

header('Access-Control-Allow-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');


include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];


if ($requestMethod == 'POST') {


    $inputData = json_decode(file_get_contents("php://input"), true); //sending data in array format > true. false > object format 

    if (empty($inputData)) {

        $storeUser = storeUserinfo($_POST); //form data value passing via post


    } else {

        $storeUser = storeUserinfo($inputData);
    }
    echo $storeUser;
} else {

    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];

    header("http/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
?>