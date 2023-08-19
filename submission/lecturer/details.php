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

// Function to generate the custom filename based on student name, assignment ID, and submission date
function generateFilename($row) {
    $studentName = $row['student_name'];
    $assignmentID = $row['assignment_ID'];
    $submissionDate = $row['submission_date'];

    // You can format the filename as per your requirement
    return $studentName . "_assignment_" . $assignmentID . "_" . $submissionDate;
}

if (isset($_GET['assignment_ID'])) {
    $assignmentID = $_GET['assignment_ID'];

        $assignmentTitle = '';
        $sql_assignment = "SELECT assignment_title FROM assignment_set WHERE assignment_ID = $assignmentID";
        $result_assignment = mysqli_query($connection, $sql_assignment);
    
        if ($result_assignment && mysqli_num_rows($result_assignment) > 0) {
            $row_assignment = mysqli_fetch_assoc($result_assignment);
            $assignmentTitle = $row_assignment['assignment_title'];
        }

    // Step 2 - Fetch the details of the specific assignment from the database
    $sql = "SELECT s.student_name, asub.assignment_ID, asub.student_ID, asub.submission_file, asub.submission_date
            FROM assignment_submission asub
            INNER JOIN student s ON asub.student_ID = s.student_ID
            WHERE asub.assignment_ID = $assignmentID";
    $result = mysqli_query($connection, $sql);


    // Step 3 - Display the details of the assignment submission
    if (mysqli_num_rows($result) > 0) {
        echo "<!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Assignment Setup Form</title>
            <link rel='stylesheet' href='../moodle/home.css'>
            <link rel='stylesheet' href='setup.css'>
            <link rel='stylesheet' href='details.css'>
            
        </head>
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
        
        <script type='module' src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js'></script>
        <script nomodule src='https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js'></script>
        
        <header>
            <div class='header-content'>
                <a href='#' onclick='goBack()'><button class='backbtn'>Back</button></a>
                <a href='home.html'></a>
                    <img src='../moodle/img/logo.png' height='80' weight='420' alt='Error' class='logo'>
                </a>
                <h2 class='setup_title'>Details Submission</h2>
            </div>
        
            <hr id='header_line'>
        </header>
        <body>
            <div class='container_grade'>
                <br>
                <h2 class ='assignment_title'> Assignment Title: $assignmentTitle</h2>
                <table class='detail_table' style='width:60%'>
                    <tr>
                        <th>Student Name</th>
                        <th>Submission File</th>
                        <th>Submission Date</th>
                        <th>Grade</th>
                    </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row['student_name'] . "</td>";
                        echo "<td><a href='download.php?file_id=" . urlencode($row['submission_file']) . "&filename=" . urlencode(generateFilename($row)) . "'>" . $row['submission_file'] . "</a></td>";
                        echo "<td>" . $row['submission_date'] . "</td>";
                        echo "<td><a href='grading.php?assignment_id=" . $row['assignment_ID'] . "&student_id=" . $row['student_ID'] . "'><button type='button'>Grade</button></a></td>";
                        echo "</tr>";
                    }
                    

        echo "</table>
            </div>
        </body>
        </html>";
    } else {
        echo "No submissions for this assignment.";
    }
} else {
    echo "Assignment ID not provided in the URL.";
}

// Close the database connection
mysqli_close($connection);
?>

<script>
        // JavaScript to add the 'show' class after a delay (e.g., 1 second)
        setTimeout(function() {
            document.querySelector('.assignment_title').classList.add('show');
        }, 1000);
    </script>