<?php
include 'dbConn.php';

if (isset($_GET['program'])) {
    $selectedProgram = $_GET['program'];
    $intakeQuery = "SELECT DISTINCT intake FROM intake WHERE program_name = '$selectedProgram'";
    $intakeResult = mysqli_query($connection, $intakeQuery);

    $intakes = [];
    while ($intakeRow = mysqli_fetch_assoc($intakeResult)) {
        $intakes[] = $intakeRow;
    }

    echo json_encode($intakes);
}
?>
