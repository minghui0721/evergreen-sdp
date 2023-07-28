<?php
include "../dbConn.php";

// Retreive ID
$RetrieveID_query="SELECT `intake_ID`, `lecturer_ID` FROM `timetable_details` WHERE `timetable_ID`='$TimetableID'";
$RetrieveID_result=mysqli_query($connection,$RetrieveID_query);
$RetrieveID_row=mysqli_fetch_assoc($RetrieveID_result);

$IntakeID=$RetrieveID_row['intake_ID'];
$LecturerID=$RetrieveID_row['lecturer_ID'];

// Retreive Student Details + create attendance
$StudentDetails_query="SELECT `student_ID`,`student_name` FROM `student` WHERE `intake_ID`='$IntakeID'";
$StudentDetails_result=mysqli_query($connection,$StudentDetails_query);
while($StudentDetails_row=mysqli_fetch_assoc($StudentDetails_result)){

    $StudedntID=$StudentDetails_row['student_ID'];
    $StudedntName=$StudentDetails_row['student_name'];

    // Create attendance
    $Attendance_query="INSERT INTO `attendance`(`lecturer_ID`, `student_ID`, `timetable_ID`, `status`, `remarks`) 
    VALUES ('$LecturerID','$StudedntID','$TimetableID','Absent','')";
    $Attendance_result=mysqli_query($connection,$Attendance_query);
?>



<?php
}
?>