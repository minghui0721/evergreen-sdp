<?php
include "dbConn.php";
// <!-- path -->

if (isset($_POST['submit'])){
    $OTP=$_POST['OTP'];
    $StudentID=$_POST['studentID'];

    //Check whether the entered OTP exist
    $TimetableID_query="SELECT `timetable_ID` FROM `opt` WHERE `opt`='$OTP'";
    $TimetableID_result=mysqli_query($connection,$TimetableID_query);
    $TimetableID_count=mysqli_num_rows($TimetableID_result);

    // Retreive timetableID from database
    if($TimetableID_count>0){
        $TimetableID_row=mysqli_fetch_assoc($TimetableID_result);
        $TimetableID=$TimetableID_row['timetable_ID'];

    }
    else{
        ?>
        <script>
            alert('!Invalid OTP!')
            window.location.replace("StudentOTPPage.php")
            //<!-- path -->
        </script>
        <?php
    }

    // Filter invalid timetableID
    $CheckAttendance_query="SELECT * FROM `attendance`
    WHERE `student_ID`='$StudentID' AND`timetable_ID`='$TimetableID'";
    $CheckAttendance_result=mysqli_query($connection,$CheckAttendance_query);
    $AttendanceCount=mysqli_num_rows($CheckAttendance_result);
    if($AttendanceCount>0){
             // Update student's attendance
            $UpdateAttendance_query="UPDATE `attendance` SET `status`='Present' 
            WHERE `student_ID`='$StudentID' AND`timetable_ID`='$TimetableID'";
            $UpdateAttendance_result=mysqli_query($connection,$UpdateAttendance_query);
        ?>

        <script>
            alert('!Attendance update successfully!')
            window.location.replace("StudentAttendancePage.php")
            //<!-- path -->
        </script>

        <?php
    }
    else{
        ?>
        <script>
            alert('!Invalid OTP!')
            window.location.replace("StudentOTPPage.php")
            //<!-- path -->
        </script>
        <?php
    }
}
?>