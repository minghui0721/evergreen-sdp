<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

$connection = mysqli_connect($host, $user, $password, $database);

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
    <link rel="stylesheet" href="../admin/view_grading.css">
</head>
<div class="container_grade">
            <br>
            <table style="width:90%">
                <tr>
                <th>Grade ID</th>
                <th>Exam ID</th>
                <th>Course Program</th>
                <th>Student Name</th>
                <th>Subject Name</th>
                <th>Exam Marks</th>
                <th>Assignment Marks</th>
                <th>Overall Grade</th>
                </tr>   
                <?php
            //$student_ID = $_SESSION['student_ID'];
            $sql = "SELECT g.grade_ID, g.exam_ID, g.courseProgram_ID, g.student_ID, e.subject_ID, g.grade
                FROM grade g
                JOIN exam e ON g.exam_ID = e.exam_ID
                WHERE g.student_ID = 1"; //$student_ID
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

                $examMarks = $row["grade"]; // Assuming exam marks are in the 'grade' column
                $assignmentMarks = $assignmentRow ? $assignmentRow["grade"] : 0; // Assign 0 if no assignment marks
                $overallGrade = ($examMarks + $assignmentMarks) / 2;

                // Map the overall grade to a label
                $overallGradeLabel = mapGrade($overallGrade);

                // Display the overall grade
                echo "<td>" . $overallGradeLabel . "</td>";
                echo "</tr>";
            }
            function mapGrade($numericGrade) {
                $gradingList = array(
                    "A+" => 95,
                    "A" => 85,
                    "B+" => 75,
                    "B" => 65,
                    "C+" => 55,
                    "C" => 50,
                    "C-" => 45,
                    "D" => 40,
                    "F" => 0
                );
            
                foreach ($gradingList as $gradeLabel => $threshold) {
                    if ($numericGrade >= $threshold) {
                        return $gradeLabel;
                    }
                }
                return "N/A"; 
            }
            $connection->close();
            ?>
        </table> 
    </div>