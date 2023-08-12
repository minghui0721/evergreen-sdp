<?php
// Include your database connection code here
include '../database/db_connection.php';



// Retrieve parameters from the AJAX request
$lecturer_ID = $_POST['lecturer_ID'];
$appointmentDate = $_POST['appointmentDate'];
$startTime = $_POST['startTime'];

// Prepare and execute the SQL query
$queryStudent = "SELECT s.student_name 
                FROM appointment a 
                JOIN student s ON a.student_ID = s.student_ID 
                WHERE a.lecturer_ID = ? 
                AND a.appointment_date = ? 
                AND a.appointment_time = ? 
                LIMIT 1";

$stmt = $conn->prepare($queryStudent);
$stmt->bind_param("iss", $lecturer_ID, $appointmentDate, $startTime);

if (!$stmt->execute()) {
    die(json_encode(["success" => false, "message" => "Query failed: " . $stmt->error]));
}

$resultStudent = $stmt->get_result();
$studentRow = $resultStudent->fetch_assoc();

// Debugging: Output received data
echo json_encode(["debug" => $_POST]);


if ($studentRow) {
    $studentName = $studentRow['student_name'];
    echo json_encode(["success" => true, "studentName" => $studentName]);
} else {
    echo json_encode(["success" => false, "message" => "No student details found"]);
}
?>
