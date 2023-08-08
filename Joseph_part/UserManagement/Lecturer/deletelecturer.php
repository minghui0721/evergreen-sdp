<?php
include 'dbConn.php';

if(isset($_GET['lecturer_ID'])) {
    $student_ID = $_GET['lecturer_ID'];

    // Create the DELETE query to remove the student record
    $query = "DELETE FROM lecturer WHERE lecturer_ID = '$lecturer_ID'";

    // Execute the query
    if(mysqli_query($connection, $query)) {
        echo 'Lecturer record deleted successfully!';
    } else {
        echo 'Error deleting record: ' . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>