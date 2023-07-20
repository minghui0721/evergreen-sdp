<?php
session_start();
include 'dbConn.php';

if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM lecturer WHERE email = '$email' AND password = '$password' ";
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($results);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        echo "<script>alert('Login successfully!');</script>";
        $_SESSION['email'] = $row['email'];
        header("Location: login.php");
        exit(); // Make sure to exit after the redirection
    } else {
        echo "<script>alert('Login Unsuccessfully. Please try again.');</script>";
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
    <link rel="stylesheet" href="LecturerLogin.css?v=<?php echo time(); ?>">
    <title>Login Form</title>

</head>
<body>
    <div class="container">
        <form action="">
            <h1>Lecturer Login</h1>
            <div class="input">
                <input type="text" placeholder="Username" name="email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock' ></i>
            </div>
            
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember Me </label>
                <a href="#"> Forgot Password? </a>
            </div>
            <button type="submit" name="btnLogin" id="btnLogin" class="btn">Login</button>
            <div class="Student">
                <p>You are a STUDENT?<a href="login.php"> Login Here</a></p>
            </div>
            
        </form>
    </div>
</body>
</html>