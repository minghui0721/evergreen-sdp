<?php
session_start();
include 'dbConn.php';

if (isset($_POST['btnResetPassword'])) {
    $email = $_POST['email'];

    // Check if the email exists in the database
    $query = "SELECT * FROM student WHERE email = '$email'";
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($results);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        // Generate a unique random token
        $token = bin2hex(random_bytes(32)); // You can adjust the token length as needed

        // Store the token and its expiration timestamp in the database
        $user_id = $row['user_id'];
        $expiration_time = time() + (24 * 60 * 60); // Token will expire after 24 hours
        $update_query = "UPDATE student SET reset_token = '$token', reset_expiration = '$expiration_time' WHERE user_id = '$user_id'";

        if (mysqli_query($connection, $update_query)) {
            // Send an email to the user with the password reset link
            $reset_link = "http://example.com/reset_password.php?token=$token"; // Replace with your reset password page URL
            // Code to send the email with the reset link
            // Example using PHPMailer:
            /*
            require 'PHPMailer/PHPMailer.php';
            $mail = new PHPMailer();
            $mail->setFrom('your_email@example.com', 'Your Name');
            $mail->addAddress($email, 'User Name');
            $mail->Subject = 'Password Reset Request';
            $mail->Body = "Click the following link to reset your password: $reset_link";
            if ($mail->send()) {
                echo "<script>alert('An email with instructions to reset your password has been sent. Please check your inbox.');</script>";
            } else {
                echo "<script>alert('Failed to send the email. Please try again later.');</script>";
            }
            */
            echo "<script>alert('An email with instructions to reset your password has been sent. Please check your inbox.');</script>";
        } else {
            echo "<script>alert('Error occurred while updating the reset token. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Email not found. Please enter a valid email address.');</script>";
    }
    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
    <title>Forgot Password</title>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <h1>Forgot Password</h1>
            <div class="input">
                <input type="email" placeholder="Email" name="email" required>
                <i class='bx bx-envelope'></i>
            </div>
            <button type="submit" name="btnResetPassword" class="btn">Reset Password</button>
            <div class="cancel-container">
                <a href="login.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>
