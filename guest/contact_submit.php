<?php
include '../database/db_connection.php';


//POST Method
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    $sql = "INSERT INTO contact_us (first_name, last_name, email, phone, message) VALUES ('$firstname', '$lastname', '$email', '$phone', '$message')";

    if($conn->query($sql) === TRUE){
        //Submission successfully
        echo '<script>alert("Form submitted successfully!"); window.location.href = "contact_us.php";</script>';
        
    } else {
        // Error occured during submission
        echo '<script>alert("An error occurred. Please try again later.");</script>';
    }
} 
?>