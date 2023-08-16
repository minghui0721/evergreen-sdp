<?php

include '../database/db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $lecturerId = 1; // Assuming you have the lecturer ID, modify as needed
    $appointmentDate = $_POST['appointment-date'];
    $startTime = $_POST['start-time'];
    $endTime = $_POST['end-time'];
    $platform = $_POST['platform'];

    // Validate the data if needed

    // Prepare and execute the SQL query
    $query = "INSERT INTO appointment_set (lecturer_ID, appointment_date, start_time, end_time, platform) 
              VALUES ('$lecturerId', '$appointmentDate', '$startTime', '$endTime', '$platform')";

    if ($conn->query($query) === TRUE) {
        echo json_encode(["success" => true]);
        
    } else {
        echo json_encode(["success" => false, "message" => "Error inserting record: " . $conn->error]);
    }

    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Only POST request allowed."]);
}

?>
