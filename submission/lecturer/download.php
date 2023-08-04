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

if (isset($_GET['file_id']) && isset($_GET['filename'])) {
    $fileID = $_GET['file_id'];
    $filename = $_GET['filename'];

    // Step 2 - Fetch the submission file from the database
    $sql = "SELECT submission_file FROM assignment_submission WHERE submission_file = '$fileID'";
    $result = mysqli_query($connection, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Step 3 - Retrieve the file content from the database and decode it
        $row = mysqli_fetch_assoc($result);
        $fileContent = base64_decode($row['submission_file']);

        // Step 4 - Set the appropriate HTTP headers for downloading the file with the custom filename
        header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        header("Content-Disposition: attachment; filename=\"" . $filename . ".docx\"");

        // Step 5 - Output the file content and exit
        echo $fileContent;
        exit;
    } else {
        die("File not found.");
    }
} else {
    die("Invalid request.");
}

// Close the database connection
mysqli_close($connection);
?>
