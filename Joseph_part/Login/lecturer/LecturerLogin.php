<?php
session_start();
include 'dbConn.php';
include '../../../assets/favicon/favicon.php'; // Include the favicon.php file


if (isset($_POST['btnLogin'])) {
   $email = $_POST['email'];
   $password = $_POST['password'];

   $query = "SELECT * FROM lecturer WHERE email = '$email'";
   $results = mysqli_query($connection, $query);
   $row = mysqli_fetch_assoc($results);
   $count = mysqli_num_rows($results);

   if ($count == 1) {
       if ($password === $row['password']) {
           echo "<script>alert('Login successfully!');</script>";
           $_SESSION['email'] = $row['email'];
           header("Location: studentlist.php");
           exit();
       } else {
           echo "<script>alert('Login Unsuccessfully. Please check your credentials.');</script>";
       }
   } else {
       echo "<script>alert('Email not found. Please try again.');</script>";
   }
}
mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="LecturerLogin.css?v=<?php echo time(); ?>">
    <script src="../../../assets/js/config.js"></script>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">
    <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName; 
    </script>

</head>
<body>
    <div class="container">
        <form action="" method='post'>
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
                <a href="forgotpassword.php">Forgot Password?</a>
            </div>
            <button type="submit" name="btnLogin" id="btnLogin" class="btn">Login</button>
            <div class="Student">
                <p>You are a STUDENT?<a href="../student/login.php"> Login Here</a></p>
            </div>
            
        </form>
    </div>
</body>
</html>