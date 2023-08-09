<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

// Step 1 - Database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check database connection
if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());
}

$LecturerID=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Setup Form</title>
    <link rel="stylesheet" href="../moodle/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="setup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <h2 class="setup_title">Exam Grading</h2>
    </div>

    <hr id="header_line">
</header>

<body>
<div class="container_setup">
        <h2 class="title_setup">Exam Checking</h2>
        <form action="insert_assignment_details.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="input">
                    <label for="courseProgram_ID">Course Name<ion-icon name="man-outline"></ion-icon><ion-icon name="woman-outline"></ion-icon></label>
                    <select name="courseProgram_ID" id="courseProgram_ID">

                    <?php
                    $IntakeID_query="SELECT `intake_ID` FROM `lecturer_handle` WHERE `lecturer_ID`='$LecturerID'";
                    $IntakeID_result=mysqli_query($connection,$IntakeID_query);
                    while($IntakeID_row=mysqli_fetch_assoc($IntakeID_result)){

                        $IntakeID=$IntakeID_row['intake_ID'];
                        $CoProID_query="SELECT `courseProgram_ID`, `intake` FROM `intake` WHERE `intake_ID`='$IntakeID'";
                        $CoProID_result=mysqli_query($connection,$CoProID_query);
                        while($CoProID_row=mysqli_fetch_assoc($CoProID_result)){
                            $CoProID=$CoProID_row['courseProgram_ID'];
                            $Intake=$CoProID_row['intake'];

                            $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
                            $CoProName_result=mysqli_query($connection,$CoProName_query);
                            $CoProName_row=mysqli_fetch_assoc($CoProName_result);

                            $IntakeName=$Intake." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
                    ?>
                        <option value="<?php echo $IntakeID;?>"><?php echo $IntakeName;?></option>
                    <?php
                        }
                    }
                    ?>
                    </select>

                </div>
                <div class="input">
                    <label for="subject_ID">Subject Name<ion-icon name="school-outline"></ion-icon></label>
                    <select name="subject_ID" id="subjectSelect" required>
                    <option value="" disable>Select a subject</option>
                    </select>
                </div>
            </div>
            <input type="submit" class = "submitbtn" value="Check">
            
        </form>
    </div>
</body>

