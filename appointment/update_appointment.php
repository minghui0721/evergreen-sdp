<?php
include '../database/db_connection.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


$lecturerID = 1; // Should be replaced with a dynamic method

// Get the JSON data from the POST request
$jsonData = file_get_contents("php://input");

// Decode the JSON data to an associative array
$data = json_decode($jsonData, true);

// Now, retrieve the values from the associative array:
$appointmentDate = $data['appointment-date'];
$startTime = $data['start-time'];
$endTime = $data['end-time'];
$platform = $data['platform'];


$formattedAppointmentDate = date('Y-m-d', strtotime($appointmentDate));
$formattedStartTime = date('H:i:s', strtotime($startTime));
$formattedEndTime = date('H:i:s', strtotime($endTime));

// Check for an existing appointment set record
$existingAppointmentSetSql = "SELECT * FROM appointment_set WHERE lecturer_ID = ?";
$stmt = $conn->prepare($existingAppointmentSetSql);
$stmt->bind_param("i", $lecturerID);
$stmt->execute();
$existingAppointmentSetResult = $stmt->get_result();

if ($existingAppointmentSetResult) {
    if ($existingAppointmentSetResult->num_rows > 0) {
        // Update the existing record
        $updateSql = "UPDATE appointment_set SET appointment_date = ?, start_time = ?, end_time = ?, platform = ? WHERE lecturer_ID = ?";
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("ssssi", $formattedAppointmentDate, $formattedStartTime, $formattedEndTime, $platform, $lecturerID);
        
        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Appointment details updated successfully.";
        } else {
            $response["success"] = false;
            $response["message"] = "Error updating appointment details.";
        }
    } else {
        // Insert a new record
        $insertSql = "INSERT INTO appointment_set (lecturer_ID, appointment_date, start_time, end_time, platform) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("issss", $lecturerID, $formattedAppointmentDate, $formattedStartTime, $formattedEndTime, $platform);
        
        if ($stmt->execute()) {
            $response["success"] = true;
            $response["message"] = "Appointment details saved successfully.";
        } else {
            $response["success"] = false;
            $response["message"] = "Error saving appointment details.";
        }
    }
} else {
    $response["success"] = false;
    $response["message"] = "Error retrieving existing appointment details.";
}

header("Content-Type: application/json");
echo json_encode($response);

?>
