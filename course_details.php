<!-- Retrieving the courses from db -->
<?php
// Prepare the SQL query
include 'database/db_connection.php';


if(isset($_GET['courseProgram_id'])){
    $courseProgramID = $_GET['courseProgram_id'];
}

$sql = "SELECT * FROM course_program WHERE courseProgram_ID = $courseProgramID";

// Execute the query and store the result in a variable
$result = mysqli_query($conn, $sql);

// If the query execution fails, the mysqli_error($conn) function will provide the error message
if (!$result) {
    die("Error executing the query: " . mysqli_error($conn));
}


$row = mysqli_fetch_assoc($result) ;

$courseName = $row['course_name'];
$courseDescription = $row['course_description'];
$image = $row['img'];

$details_sql = "SELECT * FROM course_details WHERE course_ID = $courseProgramID";

$details_result = mysqli_query($conn, $details_sql);

if(!$details_result){
    die("Error executing the query: " . mysqli_error($conn));
}

$details_row = mysqli_fetch_assoc($details_result);

$purpose = $details_row['purpose'];
$prerequisite = $details_row['prerequisite'];
$credit_houts = $details_row['credit_hours'];


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/config.js"></script> 
    <link rel="shortcut icon" href="assets/images/evergreen-background.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/course_details.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include 'assets/fonts/font.html'; ?>
<!-- header -->
<div id="header"></div>

<div class="courseDetails_container">
    <div class="details_header">
        <?php
            echo '<h2>' . $courseName . '</h2>';
        ?>
    </div>

    <div class="color">

    </div>
            
    <div class="bg_image">
            <?php
                echo '<img src="' . $image . '" alt="Image Description">';
            ?>
    </div>

    <div class="content">
        <?php
            echo '<p>' . $purpose . '</p>';
        ?>
    </div>

</div>


<!-- footer -->
<div id="footer"></div>

<script>
        const container = document.getElementById('header');
        const footerContainer = document.getElementById('footer');

        // Load header content
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            container.innerHTML = this.responseText;
        }
        };

        xhttp.open('GET', 'header.php', true);
        xhttp.send();

         // Load footer content
        const footerXhttp = new XMLHttpRequest();
        footerXhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                footerContainer.innerHTML = this.responseText;
            }
        };
        footerXhttp.open('GET', 'footer.php', true);
        footerXhttp.send();
</script>
    
</body>
</html>