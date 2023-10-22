<?php

require '../index/dbcon.php';
//conncetion database

//declaring getuserlist fucntion
function getuserList()
{

    global $conn;

    $query = "SELECT * FROM users";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
            $data = [
                'status' => 200,
                'message' => 'User list fetched successfully',
                'data'=> $res, //sending data in response
            ];
            header("http/1.0 404 User list fetched successfully");
            return json_encode($data);
        } else {

            $data = [
                'status' => 404,
                'message' => 'User data not found',
            ];

            header("http/1.0 404 User data not found");
            return json_encode($data);
        }
    } else {

        $data = [
            'status' => 505,
            'message' => 'Internal Server Error',
        ];

        header("http/1.0 505 Internal Server Error");
        return json_encode($data);
    }
}

//error422 fucntion declaration
function error422($message){

    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("http/1.0 422 Entity not found");
    return json_encode($data);
    exit();
}

//declarion the get users for single id call
function getusers($userparams)  {
    global $conn;

    if($userparams['id'] == null){

        return error422('Enter your user ID');
    }
}

function error22($message){

    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("http/1.0 422 Entity not found");
    return json_encode($data);
    exit();
}


?>
