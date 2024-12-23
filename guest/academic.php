<!-- Retrieving the courses from db -->
<?php
// Prepare the SQL query
include '../database/db_connection.php';
include '../assets/favicon/favicon.php'; // Include the favicon.php file

$sql = "SELECT courseProgram_ID, course_name, program_name, course_description, program_description, img FROM course_program";

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
    $courseProgramID = $row['courseProgram_ID'];
    $courseName = $row['course_name'];
    $programName = $row['program_name'];
    $courseDescription = $row['course_description'];
    $programDescription = $row['program_description'];
    $image = $row['img'];

    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $imageType = $finfo->buffer($image);

    $base64Image = base64_encode($image);

    // Store the course details in the $courses array
    $courses[] = array(
        'courseProgram_ID' => $courseProgramID,
        'course_name' => $courseName,
        'program_name' => $programName,
        'coursedescription' => $courseDescription,
        'description' => $programDescription,
        'image' => $base64Image,
        'image_type' => $imageType
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
    <script src="../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">
    <link rel="stylesheet" href="../assets/css/academic.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/font.html'; ?>
<!-- header -->
<div id="header"></div>

<div class="academic_container">
    <div class="academic_intro animation_bottom">
        <h2>ACADEMICS</h2>
        <p>Welcome to Evergreen Height University's 'Academics' page. We take pride in offering a diverse range of courses that inspire curiosity and foster personal growth. From Software Engineering to Business Management, our programs cater to a wide array of interests. Explore the endless possibilities for your academic journey and unlock your potential with us at Evergreen Height University.</p>
    </div>

    
    <div class="academic animation_fade">
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

        $courseName = $course['course_name'];
        $programName = $course['program_name'];

        // Determine if this is one of the specific pairs of loops to display image first
        $is_image_first_pair = in_array($counter, $image_first_pairs);

        if ($is_image_first_pair) {
            // Display image first, then details
            echo '<div class="academic_img" style="background-image: url(\'data:' . $course['image_type'] . ';base64,' . $course['image'] . '\');"></div>';
            echo '<div class="academic_grid image_first">';
            echo '<h2 class="animation_bottom">' . $courseName . ' <span style="font-size: 15px;">(' . $programName . ')</span>' . '</h2>';
            echo '<p class="animation_bottom">' . $course['description'] . '</p>';
            echo '<a href="course_details.php?courseProgram_id=' . $course['courseProgram_ID'] . '" class="course_button animation_bottom"><button id="first_button">Learn More</button></a>';
            // echo $course['prerequisites'] . '</p>';
            // echo $course['credit_hours'] . '</p>';
            echo '</div>';
        } else {
            // Display details first, then image
            echo '<div class="academic_grid details_first">';
            echo '<h2 class="animation_bottom">' . $courseName . ' <span style="font-size: 15px;">(' . $programName . ')</span>' . '</h2>';
            echo '<p  class="animation_bottom">' . $course['description'] . '</p>';
            echo '<a href="course_details.php?courseProgram_id=' . $course['courseProgram_ID'] . '" class="course_button animation_bottom"><button id="second_button" >Learn More</button></a>';
            // echo $course['prerequisites'] . '</p>';
            // echo $course['credit_hours'] . '</p>';
            echo '</div>';
            echo '<div class="academic_img" style="background-image: url(\'data:' . $course['image_type'] . ';base64,' . $course['image'] . '\');"></div>';
        }

        // Increment the counter after each course
        $counter++;
    }
    ?>
</div>

</div>

<!-- footer -->
<div id="footer"></div>

<div id="botpress-container"></div>

<script>
    // Initialize Botpress chatbot
    window.addEventListener('DOMContentLoaded', function () {
        WebChat.default.init({
            selector: '#botpress-container', // Specify the selector of your container
            baseUrl: 'https://mediafiles.botpress.cloud/823ae6e1-c24e-4c72-9235-2ec93b927a5c/webchat/bot.html', // Replace with your Botpress instance URL
        });
    });
</script>

<script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script src="https://mediafiles.botpress.cloud/823ae6e1-c24e-4c72-9235-2ec93b927a5c/webchat/config.js" defer></script>

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

<script src="../assets/js/animation.js"></script> 

</body>
</html>