<?php
include 'dbConn.php';

if(isset($_GET['student_ID'])) {
    $student_ID = $_GET['student_ID'];

    // Create the DELETE query to remove the student record
    $query = "DELETE FROM student WHERE student_ID = '$student_ID'";

    // Execute the query
    if(mysqli_query($connection, $query)) {
        echo "<script>alert('Student record deleted successfully!');</script>";
        header("Location: studentlist.php");
    } else {
        echo 'Error deleting record: ' . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>