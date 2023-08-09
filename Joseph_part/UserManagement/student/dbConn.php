<?php
$host = 'localhost';//127.0.0.1
$user = 'root';
$password = '';
$database = 'test';
// Step 1 - Database connection
$connection = mysqli_connect($host,$user,$password,$database);

// check your database connection
if($connection === false){
    die('Connection failed' . mysqli_connection());
}
?>