<?php
include 'dbConn.php';

if(isset($_GET['student_ID'])) {
    $student_ID = $_GET['student_ID'];
    
    // Retrieve student record to be edited based on the ID
    $query = "SELECT * FROM student WHERE student_ID = '$student_ID'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the student exists
    if(!$row) {
        die("Student not found.");
    }
}

if(isset($_POST['submit'])) {
    // Retrieve form data
    $student_ID = $_POST['student_ID'];
    $student_name = $_POST['student_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $program_ID = $_POST['program_ID'];
    $course_ID = $_POST['course_ID'];

    // Update student record in the database
    $update_query = "UPDATE student SET student_name = '$student_name', phone = '$phone', email = '$email', program_ID = '$program_ID', course_ID = '$course_ID' WHERE student_ID = '$student_id'";
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
        
        <label for="program_ID">Program ID:</label>
        <input type="text" id="program_ID" name="program_ID" value="<?php echo $row['program_ID']; ?>" required><br>
        
        <label for="course_ID">Course ID:</label>
        <input type="text" id="course_ID" name="course_ID" value="<?php echo $row['course_ID']; ?>" required><br>

        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
