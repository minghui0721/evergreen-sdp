<?php
// Database connection and other setup code

if (isset($_POST['btnSubmit'])) {
    $gradeID = $_POST['gradeID'];
    $studentID = $_GET['student_id'];
    $grade = $_POST['grade'];
    $gradeGet = $_GET['grade'];
    $examID = $_GET['exam_id'];
    $courseProgramID = $_GET['courseProgram_id'];
    $prevPage = $_GET['prevPage'];

    echo $grade;

    // Database connection parameters
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

    // Check if a grade record exists for the student and exam
    $checkQuery = "SELECT * FROM grade WHERE student_ID = $studentID AND exam_id = $examID";
    $checkResult = $connection->query($checkQuery);

    if ($gradeGet == 0) {
        // Insert a new grade record
        $insertQuery = "INSERT INTO grade (exam_ID, courseProgram_ID, student_ID, grade) VALUES ('$examID', '$courseProgramID', '$studentID', '$grade')";
        $insertResult = $connection->query($insertQuery);

        if ($insertResult) {
            echo '<script>alert("Exam grade inserted successfully!");</script>';
        } else {
            echo '<script>alert("Error inserting exam grade: ' . $connection->error . '");</script>';
        }
    } else {
        // Update the existing grade record
        if ($checkResult->num_rows > 0) {
            $updateQuery = "UPDATE grade SET grade = ? WHERE grade_ID = ?";
            $updateStmt = $connection->prepare($updateQuery);
            $updateStmt->bind_param('di', $grade, $gradeID);
        
            $updateResult = $updateStmt->execute();
        
            if ($updateResult) {
                echo '<script>alert("Exam grade updated successfully!");</script>';
            } else {
                echo '<script>alert("Error updating exam grade: ' . $updateStmt->error . '");</script>';
            }
        
            $updateStmt->close();
        } else {
            echo '<script>alert("Error: Grade record not found.");</script>';
        }
    }

    // Redirect back to the previous page
    echo '<script>window.location.href = "' . $prevPage . '";</script>';
    exit(); // Terminate the script

    // Close connection
    $connection->close();
}
?>
<!-- Rest of your HTML code -->
