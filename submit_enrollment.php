<?php
include 'database/db_connection.php';

// POST Method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $program_option = $_POST["program_option"];
    $course_option = $_POST["course_option"];
    $intake_option = $_POST["intake_option"];

    $sql_intake = "SELECT intake_ID FROM intake WHERE courseProgram_ID = ? AND intake = ?";

    $stmt = mysqli_prepare($conn, $sql_intake);

    mysqli_stmt_bind_param($stmt, "ss", $course_option, $intake_option);

    mysqli_stmt_execute($stmt);

    $result_intake = mysqli_stmt_get_result($stmt);


    if($result_intake){
        $row_intake = mysqli_fetch_assoc($result_intake);
        $intake_ID = $row_intake['intake_ID'];
    }
}

    $fullname = $_POST["full_name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $birthdate = $_POST["birthdate"];
    $address = $_POST["address"];
    $secondary_school = $_POST["secondary_school"];
    $paymentOption = $_POST["payment_option"];
    $status = "Pending";

    // Handling file upload and storing as BLOB
    $transcript = null; // Initialize $result variable to null
    if (isset($_FILES["transcript"]) && $_FILES["transcript"]["error"] == UPLOAD_ERR_OK) {
        $file_tmp_name = $_FILES["transcript"]["tmp_name"];
        $transcript = file_get_contents($file_tmp_name);
    }


    

    // Insert data into the enrollment_form table using prepared statement
    // ...
    $sql_insert = "INSERT INTO enrollment_form (intake_ID, name, email, phone, date_birth, address, school, result, submission_date, payment_option, status) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP, ?, ?)";


    $stmt_insert = mysqli_prepare($conn, $sql_insert);
    // Update the type definition string to have 10 data types (excluding CURRENT_TIMESTAMP)
    mysqli_stmt_bind_param($stmt_insert, "isssssssss", $intake_ID, $fullname, $email, $phone, $birthdate, $address, $secondary_school, $transcript, $paymentOption, $status);


    // Execute the prepared statement
    if (mysqli_stmt_execute($stmt_insert)) {
        echo '<script>alert("Enrollment form submitted successfully!"); window.location.href = "index.php";</script>';
    } else {
        echo "Error executing the query: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt_insert);
    mysqli_close($conn);

?>