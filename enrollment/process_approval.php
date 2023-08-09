<?php
include '../database/db_connection.php';

if (isset($_GET['action'])) {
    $action = $_GET['action']; // Add this line
    $enrollmentID = $_GET['enrollment_id'];



    if ($action === 'approve') {
        // Retrieve data from enrollment_form table
        $query = "SELECT * FROM enrollment_form WHERE enrollment_ID = $enrollmentID";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Extract data
        $intakeID = $row['intake_ID'];
        $studentName = $row['name'];
        $email = $row['email'];
        $phone = $row['phone'];

        // Set a default password (you can change this as needed)
        $defaultPassword = '123456';

        // Insert data into student table
        $insertQuery = "INSERT INTO student (intake_ID, enrollment_ID, student_name, student_password, reset_token, reset_expiration, email, phone)
                        VALUES ('$intakeID', '$enrollmentID', '$studentName', '$defaultPassword', null, null, '$email', '$phone')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            $updateQUery = "UPDATE enrollment_form SET status = 'Approved' WHERE enrollment_ID = $enrollmentID";
            $updateResult = mysqli_query($conn, $updateQUery);
            echo "<script>alert('Enrollment request approved successfully');</script>";
            echo "<script>window.location.href = 'enrollment_request.php';</script>"; 
        } else {
            echo "<script>alert('Error occurred while processing the approval');</script>";
            echo "<script>window.location.href = 'enrollment_reqeust.php';</script>"; // 
        }
    } elseif ($action === 'reject') {
        $deleteQuery = "DELETE FROM enrollment_form WHERE enrollment_ID = '$enrollmentID'";
        $deleteResult = mysqli_query($conn, $deleteQuery);
        if ($deleteResult) {
            echo "<script>alert('Enrollment request rejected and deleted successfully');</script>";
            echo "<script>window.location.href = 'enrollment_request.php';</script>"; // Replace with actual URL
        } else {
            echo "<script>alert('Error occurred while rejecting and deleting enrollment request');</script>";
            echo "<script>window.location.href = 'enrollment_request.php';</script>"; // Replace with actual URL
        }
    }
}
?>

