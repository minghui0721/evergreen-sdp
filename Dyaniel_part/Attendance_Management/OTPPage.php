<!-- path -->
<?php
include "../dbConn.php";
include "Generate_OTP.php";

// Determine either the attendance is exist or not, if not create attendance
$TimetableID=$_GET['TimetableID'];

$TimetableCount_query="SELECT `attendance_ID`FROM `attendance` WHERE `timetable_ID`='$TimetableID'";
$TimetableCount_result=mysqli_query($connection,$TimetableCount_query); 
$TimetableCount=mysqli_num_rows($TimetableCount_result);

if($TimetableCount<1){
    include "CreateAttendance.php";
}

$TimetableID=$_GET['TimetableID'];

// Generate OTP and save into database
$OTP=GenerateOTP($TimetableID);

// Retrieve the timetable details
$Timetable_query="SELECT b.class_name, c.courseProgram_ID, c.intake, d.subject_name, a.date, a.start_time, a.end_time
FROM timetable_details a
INNER JOIN class b
ON a.class_ID = b.class_ID
INNER JOIN intake c
ON a.intake_ID = c.intake_ID
INNER JOIN subject d
ON a.subject_ID = d.subject_ID
WHERE a.timetable_ID='$TimetableID'";
$Timetable_result=mysqli_query($connection,$Timetable_query);
$Timetable_row=mysqli_fetch_assoc($Timetable_result);

    //retrieve the Course Name and Program Name based on courseProgram_ID
    $CoProID=$Timetable_row['courseProgram_ID'];
    $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
    $CoProName_result=mysqli_query($connection,$CoProName_query);
    $CoProName_row=mysqli_fetch_assoc($CoProName_result);

    //save the details into variable
    $Subject=$Timetable_row['subject_name'];
    $Date=date('d M Y', strtotime($Timetable_row['date']));
    $Time=date('h: i a', strtotime($Timetable_row['start_time']))." - ".date('h: i a', strtotime($Timetable_row['end_time']));
    $Intake=$Timetable_row['intake']." ".$CoProName_row['program_name'].'<br>'.$CoProName_row['course_name'];
    $Class=$Timetable_row['class_name']
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
    <link rel="stylesheet" type="text/css" href="OPTPage_style.css?v=<?php echo time(); ?>">
    <title>Attendance OTP</title>
</head>
<body>
    <div class="Wrapper">
        <div class="Title">
            <h1>Attendance OTP</h1>
        </div>

        <div class="OPTContainer">
            <h2><?php echo $OTP?></h2>
            <h3>_ _ _</h3>
        </div>

        <div class="ClassDetails">
            <div class="Subject">
                <h3>Subject:</h3>
                <p><?php echo $Subject?></p>
            </div>
            <div class="Date-and-Time">
                <div class="Date">
                    <h3>Date :</h3>
                    <p><?php echo $Date?></p>
                </div>
                <div class="Time">
                    <h3>Time :</h3>
                    <p><?php echo $Time?></p>
                </div>
            </div>
            <div class="Intake-and-ClassName">
                <div class="Intake">
                    <h3>Intake :</h3>
                    <p><?php echo $Intake?></p>
                </div>
                <div class="ClassName">
                    <h3>Class :</h3>
                    <p><?php echo $Class?></p>
                </div>
            </div>

            <div class="CloseOTP_Button">
            <form action="Delete_OTP.php" method="post">
                <input type="hidden" name="OTP" id="OTP" value="<?php echo $OTP?>">
                <input type="hidden" name="timetableID" id="timetableID" value="<?php echo $TimetableID?>">
                <input type="submit" name="CloseOTP" id="CloseOTP" value="CloseOTP">
            </form>
        </div>
        </div>
    </div>
</body>
</html>
