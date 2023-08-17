<?php
include "../../database/db_connection.php";

if ($conn === false) {
    die('Connection failed: ' . mysqli_connect_error());
}

if (isset($_GET['subject_id']) && isset($_GET['assignment_id'])) {
    // Retrieve the subject_id and assignment_id from the URL
    $subjectID = $_GET['subject_id'];
    $assignmentID = $_GET['assignment_id'];

    // Delete the submission from the database
    $sqlDeleteSubmission = "DELETE FROM assignment_submission WHERE subject_ID = $subjectID AND assignment_ID = $assignmentID";
    $resultDeleteSubmission = mysqli_query($conn, $sqlDeleteSubmission);

    if ($resultDeleteSubmission) {
        // Deletion successful, redirect the user back to the course.php page with the updated submission status.
        header("Location: course.php?subject_id=$subjectID&assignment_id=$assignmentID");
        exit;
    } else {
        // Handle the case when the deletion query fails
        echo 'Error: ' . mysqli_error($conn);
    }
} else {
    // Redirect the user back to the course.php page if the required parameters are not provided
    header("Location: course.php");
    exit;
}
?>
