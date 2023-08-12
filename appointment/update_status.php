<?php

header('Content-Type: application/json');

// Database connection (I assume you have this from previous examples)
$conn = new mysqli('localhost', 'root', '', 'evergreen_heights_university');

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['studentId']) && isset($data['action'])) {
        $studentId = $conn->real_escape_string($data['studentId']);
        $action = $conn->real_escape_string($data['action']);
        $start = $conn->real_escape_string($data['startTime']);
        

        if ($action === 'approve') {
            // Run approve code
            if (isset($data['status'])) {
                $status = $conn->real_escape_string($data['status']);
                $query = "UPDATE appointment SET status='$status' WHERE student_ID='$studentId' AND appointment_time = '$start'";
                if ($conn->query($query) === TRUE) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error updating record: " . $conn->error]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Invalid input."]);
            }
        } elseif ($action === 'reject') {
            // Run reject code
            if (isset($data['status']) && isset($data['reason'])) {
                $status = $conn->real_escape_string($data['status']);
                $reason = $conn->real_escape_string($data['reason']);
                $query = "UPDATE appointment SET status='$status', reject_reason='$reason' WHERE student_ID='$studentId' AND appointment_time ='$start'";
                if ($conn->query($query) === TRUE) {
                    echo json_encode(["success" => true]);
                } else {
                    echo json_encode(["success" => false, "message" => "Error updating record: " . $conn->error]);
                }
            } else {
                echo json_encode(["success" => false, "message" => "Invalid input."]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "Invalid action."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Invalid input."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Only POST request allowed."]);
}

$conn->close();
?>
