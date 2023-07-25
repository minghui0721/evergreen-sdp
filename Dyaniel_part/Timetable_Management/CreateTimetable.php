<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php"
?>
    <link rel="stylesheet" type="text/css" href="CreateTimetable_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Create Timetable</title>

    <style>
    .SchoolManagement{
        display: block;
    }

    .SchoolManagement .ManageTimetable{
        color: #5c5adb;
    }
</style>
</head>
<body>
    <div class="wrapper">
        <!-- Title -->
        <div class="TitleBar">
            <h1>Create Timetable</h1>
        </div>

        <div class="ClassDetails_container">
            <form action="#" method="post">
                <div class="ID-and-Date">
                    <!-- Date -->
                    <div class="Date">
                        <p>Date:</p>
                        <input type="date" id="date" name="date"
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
                        <option value="<?php echo $Course_row['course_name']?>">
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
                        <option value="<?php echo $Subject_row['subject_name']?>">
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
                        <option value="<?php echo $Class_row['class_name']?>">
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
                        <option value="<?php echo $Lecturer_row['lecturer_name']?>">
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
                        required>
                    </div>
                    <!-- End Time -->
                    <div class="EndTime">
                        <p>End Time:</p>
                        <input type="time" id="end-time" name="end-time"
                        required>
                    </div>
                </div>

                <!-- submit button -->
                <div class="submit-button">
                    <input type="submit" value="Create" name="Create">
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
if (isset($_POST['Create'])){
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

    // Create New Timetable
    $TimetableDetails_query="INSERT INTO `timetable_details`(`class_ID`, `course_ID`, `lecturer_ID`, `subject_ID`, `start_time`, `end_time`, `date`)
    VALUES ('$ClassID','$CourseID','$LecturerID','$SubjectID','$StartTime','$EndTime','$Date')";
    mysqli_query($connection,$TimetableDetails_query);
?>
<script>
    alert("!Create Succesfully!")
    window.location.replace("TimetableList.php");
</script>
<!-- path -->

<?php
}
?>