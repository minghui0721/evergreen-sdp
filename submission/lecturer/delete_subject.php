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

// Check if the subject_id parameter is set
if (isset($_GET['id'])) {
    $subjectID = $_GET['id'];
    
    // Delete subject with the given subject_id
    $deleteQuery = "DELETE FROM subject WHERE subject_id = $subjectID";
    if ($connection->query($deleteQuery)) {
        // Redirect back to the original page
        header('Location: lesson_resource.php');
        exit;
    } else {
        echo "Error deleting record: " . $connection->error;
    }
}

// Close connection
$connection->close();
?>
