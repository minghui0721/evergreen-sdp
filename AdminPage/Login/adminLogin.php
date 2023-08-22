<?php
session_start();

$adminEmail = 'admin@email.com';
$adminPassword = 'admin';
$errorMessage = '';

if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if ($email === $adminEmail && $password === $adminPassword) {
        header("Location: ../Enrollment_Management/enrollment_request.php"); // Replace with the actual admin page
        exit();
    } else {
        // Incorrect credentials, set an error message
        $errorMessage = "Incorrect email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="shortcut icon" href="../../assets/images/evergreen-logo(without background).png" type="image/x-icon">
    <link rel="stylesheet" href="adminLogin.css?v=<?php echo time(); ?>">
    <title>Admin Login</title>
</head>
<body>
    <div class="container">
        <form action="#" method="post">
            <h1>Admin Login</h1>
            <div class="input">
                <input type="text" placeholder="Username" name="email" required>
                <i class='bx bxs-user'></i>
            </div>
            <div class="input">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock'></i>
            </div>
            <button type="submit" name="btnLogin" id="btnLogin" class="btn">Login</button>
            <?php if (!empty($errorMessage)) { ?>
                <p class="error-message"><?php echo $errorMessage; ?></p>
            <?php } ?>
        </form>
    </div>
</body>
</html>