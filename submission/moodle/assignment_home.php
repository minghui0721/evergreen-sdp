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


if(isset($_GET['subject_id'])){
    $ID = $_GET['subject_id'];
}

$sql = "SELECT * FROM subject where subject_ID = $ID"; // You may use an appropriate WHERE clause here
$result = mysqli_query($connection, $sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $subjectName = $row["subject_name"];
} else {
    $subjectName = "Default Course Name"; // Set a default course name if no record is found
}



// Query the details based on subject_ID
$sqldetails = "SELECT * FROM assignment_details WHERE subject_ID = $ID";
$resultdetails = mysqli_query($connection, $sqldetails);
$detailsData = array();

while ($rowdetails = mysqli_fetch_assoc($resultdetails)) {
    $detailsData[] = $rowdetails;
}

// Function to convert binary data to docx file and save it
function saveDOCXFile($binaryData, $filename) {
    file_put_contents($filename, $binaryData);
}

// Provide a unique name for the downloaded file
$downloadFilename = 'assignment_details.docx';

// Check if the user has requested to download a specific slide
if (isset($_GET['details_id'])) {
    $requestedDetailsID = (int)$_GET['details_id'];

    // Find the details with the requested slide_id
    foreach ($detailsData as $details) {
        if ($details['assignmentDetails_ID'] === $requestedDetailsID) {
            // Save the binary data as a .pptx file
            saveDOCXFile($details['assignment_file'], $downloadFilename);

            // Send the file to the user as an attachment
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $downloadFilename . '"');
            readfile($downloadFilename);
            exit;
        }
    }
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

   <div class="section_2_1">
        <h2 class="title_2"> Assignment Details</h2>
            <ul>
        <?php foreach ($detailsData as $details) { ?>
            <li>
                <a href="download_details.php?slide_id=<?php echo $details['assignmentDetails_ID']; ?>">
                <ion-icon name="document-outline"></ion-icon>
                    &nbsp; <?php echo $details['assignment_title']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
        <br>
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

    // The subject_ID exists in the assignment_set table, and there is a valid assignment_ID, so display the link
    ?>
    <div class="section_2_2">
        <h2 class="title_2"> Assignment Submission</h2>
        <a href="submission_home.php?subject_id=<?php echo $ID;?>&assignment_id=<?php echo $assignmentID; ?>">
            <ion-icon name="folder-outline"></ion-icon>
            <span> &nbsp; Submission </span>
        </a>
        <br>
    </div>
    <?php
}

// Don't forget to free the result after use
mysqli_free_result($resultCheckSubjectID);
?>

   <br><br><br>
</body>

   <br><br><br>
</body>


<style>
    .section_2_1 ion-icon{
        font-size: 25px;
        margin-top: 10px;
        margin-left: -25px;
    }

    .section_2_1 ul{
        margin-left: 20px;
    }

    .section_2_1{
    border: 1px solid;
    padding: 20px;
    width: 98%;
    height: 250px;
    line-height: 1.5;
    background-color: white;
    margin-top: 20px;
    border-color: rgb(168, 168, 168);
    margin-left: 15px;
}

.section_2_1 a {
    text-decoration: none;
    color: black;
    margin-left: 45px;
    position: relative;
    margin-top: 10px;
    font-size: 20px;
}

.section_2_1 a span::after {
    content: '';
    position: absolute;
    left: 0;
    width: 100%;
    height: 3px;
    background: #5c5adb;
    border-radius: 5px;
    transform-origin: left;
    bottom: -6px;
    transform: scaleX(0);
    transition: transform 0.5s;
}

.section_2_1 a:hover span::after {
    transform: scaleX(1);
}

.section_2_2{
    border: 1px solid;
    padding: 20px;
    width: 98%;
    height: 150px;
    line-height: 1.5;
    background-color: white;
    margin-top: 20px;
    border-color: rgb(168, 168, 168);
    margin-left: 15px;
}

.section_2_2 a {
    text-decoration: none;
    color: black;
    margin-left: 45px;
    position: relative;
    margin-top: 10px;
    font-size: 20px;
}

.section_2_2 a span::after {
    content: '';
    position: absolute;
    left: 0;
    width: 100%;
    height: 3px;
    background: #5c5adb;
    border-radius: 5px;
    transform-origin: left;
    bottom: -6px;
    transform: scaleX(0);
    transition: transform 0.5s;
}

.section_2_2 a:hover span::after {
    transform: scaleX(1);
}
</style>

