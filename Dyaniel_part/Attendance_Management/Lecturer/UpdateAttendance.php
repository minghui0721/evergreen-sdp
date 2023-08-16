<?php
include "dbConn.php";
// <!-- path -->

if(isset($_POST['Present'])){
    // retrieve the data
    $AttendancID=$_POST['attendanceID'];
    $Remark=$_POST['remark'];
    $TimetableID=$_POST['TimetableID'];


    // Update Attendance to present + remark
    $UpdateAttendance_query="UPDATE `attendance` SET `status`='Present',`remarks`='$Remark' 
    WHERE `attendance_ID`='$AttendancID'";
    mysqli_query($connection,$UpdateAttendance_query);

    // Back to Attendance page
    header("Location:Attendance.php?TimetableID=$TimetableID");
    // <!-- path -->
}

if(isset($_POST['Absent'])){
    // retrieve the data
    $AttendancID=$_POST['attendanceID'];
    $Remark=$_POST['remark'];
    $TimetableID=$_POST['TimetableID'];


    // Update Attendance to present + remark
    $UpdateAttendance_query="UPDATE `attendance` SET `status`='Absent',`remarks`='$Remark' 
    WHERE `attendance_ID`='$AttendancID'";
    mysqli_query($connection,$UpdateAttendance_query);

    // Back to Attendance page
    header("Location:Attendance.php?TimetableID=$TimetableID");
    // <!-- path -->
}
?>