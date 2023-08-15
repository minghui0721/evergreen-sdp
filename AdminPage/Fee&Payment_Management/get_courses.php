<?php
include 'dbConn.php';

if (isset($_GET['program'])) {
    $selectedProgram = $_GET['program'];
    $courseQuery = "SELECT DISTINCT course_name FROM course_program WHERE program_name = '$selectedProgram'";
    $courseResult = mysqli_query($connection, $courseQuery);

    $courses = [];
    while ($courseRow = mysqli_fetch_assoc($courseResult)) {
        $courses[] = $courseRow;
    }

    echo json_encode($courses);
}
?>
