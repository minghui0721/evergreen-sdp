<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php";

// Retrieve IntakeID and Intake Name
$IntakeID=$_GET['intakeID'];
?>
    <link rel="stylesheet" type="text/css" href="TimetableList_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Timetable List</title>

<style>
    .AcademicManagement{
        display: block;
    }

    .AcademicManagement .ManageTimetable{
        color: #5c5adb;
    }
</style>
    <div class="wrapper">
        <a href="TimetableChooseIntake.php">
            <button class="back_button">
                <i class="fa-solid fa-caret-left"></i> Back
            </button>
        </a>
        <!-- path -->

        <div class="TitleBar">
            <h1>Timetable List</h1>
        </div>
        

        <div class="ClassroomList">
            <table
            border="0"
            cellpadding="10px">
                <tr>
                    <th>Timetable ID</th>
                    <th>Date</th>
                    <th>Class Name</th>
                    <th>Intake</th>
                    <th>Subject Name</th>
                    <th>Lecture Name</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>

                <!-- Retrieve class list from database -->
                <?php
                $TimetableList_query="SELECT a.timetable_ID, b.class_name, c.courseProgram_ID,c.intake, d.subject_name, e.lecturer_name, a.date, a.start_time, a.end_time
                FROM timetable_details a
                INNER JOIN class b
                ON a.class_ID = b.class_ID
                INNER JOIN intake c
                ON a.intake_ID = c.intake_ID
                INNER JOIN subject d
                ON a.subject_ID = d.subject_ID
                INNER JOIN lecturer e
                ON a.lecturer_ID = e.lecturer_ID
                WHERE a.intake_ID = $IntakeID
                ORDER BY a.date ASC, a.start_time ASC";
                $TimetableList_result=mysqli_query($connection,$TimetableList_query);
                while($TimetableList_row=mysqli_fetch_assoc($TimetableList_result)){

                //retrieve the Course Name and Program Name based on courseProgram_ID
                $CoProID=$TimetableList_row['courseProgram_ID'];
                $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
                $CoProName_result=mysqli_query($connection,$CoProName_query);
                $CoProName_row=mysqli_fetch_assoc($CoProName_result);

                $IntakeName=$TimetableList_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
                ?>

                <tr>
                    <td><?php echo $TimetableList_row["timetable_ID"];?></td>
                    <td><?php echo date('d.m.Y', strtotime($TimetableList_row['date'])); ?></td>
                    <td><?php echo $TimetableList_row["class_name"];?></td>
                    <td><?php echo $IntakeName;?></td>
                    <td><?php echo $TimetableList_row["subject_name"];?></td>
                    <td><?php echo $TimetableList_row["lecturer_name"];?></td>
                    <td><?php echo date('h:i a', strtotime($TimetableList_row['start_time'])); ?></td>
                    <td><?php echo date('h:i a', strtotime($TimetableList_row['end_time'])); ?></td>
                    <td>
                        <!-- Edit Button --> <!-- path -->
                        <a href="EditTimetable.php?TimetableID=<?php echo $TimetableList_row["timetable_ID"];?>">
                        <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                        </a>
                        <!-- Delete Button --> <!-- path -->
                        <a href="DeleteTimetable.php?TimetableID=<?php echo $TimetableList_row["timetable_ID"];?>&IntakeID=<?php echo $IntakeID;?>"
                        onclick="return confirm('Are you sure want to delete this timetable?')">
                        <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                        </a>
                    </td>
                </tr>

                <?php
                    }
                ?>
            </table>
        </div>
    </div>

</body>
</html>

