<?php
include '../assets/favicon/favicon.php'; // Include the favicon.php file
include '../database/db_connection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$lecturerID = $_GET['id'];



// Retrieve lecturer information

$sqlEmail = "SELECT * FROM lecturer";
$emailResult = mysqli_query($conn, $sqlEmail);
$email = mysqli_fetch_assoc($emailResult);
$lecturerName = $email['lecturer_name'];
$lecturerEmail = $email['email'];
$lecturerImg = $email['img'];

// Retrieve all intakes associated with the lecturer
$intakeSql = "SELECT * FROM lecturer_handle WHERE lecturer_ID = $lecturerID";
$intakeResult = mysqli_query($conn, $intakeSql);
$intakes = array();

while ($intakeRow = mysqli_fetch_assoc($intakeResult)) {
    $intakeID = $intakeRow['intake_ID'];
    
    // Retrieve courseProgram_ID and intake from "intake" table
    $intakeDataSql = "SELECT courseProgram_ID, intake FROM intake WHERE intake_ID = $intakeID";
    $intakeDataResult = mysqli_query($conn, $intakeDataSql);
    $intakeData = mysqli_fetch_assoc($intakeDataResult);
    
    $courseProgramID = $intakeData['courseProgram_ID'];
    $intakeName = $intakeData['intake'];
    
    // Retrieve course_name and program_name from "course_program" table
    $courseProgramSql = "SELECT course_name, program_name FROM course_program WHERE courseProgram_ID = $courseProgramID";
    $courseProgramResult = mysqli_query($conn, $courseProgramSql);
    $courseProgram = mysqli_fetch_assoc($courseProgramResult);
    
    $courses[] = array(
        'intake_ID' => $intakeID,
        'intake_name' => $intakeName,
        'course_name' => $courseProgram['course_name'],
        'program_name' => $courseProgram['program_name']
    );
}


mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <link rel="stylesheet" href="../assets/css/lecturer_details.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
    <style>
            .more_list{
                color: #5c5adb;
            }

            .more_list:hover{
                opacity: 1;
            }
     </style>
</head>
<body>
<?php include '../assets/fonts/fontStudent.html'; ?> 

<!-- header -->
<header class="button_header">
    <div class="button">
        <a href="lecturer_list.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>        </a>
        <h2>Lecturer Details</h2>
    </div>
</header>


<div class="lecturer_content">
    <div class="container">
        <div class="lecturer-card">
            <!-- <img class="lecturer-image" src="<?php echo $lecturerImg; ?>" alt="Lecturer Image"> -->
            <img class="lecturer-image" src="../assets/images/people.avif" alt="Lecturer Image">
            <div class="lecturer-details">
                <p class="lecturer-name"><?php echo $lecturerName; ?></p>
                <p class="lecturer-email"><?php echo $lecturerEmail; ?></p>
                <p class="course-program">
                    <strong class="handle">Course Handle:</strong><br>
                    <?php foreach ($courses as $course): ?>
                        <strong>Course:</strong> <?php echo $course['course_name']; ?><br>
                        <strong>Program:</strong> <?php echo $course['program_name']; ?><br>
                        <strong>Intake:</strong> <?php echo $course['intake_name']; ?><br>
                        <br>
                    <?php endforeach; ?>
                </p>
                <a href="../appointment/select_appointment.php?lecturer_id=<?php echo $lecturerID; ?>">
                    <button class="book-button">Book Consultation</button>
                </a>
            </div>
        </div>
    </div>
</div>






</body>
</html>