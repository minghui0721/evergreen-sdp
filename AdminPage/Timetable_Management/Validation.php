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
    echo $CheckSub_count;

    if($CheckSub_count==0){
        return "Subject Error";
    }
}
?>