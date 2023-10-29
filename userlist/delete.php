<?php

header('Access-Control-Allow-origin:*'); 
header('Content-Type: application/json'); 
header('Access-Control-Allow-Method: DELETE'); 
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Request-With'); 


$requestMethod = $_SERVER["REQUEST_METHOD"];
include('function.php');

if ($requestMethod == "DELETE") {

        $deleteUser = deleteUser($_GET); //we will get the id here to delete the user
        echo $deleteUser;
}
 else {

    $data = [
        'status' => 405,
        'message' => $requestMethod . ' Method Not Allowed',
    ];

    header("http/1.0 405 Method Not Allowed");
    echo json_encode($data); 
   
}
