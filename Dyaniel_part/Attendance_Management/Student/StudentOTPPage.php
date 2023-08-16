<?php
$StudentID=1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/03e0369c68.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="StudentOTPPage_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Sign Attendance</title>
</head>
<body>
    <div class="wrapper">
        <div class="title">
            <h1>Sign Attendance</h1>
        </div>

        <a href="StudentAttendancePage.php">
            <button class="back_button">
                <i class="fa-solid fa-caret-left"></i> Back
            </button>
        </a>
        <!-- path -->

        <div class="OTPContainer">
            <div class="notice">
                <h2>Enter the OTP:</h2>
            </div>

            <div class="OTPForm">
                <form action="StudentOTP_Attendance.php" method="post"><!-- path -->
                    <input type="number" name="OTP" id="OTP" placeholder="X X X" min="100" max="999">
                    <input type="hidden" name="studentID" id="studentID" value="<?php echo $StudentID?>">

                    <input type="submit" name="submit" id="submit" value="Sign">
                </form>
            </div>
        </div>
    </div>
</body>
</html>