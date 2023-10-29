<?php

require '../index/dbcon.php';
// include('create.php');

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

//storing user function 

function storeUserinfo($userInput)
{
    global $conn;

    $User_name = mysqli_real_escape_string($conn, $userInput['User_name']);
    $Frist_name = mysqli_real_escape_string($conn, $userInput['Frist_name']);
    $Last_name = mysqli_real_escape_string($conn, $userInput['Last_name']);
    $Email = mysqli_real_escape_string($conn, $userInput['Email']);
    $Phone = mysqli_real_escape_string($conn, $userInput['Phone']);
    $Address = mysqli_real_escape_string($conn, $userInput['Address']);
    //console. log($User_name,$First_name,$Last_name,$Email,$Phone,$Address); 

    if (empty($User_name) || empty($Frist_name) || empty($Last_name) || empty($Email) || empty($Phone) || empty($Address)) {
        return error422('Please fill in all required fields.');
    } else {
        $query = "INSERT INTO users (User_name, Frist_name, Last_name, Email, Phone, Address) VALUES ('$User_name', '$Frist_name', '$Last_name', '$Email', '$Phone', '$Address')";

        $create = mysqli_query($conn, $query);

        if ($create) {
            $data = [
                'status' => 201,
                'message' => 'User Created Successfully',
            ];
            header("HTTP/1.0 201 Created");
            return json_encode($data);
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return json_encode($data);
        }
    }
}

//update user infor function

function UpdateUser($userInput, $userparams)
{
    global $conn;

    if (!isset($userparams['id'])) {
        return error422('User ID not found');
    } elseif($userparams['id'] == null) {

        return error422('Enter the User ID:');
    }

    $userID = mysqli_real_escape_string($conn,$userparams['id']);
    $User_name = mysqli_real_escape_string($conn, $userInput['User_name']);
    $Frist_name = mysqli_real_escape_string($conn, $userInput['Frist_name']);
    $Last_name = mysqli_real_escape_string($conn, $userInput['Last_name']);
    $Email = mysqli_real_escape_string($conn, $userInput['Email']);
    $Phone = mysqli_real_escape_string($conn, $userInput['Phone']);
    $Address = mysqli_real_escape_string($conn, $userInput['Address']);

    if(empty(trim($User_name))){
        return error422('Enter your User_name:');
    } elseif(empty(trim($Frist_name))){
        return error422('Enter your Frist_name:');
    }else if(empty(trim($Last_name))){
        return error422('Enter your Last_name:');
    }else if(empty(trim($Email))){
        return error422('Enter your Email:');
    } else if(empty(trim($Phone))){
        return error422('Enter your Phone:');
    }else if (empty(trim($Address))){
        return error422('Enter your Address:');
    }
    else 
    {
     $query = "UPDATE users SET User_name= '$User_name',Frist_name='$Frist_name',Last_name='$Last_name',Email='$Email',Phone='$Phone',Address='$Address' WHERE id = '$userID' LIMIT 1 ";

     $updateUser = mysqli_query($conn,$query);

     if ($updateUser){
        $data = [
            'status' => 200,
            'message' => 'User updated',
        ];
        header("HTTP/1.0 200 User updated");
            return json_encode($data);
     } else{
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error',
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return json_encode($data);
     }

    }


}
