<?php
$host = "localhost";
$username = "root";
$password = ""; //null
$dbname = "userinfo";

$conn = mysqli_connect($host,$username,$password,$dbname); //connection established with database

if(!$conn){
    die("connection failed: ".mysqli_connect_error()); //displaying the error we are getting if connection failed 
}
