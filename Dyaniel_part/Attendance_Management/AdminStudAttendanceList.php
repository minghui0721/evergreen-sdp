<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php";

// Retrieve IntakeID and Intake Name
$IntakeID=$_GET['intakeID'];
$IntakeName=$_GET['intakeName'];
?>
    <link rel="stylesheet" type="text/css" href="AdminStudAttendanceList_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Student Attendance List</title>

<style>

</style>
    <div class="wrapper">
        <a href="AdminAttendanceIntake.php">
            <button class="back_button">
                <i class="fa-solid fa-caret-left"></i> Back
            </button>
        </a>

        <div class="TitleBar">
            <h1>Intake: </h1>
            <h2><?php echo $IntakeName;?></h2>
        </div>
        

        <div class="ClassroomList">
            <table
            border="0"
            cellpadding="10px">
                <tr>
                    <th style="width:20%">Student ID</th>
                    <th style="width:50%; text-align: left;">Student Name</th>
                    <th style="width:30%">Overall Attendance</th>
                </tr>

                <?php
                // Retrieve Student ID based on Intake ID
                $StudentID_query="SELECT `student_ID`, `student_name` FROM `student` WHERE `intake_ID`='$IntakeID'";
                $StudentID_result=mysqli_query($connection,$StudentID_query);

                while($StudentID_row=mysqli_fetch_assoc($StudentID_result)){
                    $StudentID=$StudentID_row['student_ID'];
                    $StudentName=$StudentID_row['student_name'];

                    //Calculate overall attendance percentage
                    $OverallAll_query="SELECT * FROM `attendance` WHERE `student_ID`='$StudentID'";
                    $OverallAll_result=mysqli_query($connection,$OverallAll_query);
                    $OverallAll=mysqli_num_rows($OverallAll_result);


                    $OverallPresent_query="SELECT * FROM `attendance` WHERE `student_ID`='$StudentID' AND `status`='Present'";
                    $OverallPresent_result=mysqli_query($connection,$OverallPresent_query);
                    $OverallPresent=mysqli_num_rows($OverallPresent_result);

                    $OverallPercentage=(($OverallPresent/$OverallAll)*100)."%";
                ?>

                <tr>
                    <td><?php echo $StudentID;?></td>
                    <td style="text-align: left;"><?php echo $StudentName;?></td>
                    <td><?php echo $OverallPercentage;?></td>
                </tr>

                <?php
                    }
                ?>
            </table>
        </div>
    </div>

</body>
</html>

