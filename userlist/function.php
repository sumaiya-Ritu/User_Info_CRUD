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

            $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC); //input not valid - user parameter strip - httml decode sanitize - body html content - input sanitize is important. - to prevent script execution

            $data = [
                'status' => 200,
                'message' => 'User list fetched successfully',
                'data' => $res, //sending data in response
            ];
            header("http/1.0 200 User list fetched successfully");
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
            'status' => 500,
            'message' => 'Internal Server Error',
        ];

        header("http/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}

//error422 fucntion declaration
function error422($message)  //403/authorize can be applied
{

    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("http/1.0 422 Entity not found");
    return json_encode($data);
    exit();
}

//declarion the get users for single id call
function getusers($userparams)
{
    global $conn;

    if ($userparams['id'] == null) {

        return error422('Enter your user ID');
    }
    
    $userID = mysqli_real_escape_string($conn, $userparams['id']); //passing the user id parameter in user id function

    $query = "SELECT * FROM users WHERE id = '$userID' LIMIT 1"; //can use index here too to not use limit 
    $result = mysqli_query($conn, $query);

    if ($result) {

        //for checking 1 record at a time
        if (mysqli_num_rows($result) == 1) {

            $res = mysqli_fetch_assoc($result);

            $data = [

                'status' => 200,
                'message' => 'User Fetched successfully',
                'data' => $res,
            ];
            header("http/1.0 200 User Ok");
            return json_encode($data);
        } else {
            $data = [
                'status' => 404,
                'message' => 'No user Found',
            ];

            header("http/1.0 404 No user Found");
            return json_encode($data);
        }
    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];

        header("http/1.0 500 Internal Server Error");
        return json_encode($data);
    }
}


