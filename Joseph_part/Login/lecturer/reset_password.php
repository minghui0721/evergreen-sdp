<?php
session_start();
include 'dbConn.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Check if the token exists in the database and is not expired
    $current_time = time();
    $query = "SELECT * FROM lecturer WHERE reset_token = '$token' AND reset_expiration > '$current_time'";
    $results = mysqli_query($connection, $query);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        // Token is valid, show the password reset form
        ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="reset_password.css?v=<?php echo time(); ?>">
    <title>Reset Password</title> 
</head>
<body>
    <div class="container">
        <h1>Reset Your Password</h1>
        <form action="update_password.php" method="post">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <div class="input">
                <input type="password" name="new_password" placeholder="New Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <div class="input">
                <input type="password" name="confirm_password" placeholder="Confirm New Password" required>
                <i class="fa-solid fa-lock"></i>
            </div>
            <button type="submit" name="btnResetPassword" class="btn">Reset Password</button>
        </form>
    </div>
</body>
</html>

        <?php
    } else {
        // Token is invalid or expired
        echo "Invalid or expired token. Please try again.";
    }
} else {
    // Token is not provided in the URL
    echo "Token not provided. Please use the link from your email to reset your password.";
}
?>
