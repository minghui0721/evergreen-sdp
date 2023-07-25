<!-- Retrieving the courses from db -->
<?php
// Prepare the SQL query
include 'database/db_connection.php';
$sql = "SELECT * FROM course";

// Execute the query and store the result in a variable
$result = mysqli_query($conn, $sql);

// If the query execution fails, the mysqli_error($conn) function will provide the error message
if (!$result) {
    die("Error executing the query: " . mysqli_error($conn));
}

// Fetch multiple rows of data using a loop
$courses = array(); // Initialize an empty array to store course details
// Fetch multiple rows of data using a loop
while ($row = mysqli_fetch_assoc($result)) {
    // Access the data for each row using associative array keys
    $courseName = $row['course_name'];
    $courseDescription = $row['description'];
    $coursePrerequisites = $row['prerequisites'];
    $creditHours = $row['credit_hours'];
    $image = $row['img'];

    // Store the course details in the $courses array
    $courses[] = array(
        'course_name' => $courseName,
        'description' => $courseDescription,
        'prerequisites' => $coursePrerequisites,
        'credit_hours' => $creditHours,
        'image' => $image
    );
}

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
    <link rel="stylesheet" href="assets/css/academic.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include 'assets/fonts/font.html'; ?>
<!-- header -->
<div id="header"></div>

<div class="academic_container">
    <div class="academic_intro">
        <h2>ACADEMICS</h2>
        <p>Welcome to Evergreen Height University's 'Academics' page. We take pride in offering a diverse range of courses that inspire curiosity and foster personal growth. From Software Engineering to Business Management, our programs cater to a wide array of interests. Explore the endless possibilities for your academic journey and unlock your potential with us at Evergreen Height University.</p>
    </div>

    
    <div class="academic">
    <div class="background_color"></div>
    <?php
    $counter = 0; // Start with 1 to show details first
    $total_courses = count($courses);

    // Determine the pairs to display image first and then details
    $image_first_pairs = [];
    for ($i = 2; $i <= $total_courses; $i += 3) {
        $image_first_pairs[] = $i;
        $image_first_pairs[] = $i + 1;
    }

    foreach ($courses as $key => $course) {

        // Determine if this is one of the specific pairs of loops to display image first
        $is_image_first_pair = in_array($counter, $image_first_pairs);

        if ($is_image_first_pair) {
            // Display image first, then details
            echo '<div class="academic_img" style="background-image: url(\'' . $course['image'] . '\');"></div>';
            echo '<div class="academic_grid image_first">';
            echo '<h2>' . $course['course_name'] . '</h2>';
            echo '<p>' . $course['description'] . '</p>';
            echo '<button id="first_button">Learn More</button>';
            // echo $course['prerequisites'] . '</p>';
            // echo $course['credit_hours'] . '</p>';
            echo '</div>';
        } else {
            // Display details first, then image
            echo '<div class="academic_grid details_first">';
            echo '<h2>' . $course['course_name'] . '</h2>';
            echo '<p>' . $course['description'] . '</p>';
            echo '<button id="second_button">Learn More</button>';
            // echo $course['prerequisites'] . '</p>';
            // echo $course['credit_hours'] . '</p>';
            echo '</div>';
            echo '<div class="academic_img" style="background-image: url(\'' . $course['image'] . '\');"></div>';
        }

        // Increment the counter after each course
        $counter++;
    }
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