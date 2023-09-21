
<?php
session_start();
include '../../assets/favicon/favicon.php'; // Include the favicon.php file
include "../../database/db_connection.php";

if ($conn === false) {
    die('Connection failed: ' . mysqli_connect_error());

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/config.js"></script> 
    <title id="documentTitle"></title>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
    <link rel="stylesheet" href="../admin/view_grading.css">
    <link rel="stylesheet" href="../../assets/css/studentHeader.css">
    <link rel="stylesheet" href="../../assets/css/more.css.?v = <?php echo time();?>">

</head>

<div id="header"></div>


<script>
        const container = document.getElementById('header');
        // Load header content
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            container.innerHTML = this.responseText;
        }
        };

        xhttp.open('GET', '../../student/studentHeader.php', true);
        xhttp.send();
    </script>
    <br><br><br><br>
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
            $student_ID = $_SESSION['student_ID'];
            $sql = "SELECT g.grade_ID, g.exam_ID, g.courseProgram_ID, g.student_ID, e.subject_ID, g.grade
                FROM grade g
                JOIN exam e ON g.exam_ID = e.exam_ID
                WHERE g.student_ID = $student_ID"; 
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["grade_ID"] . "</td>";
                echo "<td>" . $row["exam_ID"] . "</td>";

                $courseProgramID = $row["courseProgram_ID"];
                $courseProgramQuery = "SELECT course_name FROM course_program WHERE courseProgram_ID = $courseProgramID";
                $courseProgramResult = $conn->query($courseProgramQuery);
                $courseProgramRow = $courseProgramResult->fetch_assoc();
                echo "<td>" . $courseProgramRow["course_name"] . "</td>";

                $studentID = $row["student_ID"];
                $studentQuery = "SELECT student_name FROM student WHERE student_ID = $studentID";
                $studentResult = $conn->query($studentQuery);
                $studentRow = $studentResult->fetch_assoc();
                echo "<td>" . $studentRow["student_name"] . "</td>";

                $subjectID = $row["subject_ID"];
                $subjectQuery = "SELECT subject_name FROM subject WHERE subject_ID = $subjectID";
                $subjectResult = $conn->query($subjectQuery);
                $subjectRow = $subjectResult->fetch_assoc();
                echo "<td>" . $subjectRow["subject_name"] . "</td>";

                echo "<td>" . $row["grade"] . "</td>";
                $assignmentQuery = "SELECT grade FROM assignment_grading WHERE student_ID = $studentID";
                    $assignmentResult = $conn->query($assignmentQuery);
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
            $conn->close();
            ?>
        </table> 
    </div>