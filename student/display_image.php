<?php
session_start();
include '../database/db_connection.php';

if (isset($_GET['student_id'])) {
    $studentId = $_GET['student_id'];
    
    // Retrieve the image data based on the student's ID
    $query = "SELECT img, img_type FROM `student` WHERE `student_ID`='$studentId'";
    $result = mysqli_query($conn, $query);
    
    if ($row = mysqli_fetch_assoc($result)) {
        header('Content-Type: ' . $row['img_type']);
        echo $row['img'];
        exit;
    }
}

// If student ID is not provided or image data is not found, return a default image
header('Content-Type: image/jpeg'); // Set the appropriate content type
readfile('path_to_default_image/default.jpg'); // Replace with the path to your default image
