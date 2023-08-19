<?php
// Database connection parameters
session_start();
include '../../database/db_connection.php';
include '../../assets/favicon/favicon.php'; // Include the favicon.php file


try {
    // Replace lecturer_ID with the actual value
    $lecturerID = $_SESSION['lecturer_ID'];
    $lecturerID = 1;
    // Step 1: Retrieve subject details using lecturer_ID
    $query1 = "SELECT s.subject_ID, s.subject_name, s.courseProgram_ID
               FROM subject s
               WHERE s.lecturer_ID = ?";
    $stmt1 = $conn->prepare($query1);
    $stmt1->bind_param('i', $lecturerID);
    $stmt1->execute();
    $result1 = $stmt1->get_result();
    $subjects = $result1->fetch_all(MYSQLI_ASSOC);

    
    // Step 2: Retrieve intake details using courseProgram_ID
    $tableData = array();
    $counter = 1;
    foreach ($subjects as $subject) {

        $courseProgramID = $subject['courseProgram_ID'];

         // Query to fetch course name and program name
        $queryCourseProgram = "SELECT cp.course_name, cp.program_name
                               FROM course_program cp
                               WHERE cp.courseProgram_ID = ?";
        $stmtCourseProgram = $conn->prepare($queryCourseProgram);
        $stmtCourseProgram->bind_param('i', $courseProgramID);
        $stmtCourseProgram->execute();
        $resultCourseProgram = $stmtCourseProgram->get_result();
        $courseProgramData = $resultCourseProgram->fetch_assoc();

        
        $query2 = "SELECT i.intake_ID, i.intake
                   FROM intake i
                   WHERE i.courseProgram_ID = ?";
        $stmt2 = $conn->prepare($query2);
        $stmt2->bind_param('i', $courseProgramID);
        $stmt2->execute();
        $result2 = $stmt2->get_result();
        $intakes = $result2->fetch_all(MYSQLI_ASSOC);

        foreach ($intakes as $intake) {
            // Step 3: Retrieve exam details using intake_ID and subject_ID
            $intakeID = $intake['intake_ID'];
            $subjectID = $subject['subject_ID'];
            $currentDateTime = date('Y-m-d H:i:s');

            $query3 = "SELECT e.date_time, e.exam_ID
                       FROM exam e
                       WHERE e.intake_ID = ? AND e.subject_ID = ? AND e.date_time < ?";
            $stmt3 = $conn->prepare($query3);
            $stmt3->bind_param('iis', $intakeID, $subjectID, $currentDateTime);
            $stmt3->execute();
            $result3 = $stmt3->get_result();
            $exams = $result3->fetch_all(MYSQLI_ASSOC);

            foreach ($exams as $exam) {
             // Inside the loop, split date_time into date and time
            $examDateTime = new DateTime($exam['date_time']);
            $examDate = $examDateTime->format('Y-m-d');
            $examTime = $examDateTime->format('H:i:s');

            
                $row = array(
                    'Numbering' => $counter, // You can add numbering logic here
                    'Subject Name' => $subject['subject_name'],
                    'Course Name' =>  $courseProgramData['course_name'], // Fetch course name using courseProgram_ID
                    'Program Name' => $courseProgramData['program_name'], // Fetch program name using courseProgram_ID
                    'Intake' => $intake['intake'],
                    'Date' => $examDate, // Split date_time into date
                    'Time' => $examTime, // Split date_time into time
                    'Exam_ID' => $exam['exam_ID'],
                    'intake_ID' => $intakeID,
                );

                $tableData[] = $row;
            }
        }
        $counter = $counter + 1;
    }

    // Now you can use $tableData to generate your HTML table

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html>
<head>
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="../../assets/css/exam_grading.css.?v=<?php echo time(); ?>">  
    <script src="../../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
        function goBack() {
    window.history.back();
}
</script>
</script>
</head>
<body>
<div class="container fade-in">     
    <a href="#" onclick="goBack()"><button class="backbtn">Back</button></a>       
        <h1>Exam Grading Overview</h1>

        <table id="appointmentTable">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Subject Name</th>
                    <th>Course Name</th>
                    <th>Program Name</th>
                    <th>Intake</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tableData as $row): ?>
                    <tr>
                        <td><?php echo $row['Numbering']; ?></td>
                        <td><?php echo $row['Subject Name']; ?></td>
                        <td><?php echo $row['Course Name']; ?></td>
                        <td><?php echo $row['Program Name']; ?></td>
                        <td><?php echo $row['Intake']; ?></td>
                        <td><?php echo $row['Date']; ?></td>
                        <td><?php echo $row['Time']; ?></td>
                        <td>
                            <a href="exam_grading.php?subject=<?php echo $subject['subject_name']; ?>&intake=<?php echo $intake['intake']; ?>&date=<?php echo $examDate; ?>&time=<?php echo $examTime; ?>&exam_id=<?php echo $row['Exam_ID']; ?>&courseProgram_id=<?php echo $courseProgramID; ?>&intake_id=<?php echo $row['intake_ID']; ?>">
                                <button class="grade-button">Grade</button>

                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<style>

    .backbtn{
    width: 100px;
    height: 50px;
    margin-top: 50px;
    margin-bottom: -200px;
    margin-left: 50px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
    transition: 0.5s;
    border: 2px solid rgb(53, 51, 51);
    background: #504099;
    color: white;

    
}

.backbtn:hover{
    background: #093e78;
    color: beige;
}
</style>