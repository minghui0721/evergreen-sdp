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
        $checkQuery = "SELECT * FROM course_program WHERE course_name = '$courseName' AND program_name = '$programName'";
        $result = mysqli_query($conn, $checkQuery);
        $existingRecord = mysqli_fetch_assoc($result);
        $img = "noChange";
    }
}

    // Check if the record already exists in course_program
    $checkQuery = "SELECT * FROM course_program WHERE course_name = '$courseName' AND program_name = '$programName'";
    $result = mysqli_query($conn, $checkQuery);


    if (mysqli_num_rows($result) > 0) {
        $existingRecord = mysqli_fetch_assoc($result);
        $courseProgram_ID = $existingRecord['courseProgram_ID'];

         // Check if the other attributes are also the same
         if ($existingRecord['course_description'] == $courseDescription && 
         $existingRecord['program_description'] == $programDescription && 
         ($existingRecord['img'] == $img || ($img == "noChange"))){
            echo '<script>alert("Warning: Record already exists.");</script>';
            echo '<script>window.location.href = "course_view.php";</script>';
            exit;
        } else{
            // Check if the user wants to update the image
            if ($img !== "noChange") {
                $updateCourseProgramQuery = "UPDATE course_program SET course_name=?, program_name=?, course_description=?, program_description=?, img=? WHERE courseProgram_ID=?";
                $stmt = mysqli_prepare($conn, $updateCourseProgramQuery);
                mysqli_stmt_bind_param($stmt, "sssssi", $courseName, $programName, $courseDescription, $programDescription, $img, $courseProgram_ID);
                $updateSuccess = mysqli_stmt_execute($stmt);
                $action = "changeImage";
            } else {
                // User wants to keep the existing image
                $updateCourseProgramQuery = "UPDATE course_program SET course_name=?, program_name=?, course_description=?, program_description=? WHERE courseProgram_ID=?";
                $stmt = mysqli_prepare($conn, $updateCourseProgramQuery);
                mysqli_stmt_bind_param($stmt, "ssssi", $courseName, $programName, $courseDescription, $programDescription, $courseProgram_ID);
                $updateSuccess = mysqli_stmt_execute($stmt);
                $action = "sameImage";
            }

                
            if ($updateSuccess) {
                echo '<script>alert("Course details updated successfully!");</script>';
            } else {
                echo '<script>alert("Course details update failed!");</script>';
            }
            mysqli_stmt_close($stmt);
            echo '<script>window.location.href = "course_view.php";</script>';
            exit;

            }
        }
        
    if (isset($_POST['courseProgram_ID']) && !empty($_POST['courseProgram_ID'])) {
            // UPDATE existing course record
            $courseProgram_ID = $_POST['courseProgram_ID'];;
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
            
            // Update existing record in course_program
            $updateCourseProgramQuery = "UPDATE course_program SET course_name=?, program_name=?, course_description=?, program_description=?, img=? WHERE courseProgram_ID=?";
            $stmt = mysqli_prepare($conn, $updateCourseProgramQuery);
            mysqli_stmt_bind_param($stmt, "sssssi", $courseName, $programName, $courseDescription, $programDescription, $img, $_POST['courseProgram_ID']);  
            $updateSuccess = mysqli_stmt_execute($stmt);
            
            if ($updateSuccess) {
                echo '<script>alert("Course details updated successfully2!");</script>';
            } else {
                echo '<script>alert("Course details update failed!");</script>';
            }
            
            echo '<script>window.location.href = "course_view.php";</script>';
            mysqli_stmt_close($stmt);
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
                echo '<script>alert("Course details inserted unsuccessfully!");</script>';
                echo '<script>window.location.href = "course_view.php";</script>';
        } 
        // Close the prepared statement
        mysqli_stmt_close($stmt);
        }    
    }
?>
