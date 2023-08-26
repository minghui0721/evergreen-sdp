<?php
session_start(); // Start the session
include '../../database/db_connection.php';
include '../../assets/favicon/favicon.php';

// Retrieve lecturer_id from the session
$lecturer_ID = $_SESSION['lecturer_ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../moodle/home.css">
    <link rel="stylesheet" href="lecturer_home.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">  
</head>
<script>    
function goBack() {
    window.history.back();
}
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<header>
    <div class="header-content">
        <a href="#" onclick="goBack()"><button class="backbtn">Back</button></a>
        <a href="home.html"></a>
            <img src="../moodle/img/logo.png" height="80" weight="420" alt="Error" class="logo">
        </a>
        <h2 class="setup_title">Lecturer Materials</h2>
    </div>

    <hr id="header_line">
</header>

<div class="image-wrapper">
        <div class="image-container">
            <div class="image-box">
                <a href="lesson_resource.php">
                <img src="./images/lesson_resource.png" alt="Image 1">
                </a>
                <h2 class = "topic">Lesson Resource</h2>
            </div>
            <div class="image-box">
                <a href="lecturer_setup.php">
                <img src="./images/assignment_form.png" alt="Image 2">
                </a>
                <h2 class = "topic"> Assignment Form</h2>
            </div>
            <div class="image-box">
                <a href="assignment_details.php">
                <img src="./images/assignment_details.png" alt="Image 3">
                </a>
                <h2 class = "topic"> Assignment Details</h2>
            </div>
            <div class="image-box">
                <a href="examGrading_main.php">
                <img src="./images/exam.png" alt="Image 4">
                </a>
                <h2 class = "topic"> Exam Grading</h2>
            </div>
            
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>