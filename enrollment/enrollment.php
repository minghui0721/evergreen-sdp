<?php
include '../assets/favicon/favicon.php'; // Include the favicon.php file
?>


<!-- Retrieving the courses from db -->
<?php
// Prepare the SQL query
include '../database/db_connection.php';
$sql = "SELECT * FROM course_program";

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

    // Store the course details in the $courses array
    $courses[] = array(
        'courseProgram_ID' => $courseProgramID,
        'course_name' => $courseName,
        'program_name' => $programName,
        'course_description' => $courseDescription,
        'program_description' => $programDescription,
        'image' => $image
    );
}


$sql_intake = "SELECT * FROM intake";

$result_intake = mysqli_query($conn, $sql_intake);

if (!$result_intake) {
    die("Error executing the query: " . mysqli_error($conn));
}

$intakes = array();

while ($row_intake = mysqli_fetch_assoc($result_intake)) {
    $courseProgram_intake = $row_intake['courseProgram_ID'];
    $intake = $row_intake['intake'];
    $opening = $row_intake['opening_date'];

    $intakes[] = array(
        'courseProgram_intake' => $courseProgram_intake,
        'intake' => $intake,
        'opening' => $opening
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
    <script src="../assets/js/config.js"></script> 
    <link rel="stylesheet" href="../assets/css/enrollment.css.?v=<?php echo time(); ?>">  
    <link rel="stylesheet" href="../assets/css/header.css.?v=<?php echo time(); ?>">  
    <link rel="stylesheet" href="../assets/css/footer.css.?v=<?php echo time(); ?>">  
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">

    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
    <div id="header"></div>

    <div class="container">
        <h1 class="animation_bottom">Enrollment Application</h1>
        
        <form action="submit_enrollment.php" method="post" enctype="multipart/form-data" class="animation_fade">
        <div class="form-group">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="birthdate">Date of Birth:</label>
            <input type="date" id="birthdate" name="birthdate" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="secondary_school">Secondary School:</label>
            <input type="text" id="secondary_school" name="secondary_school" required>
        </div>
        <div class="form-group">
            <label for="transcript">Upload Secondary Result:</label>
            <input type="file" id="transcript" name="transcript" accept="image/*" required>
        </div>
<<<<<<< Updated upstream
        
        <div class="form-group">
            <label for="profile">Upload Profile Picture:</label>
=======
        <div class="form-group">
            <label for="profile">Profile Picture:</label>
>>>>>>> Stashed changes
            <input type="file" id="profile" name="profile" accept="image/*" required>
        </div>

        <div class="form-group">
            <label for="program_option">Program Option:</label>
            <select id="program_option" name="program_option" required>
                <option value="" disabled selected>Select an option</option>
                <option value="Diploma">Diploma</option>
                <option value="Foundation">Foundation</option>
                <option value="Degree">Degree</option>
            </select>
        </div>

        <div class="form-group">
            <label for="course_option">Course Option:</label>
            <select id="course_option" name="course_option" required>
                <option value="" disabled selected>Select a course</option>
                <!-- Courses options will be dynamically updated using JavaScript -->
            </select>
        </div>

        <div class="form-group">
            <label for="intake_option">Intake Option:</label>
            <select id="intake_option" name="intake_option" required>
                <option value="" disabled selected>Select an intake</option>
                <!-- intakes options will be dynamically updated using JavaScript -->
            </select>
        </div>
        
            
        <script>
    var programOption = document.getElementById("program_option");
    var courseOption = document.getElementById("course_option");
    var intakeOption = document.getElementById("intake_option");

    var selectedCourseID;

    // Function to update the course dropdown based on the selected program
    function updateCourseOptions() {
        // Get the selected program ID
        var selectedProgram = programOption.value;

        // Clear existing course options
        courseOption.innerHTML = '<option value="" disabled selected>Select a course</option>';

        // Loop through the courses array and add course options that match the selected program
        <?php foreach ($courses as $course) { ?>
            var courseID = "<?php echo $course['courseProgram_ID']; ?>";
            var courseName = "<?php echo $course['course_name']; ?>";
            var programName = "<?php echo $course['program_name']; ?>";

            if (programName === selectedProgram) {
                var newOption = document.createElement("option");
                newOption.value = courseID; // Use the courseProgram ID as the value for later we can direct find the intake_ID
                newOption.textContent = courseName; // Display the course name
                courseOption.appendChild(newOption);
            }
        <?php } ?>
    }

    // Function to update the intake options based on the selected course
    function updateIntakeOptions() {
        var selectedCourseProgramID = courseOption.value;

        // Clear existing intake options
        intakeOption.innerHTML = '<option value="" disabled selected>Select an intake</option>';
        
        // Get the current date
         var currentDate = new Date();

        // Loop through the intakes array and add intake options that match the selected courseProgram_ID
        <?php foreach ($intakes as $intake) { ?>
            var courseProgramID = "<?php echo $intake['courseProgram_intake']; ?>";
            var intakeName = "<?php echo $intake['intake']; ?>";
            var openingDate = "<?php echo $intake['opening']; ?>";

            if (courseProgramID === selectedCourseProgramID) {
                var intakeDate = new Date(openingDate);
                var newIntakeOption = document.createElement("option");
                newIntakeOption.value = intakeName;
                newIntakeOption.textContent = intakeName + " (" + openingDate + ")";
                if (intakeDate < currentDate) {
                    newIntakeOption.disabled = true;
                }
                intakeOption.appendChild(newIntakeOption);
            } 
        <?php } ?>
    }

    // Attach the updateCourseOptions function to the change event of the program option select element
    programOption.addEventListener("change", updateCourseOptions);

    // Attach the updateIntakeOptions function to the change event of the course option select element
    courseOption.addEventListener("change", function () {
        selectedCourseID = courseOption.value;
        console.log(selectedCourseID); // Log the selectedCourseID for debugging
        updateIntakeOptions();
    });

    // Trigger the function initially to populate the course options based on the default selected program (if any)
    updateCourseOptions();
</script>



        <div class="form-group">
            <label for="payment_option">Payment Option:</label>
            <select id="payment_option" name="payment_option" required>
            <option value="" disabled selected>Select an option</option>
            <option value="installment">Installment</option>
            <option value="full_payment">Full Payment</option>
            </select>
        </div>
        <button type="submit" class="application_button">Submit Application</button>
        </form>
  </div>

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

        xhttp.open('GET', '../guest/header.php', true);
        xhttp.send();

         // Load footer content
        const footerXhttp = new XMLHttpRequest();
        footerXhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                footerContainer.innerHTML = this.responseText;
            }
        };
        footerXhttp.open('GET', '../guest/footer.php', true);
        footerXhttp.send();
    </script>

    <script src="../assets/js/animation.js"></script> 

</body>
</html>