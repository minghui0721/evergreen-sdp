//stored as plain text
<?php
include 'dbConn.php';

if (isset($_POST['btnResetPassword'])) {
    $token = $_POST['token'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if the token exists in the database and is not expired
    $current_time = time();
    $query = "SELECT * FROM lecturer WHERE reset_token = '$token' AND reset_expiration > '$current_time'";
    $results = mysqli_query($connection, $query);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        // Token is valid, update the user's password
        if ($new_password === $confirm_password) {
            // Store the new password directly (without hashing)
            $row = mysqli_fetch_assoc($results);
            $lecturer_ID = $row['lecturer_ID'];

            $update_query = "UPDATE lecturer SET password = '$new_password', reset_token = NULL, reset_expiration = NULL WHERE lecturer_ID = '$lecturer_ID'";

            if (mysqli_query($connection, $update_query)) {
                echo "<script>alert('Password reset successfully. You can now login with your new password.');</script>";
                echo "<script>window.location.href = 'LecturerLogin.php';</script>";
                exit();
            } else {
                echo "<script>alert('Failed to reset password. Please try again later.');</script>";
                echo "<script>window.location.href = 'forgotpassword.php';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Passwords do not match. Please make sure both passwords are the same.');</script>";
            echo "<script>window.location.href = 'forgotpassword.php';</script>";          
            exit();
        }
    } else {
        // Token is invalid or expired
        echo "<script>alert('Invalid or expired token. Please try again.');</script>";
        echo "<script>window.location.href = 'forgotpassword.php';</script>";
        exit();
    }
    mysqli_close($connection);
}
?>
