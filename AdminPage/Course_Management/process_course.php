<?php
include 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action'])) {
    $action = $_GET['action'];
    $courseProgramID = $_GET['courseProgram_id'];

    if ($action === 'edit') {
        // Handle edit action
        // You can redirect the user to an edit page or perform any necessary actions here
    } elseif ($action === 'delete') {

        $deleteIntakeQuery = "DELETE FROM intake WHERE courseProgram_ID = '$courseProgramID'";
        mysqli_query($conn, $deleteIntakeQuery);

        // Delete from course_program table
        $deleteCourseProgramQuery = "DELETE FROM course_program WHERE courseProgram_ID = '$courseProgramID'";
        mysqli_query($conn, $deleteCourseProgramQuery);
        
        // Redirect back to the course view page or show a success message
        header('Location: course_view.php');
        exit();
    }
}

// Handle other cases or errors here
?>
