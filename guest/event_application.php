<?php
include '../database/db_connection.php';

//POST Method
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $id = $_POST["event_id"];


    $sql = "INSERT INTO event_application (event_ID, first_name, last_name, email) VALUES ('$id', '$firstname', '$lastname', '$email')";

    if($conn->query($sql) === TRUE){
        //Submission successfully
        echo '<script>alert("Form submitted successfully!"); window.location.href = "event.php";</script>';
        
    } else {
        // Error occured during submission
        echo '<script>alert("An error occurred. Please try again later.");</script>';
    }
} 
?>


