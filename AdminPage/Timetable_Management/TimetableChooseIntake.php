<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php";
// <!-- path -->
?>

    <link rel="stylesheet" type="text/css" href="TimetableChooseIntake_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Manage Timetable</title>
<style>
    .AcademicManagement{
        display: block;
    }

    .AcademicManagement .ManageTimetable{
        color: #5c5adb;
    }
</style>
</head>
<body>
    <div class="wrapper">
        <div class="title">
            <h1>Manage Timetable</h1>
            <a href="CreateTimetable.php">
            <button><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i></i> &nbsp;Add New</button>
            </a>
        </div>
        
        <div class="IntakeContainer">
            <?php
            // Retreive CoProID and Intake
            $Intake_query="SELECT `intake_ID`, `courseProgram_ID`, `intake` FROM `intake` ORDER BY `intake` ASC";
            $Intake_result=mysqli_query($connection,$Intake_query);

            while($Intake_row=mysqli_fetch_assoc($Intake_result)){
                $IntakeID=$Intake_row['intake_ID'];
                $CoProID=$Intake_row['courseProgram_ID'];
                $Intake=$Intake_row['intake'];
                
                //retrieve the Course Name and Program Name based on courseProgram_ID
                $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
                $CoProName_result=mysqli_query($connection,$CoProName_query);
                $CoProName_row=mysqli_fetch_assoc($CoProName_result);

                $IntakeName=$Intake." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
            ?>

            <a href="TimetableList.php?intakeID=<?php echo $IntakeID;?>">
                <div class="IntakeBox">
                    <h3><?php echo $IntakeName;?></h3>
                    <p><i class="fa-solid fa-play" style="color: #ffffff;"></i></p>
                </div>
            </a>

            <?php
            }
            ?>
        </div>
    </div>
</body>
</html>