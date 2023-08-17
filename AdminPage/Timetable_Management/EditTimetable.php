<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php";
?>
    <link rel="stylesheet" type="text/css" href="EditTimetable_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Edit Timetable</title>

    <style>
    .AcademicManagement{
        display: block;
    }

    .AcademicManagement .ManageTimetable{
        color: #5c5adb;
    }
</style>

<?php
// Retrieve data from database
$TimetableID=$_GET['TimetableID'];
$TimetableList_query="SELECT a.timetable_ID, b.class_name,c.intake_ID, c.courseProgram_ID, c.intake, d.subject_name, e.lecturer_name, a.date, a.start_time, a.end_time
FROM timetable_details a
INNER JOIN class b
ON a.class_ID = b.class_ID
INNER JOIN intake c
ON a.intake_ID = c.intake_ID
INNER JOIN subject d
ON a.subject_ID = d.subject_ID
INNER JOIN lecturer e
ON a.lecturer_ID = e.lecturer_ID
WHERE a.timetable_ID=$TimetableID";
$TimetableList_result=mysqli_query($connection,$TimetableList_query);
$TimetableList_row=mysqli_fetch_assoc($TimetableList_result);

//retrieve the Course Name and Program Name based on courseProgram_ID
$CoProID=$TimetableList_row['courseProgram_ID'];
$CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
$CoProName_result=mysqli_query($connection,$CoProName_query);
$CoProName_row=mysqli_fetch_assoc($CoProName_result);

//combine a intake name
$SelectedIntake=$TimetableList_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
?>

</head>
<body>
    <div class="wrapper">
        <!-- Title -->
        <div class="TitleBar">
            <h1>Edit Timetable</h1>
        </div>

        <div class="ClassDetails_container">
            <form action="#" method="post">
                <div class="ID-and-Date">
                    <!-- Timetable ID -->
                    <div class="TimetableID">
                        <h3>TimetableID: <?php echo $TimetableList_row["timetable_ID"]?></h3>
                    </div>
                    <!-- Date -->
                    <div class="Date">
                        <p>Date:</p>
                        <input type="date" id="date" name="date"
                        value="<?php echo $TimetableList_row["date"]?>"
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
                        <option value="<?php echo $Intake_row['intake_ID']?>" 
                        <?php if($Intake==$SelectedIntake) echo"selected"?>>
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
                        <option value="<?php echo $Subject_row['subject_ID']?>" 
                        <?php if($Subject_row['subject_name']==$TimetableList_row['subject_name']) echo"selected"?>>
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
                        $Class_query="SELECT `class_ID`,`class_name` FROM `class`";
                        $Class_result=mysqli_query($connection,$Class_query);
                        while($Class_row=mysqli_fetch_assoc($Class_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Class_row['class_ID']?>" 
                        <?php if($Class_row['class_name']==$TimetableList_row['class_name']) echo"selected"?>>
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
                        <option value="<?php echo $Lecturer_row['lecturer_ID']?>" 
                        <?php if($Lecturer_row['lecturer_name']==$TimetableList_row['lecturer_name']) echo"selected"?>>
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
                        value="<?php echo $TimetableList_row["start_time"];?>"
                        required>
                    </div>
                    <!-- End Time -->
                    <div class="EndTime">
                        <p>End Time:</p>
                        <input type="time" id="end-time" name="end-time"
                        value="<?php echo $TimetableList_row["end_time"];?>"
                        required>
                    </div>
                </div>

                <!-- submit button -->
                <div class="submit-button">
                    <input type="submit" value="Edit" name="Edit">
                </div>
            </form>

            <!-- back button -->
            <a href="TimetableList.php?intakeID=<?php echo $TimetableList_row['intake_ID'];?>">
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
if (isset($_POST['Edit'])){
    $Date=$_POST['date'];
    $Intake=$_POST['intake'];
    $SubjectID=$_POST['subjectID'];
    $ClassID=$_POST['classID'];
    $LecturerID=$_POST['lecturerID'];
    $StartTime=$_POST['start-time'];
    $EndTime=$_POST['end-time'];

    // Update the timetable details
    $TimetableDetails_query="UPDATE `timetable_details` SET `class_ID`='$ClassID',
    `intake_ID`='$Intake',`lecturer_ID`='$LecturerID',`subject_ID`='$SubjectID',
    `start_time`='$StartTime',`end_time`='$EndTime',`date`='$Date' 
    WHERE `timetable_ID`=$TimetableID";
    mysqli_query($connection,$TimetableDetails_query);
?>
<script>
    alert("!Update Succesfully!")
    window.location.replace("TimetableList.php?intakeID=<?php echo $Intake;?>")
</script>
<!-- path -->

<?php
}
?>