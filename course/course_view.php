<?php
include '../database/db_connection.php';

// Retrieve enrollment requests from the database
$query = "SELECT * FROM course_program ";

$result = mysqli_query($conn, $query);

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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/course_view.css?v=<?php echo time(); ?>"> <!-- Include your CSS file -->
    <link rel="shortcut icon" href="../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <title id="documentTitle"></title>
    <script src="../assets/js/config.js"></script> 
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>

</head>
<body>
    <?php include '../assets/fonts/font.html'; ?>
    <h1>Course Details</h1>

    <div class="page-container">
        <a href="course_create.php" class="add-course-btn">Add New Course</a>
        <table>
            <tr>
                <th>No.</th>
                <th>Course Name</th>
                <th>Program Name</th>
                <th>Intake</th>
                <th>Course Description</th>
                <th>Program Description</th>
                <th>Action</th>
            </tr>

            <?php
            $counter = 1;

            foreach ($courses as $course) {
                $courseProgramID = $course['courseProgram_ID'];
                $courseName = $course['course_name'];
                $programName = $course['program_name'];


                echo '<tr>';
                
                echo '<td>' . $counter . '</td>';
                echo '<td>' . $courseName. '</td>';
                echo '<td>' . $programName . '</td>';

                // Find the matching intake data using the courseProgram_ID
                $intakeQuery = "SELECT *  FROM intake WHERE courseProgram_ID = '$courseProgramID'";
                $intakeResult = mysqli_query($conn, $intakeQuery);
            
               $intakeRow = mysqli_fetch_assoc($intakeResult);

                $intakeID = $intakeRow['intake_ID'];
                $intake = $intakeRow['intake'];
                $open = $intakeRow['opening_date'];

                echo '<td>' . $intake . '</td>';

                echo '<td>' . $course['coursedescription'] . '</td>';
                echo '<td>' . $course['description'] . '</td>';

                echo '<td>
                            
                                <button class="edit-btn showModalBtn" data-courseprogram-id="' . $courseProgramID . '">Edit</button>
                            <form method="GET" action="process_course.php">
                                <button class="delete-btn" name="action" value="delete" data-courseProgram-id="' . $courseProgramID  . '" onclick="return confirmDelete();">Delete</button>
                                <input type="hidden" name="courseProgram_id" value="' . $courseProgramID  . '">
                            </form>
                        </td>';

                echo '</tr>';
                

                $counter++;
            }
            ?>
        </table>

    </div>

    <!-- Modal Structure -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        
        <!-- Your form -->
        <form action="add_course.php" method="post" enctype="multipart/form-data">

            <input type="hidden" name="courseProgram_ID" id="courseProgram_ID">

            <label for="course_name">Course Name:</label>
            <input type="text" id="course_name" name="course_name" required><br>

            <label for="program_name">Program Name:</label>
            <select id="program_name" name="program_name" required>
                <option value="" disabled selected>Select Program</option>
                <option value="Foundation">Foundation</option>
                <option value="Diploma">Diploma</option>
                <option value="Degree">Degree</option>
            </select><br>

            <label for="course_description">Course Description:</label>
            <textarea id="course_description" name="course_description" rows="4" cols="50" required></textarea><br>

            <label for="program_description">Program Description:</label>
            <textarea id="program_description" name="program_description" rows="4" cols="50" required></textarea><br>

            <label for="img" class="label_image">Upload Image:</label>
            <input type="file" id="img" name="img" accept="image/*"><br>

            <img id="courseImage" src="" alt="Course Image"> <!-- Image element to display the course image -->
            <br>

           <input type="submit" value="Add Course <?php echo isset($_POST['courseProgram_ID']) ? '(ID: ' . $_POST['courseProgram_ID'] . ')' : ''; ?>">

        </form>
        
    </div>
</div>



<script src="modal.js"></script>

    

    
    <script>
        const zoomImages = document.querySelectorAll('.zoom-image');
     
        function openModal(imgElement) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('enlargedImg');
            modalImg.src = imgElement.src;
            modal.style.display = 'block';

            const closeModalBtn = document.getElementsByClassName('close')[0];
            closeModalBtn.onclick = function() {
                modal.style.display = 'none';
            };
        }

        function confirmDelete() {
        return confirm('Are you sure you want to delete this record? This action cannot be undone.');
    }

</script>


</body>
</html>
