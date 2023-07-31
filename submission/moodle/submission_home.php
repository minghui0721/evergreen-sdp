<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

$connection = mysqli_connect($host, $user, $password, $database);

if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());

}

if(isset($_GET['subject_id'])){
    $ID = $_GET['subject_id'];
}

//subject title
$sql = "SELECT * FROM subject where subject_ID = $ID"; // You may use an appropriate WHERE clause here
$result = mysqli_query($connection, $sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $subjectName = $row["subject_name"];
} else {
    $subjectName = "Default Course Name"; // Set a default course name if no record is found
}

// Submission title
$student_ID = 1;

if (isset($_GET['assignment_id'])) {
    $assignmentID = $_GET['assignment_id'];

    // Submission status
    $sqlSubmissionStatus = "SELECT submission_file FROM assignment_submission WHERE student_ID = $student_ID AND assignment_ID = $assignmentID";
    $resultSubmissionStatus = mysqli_query($connection, $sqlSubmissionStatus);

    if ($resultSubmissionStatus) {
        if (mysqli_num_rows($resultSubmissionStatus) > 0) {
            // Fetch the submission file data
            $submissionData = mysqli_fetch_assoc($resultSubmissionStatus);
            $submissionStatus = "Submitted for Grading";
        } else {
            // No record found for the student ID and assignment ID
            $submissionStatus = "Not Submitted";
        }

        // Don't forget to free the result after use
        mysqli_free_result($resultSubmissionStatus);
    } else {
        // Handle the case when the query fails
        echo 'Error: ' . mysqli_error($connection);
    }
} else {
    // Assignment ID is not provided in the URL
    $submissionStatus = "Assignment ID not specified";
}

// Due date code
$sqlDueDate = "SELECT time_end FROM assignment_set WHERE subject_ID = $ID";
$resultDueDate = mysqli_query($connection, $sqlDueDate);

if ($resultDueDate) {
    if (mysqli_num_rows($resultDueDate) > 0) {
        // Fetch the due date from the result set
        $dueDateData = mysqli_fetch_assoc($resultDueDate);
        $dueDate = $dueDateData['time_end'];

        // Time remaining
        $currentDate = new DateTime(); // Current date and time
        $dueDateTime = new DateTime($dueDate); // Due date and time
        $timeRemaining = $currentDate->diff($dueDateTime);
        $timeRemainingFormatted = $timeRemaining->format('%a Days %h Hours %i Minutes');

        if ($submissionStatus === "Submitted for Grading" && $currentDate < $dueDateTime) {
            // Assignment was submitted early
            $timeRemainingStatus = "Assignment was submitted " . $timeRemainingFormatted . " early";
            $timeRemainingClass = "early_submission"; // CSS class for early submission
        } elseif ($submissionStatus === "Not Submitted" && $currentDate > $dueDateTime) {
            // Assignment is overdue
            $timeRemainingStatus = "Assignment is overdue by: " . $timeRemainingFormatted;
            $timeRemainingClass = "overdue_submission"; // CSS class for overdue submission
        } else {
            // Assignment is either submitted on time or not yet due
            $timeRemainingStatus = "Time remaining: " . $timeRemainingFormatted . " Remaining";
            $timeRemainingClass = "normal_submission"; // CSS class for normal submission
        }
    } else {
        // No record found for the student ID or the due date is not set
        $timeRemainingFormatted = "Not specified";
    }

    // Don't forget to free the result after use
    mysqli_free_result($resultDueDate);
} else {
    // Handle the case when the query fails
    echo 'Error: ' . mysqli_error($connection);
}

//assignment title
$sqlSubmission = "SELECT * FROM assignment_set where subject_ID = $ID"; 
$resultSubmission = mysqli_query($connection, $sqlSubmission);

