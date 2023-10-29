<?php

// error_reporting(0);

header('Access-Control-Allow-origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');


include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];


if ($requestMethod == 'PUT') {


    $inputData = json_decode(file_get_contents("php://input"), true);

    // if (empty($inputData)) {
    //     $UpdateUser = UpdateUser($_POST,$_GET); //form data value passing via post //sending one parameter as id  and post for form type data
    // } 

    $UpdateUser = UpdateUser($inputData, $_GET); //directly using raw data to update
    echo $UpdateUser;
} else {

    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];

    header("http/1.0 405 Method Not Allowed");
    echo json_encode($data);
}
