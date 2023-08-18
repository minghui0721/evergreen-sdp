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
    <title>Assignment Setup Form</title>
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
                <th>Grade ID</th>
                <th>Exam ID</th>
                <th>Course Program</th>
                <th>Student Name </th>
                <th>Subject Name</th>
                <th>Exam Marks</th>
                <th style="width: 130px;">Action</th>
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

                echo "<td><a href='grade_exam.php?id=" . $row["grade_ID"] . "&prevPage=" . urlencode($_SERVER['REQUEST_URI']) . "'><button style='margin-left: 15px;'>Grade</button></a></td>";
                echo "</tr>";
            }
            $connection->close();
            ?>
        </table>
    </div>
</body>

