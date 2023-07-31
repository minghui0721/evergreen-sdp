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

// Retrieve assignment_id and student_id from URL
if (isset($_GET['subject_id']) && isset($_GET['assignment_id'])) {
    $assignmentID = $_GET['assignment_id'];
    $studentID = 1; // You can set this to the appropriate student ID
} else {
    echo "Error: Assignment ID or Student ID not provided in the URL.";
    exit;
}

// Step 2 - Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a file was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['file'];
        $file_name = $file['name'];
        $file_tmp = $file['tmp_name'];

        // Move the uploaded file to a specific directory (e.g., uploads/)
        $upload_directory = 'uploads/';
        $file_path = $upload_directory . $file_name;
        move_uploaded_file($file_tmp, $file_path);

        // Step 3 - Insert data into the database
        $sql = "INSERT INTO assignment_submission (assignment_ID, student_ID, submission_file, submission_date) 
                VALUES ('$assignmentID', '$studentID', '$file_name', NOW())";

        if (mysqli_query($connection, $sql)) {
            echo "File uploaded and data inserted successfully.";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($connection);
        }
    } else {
        echo "Error: File upload failed.";
    }
}

// Close the database connection
mysqli_close($connection);
?>
