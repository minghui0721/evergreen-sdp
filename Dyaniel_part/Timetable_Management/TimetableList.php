<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php"
?>
    <link rel="stylesheet" type="text/css" href="TimetableList_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Timetable List</title>

<style>
    .SchoolManagement{
        display: block;
    }

    .SchoolManagement .ManageTimetable{
        color: #5c5adb;
    }
</style>
    <div class="wrapper">
        <div class="TitleBar">
            <h1>Timetable List</h1>
            <a href="CreateTimetable.php">
            <button><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i></i> &nbsp;Add New</button>
            </a>
            <!-- path -->
        </div>
        

        <div class="ClassroomList">
            <table
            border="0"
            cellpadding="10px">
                <tr>
                    <th>Timetable ID</th>
                    <th>Class Name</th>
                    <th>Course Name</th>
                    <th>Course Name</th>
                    <th>Subject Name</th>
                    <th>Lecture Name</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Action</th>
                </tr>

                <!-- Retrieve class list from database -->
                <?php
                $TimetableList_query="SELECT a.timetable_ID, b.class_name, c.course_name, d.subject_name, e.lecturer_name, a.date, a.start_time, a.end_time
                FROM timetable_details a
                INNER JOIN class b
                ON a.class_ID = b.class_ID
                INNER JOIN course c
                ON a.course_ID = c.course_ID
                INNER JOIN subject d
                ON a.subject_ID = d.subject_ID
                INNER JOIN lecturer e
                ON a.lecturer_ID = e.lecturer_ID";
                $TimetableList_result=mysqli_query($connection,$TimetableList_query);
                while($TimetableList_row=mysqli_fetch_assoc($TimetableList_result)){
                     // Get the ProgramID
                     $CourseName=$TimetableList_row["course_name"];
                     $ProgramID_query="SELECT `program_ID` FROM `course` WHERE `course_name`='$CourseName'";
                     $ProgramID_result=mysqli_query($connection,$ProgramID_query);
                     $ProgramID_row=mysqli_fetch_assoc($ProgramID_result);
 
                     $ProgramID=$ProgramID_row['program_ID'];  
 
                     // Retreive the Program Name based on ProgramID
                     $ProgramName_query="SELECT `program_name`FROM `program` WHERE `program_ID`='$ProgramID'";
                     $ProgramName_result=mysqli_query($connection,$ProgramName_query);
                     $ProgramName_row=mysqli_fetch_assoc($ProgramName_result);
 
                     $ProgramName=$ProgramName_row['program_name'];
                ?>

                <tr>
                    <td><?php echo $TimetableList_row["timetable_ID"];?></td>
                    <td><?php echo $TimetableList_row["class_name"];?></td>
                    <td><?php echo $ProgramName;?></td>
                    <td><?php echo $TimetableList_row["course_name"];?></td>
                    <td><?php echo $TimetableList_row["subject_name"];?></td>
                    <td><?php echo $TimetableList_row["lecturer_name"];?></td>
                    <td><?php echo date('d.m.Y', strtotime($TimetableList_row['date'])); ?></td>
                    <td><?php echo date('h:i a', strtotime($TimetableList_row['start_time'])); ?></td>
                    <td><?php echo date('h:i a', strtotime($TimetableList_row['end_time'])); ?></td>
                    <td>
                        <!-- Edit Button --> <!-- path -->
                        <a href="EditTimetable.php?TimetableID=<?php echo $TimetableList_row["timetable_ID"];?>">
                        <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                        </a>
                        <!-- Delete Button --> <!-- path -->
                        <a href="DeleteTimetable.php?TimetableID=<?php echo $TimetableList_row["timetable_ID"];?>"
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

