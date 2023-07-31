<?php
include "../dbConn.php";
// <!-- path -->

if (isset($_POST['CloseOTP'])){
    $OTP=$_POST['OTP'];
    $TimetableID=$_POST['timetableID'];

    // Delete OTP from database
    $DeleteOTP_query="DELETE FROM `opt` WHERE `opt`='$OTP'";
    $DeleteOTP_row=mysqli_query($connection,$DeleteOTP_query);

    // <!-- path -->
    header("Location:Attendance.php?TimetableID=$TimetableID");
}
?>