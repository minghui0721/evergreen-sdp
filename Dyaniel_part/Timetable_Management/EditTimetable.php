<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php"
?>
    <link rel="stylesheet" type="text/css" href="EditTimetable_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Edit Timetable</title>

    <style>
    .SchoolManagement{
        display: block;
    }

    .SchoolManagement .ManageTimetable{
        color: #5c5adb;
    }
</style>

<?php
// Retrieve data from database
$TimetableID=$_GET['TimetableID'];
$TimetableList_query="SELECT a.timetable_ID, b.class_name, c.course_name, d.subject_name, e.lecturer_name, a.date, a.start_time, a.end_time
FROM timetable_details a
INNER JOIN class b
ON a.class_ID = b.class_ID
INNER JOIN course c
ON a.course_ID = c.course_ID
INNER JOIN subject d
ON a.subject_ID = d.subject_ID
INNER JOIN lecturer e
ON a.lecturer_ID = e.lecturer_ID
WHERE a.timetable_ID=$TimetableID";
$TimetableList_result=mysqli_query($connection,$TimetableList_query);
$TimetableList_row=mysqli_fetch_assoc($TimetableList_result)
?>

</head>
<body>
    <div class="wrapper">
        <!-- Title -->
        <div class="TitleBar">
            <h1>Edit Timetable</h1>
        </div>

        <div class="ClassDetails_container">
            <form action="#" method="post">
                <div class="ID-and-Date">
                    <!-- Timetable ID -->
                    <div class="TimetableID">
                        <h3>TimetableID: <?php echo $TimetableList_row["timetable_ID"]?></h3>
                    </div>
                    <!-- Date -->
                    <div class="Date">
                        <p>Date:</p>
                        <input type="date" id="date" name="date"
                        value="<?php echo $TimetableList_row["date"]?>"
                        required>
                    </div>
                </div>

                <div class="CourseName-and-SubjectType">
                    <!-- Course Name -->
                    <div class="CourseName">
                        <p>Course Name:</p>
                        <select name="course-name" id="course-name">
                        <?php
                        $Course_query="SELECT `course_name` FROM `course`";
                        $Course_result=mysqli_query($connection,$Course_query);
                        while($Course_row=mysqli_fetch_assoc($Course_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Course_row['course_name']?>" 
                        <?php if($Course_row['course_name']==$TimetableList_row['course_name']) echo"selected"?>>
                        <?php echo $Course_row['course_name']?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <!-- Subject Type -->
                    <div class="SubjectName">
                        <p>Subject Name:</p>
                        <select name="subject-name" id="subject-name">
                        <?php
                        $Subject_query="SELECT `subject_name` FROM `subject`";
                        $Subject_result=mysqli_query($connection,$Subject_query);
                        while($Subject_row=mysqli_fetch_assoc($Subject_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Subject_row['subject_name']?>" 
                        <?php if($Subject_row['subject_name']==$TimetableList_row['subject_name']) echo"selected"?>>
                        <?php echo $Subject_row['subject_name']?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="ClassName-and-LecturerName">
                    <!-- Class Name -->
                    <div class="ClassName">
                        <p>Class Name:</p>
                        <select name="class-name" id="class-name">
                        <?php
                        $Class_query="SELECT `class_name` FROM `class`";
                        $Class_result=mysqli_query($connection,$Class_query);
                        while($Class_row=mysqli_fetch_assoc($Class_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Class_row['class_name']?>" 
                        <?php if($Class_row['class_name']==$TimetableList_row['class_name']) echo"selected"?>>
                        <?php echo $Class_row['class_name']?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                    <!-- Room Type -->
                    <div class="LecturerName">
                        <p>Lecturer Name:</p>
                        <select name="lecturer-name" id="lecturer-name">
                        <?php
                        $Lecturer_query="SELECT `lecturer_name` FROM `lecturer`";
                        $Lecturer_result=mysqli_query($connection,$Lecturer_query);
                        while($Lecturer_row=mysqli_fetch_assoc($Lecturer_result)){
                        ?>
                        <!-- Retrieve the option value -->
                        <option value="<?php echo $Lecturer_row['lecturer_name']?>" 
                        <?php if($Lecturer_row['lecturer_name']==$TimetableList_row['lecturer_name']) echo"selected"?>>
                        <?php echo $Lecturer_row['lecturer_name']?></option>

                        <?php
                        }
                        ?>
                        </select>
                    </div>
                </div>

                <div class="StartTime-and-EndTime">
                    <!-- Start Time -->
                    <div class="StartTime">
                        <p>Start Time:</p>
                        <input type="time" id="start-time" name="start-time"
                        value="<?php echo $TimetableList_row["start_time"];?>"
                        required>
                    </div>
                    <!-- End Time -->
                    <div class="EndTime">
                        <p>End Time:</p>
                        <input type="time" id="end-time" name="end-time"
                        value="<?php echo $TimetableList_row["end_time"];?>"
                        required>
                    </div>
                </div>

                <!-- submit button -->
                <div class="submit-button">
                    <input type="submit" value="Edit" name="Edit">
                </div>
            </form>

            <!-- back button -->
            <a href="TimetableList.php">
                <button class="back_button">
                    Back
                </button>
                <!-- path -->
            </a>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['Edit'])){
    $Date=$_POST['date'];
    $CourseName=$_POST['course-name'];
    $SubjectName=$_POST['subject-name'];
    $ClassName=$_POST['class-name'];
    $LecturerName=$_POST['lecturer-name'];
    $StartTime=$_POST['start-time'];
    $EndTime=$_POST['end-time'];
    
    // Retrieve CourseID
    $CourseID_query="SELECT `course_ID`FROM `course` WHERE `course_name`='$CourseName'";
    $CourseID_result = mysqli_query($connection,$CourseID_query);
    $CourseID_row = mysqli_fetch_assoc($CourseID_result);
    
    // Retrieve SubjectID
    $SubjectID_query="SELECT `subject_ID` FROM `subject` WHERE subject_name='$SubjectName'";
    $SubjectID_result = mysqli_query($connection,$SubjectID_query);
    $SubjectID_row = mysqli_fetch_assoc($SubjectID_result);
    
    // Retrieve ClassID
    $ClassID_query="SELECT `class_ID`FROM `class` WHERE `class_name`='$ClassName'";
    $ClassID_result = mysqli_query($connection,$ClassID_query);
    $ClassID_row = mysqli_fetch_assoc($ClassID_result);
    
    // Retrieve LecturerID
    $LecturerID_query="SELECT `lecturer_ID`FROM `lecturer` WHERE `lecturer_name`='$LecturerName'";
    $LecturerID_result = mysqli_query($connection,$LecturerID_query);
    $LecturerID_row = mysqli_fetch_assoc($LecturerID_result);

    // Save the retreived ID into variable
    $CourseID = $CourseID_row['course_ID'];
    $SubjectID = $SubjectID_row['subject_ID'];
    $ClassID = $ClassID_row['class_ID'];
    $LecturerID = $LecturerID_row['lecturer_ID'];

    // Update the timetable details
    $TimetableDetails_query="UPDATE `timetable_details` SET `class_ID`='$ClassID',
    `course_ID`='$CourseID',`lecturer_ID`='$LecturerID',`subject_ID`='$SubjectID',
    `start_time`='$StartTime',`end_time`='$EndTime',`date`='$Date' 
    WHERE `timetable_ID`=$TimetableID";
    mysqli_query($connection,$TimetableDetails_query);
?>
<script>
    alert("!Update Succesfully!")
    window.location.replace("TimetableList.php")
</script>
<!-- path -->

<?php
}
?>