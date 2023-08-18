<?php
// Database connection parameters
session_start();
include '../../database/db_connection.php';

// Retrieve the values from the URL parameters
$subject = $_GET['subject'];
$intake = $_GET['intake'];
$date = $_GET['date'];
$time = $_GET['time'];
$examID = $_GET['exam_id'];
$intakeID = $_GET['intake_id'];
$courseProgramID = $_GET['courseProgram_id'];

// Retrieve student data for the given intake_ID
$studentData = array();
$query = "SELECT student_name, student_ID FROM student WHERE intake_ID = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $intakeID);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Fetch grade data for each student
    $queryExamMarks = "SELECT grade, grade_ID FROM grade WHERE student_ID = ? AND exam_ID = ?";
    $stmtExamMarks = $conn->prepare($queryExamMarks);
    $stmtExamMarks->bind_param('si', $row['student_ID'], $examID);
    $stmtExamMarks->execute();
    $resultExamMarks = $stmtExamMarks->get_result();
    $rowExamMarks = $resultExamMarks->fetch_assoc();



if ($rowExamMarks = $resultExamMarks->fetch_assoc()) {
    $gradeID = $rowExamMarks['grade_ID'];
    $grade = $rowExamMarks['grade'];
} else {
    $gradeID = null;
    $grade = null;
}


// Add student data including grade_ID and grade to the array
$studentData[] = array(
    'student_name' => $row['student_name'],
    'student_ID' => $row['student_ID'],
    'grade_ID' => $gradeID,
    'grade' => $grade
);

    // Close the grade query prepared statement
    $stmtExamMarks->close();
}

// Close the first prepared statement
$stmt->close();

// Retrieve course name and program name from the course_program table
$queryCourseProgram = "SELECT course_name, program_name FROM course_program WHERE courseProgram_ID = ?";
$stmtCourseProgram = $conn->prepare($queryCourseProgram);
$stmtCourseProgram->bind_param('i', $courseProgramID);
$stmtCourseProgram->execute();
$resultCourseProgram = $stmtCourseProgram->get_result();
$rowCourseProgram = $resultCourseProgram->fetch_assoc();
$courseName = $rowCourseProgram['course_name'];
$programName = $rowCourseProgram['program_name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exam Grading</title>
    <link rel="stylesheet" href="../moodle/home.css">
    <link rel="stylesheet" href="setup.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<script>    
function goBack() {
    window.history.back();
}
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<header>
    <div class="header-content">
        <a href="#" onclick="goBack()"><button class="backbtn">Back</button></a>
        <a href="home.html"></a>
            <img src="../moodle/img/logo.png" height="80" weight="420" alt="Error" class="logo">
        </a>
        <h2 class="setup_title">Exam Grading</h2>
    </div>

    <hr id="header_line">
</header>


<body>
    <div class="container_grade">
        <h2 class="history_title">Exam Grading</h2>
        <br>
        <table style="width:80%">
            <tr>
                <th>No.</th>
                <th>Student</th>
                <th>Course</th>
                <th>Program</th>
                <th>Intake</th>
                <th>Exam Marks</th>
                <th style="width: 130px;">Action</th>
            </tr>
            <?php foreach ($studentData as $index => $student): ?>
                <tr>
                    <td><?php echo $index + 1; ?></td>
                    <td><?php echo $student['student_name']; ?></td>
                    <td><?php echo $courseName; ?></td>
                    <td><?php echo $programName; ?></td>
                    <td><?php echo $intake; ?></td>
                    <td>
                        <?php
                        if ($student['grade_ID']) {
                            $grade = $student['grade'];
                            echo $grade;
                        } else {
                            $grade = 0;
                            echo $grade;
                        }
                        ?>
                    </td>
                    <td>
<?php echo $grade; ?>
                    <?php
                            $gradeLink = "grade_exam.php" .
                                "?student_id=" . $student['student_ID'] .
                                "&grade_id=" . $student['grade_ID'] .
                                "&grade=" . $grade .
                                "&exam_id=" . $examID .
                                "&courseProgram_id=" . $courseProgramID .
                                "&prevPage=" . $_SERVER['REQUEST_URI'];
                            ?>
                            <a href="<?php echo $gradeLink; ?>">
                                <button style="margin-left: 15px;">Grade</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>


                <!-- if grade = 0, then insert new record -->

                <!-- if grade not 0, update grade -->






        </table>
    </div>
</body>

</html>

<?php
// Close the database connection
$conn->close();
?>







