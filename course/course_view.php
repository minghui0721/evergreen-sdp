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
    <title>Enrollment Requests</title>

</head>
<body>
    <?php include '../assets/fonts/font.html'; ?>
    <h1>Course Details</h1>

    <div class="page-container">

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
                            <form method="GET" action="process_approval.php">
                                <button class="approve-btn" name="action" value="approve" data-enrollment-id="' . $courseProgramID . '">Approve</button>
                                <button class="reject-btn" name="action" value="reject" data-enrollment-id="' . $courseProgramID  . '">Reject</button>
                                <input type="hidden" name="enrollment_id" value="' . $courseProgramID  . '">
                            </form>
                        </td>';

                echo '</tr>';

                $counter++;
            }
            ?>
        </table>


    </div>

    
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

</script>


</body>
</html>
