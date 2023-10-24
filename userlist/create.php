<?php

header('Access-Control-Allow-origin:*'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With');


include('function.php');

$requestMethod = $_SERVER["REQUEST_METHOD"];


if($requestMethod == 'POST'){


$inputData = json_decode(file_get_contents("php://input"),true);
echo $inputData;

}
else {

    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];

    header("http/1.0 405 Method Not Allowed");
    echo json_encode($data); 
}










?>