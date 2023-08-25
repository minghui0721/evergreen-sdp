<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php";
include "Validation.php";
?>
    <link rel="stylesheet" type="text/css" href="CreateTimetable_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Create Timetable</title>

    <style>
    .AcademicManagement{
        display: block;
    }

    .AcademicManagement .ManageTimetable{
        color: #5c5adb;
    }
</style>
</head>
<body>
    <div class="wrapper">
        <!-- Title -->
        <div class="TitleBar">
            <h1>Create Timetable</h1>
        </div>

        <div class="ClassDetails_container">
            <form action="#" method="post">
                <div class="ID-and-Date">
                    <!-- Date -->
                    <div class="Date">
                        <p>Date:</p>
                        <input type="date" id="date" name="date"
                        required>
                    </div>
                </div>

                <div class="CourseName-and-SubjectType">
                    <!-- Intake -->
                    <div class="CourseName">
                        <p>Intake:</p>
                        <select name="intake" id="intake">
                        <?php
                        $Intake_query="SELECT `intake_ID`, `courseProgram_ID`, `intake` FROM `intake` ORDER BY `intake` ASC";
                        $Intake_result=mysqli_query($connection,$Intake_query);
                        while($Intake_row=mysqli_fetch_assoc($Intake_result)){

                            //retrieve the Course Name and Program Name based on courseProgram_ID
                            $CoProID=$Intake_row['courseProgram_ID'];
                            $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
                            $CoProName_result=mysqli_query($connection,$CoProName_query);
                            $CoProName_row=mysqli_fetch_assoc($CoProName_result);
                            
                            //combine a intake name
                            $Intake=$Intake_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Intake_row['intake_ID']?>">
                        <?php echo $Intake?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <!-- Subject Type -->
                    <div class="SubjectName">
                        <p>Subject Name:</p>
                        <select name="subjectID" id="subjectID">
                        <?php
                        $Subject_query="SELECT `subject_ID`,`subject_name` FROM `subject`";
                        $Subject_result=mysqli_query($connection,$Subject_query);
                        while($Subject_row=mysqli_fetch_assoc($Subject_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Subject_row['subject_ID']?>">
                        <?php echo $Subject_row['subject_name']?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="ClassName-and-LecturerName">
                    <!-- Class Name -->
                    <div class="ClassName">
                        <p>Class Name:</p>
                        <select name="classID" id="classID">
                        <?php
                        $Class_query="SELECT `class_ID`,`class_name` FROM `class` ORDER BY class_name ASC";
                        $Class_result=mysqli_query($connection,$Class_query);
                        while($Class_row=mysqli_fetch_assoc($Class_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Class_row['class_ID']?>">
                        <?php echo $Class_row['class_name']?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <!-- Lecturer Name -->
                    <div class="LecturerName">
                    <p>Lecturer Name:</p>
                        <select name="lecturerID" id="lecturerID">
                        <?php
                        $Lecturer_query="SELECT `lecturer_ID`, `lecturer_name` FROM `lecturer`";
                        $Lecturer_result=mysqli_query($connection,$Lecturer_query);
                        while($Lecturer_row=mysqli_fetch_assoc($Lecturer_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Lecturer_row['lecturer_ID']?>">
                        <?php echo $Lecturer_row['lecturer_name']?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="StartTime-and-EndTime">
                    <!-- Start Time -->
                    <div class="StartTime">
                        <p>Start Time:</p>
                        <input type="time" id="start-time" name="start-time"
                        required>
                    </div>
                    <!-- End Time -->
                    <div class="EndTime">
                        <p>End Time:</p>
                        <input type="time" id="end-time" name="end-time"
                        required>
                    </div>
                </div>

                <!-- submit button -->
                <div class="submit-button">
                    <input type="submit" value="Create" name="Create">
                </div>
            </form>

            <!-- back button -->
            <a href="TimetableChooseIntake.php">
                <button class="back_button">
                    Back
                </button>
                <!-- path -->
            </a>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['Create'])){
    $Date=$_POST['date'];
    $Intake=$_POST['intake'];
    $SubjectID=$_POST['subjectID'];
    $ClassID=$_POST['classID'];
    $LecturerID=$_POST['lecturerID'];
    $StartTime=$_POST['start-time'];
    $EndTime=$_POST['end-time'];
    
    // Validation
    $Check="pass";
    $Check=SubjectCheck($SubjectID,$Intake);
    $Check=TimeCheck($ClassID, $Date, $StartTime, $EndTime);

    if($Check=="pass"){
    // Create New Timetable
    $TimetableDetails_query="INSERT INTO `timetable_details`(`class_ID`, `intake_ID`, `lecturer_ID`, `subject_ID`, `start_time`, `end_time`, `date`)
    VALUES ('$ClassID','$Intake','$LecturerID','$SubjectID','$StartTime','$EndTime','$Date')";
    mysqli_query($connection,$TimetableDetails_query);
?>
<script>
    alert("!Create Succesfully!")
    window.location.replace("TimetableChooseIntake.php");
</script>
<!-- path -->

<?php
    }
    else if($Check=="Subject Error"){
?>
<script>
    alert("!Incorrect subject for this course!")
    window.location.replace("#");
</script>
    <!-- path -->
<?php
    }
    else if($Check=="Time Error"){
?>
<script>
    alert("!The classroom is not available at this period!")
    window.location.replace("#");
</script>
    <!-- path -->
<?php
    }
}
?>