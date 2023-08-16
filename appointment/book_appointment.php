<?php
include '../database/db_connection.php';

$message = '';  // Define a variable to hold the message.

if (isset($_POST['appointment_slot'])) {
    list($setID, $startTime) = explode(',', $_POST['appointment_slot']);

    // Assuming you have the student_ID in session or any global context. 
    // For this example, I'm just using a placeholder
    // $studentID = $_SESSION['student_ID']; 
    $studentID = "1"; 

    // Fetch the lecturer_ID and appointment_date from the appointment_set table using the setID
    $sql = "SELECT lecturer_ID, appointment_date FROM appointment_set WHERE appointmentSet_ID = $setID";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lecturerID = $row['lecturer_ID'];
        $appointmentDate = $row['appointment_date'];

        // Insert into the appointment table
        $stmt = $conn->prepare("INSERT INTO appointment (lecturer_ID, student_ID, appointment_date, appointment_time, status) VALUES (?, ?, ?, ?, 'Pending')");
        $appointmentTime = $startTime;
        $stmt->bind_param("iiss", $lecturerID, $studentID, $appointmentDate, $appointmentTime);

        if ($stmt->execute()) {
            $message = "Appointment booked successfully!";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $message = "Error fetching appointment details!";
    }
} else {
    $message = "No appointment slot selected!";
}

$conn->close();
?>

<html>
<head>
    <script>
        alert('<?php echo $message; ?>');  // Display the message in a browser alert.
        window.location.href = 'select_appointment.php';  // Redirect to 'select_appointment.php'.
    </script>
</head>
<body>
</body>
</html>

