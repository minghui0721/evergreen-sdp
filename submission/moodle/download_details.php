<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

// Step 1 - Database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check database connection
if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());
}

if (isset($_GET['assignmentDetails_ID'])) {
    $requestedAssignmentDetailsID = (int)$_GET['assignmentDetails_ID'];

    // Query the specific assignment details based on the requested assignmentDetails_ID
    $sqlAssignmentDetails = "SELECT * FROM assignment_details WHERE assignmentDetails_ID = $requestedAssignmentDetailsID";
    $resultAssignmentDetails = mysqli_query($connection, $sqlAssignmentDetails);

    if ($resultAssignmentDetails && $resultAssignmentDetails->num_rows > 0) {
        $assignmentDetails = $resultAssignmentDetails->fetch_assoc();

        // Use the assignment_title as the filename
        $downloadFilename = $assignmentDetails['assignment_title'] . '.docx';

        // Get the binary data of the file (adjust the column name accordingly)
        $fileBinaryData = $assignmentDetails['assignment_file'];

        // Send the appropriate headers to trigger the download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $downloadFilename . '"');
        header('Content-Length: ' . strlen($fileBinaryData));
        header('Content-Transfer-Encoding: binary');

        // Output the binary data to the browser
        echo $fileBinaryData;
        exit;
    }
}   