<?php
include '../../assets/favicon/favicon.php'; // Include the favicon.php file
include "../../database/db_connection.php";

// Check database connection
if ($conn === false) {
    die('Connection failed: ' . mysqli_connect_error());

}

// Fetch courses from the database
$sql = "SELECT * FROM subject where courseProgram_ID = '1'"; // Replace 'your_table_name' with the actual table name
$result = mysqli_query($conn, $sql);

$subjects = array(); // Initialize an empty array to store course details

// Fetch multiple rows of data using a loop
while ($row = mysqli_fetch_assoc($result)) {
    // Access the data for each row using associative array keys
    $subject_ID = $row['subject_ID'];
    $subject_name = $row['subject_name'];
    $image = $row['img'];

    // Store the course details in the $subjects array
    $subjects[] = array(
        'subject_ID' => $subject_ID,
        'subject_name' => $subject_name,
        'img' => $image
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/config.js"></script> 
    <title id="documentTitle"></title>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
    <link rel="stylesheet" href="home.css">
</head>
<header>
<div class="header-content">
            <a href="../../student/more.php"><button class="backbtn">Back</button></a>
            <a href="home.php"></a>
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

<body>
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
<body>
    <div id="mySidenav" class="sidenav">
        <a href="#" id="SDP">Software Development Project (052023-DWO)</a>
        <a href="#" id="DSF">Digital Security and Forensic (052023-RHW)</a>
        <a href="#" id="JP">Java Programming (052023-KGT)</a>
        <a href="#" id="AI">Introduction to Artificial Intelligence (052023-VTK)</a>
      </div>
      
</body>

<?php
$counter = 0; // Start with 0 to show details first
$total_subjects = count($subjects);

// Determine the pairs to display image first and then details
$image_first_pairs = [];
for ($i = 1; $i < $total_subjects; $i += 2) {
    $image_first_pairs[] = $i;
}

$counter = 0; // Initialize the counter
foreach ($subjects as $key => $subject) {
    // Increment the counter for each subject
    $counter++;

    // Start a new row for every even subject
    if ($counter % 2 !== 0) {
        // Choose the class for the row based on the counter
        $row_class = $counter % 4 === 1 ? 'row-color-1' : 'row-color-2';
        echo '<div class="row ' . $row_class . '">';
    }

    echo '<div class="image-container">';
    echo '<a href="course.php?subject_id=' .$subject['subject_ID']. '"class="image-link">';
    echo '<div class="image-box">';
    echo '<img src="' . $subject['img'] . '" height="250" width="380" alt="' . $subject['subject_name'] . '" class="img_sdp">';
    echo '<p class="image-caption">' . $subject['subject_name'] . '</p>';
    echo '</div></a>';
    echo '</div>';

    // Close the row after every even subject
    if ($counter % 2 === 0 || $counter === $total_subjects) {
        echo '</div>';
    }
}
?>
    </body>

    </html>
