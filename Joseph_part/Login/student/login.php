<?php
session_start();
include '../../../database/db_connection.php';
include '../../../assets/favicon/favicon.php'; // Include the favicon.php file
if (isset($_POST['btnLogin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM student WHERE email = '$email' ORDER BY student_ID DESC LIMIT 1";
    $results = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($results);
    $count = mysqli_num_rows($results);

    if ($count == 1) {
        if ($password === $row['student_password']) {
            echo "<script>alert('Login successfully!');</script>";
            $_SESSION['email'] = $row['email'];
            $_SESSION['student_ID'] = $row['student_ID'];
            $_SESSION['student_name'] = $row['student_name'];
            header("Location: ../../../student/dashboard.php");                
        } else {
            echo "<script>alert('Login Unsuccessfully. Please check your credentials.');</script>";
        }
    } else {
        echo "<script>alert('Email not found. Please try again.');</script>";
    }
 }
 mysqli_close($conn);
 ?>
 


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Fjalla+One&family=PT+Serif&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
    <script src="../../../assets/js/config.js"></script>
    <link rel="stylesheet" href="../assets/css/appointment.css.?v=<?php echo time(); ?>">  
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">
    <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName; 
    </script>

</head>
<body>
    <div class="container">
        <form action="login.php" method="post"> <!-- Corrected the form action -->
            <h1>Student Login</h1>
            <div class="input">
                <input type="text" placeholder="Username" name="email" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input">
                <input type="password" placeholder="Password" name="password" required>
                <i class='bx bxs-lock'></i>
            </div>
            
            <div class="remember-forgot">
                <label><input type="checkbox"> Remember Me </label>
                <a href="forgotpassword.php">Forgot Password?</a>
            </div>
            <button type="submit" name="btnLogin" id="btnLogin" class="btn">Login</button>
            <div class="Lecturer">
                <p>You are a LECTURER?<a href="../lecturer/LecturerLogin.php"> Login Here</a></p>
            </div>
            
        </form>
    </div>
</body>
</html>