if ($resultSubmission->num_rows > 0) {
    // Output data of the first row
    $row = $resultSubmission->fetch_assoc();
    $assignment_title = $row["assignment_title"];
} else {
    $assignment_title = "Assignment Not Available"; 
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $subjectName; ?></title>
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="course.css">
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
            <img src="./img/logo.png" height="80" weight="420" alt="Error" class="logo">
        </a>
        <h2 class="course_title">Course Material</h2>
        <!-- This is for searchbutton-->
        <div class="searchdown" >
            <button onclick="myFunction(event)" class="searchbtn" style="color:rgb(106, 117, 125);">Search...</button>
            <div id="mysearchdown" class="searchdown-content">
                <input type="text" placeholder="Search..." id="searchInput" onkeyup="filterFunction()">
                <a href="#">Software Development</a> 
                <a href="#">Digital Security and Forensic</a> 
                <a href="#">Introduction to Artificial Intelligence</a> 
                <a href="#">Java Programming</a> 
            
            </div>
        </div>
    </div>

<hr id="header_line">
</header>
<script>
function myFunction(event) {
document.getElementById("mysearchdown").classList.toggle("show");
}

function filterFunction() {
var input, filter, ul, li, a, i;
input = document.getElementById("searchInput");
filter = input.value.toUpperCase();
div = document.getElementById("mysearchdown");
a = div.getElementsByTagName("a");
for (i = 0; i < a.length; i++) {
    txtValue = a[i].textContent || a[i].innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
    a[i].style.display = "";
    } else {
    a[i].style.display = "none";
    }
}
}
</script>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<body>
   <div class="section_1">
        <h2 class="title"> <?php echo $subjectName; ?></h2>
        <a href="home.css"> 
            <span>My Courses</span> 
        </a>
   </div>
   
   <?php
   // Check if the subject_ID exists in the assignment_set table
$sqlCheckSubjectID = "SELECT assignment_ID FROM assignment_set WHERE subject_ID = $ID AND assignment_ID IS NOT NULL";
$resultCheckSubjectID = mysqli_query($connection, $sqlCheckSubjectID);

// Check if the query was successful and fetch the assignment_ID
if ($resultCheckSubjectID && mysqli_num_rows($resultCheckSubjectID) > 0) {
    // Fetch the assignment_ID from the result set
    $row = mysqli_fetch_assoc($resultCheckSubjectID);
    $assignmentID = $row['assignment_ID'];
    ?>

   <div class="container_submission">
    <h2 class="title"> <?php echo $assignment_title; ?></h2>
        <h3> Submission Status</h3>
            <div class="submission_container">
            <h4>Submission Status: <span style="color: <?php echo ($submissionStatus === 'Submitted for Grading') ? 'green' : 'red'; ?>"><?php echo $submissionStatus; ?></span></h4>
            </div>
            <div class="submission_container">
                <h4>Grading Status: Not Graded </h4>
            </div>
            <div class="submission_container">
                <h4>Due Date: <?php echo $dueDate; ?></h4>
            </div>
            <div class="submission_container">
            <h4 class="<?php echo $timeRemainingClass; ?>"><?php echo $timeRemainingStatus; ?></h4>
            </div>
            <div class="submission_container" style ="height: 90px;">
                <h4>File Submissions: <a href="upload.php?subject_id=<?php echo $ID;?>&assignment_id=<?php echo $assignmentID;?> " class="submission_button" >Submit</a></h4>
            </div>

    </div>
    <?php
}
// Don't forget to free the result after use
mysqli_free_result($resultCheckSubjectID);
?>
</body>

<style>
    .container_submission {
    border: 1px solid;
    padding: 20px;
    width: 98%;
    height: 530px;
    line-height: 1.5;
    background-color: white;
    margin-top: 20px;
    border-color: rgb(168, 168, 168);
    margin-left: 15px;
}

.submission_container{
    border: 1px solid;
    padding: 20px;
    width: 98%;
    height: 60px;
    line-height: 1.5;
    background-color: white;
    margin-top: 5px;
    border-color: rgb(168, 168, 168);
    margin-left: 15px;
}

.container_submission h3{
    margin-left: 20px;
    font-size: 23px;
    font-weight: normal;
}

.early_submission {
    color: green;
    font-weight: bold;
}

.overdue_submission {
    color: red;
    font-weight: bold;
}

.normal_submission {
    color: blue;
    /* Add other styles for normal submission */
}

.submission_button {
    padding: 10px 20px;
    background-color: transparent;
    color:rgb(61, 60, 60);
    text-decoration: none;
    border-radius: 5px;
    border: 2px solid rgb(53, 51, 51);
    height: 40px;
    width: 100px;
    outline: none;
    cursor: pointer;
    font-weight: 600;
    transition: 0.5s;
}

.submission_button:hover {
    background: #093e78;
    color: beige;
}

</style>

