<?php
$LecturerID="1";
include "../dbConn.php"
// <!-- path -->
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
    <link rel="stylesheet" type="text/css" href="AttendanceList_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Attendance List</title>
</head>
<body>

    <div class="wrapper">
        <div class="TitleBar">
            <h1>Attendance List</h1>
        </div>
        

        <div class="TimetableList">
            <table
            border="0"
            cellpadding="10px">
                <tr>
                    <th>Timetable ID</th>
                    <th>Date</th>
                    <th>Subject Name</th>
                    <th>Class Name</th>
                    <th>Intake</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>

                <!-- Retrieve class list from database -->
                <?php
                $TimetableList_query="SELECT a.timetable_ID, b.class_name, c.courseProgram_ID, c.intake, d.subject_name, a.date, a.start_time, a.end_time
                FROM timetable_details a
                INNER JOIN class b
                ON a.class_ID = b.class_ID
                INNER JOIN intake c
                ON a.intake_ID = c.intake_ID
                INNER JOIN subject d
                ON a.subject_ID = d.subject_ID
                WHERE a.lecturer_ID=$LecturerID
                ORDER BY a.date ASC, a.start_time ASC";
                $TimetableList_result=mysqli_query($connection,$TimetableList_query);
                while($TimetableList_row=mysqli_fetch_assoc($TimetableList_result)){

                    //retrieve the Course Name and Program Name based on courseProgram_ID
                    $CoProID=$TimetableList_row['courseProgram_ID'];
                    $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
                    $CoProName_result=mysqli_query($connection,$CoProName_query);
                    $CoProName_row=mysqli_fetch_assoc($CoProName_result);

                    //combine a intake name
                    $Intake=$TimetableList_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
                ?>

                <tr>
                    <td><?php echo $TimetableList_row["timetable_ID"];?></td>
                    <td><?php echo date('d.m.Y', strtotime($TimetableList_row['date'])); ?></td>
                    <td><?php echo $TimetableList_row["subject_name"];?></td>
                    <td><?php echo $TimetableList_row["class_name"];?></td>
                    <td><?php echo $Intake;?></td>
                    <td><?php echo date('h:i a', strtotime($TimetableList_row['start_time'])); ?></td>
                    <td><?php echo date('h:i a', strtotime($TimetableList_row['end_time'])); ?></td>
                    <td>
                        <!-- OTP Attendance --> <!-- path -->
                        <a href="LecturerOTPPage.php?TimetableID=<?php echo $TimetableList_row["timetable_ID"];?>">
                        <button class="otp_button"><i class="fa-solid fa-asterisk" style="color: #ffffff;"></i>&nbsp;OTP</button>
                        </a>
                        <!-- Manually Attendance --> <!-- path -->
                        <a href="Attendance.php?TimetableID=<?php echo $TimetableList_row["timetable_ID"];?>">
                        <button class="delete_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i>&nbsp;Manually</button>
                        </a>
                    </td>
                </tr>

                <?php
                    }
                ?>
            </table>
        </div>
    </div>

</body>
</html>

