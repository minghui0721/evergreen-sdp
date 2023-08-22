<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

// Step 1 - Database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check database connection
if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Grading</title>
    <link rel="stylesheet" href="view_grading.css">
    <link rel="stylesheet" href="../lecturer/setup.css">
</head>
<script>    
function goBack() {
    window.history.back();
}
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<body>
    <div class="wrapper">
    
        <div class="container_grade">
        <h2 class="setup_title" style = "margin-left:550px; margin-top:20px;" >Student Grading</h2>
            <br>
            <table style="width:80%">
                <tr>
                <th>Grade ID</th>
                <th>Exam ID</th>
                <th>Course Program</th>
                <th>Student Name</th>
                <th>Subject Name</th>
                <th>Exam Marks</th>
                <th>Assignment Marks</th>
                </tr>   

                <?php
            $sql = "SELECT g.grade_ID, g.exam_ID, g.courseProgram_ID, g.student_ID, e.subject_ID, g.grade
                    FROM grade g
                    JOIN exam e ON g.exam_ID = e.exam_ID";
            
            $result = $connection->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["grade_ID"] . "</td>";
                echo "<td>" . $row["exam_ID"] . "</td>";

                $courseProgramID = $row["courseProgram_ID"];
                $courseProgramQuery = "SELECT course_name FROM course_program WHERE courseProgram_ID = $courseProgramID";
                $courseProgramResult = $connection->query($courseProgramQuery);
                $courseProgramRow = $courseProgramResult->fetch_assoc();
                echo "<td>" . $courseProgramRow["course_name"] . "</td>";

                $studentID = $row["student_ID"];
                $studentQuery = "SELECT student_name FROM student WHERE student_ID = $studentID";
                $studentResult = $connection->query($studentQuery);
                $studentRow = $studentResult->fetch_assoc();
                echo "<td>" . $studentRow["student_name"] . "</td>";

                $subjectID = $row["subject_ID"];
                $subjectQuery = "SELECT subject_name FROM subject WHERE subject_ID = $subjectID";
                $subjectResult = $connection->query($subjectQuery);
                $subjectRow = $subjectResult->fetch_assoc();
                echo "<td>" . $subjectRow["subject_name"] . "</td>";

                echo "<td>" . $row["grade"] . "</td>";
                $assignmentQuery = "SELECT grade FROM assignment_grading WHERE student_ID = $studentID";
                    $assignmentResult = $connection->query($assignmentQuery);
                    $assignmentRow = $assignmentResult->fetch_assoc();

                    // If assignment marks exist, display them; otherwise, display N/A
                    $assignmentMarks = $assignmentRow ? $assignmentRow["grade"].' <ion-icon name="medal-outline" style="font-size: 17px;"></ion-icon>' : 'N/A <ion-icon name="close-circle-outline"style="font-size: 17px;"></ion-icon>';
                    echo "<td>" . $assignmentMarks . "</td>";
                echo "</tr>";
            }
            $connection->close();
            ?>
        </table> 
        </div>
    </div>
</body>
</html>

