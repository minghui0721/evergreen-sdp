<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grading Page</title>
    <link rel="stylesheet" href="../moodle/home.css">
    <link rel="stylesheet" href="grading.css">
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
        <h2 class="setup_title">Grading</h2>
    </div>

    <hr id="header_line">
</header>
<body>
<div class="container_setup">
        <h1 class="title_setup">Grading Form</h1>
        <?php
        session_start(); // Start the session

        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'evergreen_heights_university';

        // Check if the assignment_id and student_id are provided in the URL
        if (isset($_GET['assignment_id']) && isset($_GET['student_id'])) {
            $assignment_id = $_GET['assignment_id'];
            $student_id = $_GET['student_id'];

            // Step 1 - Database connection
            $connection = mysqli_connect($host, $user, $password, $database);

            // Check database connection
            if ($connection === false) {
                die('Connection failed: ' . mysqli_connect_error());
            }
            
            // Fetch all the submissions from the assignment_submission table, filtered by assignment and student IDs
            $query = "SELECT asub.submission_ID, asub.assignment_ID, asub.student_ID, s.subject_name, asub.submission_file, asub.submission_date FROM assignment_submission asub
                      JOIN subject s ON asub.subject_ID = s.subject_ID
                      WHERE asub.assignment_ID = '$assignment_id' AND asub.student_ID = '$student_id'";

            $result = mysqli_query($connection, $query);

            if (mysqli_num_rows($result) > 0) {
                echo "<form method='post'>";
                echo "<input type='hidden' name='assignment_id' value='" . $assignment_id . "' />"; // Hidden input field for assignment ID
                echo "<table>";
                echo "<tr><th>Submission ID</th><th>Assignment ID</th><th>Student ID</th><th>Subject Name</th><th>Submission File</th><th>Submission Date</th><th>Grade</th></tr>";

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['submission_ID'] . "</td>";
                    echo "<td>" . $row['assignment_ID'] . "</td>";
                    echo "<td>" . $row['student_ID'] . "</td>";
                    echo "<td>" . $row['subject_name'] . "</td>"; // Displaying subject name
                    echo "<td>" . $row['submission_file'] . "</td>";
                    echo "<td>" . $row['submission_date'] . "</td>";
                    echo "<td class='input'><input type='hidden' name='submission_id' value='" . $row['submission_ID'] . "' />";
                    echo "<input type='hidden' name='student_id' value='" . $row['student_ID'] . "' />";
                    echo "<input type='text' name='grade' /></td>";
                    echo "</tr>";
                }

                echo "</table>";
                echo "<div class='button_wrapper'><button type='submit' name='submit'>Submit Grades</button></div>";
                echo "</form>";
            } else {
                echo "No submissions found.";
            }

            // Check if the form has been submitted
            if (isset($_POST['submit'])) {
                // Retrieve the form data
                $submission_id = $_POST['submission_id'];
                $student_id = $_POST['student_id'];
                $grade = $_POST['grade'];

                // Insert the grade into the assignment_grading table
                $query = "INSERT INTO assignment_grading (student_ID, grade) VALUES ('$student_id', '$grade')";
                mysqli_query($connection, $query);

                // Set a session variable to indicate successful submission
                $_SESSION['grade_submitted'] = true;
                
            }

            // Close the database connection after using the query result
            mysqli_close($connection);
        } else {
            echo "Assignment ID and Student ID not provided in the URL.";
        }
        ?>
    </div>
    <script>
    // After successfully submitting the grades
    if (<?php echo isset($_SESSION['grade_submitted']) ? 'true' : 'false'; ?>) {
        // After 2 seconds, go back to the previous page
        setTimeout(() => {
            window.history.back();
        }, 3000);

        // Clear the session variable after 2 seconds
        setTimeout(() => {
            <?php unset($_SESSION['grade_submitted']); ?>
        }, 3000);
    }
</script>
</body>
</html>