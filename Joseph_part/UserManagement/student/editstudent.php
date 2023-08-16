<?php
include 'dbConn.php';

include 'dbConn.php';

if(isset($_GET['student_ID'])) {
    $student_ID = $_GET['student_ID'];
    
    // Retrieve student record to be edited based on the ID
    $query = "SELECT student.*, intake.intake, course_program.course_name, course_program.program_name 
              FROM student 
              JOIN intake ON student.intake_ID = intake.intake_ID 
              JOIN course_program ON intake.CourseProgram_ID = course_program.CourseProgram_ID 
              WHERE student.student_ID = '$student_ID'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the student exists
    if(!$row) {
        die("Student not found.");
    }

    // Fetch all available intakes and associated course programs for the dropdown
    $intake_query = "SELECT intake.intake_ID, intake.intake, course_program.course_name, course_program.program_name 
                     FROM intake 
                     JOIN course_program ON intake.CourseProgram_ID = course_program.CourseProgram_ID";
    $intake_results = mysqli_query($connection, $intake_query);
}

if(isset($_POST['submit'])) {
    // Retrieve form data
    $student_ID = $_POST['student_ID'];
    $student_name = $_POST['student_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $intake_ID = $_POST['intake_ID'];

    // Update student record in the database
    $update_query = "UPDATE student SET student_name = '$student_name', phone = '$phone', email = '$email', intake_ID = '$intake_ID' WHERE student_ID = '$student_ID'";
    $update_result = mysqli_query($connection, $update_query);


    if($update_result) {
        // Redirect to the student list page after successful update
        echo "Successful updating student! ";
        header("Location: studentlist.php");
        exit();
    } else {
        echo "Error updating student: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student</title>
    <link rel="stylesheet" href="editstudent.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="wrapper">
        <h2>Edit Student</h2>
        <form action="" method="post">
            <label for="student_ID">ID:</label>
            <input type="text" id="student_ID" name="student_ID" value="<?php echo $row['student_ID']; ?>" required><br>

            <label for="student_name">Full Name:</label>
            <input type="text" id="student_name" name="student_name" value="<?php echo $row['student_name']; ?>" required><br>
            
            <label for="phone">Contact:</label>
            <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
            
            <label for="intake">Course Program:</label>
                <select id="intake" name="intake_ID" required>
                    <?php 
                    while($intake_row = mysqli_fetch_assoc($intake_results)) {
                        $selected = ($intake_row['intake_ID'] == $row['intake_ID']) ? 'selected' : '';
                        echo "<option value='{$intake_row['intake_ID']}' $selected>{$intake_row['intake']} - {$intake_row['program_name']} in {$intake_row['course_name']}</option>";
                    }
                    ?>
                </select>
                <br>

            <button type="submit" name="submit">Update</button>
        </form>
    </div>
</body>
</html>
