<?php
include '../database/db_connection.php';


//POST Method
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST["email"];

    $sql = "INSERT INTO guest (email) VALUES ('$email')";

    if($conn->query($sql) === TRUE){
        //Submission successfully
        echo '<script>alert("Email submitted successfully!"); window.location.href = "index.php";</script>';
        
    } else {
        // Error occured during submission
        echo '<script>alert("An error occurred. Please try again later.");</script>';
    }
} 
?>