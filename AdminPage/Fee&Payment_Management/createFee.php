<?php
session_start();
include "../Admin_header/AdminHeader.php";
include 'dbConn.php';

if (isset($_POST['create_fee'])) {
    $programName = $_POST['program_name'];
    $courseName = $_POST['course_name'];
    $amount = $_POST['amount'];

    // Retrieve courseProgram_ID from course_program table
    $query = "SELECT courseProgram_ID FROM course_program WHERE program_name = '$programName' AND course_name = '$courseName'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $courseProgramID = $row['courseProgram_ID'];

    // Retrieve intakes for the selected courseProgram_ID
    $intakeQuery = "SELECT intake_ID, opening_date FROM intake WHERE courseProgram_ID = '$courseProgramID'";
    $intakeResult = mysqli_query($connection, $intakeQuery);

    $feeCreationSuccess = true; // Track the success of fee creation

    while ($intakeRow = mysqli_fetch_assoc($intakeResult)) {
        $intakeID = $intakeRow['intake_ID'];
        $openingDate = $intakeRow['opening_date'];

        // Check if a fee already exists for the current intake, program, and course
        $existingFeeQuery = "SELECT * FROM fee 
                             INNER JOIN intake ON fee.intake_ID = intake.intake_ID
                             INNER JOIN course_program ON intake.courseProgram_ID = course_program.courseProgram_ID
                             WHERE intake.intake_ID = '$intakeID'
                             AND course_program.program_name = '$programName'
                             AND course_program.course_name = '$courseName'";
        $existingFeeResult = mysqli_query($connection, $existingFeeQuery);

        if (mysqli_num_rows($existingFeeResult) > 0) {
            // Display a message that fee has already been created for this intake, program, and course
            echo "<script>alert('Fee has already been created for this course');</script>";
            $feeCreationSuccess = false; // Set success flag to false
            break; // Exit the loop
        }

        // Calculate due_date
        $dueDate = date('Y-m-d', strtotime($openingDate . ' +3 months'));

        // Insert into fee table
        $insertFeeQuery = "INSERT INTO fee (intake_ID, total_amount, due_date) VALUES ('$intakeID', '$amount', '$dueDate')";

        if (mysqli_query($connection, $insertFeeQuery)) {
            $feeID = mysqli_insert_id($connection); // Get the ID of the last inserted fee

            $installmentDueDates = []; // Array to store due dates for installments
            $originalDueDate = strtotime($dueDate); // Convert due date to a timestamp

            // Calculate the due dates for installments
            $installmentDueDates[] = date('Y-m-d', $originalDueDate); // Initial due date
            $installmentDueDates[] = date('Y-m-d', strtotime('+3 months', $originalDueDate)); // Second installment due date
            $installmentDueDates[] = date('Y-m-d', strtotime('+6 months', $originalDueDate)); // Third installment due date

            foreach ($installmentDueDates as $index => $installmentDueDate) {
                $installmentCount = $index + 1; // Installment count (1, 2, 3)
                $installmentAmount = $amount / 3; // Split total amount into 3 installments
                
                // Insert into installment table
                $insertInstallmentQuery = "INSERT INTO installment (fee_ID, installment_count, amount, due_date) VALUES ('$feeID', '$installmentCount', '$installmentAmount', '$installmentDueDate')";

                if (!mysqli_query($connection, $insertInstallmentQuery)) {
                    // Handle insertion failure if needed
                }
            }
        } else {
            $feeCreationSuccess = false;
        }
    }

    if ($feeCreationSuccess) {
        echo '<script>alert("Fee creation completed successfully!");</script>';
    } else {
        echo '<script>alert("Fee creation failed. Please try again.");</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="createFee.css?v=<?php echo time(); ?>">
    <title>Create Fee</title>

<style>
    .FinancialManagement{
        display: block;
    }

    .FinancialManagement .CreateFees{
        color: #5c5adb;
    }
</style>

</head>
<body>
    <div class="wrapper">
        <div class="center-container">
            <h1>Create Fee</h1>
            <div class="container">
                <form action="" method="post">
                    <div class="form-row">
                        <div class="form-column">
                            <label for="program_name">Program:</label>
                            <select name="program_name" required onchange="this.form.submit()">
                                <option value="" selected disabled>Select a program</option>
                                <?php
                                $programQuery = "SELECT DISTINCT program_name FROM course_program ORDER BY FIELD(program_name, 'Foundation', 'Diploma', 'Degree')";
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
                            <select name="course_name" required onchange="this.form.submit()">
                                <option value="" disabled selected>Select a course</option>
                                <?php
                                if (isset($_POST['program_name'])) {
                                    $selectedProgram = $_POST['program_name'];
                                    $courseQuery = "SELECT DISTINCT course_name FROM course_program WHERE program_name = '$selectedProgram'";
                                    $courseResult = mysqli_query($connection, $courseQuery);
                                    while ($courseRow = mysqli_fetch_assoc($courseResult)) {
                                        $selected = ($_POST['course_name'] == $courseRow['course_name']) ? 'selected' : '';
                                        echo '<option value="' . $courseRow['course_name'] . '" ' . $selected . '>' . $courseRow['course_name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
 
                    <div class="center-column">
                        <label for="amount">Amount:</label><br>
                        <input class="amount-input" type="text" name="amount" style="width:250px;" required>
                    </div>
                    
                    <div class="center-column">
                        <input type="submit" name="create_fee" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
