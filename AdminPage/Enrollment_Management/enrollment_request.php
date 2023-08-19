<?php
include 'db_connection.php';
include "../Admin_header/AdminHeader.php";

// Retrieve enrollment requests from the database
$query = "SELECT * FROM enrollment_form WHERE status = 'Pending' ";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="enrollment_request.css?v=<?php echo time(); ?>"> <!-- Include your CSS file -->
    <link rel="shortcut icon" href="../../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <title>Enrollment Requests</title>

    <style>
    .AcademicManagement{
        display: block;
    }

    .AcademicManagement .ManageEnrollment{
        color: #5c5adb;
    }
    </style>
    
</head>
<body>
    <div class="wrapper">
        <?php include '../../assets/fonts/font.html'; ?>
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
                    <th>Picture</th>
                    <th>Action</th>
                </tr>
                
                <?php
                $counter = 1;

                if (mysqli_num_rows($result) == 0) {
                    echo '<table>';
                    echo '<tr><td colspan="7">No Enrollment Requests at the moment</td></tr>';
                    echo '</table>';
                } else{
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
                        
                        $result_profile = $row['profile'];
                        $finfo = new finfo(FILEINFO_MIME_TYPE);
                        $profileType = $finfo->buffer($result_profile);
                        $base64Profile = base64_encode($result_profile);
                        
                        echo '<tr>';
                        echo '<td>' . $counter . '</td>';
                        echo '<td>' . $courseName . ' (' . $programName .  ')</td>';
                        echo '<td>' . $intake . '</td>';
                        echo '<td>' . $row['name'] . '</td>';
                        echo '<td>' . $row['email'] . '</td>';
                        
                        // Inside the loop
                        echo '<td class="zoom-image"><img src="data:' . $imageType . ';base64,' . $base64Image . '" alt="Result Image" width="100" onclick="openModal(this)"></td>';
                        echo '<td class="zoom-image"><img src="data:' . $profileType . ';base64,' . $base64Profile . '" alt="Result Image" width="100" onclick="openModal(this)"></td>';
        
                        echo '<td>
                                <form method="GET" action="process_approval.php">
                                    <button class="approve-btn" name="action" value="approve" data-enrollment-id="' . $row['enrollment_ID'] . '">Approve</button>
                                    <button class="reject-btn" name="action" value="reject" data-enrollment-id="' . $row['enrollment_ID'] . '" onclick="return confirmReject();">Reject</button>
                                    <input type="hidden" name="enrollment_id" value="' . $row['enrollment_ID'] . '">
                                    <input type="hidden" name="course_program_id" value="' . $courseProgramID . '">
                                </form>
                            </td>';
                        echo '</tr>';
        
                        $counter++;
                    }   
                }
                ?>
            </table>
        </div>

        <div class="approved-container">
            <h1>Approved Enrollments</h1>
            <table>
                <tr>
                    <th>No.</th>
                    <th>Program</th>
                    <th>Intake</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                </tr>
                <?php
                // Retrieve approved enrollment requests from the database
                $approvedQuery = "SELECT * FROM enrollment_form WHERE status = 'Approved'";
                $approvedResult = mysqli_query($conn, $approvedQuery);
                $counter = 1;

                while ($row = mysqli_fetch_assoc($approvedResult)) {
                    $ApprovedIntakeID = $row['intake_ID'];
                    $ApprovedIntakeQuery = "SELECT courseProgram_ID, intake FROM intake WHERE intake_ID = '$ApprovedIntakeID'";
                    $ApprovedIntakeResult = mysqli_query($conn, $ApprovedIntakeQuery);

                    if ($ApprovedIntakeRow = mysqli_fetch_assoc($ApprovedIntakeResult)) {
                        $ApprovedCourseProgramID = $ApprovedIntakeRow['courseProgram_ID'];
                        $ApprovedIntake = $ApprovedIntakeRow['intake'];

                        // Fetch course_name and program_name from course_program table based on courseProgram_ID
                        $ApprovedCourseProgramQuery = "SELECT course_name, program_name FROM course_program WHERE courseProgram_ID = '$ApprovedCourseProgramID'";
                        $ApprovedCourseProgramResult = mysqli_query($conn, $ApprovedCourseProgramQuery);

                        if ($ApprovedCourseProgramRow = mysqli_fetch_assoc($ApprovedCourseProgramResult)) {
                            $ApprovedCourseName = $ApprovedCourseProgramRow['course_name'];
                            $ApprovedProgramName = $ApprovedCourseProgramRow['program_name'];
                        } else {
                            $ApprovedCourseName = 'N/A';
                            $ApprovedProgramName = 'N/A';
                        }
                    } else {
                        $ApprovedCourseProgramID = 'N/A'; // Set a default value if not found
                    }


                    echo '<tr>';
                    echo '<td>' . $counter . '</td>';
                    echo '<td>' . $ApprovedCourseName . ' (' . $ApprovedProgramName .  ')</td>';
                    echo '<td>' . $ApprovedIntake . '</td>';
                    echo '<td>' . $row['name'] . '</td>';
                    echo '<td>' . $row['email'] . '</td>';
                    echo '<td>' . $row['status'] . '</td>';
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


            function confirmReject() {
            return confirm('Are you sure you want to reject this enrollment request? This action cannot be undone.');
            }
        </script>

    </div>
</body>
</html>
