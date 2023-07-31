<?php
include "../dbConn.php";
$student_ID = 1; // The student ID for which you want to check the submission status

// Assuming 'submission_file' is the field containing the file path or identifier
$sqlSubmissionStatus = "SELECT submission_file FROM assignment_submission WHERE student_ID = $student_ID";
$resultSubmissionStatus = mysqli_query($connection, $sqlSubmissionStatus);

if ($resultSubmissionStatus) {
    if (mysqli_num_rows($resultSubmissionStatus) > 0) {
        // Fetch the submission file data
        $submissionData = mysqli_fetch_assoc($resultSubmissionStatus);
        $submissionStatus = "Submitted for Grading";

        // Check if the file exists
        if (file_exists($submissionData['submission_file'])) {
            $submissionStatus = "Submitted for Grading";
        } else {
            $submissionStatus = "Not Submitted";
        }
    } else {
        // No record found for the student ID
        $submissionStatus = "Not Submitted";
    }

    // Output the submission status
    echo "Submission Status: " . $submissionStatus;

    // Don't forget to free the result after use
    mysqli_free_result($resultSubmissionStatus);
} else {
    // Handle the case when the query fails
    echo 'Error: ' . mysqli_error($connection);
}