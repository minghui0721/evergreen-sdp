<?php
// update_payment.php

session_start();
include 'dbConn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $student_ID = $_POST['student_ID'];
    $fee_ID = $_POST['fee_ID'];
    $paymentDatetime = date("Y-m-d H:i:s"); // Current date and time
    $paymentMethod = $_POST['paymentMethod'];
    $status = 'Paid';

    // Prepare and execute the SQL query to update the payment table
    $updateQuery = "UPDATE payment 
                    SET payment_datetime = '$paymentDatetime', 
                        payment_method = '$paymentMethod', 
                        status = '$status'
                    WHERE student_ID = '$student_ID' AND fee_ID = '$fee_ID'";

    if (mysqli_query($connection, $updateQuery)) {
        // Redirect back to the payment page with a success message
        header("Location: fee.php?success=1");
        exit();
    } else {
        // Redirect back to the payment page with an error message
        header("Location: fee.php?error=1");
        exit();
    }
}
?>