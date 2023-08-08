<?php
include '../database/db_connection.php';

// Retrieve enrollment requests from the database
$query = "SELECT * FROM enrollment_form";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/enrollment_request.css?v=<?php echo time(); ?>"> <!-- Include your CSS file -->
    <link rel="shortcut icon" href="../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <title>Enrollment Requests</title>

</head>
<body>
    <?php include '../assets/fonts/font.html'; ?>
    <h1>Enrollment Requests</h1>

    <div class="page-container">
        <table>
            <tr>
                <th>No.</th>
                <th>Program</th>
                <th>Intake</th>
                <th>Name</th>
                <th>Email</th>
                <th>Result</th>
                <th>Action</th>
            </tr>
            
            <?php
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {

                $intakeID = $row['intake_ID'];
                $intakeQuery = "SELECT courseProgram_ID, intake FROM intake WHERE intake_ID = '$intakeID'";
                $intakeResult = mysqli_query($conn, $intakeQuery);
                if ($intakeRow = mysqli_fetch_assoc($intakeResult)) {
                    $courseProgramID = $intakeRow['courseProgram_ID'];
                    $intake = $intakeRow['intake'];

                    // Fetch course_name and program_name from course_program table based on courseProgram_ID
                    $courseProgramQuery = "SELECT course_name, program_name FROM course_program WHERE courseProgram_ID = '$courseProgramID'";
                    $courseProgramResult = mysqli_query($conn, $courseProgramQuery);

                    if ($courseProgramRow = mysqli_fetch_assoc($courseProgramResult)) {
                        $courseName = $courseProgramRow['course_name'];
                        $programName = $courseProgramRow['program_name'];
                    } else {
                        $courseName = 'N/A';
                        $programName = 'N/A';
                    }
                } else {
                    $courseProgramID = 'N/A'; // Set a default value if not found
                }

                $result_image = $row['result'];
                $finfo = new finfo(FILEINFO_MIME_TYPE);
                $imageType = $finfo->buffer($result_image);
                $base64Image = base64_encode($result_image);
                
                echo '<tr>';
                echo '<td>' . $counter . '</td>';
                echo '<td>' . $courseName . ' (' . $programName .  ')</td>';
                echo '<td>' . $intake . '</td>';
                echo '<td>' . $row['name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                
            // Inside the loop
                echo '<td class="zoom-image"><img src="data:' . $imageType . ';base64,' . $base64Image . '" alt="Result Image" width="100" onclick="openModal(this)"></td>';

                echo '<td>
                        <form method="GET" action="process_approval.php">
                            <button class="approve-btn" name="action" value="approve" data-enrollment-id="' . $row['enrollment_ID'] . '">Approve</button>
                            <button class="reject-btn" name="action" value="reject" data-enrollment-id="' . $row['enrollment_ID'] . '">Reject</button>
                            <input type="hidden" name="enrollment_id" value="' . $row['enrollment_ID'] . '">
                        </form>
                    </td>';
                echo '</tr>';

                $counter++;
            }
            ?>
        </table>
    </div>

    <div id="imageModal" class="modal">
        <span class="close">&times;</span>
        <img class="modal-content" id="enlargedImg">
    </div>

    
    <script>
        const zoomImages = document.querySelectorAll('.zoom-image');
        const approveButtons = document.querySelectorAll('.approve-btn');
        const rejectButtons = document.querySelectorAll('.reject-btn');


        rejectButtons.forEach(button => {
            button.addEventListener('click', () => {
                const enrollmentID = button.getAttribute('data-enrollment-id');
                // Use AJAX to send the rejection request to the server and update the status
                // Display success message or update the row's status
            });
        });

        
        // At the bottom of the script tag
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
