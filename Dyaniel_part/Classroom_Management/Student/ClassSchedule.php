<?php
include "dbConn.php";

// Retreive the data from from
$ClassID=$_GET['classID'];
$ClassName=$_GET['className'];
$RoomType=$_GET['roomType'];
$Date=$_GET['date'];

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
    <link rel="stylesheet" type="text/css" href="ClassSchedule_style.css?v=<?php echo time(); ?>">
    <title>A-02-04 Class Schedule</title>
    <!-- path -->
</head>
<body>
    <!-- Back Button -->
    <a href="ClassFinder.php"> <!-- path -->
        <button class="back_button">
            <i class="fa-solid fa-caret-left"></i> Back
        </button>
    </a>

    <div class="Title">
        <h1><?php echo $ClassName?></h1>
        <p class="roomType">Room type: <?php echo $RoomType?></p>
        <p class="date"><?php echo date('d M Y, D', strtotime($Date));?></p>
    </div>

    <div class="ClassScheContainer">
        <?php
        // Retreive the class schedule
        $Timetable_query="SELECT b.intake_ID, b.intake,b.courseProgram_ID, c.lecturer_name, d.subject_name, a.start_time, a.end_time
        FROM timetable_details a
        INNER JOIN intake b
        ON a.intake_ID = b.intake_ID
        INNER JOIN lecturer c
        ON a.lecturer_ID = c.lecturer_ID
        INNER JOIN subject d
        ON a.subject_ID = d.subject_ID
        WHERE a.class_ID='$ClassID' AND a.date='$Date'
        ORDER BY a.start_time ASC";
        $Timetable_result=mysqli_query($connection,$Timetable_query);
        $Timetable_count=mysqli_num_rows($Timetable_result);

        if($Timetable_count>0){
            while($Timetable_row=mysqli_fetch_assoc($Timetable_result)){
                //retrieve the Course Name and Program Name based on courseProgram_ID
                $CoProID=$Timetable_row['courseProgram_ID'];
                $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
                $CoProName_result=mysqli_query($connection,$CoProName_query);
                $CoProName_row=mysqli_fetch_assoc($CoProName_result);

                // save retrieved data into variable
                $SubjectName=$Timetable_row['subject_name'];
                $Time=date('h:i a', strtotime($Timetable_row['start_time']))." <br> ".date('h:i a', strtotime($Timetable_row['end_time']));
                $Lecturer=$Timetable_row['lecturer_name'];
                $Intake=$Timetable_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
            ?>
            <div class="ClassScheBox">
                <div class="Time">
                    <p><?php echo $Time?></p>
                </div>

                <div class="ClassDetailsBox">
                    <div class="FirstLine">
                        <p><?php echo $SubjectName?></p>
                    </div>
                    <div class="SecondLine">
                        <p class="intake">
                            <i class="fa-solid fa-people-group" style="color: #ffffff;"></i><?php echo $Intake?>
                        </p>
                        <p class="lecturer">
                            <i class="fa-solid fa-user-tie" style="color: #ffffff;"></i> <?php echo $Lecturer?>
                        </p>
                    </div>
                </div>
            </div>
        <?php
            }
        }
        else{
        ?>
        <div class="NoClass">
            <h2>! There is no any class in this room today !</h2>
        </div>
        <?php
        }
        ?>
    </div>
</body>
</html>