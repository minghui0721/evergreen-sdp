<?php
session_start();
include '../../assets/favicon/favicon.php';
$lecturer_ID = $_SESSION['lecturer_ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Setup Form</title>
    <link rel="stylesheet" href="../moodle/home.css">
    <link rel="stylesheet" href="setup.css">
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png"> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png"> 
</head>
<script>    
function goBack() {
    window.history.back();
}
</script>

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
<?php
// Database connection and other setup code

if (isset($_GET['student_id'], $_GET['grade_id'], $_GET['exam_id'], $_GET['courseProgram_id'], $_GET['grade'], $_GET['prevPage'])) {
    $studentID = $_GET['student_id'];
    $gradeID = $_GET['grade_id'];
    $grade = $_GET['grade']; // Corrected line
    $examID = $_GET['exam_id'];
    $courseProgramID = $_GET['courseProgram_id'];
    $prevPage = $_GET['prevPage'];
} else {
    echo "One or more required parameters are missing.";
}

?>

<div class="container_setup">
<form action="grade_submit.php?student_id=<?php echo $studentID; ?>&grade_id=<?php echo $gradeID; ?>&grade=<?php echo $grade; ?>&exam_id=<?php echo $examID; ?>&courseProgram_id=<?php echo $courseProgramID; ?>&prevPage=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" method="post">
            <label for="grade">Enter Grade Marks:</label>
            <input type="number" name="grade" id="grade" value="<?php echo $grade; ?>" min="0" max="100" required>

            <input type="hidden" name="gradeID" value="<?php echo $gradeID; ?>">
            <br><br>
            <button type="submit" name="btnSubmit">Submit</button>
        </form>
    </div>
</body>
</html>