<?php
// Include the database connection file
include '../database/db_connection.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $courseName = $_POST['course_name'];
    $programName = $_POST['program_name'];
    $courseDescription = $_POST['course_description'];
    $programDescription = $_POST['program_description'];

    $img = null;
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES["img"]["tmp_name"];
        $img = file_get_contents($file_tmp_name);
    } else {
        $errorMessage = "File upload failed. Error code: " . $_FILES["img"]["error"];
        echo '<script>console.error("' . $errorMessage . '");</script>';
    }




    // Check if the record already exists in course_program
    $checkQuery = "SELECT * FROM course_program WHERE course_name = '$courseName' AND program_name = '$programName'";
    $result = mysqli_query($conn, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Error: Record added already exists.");</script>';
        echo '<script>window.location.href = "course_create.php";</script>';
    } else{
        $insertCourseProgramQuery = "INSERT INTO course_program (course_name, program_name, course_description, program_description, img) VALUES (?, ?, ?, ?, ?)";

        // Use prepared statement for INSERT
        $stmt = mysqli_prepare($conn, $insertCourseProgramQuery);

        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "sssss", $courseName, $programName, $courseDescription, $programDescription, $img);

        // Execute the prepared statement
        $insertSuccess = mysqli_stmt_execute($stmt);

        // Check if the insertion was successful
        if ($insertSuccess) {
            // Insertion successful
            $courseProgramID = mysqli_insert_id($conn);

            $intakes = [
                    'January' => '2023-01-16',
                    'July' => '2023-07-10',
                    'November' => '2023-11-13'
            ];
            foreach ($intakes as $intakeValue => $openingDate) {
                $insertCourseDetailsQuery = "INSERT INTO intake (courseProgram_ID, intake, opening_date) VALUES ('$courseProgramID', '$intakeValue', '$openingDate')";
                $insertDetailsSuccess = mysqli_query($conn, $insertCourseDetailsQuery);
            }
            
            if ($insertSuccess && $insertDetailsSuccess) {
                // Insertions successful
                echo '<script class="">alert("Course details inserted successfully!");</script>';
                echo '<script>window.location.href = "course_view.php";</script>';
            } else {
                // Insertion failed
                echo '<script>alert("Course details inserted successfully!");</script>';
                echo '<script>window.location.href = "course_view.php";</script>';
        } else {
            // Insertion failed
            echo '<script>alert("Course details inserted successfully!");</script>';
            echo '<script>window.location.href = "course_view.php";</script>';
            }

        // Close the prepared statement
        mysqli_stmt_close($stmt);
        }
    } }
?>
