<?php
include "../dbConn.php";
include "../WeekDateRange.php";
//<!-- path -->

$StudentID=1;

//Calculate overall attendance percentage
$OverallAll_query="SELECT * FROM `attendance` WHERE `student_ID`='$StudentID'";
$OverallAll_result=mysqli_query($connection,$OverallAll_query);
$OverallAll=mysqli_num_rows($OverallAll_result);


$OverallPresent_query="SELECT * FROM `attendance` WHERE `student_ID`='$StudentID' AND `status`='Present'";
$OverallPresent_result=mysqli_query($connection,$OverallPresent_query);
$OverallPresent=mysqli_num_rows($OverallPresent_result);

$OverallPercentage=($OverallPresent/$OverallAll)*100;
$OverallPercentage=round($OverallPercentage,2);


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
    <link rel="stylesheet" type="text/css" href="StudentAttendancePage_style.css?v=<?php echo time(); ?>">
    <title>Attendance</title>
</head>
<body>
    <div class="wrapper">
        <div class="title">
            <h1>Attendance</h1>
        </div>

        <div class="OverallAttendance_Box">
            <div class="text">
                <h3>Overall attendance percentage: </h3>
            </div>
            <div class="OverallPercentage">
                <p><?php echo $OverallPercentage?>%</p>
            </div>
        </div>

        <div class="SignAttendance">
            <a href="StudentOTPPage.php"> <!-- path -->
                <button>Sign Attendance</button>
            </a>
        </div>

        <?php
        //Calculate the attendance percentage for each subject
        // Retrieve Intake ID based on Student ID
        $IntakeID_query="SELECT `intake_ID` FROM `student` WHERE `student_ID`='$StudentID'";
        $IntakeID_result=mysqli_query($connection,$IntakeID_query);
        $IntakeID_row=mysqli_fetch_assoc($IntakeID_result);

        $IntakeID=$IntakeID_row['intake_ID'];

        // Retrieve CourseProgram ID based on Intake ID
        $CoProID_query="SELECT `courseProgram_ID`, `intake` FROM `intake` WHERE `intake_ID`='$IntakeID'";
        $CoProID_result=mysqli_query($connection,$CoProID_query);
        $CoProID_row=mysqli_fetch_assoc($CoProID_result);

        $CoProID=$CoProID_row['courseProgram_ID'];

        //Retrieve intake name
        $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
        $CoProName_result=mysqli_query($connection,$CoProName_query);
        $CoProName_row=mysqli_fetch_assoc($CoProName_result);

        $Intake=$CoProID_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
        ?>

        <div class="AttendanceDetails_Container">
            <div class="text">
                <h2>Intake: <?php echo $Intake?></h2>
            </div>

            <?php
            // Retrieve Subject ID based on CourseProgram ID
            $SubjectID_query="SELECT `subject_ID`, `subject_name`FROM `subject` WHERE `courseProgram_ID`='$CoProID'";
            $SubjectID_result=mysqli_query($connection,$SubjectID_query);

            while($SubjectID_row=mysqli_fetch_assoc($SubjectID_result)){
                $SubjectID=$SubjectID_row['subject_ID'];
                $SubjectName=$SubjectID_row['subject_name'];

                // Retrieve TimetableID based on Subject ID
                $TimetableID_query="SELECT `timetable_ID`FROM `timetable_details` WHERE `subject_ID`='$SubjectID'";
                $TimetableID_result=mysqli_query($connection,$TimetableID_query);
                $TimetableID_count=mysqli_num_rows($TimetableID_result);
                
                $SubjectAll_Count=0;
                $SubjectPresent_Count=0;
                if($TimetableID_count==0){
                    $SubjectPercentage="-";
                }
                else{
                    while($TimetableID_row=mysqli_fetch_assoc($TimetableID_result)){
                        $TimetableID=$TimetableID_row['timetable_ID'];

                        // Count number of class
                        $SubjectAll_query="SELECT * FROM `attendance` WHERE `student_ID`='$StudentID' AND `timetable_ID`='$TimetableID'";
                        $SubjectAll_result=mysqli_query($connection,$SubjectAll_query);
                        $SubjectAll=mysqli_num_rows($SubjectAll_result);
                        if($SubjectAll==1){
                            $SubjectAll_Count++;
                        }

                        // Count number of class which is present
                        $SubjectPresent_query="SELECT * FROM `attendance` WHERE `student_ID`='$StudentID' AND `timetable_ID`='$TimetableID' AND `status`='Present'";
                        $SubjectPresent_result=mysqli_query($connection,$SubjectPresent_query);
                        $SubjectPresent=mysqli_num_rows($SubjectPresent_result);
                        if($SubjectPresent==1){
                            $SubjectPresent_Count++;
                        }
                    }
                    // Calculate the subject attendance percentage
                    $SubjectPercentage=(($SubjectPresent_Count/$SubjectAll_Count)*100);
                    $SubjectPercentage=round($SubjectPercentage,2)."%";
                }
                
            ?>

            <div class="SubjectAttendance_Box">
                <div class="Subject">
                    <h3>·&nbsp;<?php echo $SubjectName?></h3>
                </div>

                <div class="TotalClasses">
                    <p>Classes:&nbsp;<?php echo $SubjectPresent_Count?>/<?php echo $SubjectAll_Count?></p>
                </div>
                <div class="Percent">
                    <p>Percent:&nbsp;<?php echo $SubjectPercentage?></p>
                </div>
            </div>

            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>