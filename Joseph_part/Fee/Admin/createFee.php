<?php
session_start();
include 'dbConn.php';

if (isset($_POST['create_fee'])) {
    $programName = $_POST['program_name'];
    $courseName = $_POST['course_name'];
    $intake = $_POST['intake'];
    $amount = $_POST['amount'];

    // Retrieve courseProgram_ID and intake_ID from respective tables
    $query = "SELECT courseProgram_ID FROM course_program WHERE program_name = '$programName' AND course_name = '$courseName'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $courseProgramID = $row['courseProgram_ID'];

    $query = "SELECT intake_ID, opening_date FROM intake WHERE courseProgram_ID = '$courseProgramID' AND intake = '$intake'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $intakeID = $row['intake_ID'];
    $openingDate = $row['opening_date'];

    // Calculate due dates
    $initialDueDate = date('Y-m-d', strtotime($openingDate . ' +3 months'));
    $secondDueDate = date('Y-m-d', strtotime($initialDueDate . ' +3 months'));
    $thirdDueDate = date('Y-m-d', strtotime($secondDueDate . ' +3 months'));

    // Insert into fee table
    $insertFeeQuery = "INSERT INTO fee (courseProgram_ID, total_amount, due_date) VALUES ('$courseProgramID', '$amount', '$initialDueDate')";
    
    if (mysqli_query($connection, $insertFeeQuery)) {
        $feeID = mysqli_insert_id($connection);
        
        // Insert into installment table
        $insertInstallmentQuery1 = "INSERT INTO installment (fee_ID, installment_count, amount, due_date) VALUES ('$feeID', '1', '$amount', '$initialDueDate')";
        mysqli_query($connection, $insertInstallmentQuery1);

        $insertInstallmentQuery2 = "INSERT INTO installment (fee_ID, installment_count, amount, due_date) VALUES ('$feeID', '2', '$amount', '$secondDueDate')";
        mysqli_query($connection, $insertInstallmentQuery2);

        $insertInstallmentQuery3 = "INSERT INTO installment (fee_ID, installment_count, amount, due_date) VALUES ('$feeID', '3', '$amount', '$thirdDueDate')";
        mysqli_query($connection, $insertInstallmentQuery3);

        echo "Fee creation completed successfully!";
        header('Location: createFee.php');
        exit();
    } else {
        echo "Fee creation failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fee.css?v=<?php echo time(); ?>">
    <title>Create Fee</title>
</head>
<body>
    <div class="center-container">
        <h1>Create Fee</h1>
        <div class="container">
        <form action="" method="post">
            <div class="form-row">
                <div class="form-column">
                    <label for="program_name">Program:</label>
                    <select name="program_name" required onchange="this.form.submit()">
                        <option value="" disabled>Select a program</option>
                        <?php
                        $programQuery = "SELECT DISTINCT program_name FROM course_program";
                        $programResult = mysqli_query($connection, $programQuery);
                        while ($programRow = mysqli_fetch_assoc($programResult)) {
                            $selected = '';
                            if (isset($_POST['program_name']) && $_POST['program_name'] == $programRow['program_name']) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . $programRow['program_name'] . '" ' . $selected . '>' . $programRow['program_name'] . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="form-column">
                    <label for="course_name">Course:</label>
                    <select name="course_name" required>
                        <option value="" disabled selected>Select a course</option>
                        <?php
                        if (isset($_POST['program_name'])) {
                            $selectedProgram = $_POST['program_name'];
                            echo "Selected Program: $selectedProgram"; 
                            $courseQuery = "SELECT DISTINCT course_name FROM course_program WHERE program_name = '$selectedProgram'";
                            $courseResult = mysqli_query($connection, $courseQuery);
                            while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                                echo '<option value="' . $courseRow['course_name'] . '">' . $courseRow['course_name'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-column">
                    <label for="intake">Intake:</label>
                    <select name="intake" required>
                        <option value="" disabled selected>Select an intake</option>
                        <?php
                        if (isset($_POST['program_name']) && isset($_POST['course_name'])) {
                            $selectedProgram = $_POST['program_name'];
                            $selectedCourse = $_POST['course_name']; 
                            // Get courseProgram_ID based on the selected program and course
                            $courseProgramQuery = "SELECT courseProgram_ID FROM course_program WHERE program_name = '$selectedProgram' AND course_name = '$selectedCourse'";
                            $courseProgramResult = mysqli_query($connection, $courseProgramQuery);
                            $courseProgramRow = mysqli_fetch_assoc($courseProgramResult);
                            $courseProgramID = $courseProgramRow['courseProgram_ID'];

                            // Fetch intakes based on the selected course program from the database
                            $intakeQuery = "SELECT DISTINCT intake FROM intake WHERE courseProgram_ID = '$courseProgramID'";
                            $intakeResult = mysqli_query($connection, $intakeQuery);
                            while ($intakeRow = mysqli_fetch_assoc($intakeResult)) {
                                echo '<option value="' . $intakeRow['intake'] . '">' . $intakeRow['intake'] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>

                <div class="form-column">
                    <label for="amount">Amount:</label>
                    <input type="text" name="amount" required>
                </div>
            </div>
            <input type="submit" name="create_fee" value="Create">
        </form>

        </div>
    </div>
</body>
</html>