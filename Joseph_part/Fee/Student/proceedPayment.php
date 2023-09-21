<?php
session_start();
include '../../../database/db_connection.php'; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get payment ID and installment number from the URL
$payment_ID = $_GET['payment_id'];
$installment_ID = $_GET['installment_ID'];
$payment_amount = isset($_GET['amount']) ? $_GET['amount'] : 0;

// Fetch payment details and other necessary data
$payment_query = "SELECT * FROM payment WHERE payment_ID = $payment_ID";
$payment_result = mysqli_query($conn, $payment_query);
$payment_data = mysqli_fetch_assoc($payment_result);

$student_name_query = "SELECT student_name FROM student WHERE student_ID = {$payment_data['student_ID']}";
$student_name_result = mysqli_query($conn, $student_name_query);
if ($student_name_result) {
    $student = mysqli_fetch_assoc($student_name_result);
    $student_name = $student['student_name'];
} else {
    // Handle query error
    echo "Error fetching student name: " . mysqli_error($conn);
    exit; // Exit the script
}

$course_program_query = "SELECT program_name, course_name FROM course_program WHERE courseProgram_ID = (SELECT courseProgram_ID FROM intake WHERE intake_ID = (SELECT intake_ID FROM student WHERE student_ID = {$payment_data['student_ID']}))";
$course_program_result = mysqli_query($conn, $course_program_query);
$course_program = mysqli_fetch_assoc($course_program_result);

if ($payment_data['installment_ID'] == 0 && isset($payment_data['fee_ID'])) {
    $fee_ID = $payment_data['fee_ID'];

    // Fetch the total amount from the fee table
    $fee_query = "SELECT total_amount FROM fee WHERE fee_ID = $fee_ID";
    $fee_result = mysqli_query($conn, $fee_query);

    if ($fee_result && mysqli_num_rows($fee_result) > 0) {
        $fee_data = mysqli_fetch_assoc($fee_result);
        $payment_amount = $fee_data['total_amount'];
    } else {
        echo "Error fetching fee details: " . mysqli_error($conn);
        exit; // Exit the script
    }
} elseif ($payment_data['installment_ID'] > 0) {

    // Fetch the installment count based on the installment_ID
    $installment_ID = $payment_data['installment_ID'];
    $installment_query = "SELECT installment_count FROM installment WHERE installment_ID = $installment_ID";
    $installment_result = mysqli_query($conn, $installment_query);

    if ($installment_result && mysqli_num_rows($installment_result) > 0) {
        $installment_row = mysqli_fetch_assoc($installment_result);
        $installment_count = $installment_row['installment_count'];
    } else {
        echo "Error fetching installment count: " . mysqli_error($conn);
        exit; // Exit the script
    }
} else {
    echo "Invalid payment details.";
    exit; // Exit the script
}

// Define payment methods
$payment_methods = array('Credit Card', 'Debit Card', 'Bank Transfer');

// Handle payment submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selected_method = mysqli_real_escape_string($conn, $_POST['payment_method']); // Escape and sanitize the input

    // Perform payment processing and update payment status
    $update_query = "UPDATE payment SET payment_datetime = NOW(), payment_method = '$selected_method', status = 'Paid' WHERE payment_ID = $payment_ID";
    $update_result = mysqli_query($conn, $update_query);

    if ($update_result) {
        // Fetch student's email from the database
        $student_email_query = "SELECT email FROM student WHERE student_ID = {$payment_data['student_ID']}";
        $student_email_result = mysqli_query($conn, $student_email_query);
        if ($student_email_result) {
            $student_email_data = mysqli_fetch_assoc($student_email_result);
            $student_email = $student_email_data['email'];
        } else {
            // Handle query error
            echo "Error fetching student email: " . mysqli_error($conn);
            exit; // Exit the script
        }

        // Send email receipt
        require '../../SendEmail/PHPMailer.php';
        require '../../SendEmail/SMTP.php';
        require '../../SendEmail/Exception.php';


        try {
            // Create a new instance of PHPMailer
            $mail = new PHPMailer();
            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "josephho1437@gmail.com";
            $mail->Password = "xoqkcibjejymhhxg";
            $mail->SMTPSecure = "tls";
            $mail->Port = "587";

            $mail->setFrom('josephho1437@gmail.com', 'Joseph');
            $mail->addAddress($student_email);
            $mail->isHTML(true);
            $mail->Subject = 'Payment Receipt';

            // Construct email body
            $email_body = "Dear {$student_name},<br>";
            $email_body .= "Your payment of RM {$payment_amount} has been successfully processed.<br>";

            if ($payment_data['installment_ID'] == 0 && isset($payment_data['fee_ID'])) {
                $email_body .= "You have paid for the following program and course: {$course_program['program_name']} {$course_program['course_name']}<br>";
            } elseif ($payment_data['installment_ID'] > 0) {
                $email_body .= "You have paid for the following installment: {$installment_count} Installment of {$course_program['program_name']} {$course_program['course_name']}<br>";
            }
            
            $mail->Body = $email_body;
            $mail->send();
            
            echo '<script>alert("Payment status updated successfully. Email receipt sent.");</script>';
            header("Refresh: 0; URL=studentPayment.php");
        } catch (Exception $e) {
            echo '<script>alert("Error sending email receipt: ' . $mail->ErrorInfo . '");</script>';
        }
    } else {
        echo '<script>alert("Error updating payment status: ' . mysqli_error($conn) . '");</script>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Fjalla+One&family=PT+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="proceedPayment.css?v=<?php echo time(); ?>">
    <title>Payment Processing</title> 
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('header');
            // Load header content using XMLHttpRequest
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    container.innerHTML = this.responseText;
                }
            };

            xhttp.open('GET', '../../../student/studentHeader.php', true);
            xhttp.send();
        });
    </script>
</head>
<!-- header -->
<header class="button_header">
    <div class="button">
        <a href="studentPayment.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>        
        </a>
        <h2>Payment Details</h2>
    </div>
</header>
<body>
    <div class="container">
        <div class="payment-form">
            <h1>Payment Processing</h1>
            <div class="payment-details">
                <p><strong>Student Name:</strong> <?php echo $student_name; ?></p>
                <p><strong>Program and Course:</strong> <?php echo $course_program['program_name']; ?> <?php echo $course_program['course_name']; ?></p>
                <p><strong>Payment Amount:</strong> RM <?php echo $payment_amount; ?></p>
            </div>
            <form method="post">
                <label for="payment_method"><strong>Select Payment Method:</strong></label>
                <select id="payment_method" name="payment_method">
                    <?php foreach ($payment_methods as $method) { ?>
                        <option value="<?php echo $method; ?>"><?php echo $method; ?></option>
                    <?php } ?>
                </select>
                <button type="submit" id="pay-btn">Pay Now</button>
            </form>
        </div>
    </div>
</body>
</html>
