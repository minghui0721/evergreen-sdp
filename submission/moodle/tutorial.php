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

$ID = 0; // Default value in case 'subject_id' is not provided

if(isset($_GET['subject_id'])){
    $ID = (int)$_GET['subject_id']; // Convert to an integer to prevent SQL injection
}

if ($ID > 0) {
    // Query the subject based on subject_ID
    $sql = "SELECT * FROM subject WHERE subject_ID = $ID";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows > 0) {
        // Output data of the first row
        $row = $result->fetch_assoc();
        $subjectName = $row["subject_name"];
    } else {
        $subjectName = "Default Course Name"; // Set a default course name if no record is found
    }
} else {
    $subjectName = "Default Course Name"; // Set a default course name if 'subject_id' is not provided or invalid
}

// Query the tutorial based on subject_ID
$sqlTutorial = "SELECT * FROM tutorial_exercises WHERE subject_ID = $ID";
$resultTutorial = mysqli_query($connection, $sqlTutorial);
$TutorialData = array();

while ($rowTutorial = mysqli_fetch_assoc($resultTutorial)) {
    $TutorialData[] = $rowTutorial;
}

// Function to convert binary data to pptx file and save it
function savePPTXFile($binaryData, $filename) {
    file_put_contents($filename, $binaryData);
}

// Provide a unique name for the downloaded file
$downloadFilename = 'tutorial_exercises.pptx';

// Check if the user has requested to download a specific slide
if (isset($_GET['tutorial_id'])) {
    $requestedSlideID = (int)$_GET['tutorial_id'];

    // Find the slide with the requested slide_id
    foreach ($turotialData as $tutorial) {
        if ($tutorial['exercises_ID'] === $requestedTutorialID) {
            // Save the binary data as a .pptx file
            savePPTXFile($tutorial['tutorial_file'], $downloadFilename);

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
    <title>Java Programming (052023-KGT)</title>
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
        <a href="../home.html"></a>
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
        <a href="../home.html"> 
            <span>My Courses</span> 
        </a>
   </div>

   <div class="slides_java">
        <h2 class="title_2">Tutorial Exercises</h2>
        <ul>
        <?php foreach ($TutorialData as $tutorial) { ?>
            <li>
                <a href="download_tutorial.php?slide_id=<?php echo $tutorial['exercises_ID']; ?>">
                    <ion-icon name="albums-outline"></ion-icon>
                    &nbsp; <?php echo $tutorial['tutorial_title']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
        <br><br>
        
</body>
<style>
    .slides_java {
        border: 1px solid;
        padding: 20px;
        width: 98%;
        height: 520px;
        line-height: 1.5;
        background-color: white;
        margin-top: 20px;
        border-color: rgb(168, 168, 168);
        margin-left: 15px;
    }

    .slides_java a{
        text-decoration: none;
        color: black;
        margin-left: 20px;
        position: relative;
        margin-top: 10px;
        font-size: 20px;
    }

    .slides_java li{
        margin-left: 20px;
        margin-top: 5px;
    }
</style>



