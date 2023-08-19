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

if (isset($_POST['btnsubmit'])) {
    // Retrieve the form data
    $lecturerID = 1;
    $courseProgramID = $_POST['courseProgram_ID'];
    $timeStart = $_POST['time_start'];
    $timeEnd = $_POST['time_end'];
    $subjectID = $_POST['subject_ID'];
    $assignmentTitle = $_POST['assignment_title'];

    // Step 3 - Insert data into the database
    $sql = "INSERT INTO assignment_set (lecturer_ID, courseProgram_ID, time_start, time_end, subject_ID, assignment_title) 
            VALUES ('$lecturerID', '$courseProgramID', '$timeStart', '$timeEnd', '$subjectID', '$assignmentTitle')";

    if (mysqli_query($connection, $sql)) {
        echo '<script>alert("Assignment data inserted successfully.");</script>';
        header("Location: lecturer_setup.php");
        exit;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}

// Close the database connection (remember to replace $connection with your actual database connection variable)
mysqli_close($connection);
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
        <h2 class="setup_title">Assignment</h2>
    </div>

    <hr id="header_line">
</header>

<body>
    <div class="container_setup">
        <h2 class="title_setup"> Assignment Form</h2>
        <form action="" method="post">
            <div class="input-group">
                <div class="input">
                    <label for="courseProgram_ID">Course Program ID <ion-icon name="school-outline"></ion-icon></label>
                    <input type="number" name="courseProgram_ID" id="courseProgram_ID" required min="1">
                </div>
            </div>
            <div class="input-group">
                <div class="input">
                    <label for="time_start">Date Start <ion-icon name="calendar-outline"></ion-icon></label>
                    <input type="datetime-local" name="time_start" id="time_start" required>
                </div>
                <div class="input">
                    <label for="time_end">Date End <ion-icon name="calendar-number-outline"></ion-icon></label>
                    <input type="datetime-local" name="time_end" id="time_end" required>
                </div>
            </div>
            <div class="input">
                <label for="subject_ID">Subject ID <ion-icon name="language-outline"></ion-icon></label>
                <input type="number" name="subject_ID" id="subject_ID" required min="1">
            </div>
            <div class="input">
                <label for="assignment_title">Assignment Title <ion-icon name="laptop-outline"></ion-icon></label>
                <input type="text" name="assignment_title" id="assignment_title" required >
            </div>
            <div class="button_wrapper">
                <a href=""><button type="submit" name = "btnsubmit">Submit</button></a>
            </div>
        </form>
    </div>
    <br><br>
    <hr style = "width: 95%; margin-left: 35px;" >

    <div class="container_grade">
        <h2 class="history_title">History</h2>
        <br>
        <h2 class="details">Click on the Assignment Title to check the details</h2>
        <table style="width:80%">
            <tr>
                <th>Assignment Title</th>
                <th>Subject Name</th>
                <th>Time Start</th>
                <th>Time End</th>
                <th>Action</th>
            </tr>

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

            // Step 2 - Fetch data from the database with subject_name from subject table
            $lecturerID = 1;
            $sql = "SELECT a.assignment_ID, a.assignment_title, a.subject_ID, a.time_start, a.time_end, s.subject_name 
                    FROM assignment_set a
                    INNER JOIN subject s ON a.subject_ID = s.subject_ID
                    WHERE a.lecturer_ID = $lecturerID";
            $result = mysqli_query($connection, $sql);

            // Step 3 - Loop through the data and display it in the table
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo '<td><a href="details.php?assignment_ID=' . $row['assignment_ID'] . '"><ion-icon name="arrow-forward-outline" class="arrow-icon"></ion-icon> ' . $row['assignment_title'] . '</a></td>';
                echo "<td>" . $row['subject_name'] . "</td>";
                echo "<td>" . $row['time_start'] . "</td>";
                echo "<td>" . $row['time_end'] . "</td>";
                echo '<td><a href="update_form.php?assignment_ID=' . $row['assignment_ID'] . '">Update</a></td>';
                echo "</tr>";
            }

            // Close the database connection
            mysqli_close($connection);
            ?>
        </table>
</div>

</div>
</body>
</html>





