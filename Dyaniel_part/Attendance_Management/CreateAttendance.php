<?php
include "../dbConn.php"

// Retreive ID
$RetrieveID_query="SELECT `course_ID`, `lecturer_ID` FROM `timetable_details` WHERE `timetable_ID`='---'";
$RetrieveID_result=mysqli_query($connection,$RetrieveID_query);
$RetrieveID_row=mysqli_fetch_assoc($RetrieveID_result);

$CourseID=$RetrieveID_row['course_ID'];
$LecturerID=$RetrieveID_row['lecturer_ID'];

// Retreive Student Details + create attendance
$StudentDetails_query="SELECT `student_ID`, `student_name` FROM `student` WHERE `course_ID`='$CourseID'";
$StudentDetails_result=mysqli_query($StudentDetails_query);
while($StudentDetails_row=mysqli_fetch_assoc($StudentDetails_result)){;

    $StudedntID=$StudentDetails_row['student_ID'];
    $StudedntName=$StudentDetails_row['student_name'];

    // Create attendance
    $Attendance_query="INSERT INTO `attendance`(`lecturer_ID`, `student_ID`, `timetable_ID`, `otp`, `status`, `remarks`) 
    VALUES ('$LecturerID','$StudedntID','[value-4]',NULL,'absent',NULL)"
    $Attendance_result=mysqli_query($Attendance_query);
?>



<?php
}
?>