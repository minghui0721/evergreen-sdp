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
    <div class="container_setup">
        <form action="" method="post">
            <label for="grade">Enter Grade Marks:</label>
            <input type="number" name="grade" id="grade" min="0" required>
            <input type="hidden" name="gradeID" value="<?php echo $gradeID; ?>">
            <br><br>
            <button type="submit" name="btnSubmit">Submit</button>
        </form>
    </div>

    <?php
        if (isset($_GET['btnSubmit'])) {
            $grade = $_GET['grade'];
            $gradeID = $_GET['gradeID'];

            // Database connection parameters
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

            // Update the grade in the database (modify this query based on your database structure)
            $updateQuery = "UPDATE grade SET grade = '$grade' WHERE grade_ID = $gradeID";
            $updateResult = $connection->query($updateQuery);

            if ($updateResult) {
                echo '<script>alert("Exam graded successfully!");</script>';
                echo '<script>window.location.href = "' . $_GET['prevPage'] . '";</script>';
                exit(); // Terminate the script
            } else {
                echo '<script>alert("Error grading exam: ' . $connection->error . '");</script>';
            }


            // Close connection
            $connection->close();
        }
else {
        echo "Grade ID not provided.";
    }
    ?>
</body>
</html>