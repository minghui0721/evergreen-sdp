<?php
include '../../database/db_connection.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $enrollmentID = $_GET['enrollment_id'];
    $courseProgramID = $_GET['course_program_id'];


    if ($action === 'approve') {
        // Retrieve fee_ID from fee table using courseProgramID
        $feeQuery = "SELECT fee_ID FROM fee WHERE courseProgram_ID = '$courseProgramID'";
        $feeResult = mysqli_query($conn, $feeQuery);
        $feeRow = mysqli_fetch_assoc($feeResult);
        $feeID = $feeRow['fee_ID'];

        if ($feeID) {
            // Retrieve installment_ID values from installment_table using fee_ID
            $installmentQuery = "SELECT installment_ID FROM installment WHERE fee_ID = '$feeID'";
            $installmentResult = mysqli_query($conn, $installmentQuery);

            $installmentIDs = array(); // Initialize an array to store installment_ID values

            while ($installmentRow = mysqli_fetch_assoc($installmentResult)) {
                $installmentIDs[] = $installmentRow['installment_ID'];
            }

            // Retrieve data from enrollment_form table
            $query = "SELECT * FROM enrollment_form WHERE enrollment_ID = $enrollmentID";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);

            // Extract data
            $intakeID = $row['intake_ID'];
            $studentName = $row['name'];
            $email = $row['email'];
            $phone = $row['phone'];
            $payment = $row['payment_option'];

            // Set a default password (you can change this as needed)
            $defaultPassword = '123456';

            // Insert data into student table
            $insertQuery = "INSERT INTO student (intake_ID, enrollment_ID, student_name, student_password, reset_token, reset_expiration, email, phone)
                            VALUES ('$intakeID', '$enrollmentID', '$studentName', '$defaultPassword', null, null, '$email', '$phone')";
            $insertResult = mysqli_query($conn, $insertQuery);

            $studentID = mysqli_insert_id($conn); // Get the last inserted student ID

            if ($payment == 'full_payment') {
                $insertPaymentQuery = "INSERT INTO payment (student_ID, fee_ID, installment_ID, payment_datetime, payment_method, status)
                                       VALUES ('$studentID', '$feeID', '0', null, null, 'Unpaid')";
                $insertPaymentResult = mysqli_query($conn, $insertPaymentQuery);

                if ($insertPaymentResult) {
                    $updateQuery = "UPDATE enrollment_form SET status = 'Approved' WHERE enrollment_ID = $enrollmentID";
                    $updateResult = mysqli_query($conn, $updateQuery);

                    if ($updateResult) {
                        echo "<script>alert('Enrollment request approved successfully');</script>";
                        echo "<script>window.location.href = 'enrollment_request.php';</script>";
                    } else {
                        echo "<script>alert('Error occurred while updating enrollment status');</script>";
                        echo "<script>window.location.href = 'enrollment_request.php';</script>";
                    }
                } else {
                    echo "<script>alert('Error occurred while processing the approval');</script>";
                    echo "<script>window.location.href = 'enrollment_request.php';</script>";
                }
            } elseif ($payment == 'installment') {
                foreach ($installmentIDs as $selectedInstallmentID) {
                    $insertPaymentQuery = "INSERT INTO payment (student_ID, fee_ID, installment_ID, payment_datetime, payment_method, status)
                                           VALUES ('$studentID', '0', '$selectedInstallmentID', null, null, 'Unpaid')";
        
                    $insertPaymentResult = mysqli_query($conn, $insertPaymentQuery);

                    if (!$insertPaymentResult) {
                        echo "<script>alert('Error occurred while processing the approval');</script>";
                        echo "<script>window.location.href = 'enrollment_request.php';</script>";
                        exit; // Exit the loop and stop processing if an error occurs
                    }
                }
    
                $updateQuery = "UPDATE enrollment_form SET status = 'Approved' WHERE enrollment_ID = $enrollmentID";
                $updateResult = mysqli_query($conn, $updateQuery);
                    
                if ($updateResult) {
                    echo "<script>alert('Enrollment request approved successfully');</script>";
                    echo "<script>window.location.href = 'enrollment_request.php';</script>";
                } else {
                    echo "<script>alert('Error occurred while updating enrollment status');</script>";
                    echo "<script>window.location.href = 'enrollment_request.php';</script>";
                }
            }
         } else {
            echo "<script>alert('Fee ID not found for the selected course program');</script>";
            echo "<script>window.location.href = 'enrollment_request.php';</script>";
        }
    }
}
?>

