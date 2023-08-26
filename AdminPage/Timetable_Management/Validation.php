<?php

function SubjectCheck($SubjectID,$IntakeID){
    include "../dbConn.php";

    //Retrieve CoProID based on intakeID
    $CoProID_query="SELECT `courseProgram_ID` FROM `intake` WHERE `intake_ID`='$IntakeID'";
    $CoProID_result=mysqli_query($connection,$CoProID_query);
    $CoProID_row=mysqli_fetch_assoc($CoProID_result);

    $CoProID=$CoProID_row['courseProgram_ID'];

    // Check the Subject whether is belonging to the Corse or not
    $CheckSub_query="SELECT * FROM `subject` WHERE `subject_ID`='$SubjectID' AND `courseProgram_ID`='$CoProID'";
    $CheckSub_result=mysqli_query($connection,$CheckSub_query);
    $CheckSub_count=mysqli_num_rows($CheckSub_result);

    if($CheckSub_count==0){
        return "Subject Error";
    }
    else{
        return "pass";
    }
}

function TimeCheck($ClassID, $Date, $StartTime, $EndTime){
    include "../dbConn.php";
    // set the format for the input Start Time and End Time
    $StartTime=date('H:i', strtotime($StartTime));
    $EndTime=date('H:i', strtotime($EndTime));

    // Check classroom Open Time and Close Time
    $Classroom_query="SELECT `start_time`, `end_time` FROM `class` WHERE `class_ID`='$ClassID'";
    $Classroom_result=mysqli_query($connection,$Classroom_query);
    $Classroom_row=mysqli_fetch_assoc($Classroom_result);

    //save classroom details into variable
    $OpenTime=date('H:i', strtotime($Classroom_row['start_time']));
    $CloseTime=date('H:i', strtotime($Classroom_row['end_time']));

    if($StartTime<$OpenTime || $EndTime>$CloseTime){
        return "Time Error";
    }

    // Check either there is any class in progress between the input time interval based on class
    $TimetableCheck_query="SELECT `start_time`, `end_time` FROM `timetable_details` WHERE `class_ID`='$ClassID' AND `date`='$Date'";
    $TimetableCheck_result=mysqli_query($connection,$TimetableCheck_query);
    $TimetableCheck_count=mysqli_num_rows($TimetableCheck_result);

    if($TimetableCheck_count<=0){
        return "pass";
    }

    while($TimetableCheck_row=mysqli_fetch_assoc($TimetableCheck_result)){
        $ClassStart=date('H:i', strtotime($TimetableCheck_row['start_time']));
        $ClassEnd=date('H:i', strtotime($TimetableCheck_row['end_time']));



        if(($StartTime<$ClassStart && $EndTime<=$ClassStart) || ($StartTime>=$ClassEnd && $EndTime>$ClassEnd)){
            return "pass";
        }
        else{
            return "Time Error";
        }
    }
}
?>