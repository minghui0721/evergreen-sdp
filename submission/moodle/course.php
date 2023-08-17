<?php
include '../../assets/favicon/favicon.php'; // Include the favicon.php file
include "../../database/db_connection.php";


// Check database connection
if ($conn === false) {
    die('Connection failed: ' . mysqli_connect_error());

}


if(isset($_GET['subject_id'])){
    $ID = $_GET['subject_id'];
}

$sql = "SELECT * FROM subject where subject_ID = $ID"; // You may use an appropriate WHERE clause here
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    // Output data of the first row
    $row = $result->fetch_assoc();
    $subjectName = $row["subject_name"];
} else {
    $subjectName = "Default Course Name"; // Set a default course name if no record is found
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="course.css">
    <script src="../../assets/js/config.js"></script> 
    <title id="documentTitle"></title>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
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

   <div class="section_2">
        <h2 class="title_2"> Assesment Summative Assesment (eventually marked & moderated)</h2>
        <a href="assignment_home.php?subject_id=<?php echo $ID;?>">
            <ion-icon name="folder-outline"></ion-icon>
            <span> &nbsp; Assignment</span>
        </a>
        <br><br><hr>
        <br>
        <h2 class="title_2"> Teaching and Learning Materials</h2>
        <a href="slides.php?subject_id=<?php echo $ID;?>">
            <ion-icon name="folder-outline"></ion-icon>
            <span> &nbsp; Lecturer Slides</span><br>
        </a>
        <a href="tutorial.php?subject_id=<?php echo $ID;?>">
            <ion-icon name="folder-outline" class="tutorial"></ion-icon>
            <span> &nbsp; Tutorial Exercises</span>
        </a>
        <br><br><hr>
   </div>
</body>



