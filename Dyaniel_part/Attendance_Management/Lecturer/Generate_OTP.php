<?php

function GenerateOTP($TimetableID){
    include "dbConn.php";
    // <!-- path -->

    // Generate OTP
    $OTP=random_int(100, 999);

    // Check if the OTP exists in the database
    $CompareOTP_query = "SELECT `opt` FROM `opt` WHERE `opt` = '$OTP'";
    $CompareOTP_result = mysqli_query($connection, $CompareOTP_query);
    $CompareOTP_row = mysqli_fetch_assoc($CompareOTP_result);

    // If the OTP already exists, generate the OTP again
    while ($CompareOTP_row) {
        $OTP = random_int(100, 999);
        $CompareOTP_query = "SELECT `opt` FROM `opt` WHERE `opt` = '$OTP'";
        $CompareOTP_result = mysqli_query($connection, $CompareOTP_query);
        $CompareOTP_row = mysqli_fetch_assoc($CompareOTP_result);
    }

    //Insert OTP into database
    $InsertOTP_query="INSERT INTO `opt`( `opt`, `timetable_ID`) VALUES ('$OTP','$TimetableID')";
    if(mysqli_query($connection,$InsertOTP_query)){
        return $OTP;
    }
    else{
    ?>
        <script>
        alert("OTP Generated Fail")
        window.location.replace("AttendanceList.php")
        // <!-- path -->
        </script>
    <?php
    }
}
?>