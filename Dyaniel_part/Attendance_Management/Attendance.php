<?php
include "../dbConn.php";
// <!-- path -->

// Determine either the attendance is exist or not, if not create attendance
$TimetableID=$_GET['TimetableID'];

$TimetableCount_query="SELECT `attendance_ID`FROM `attendance` WHERE `timetable_ID`='$TimetableID'";
$TimetableCount_result=mysqli_query($connection,$TimetableCount_query); 
$TimetableCount=mysqli_num_rows($TimetableCount_result);

if($TimetableCount<1){
    include "CreateAttendance.php";
}

// Retrieve Timetable Details
$Timetable_query="SELECT a.timetable_ID, b.class_name,c.intake_ID, c.courseProgram_ID, c.intake, d.subject_name, a.date, a.start_time, a.end_time
FROM timetable_details a
INNER JOIN class b
ON a.class_ID = b.class_ID
INNER JOIN intake c
ON a.intake_ID = c.intake_ID
INNER JOIN subject d
ON a.subject_ID = d.subject_ID
WHERE a.timetable_ID=$TimetableID";
$Timetable_result=mysqli_query($connection,$Timetable_query);
$Timetable_row=mysqli_fetch_assoc($Timetable_result);

//retrieve the Course Name and Program Name based on courseProgram_ID
$CoProID=$Timetable_row['courseProgram_ID'];
$CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
$CoProName_result=mysqli_query($connection,$CoProName_query);
$CoProName_row=mysqli_fetch_assoc($CoProName_result);

// Save all Timetable Details into variable
$Intake=$Timetable_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
$SubjectName=$Timetable_row['subject_name'];
$Date=date('d M Y', strtotime($Timetable_row['date']));
$Time=date('h: i a', strtotime($Timetable_row['start_time']))." - ".date('h: i a', strtotime($Timetable_row['end_time']));
$ClassName=$Timetable_row['class_name'];

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
    <link rel="stylesheet" type="text/css" href="attendance_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Mark Attendance</title>
</head>

<body>
     <div class="wrapper">
        <!-- Back button -->
        <a href="AttendanceList.php">
            <button class="back_button">
                <i class="fa-solid fa-caret-left"></i> Back
            </button>
        </a>
        <!-- path -->

        <!-- Class Details -->
        <div class="ClassDetails">
            <h2><?php echo $Intake?></h2>
            <h2><?php echo $SubjectName?></h2>
            <h1></h1>
            <h3><i class="fa-solid fa-calendar-days"></i> &nbsp;<?php echo $Date?></h3>
            <h3 style="display: inline;"><i class="fa-regular fa-clock"></i> &nbsp;<?php echo $Time?></h3>
            <h3 style="display: inline; margin-left: 100px;"><i class="fa-solid fa-location-dot"></i> &nbsp;<?php echo $ClassName?></h3>
        </div>

        <div class="StudentList">
            <table
            border="0"
            cellpadding="20px">
                <tr>
                    <th>Studednt ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Remark</th>
                    <th>Action</th>
                </tr>

                <?php
                // Retreive Student Details
                $IntakeID=$Timetable_row['intake_ID'];

                $StudentDetails_query="SELECT `student_ID`, `student_name` FROM `student` WHERE `intake_ID`='$IntakeID'";
                $StudentDetails_result=mysqli_query($connection,$StudentDetails_query);
                while($StudentDetails_row=mysqli_fetch_assoc($StudentDetails_result)){;
                
                    $StudentID=$StudentDetails_row['student_ID'];
                    $StudentName=$StudentDetails_row['student_name'];
                
                    // Retrieve Students' attendance status and remark
                    $Attendance_query="SELECT `attendance_ID`,`status`, `remarks` FROM `attendance` WHERE `student_ID`='$StudentID' AND `timetable_ID`='$TimetableID'";
                    $Attendance_result=mysqli_query($connection,$Attendance_query);
                    $Attendance_row=mysqli_fetch_assoc($Attendance_result);
                    $AttendanceStatus=$Attendance_row['status'];
                    $Remark=$Attendance_row['remarks'];
                
                ?>

                <form action="UpdateAttendance.php" method="post" class="get_remark">
                <!-- path -->
                <tr class="<?php echo $AttendanceStatus?>">
                    <td><?php echo $StudentID?></td>
                    <td><?php echo $StudentName?></td>
                    <td><?php echo $AttendanceStatus?></td>
                    <td>
                        <input type="text" placeholder="Absent with reason" name="remark" id="remark" class="remark"
                    value="<?php echo $Remark?>">
                        <input type="hidden" name="attendanceID" id="attendanceID" value="<?php echo $Attendance_row['attendance_ID'] ?>">
                        <input type="hidden" name="TimetableID" id="TimetableID" value="<?php echo $TimetableID ?>">
                    </td>
                    <td>
                        <input type="submit" value="Present" name="Present" class="present_button">
                        <input type="submit" value="Absent" name="Absent" class="absent_button">
                    </td>
                </tr>

            </form>
            <?php
                }
            ?>
            </table>
        </div>
     </div>
</body>
</html>
