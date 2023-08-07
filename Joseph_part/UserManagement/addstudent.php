<?php
include 'dbConn.php';

if (isset($_POST['add'])) {
    $student_name = $_POST['student_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $program_ID = $_POST['program_ID'];
    $course_ID = $_POST['course_ID'];

    $query = "INSERT INTO student (student_name, phone, email, program_ID, course_ID) 
                    VALUES ('$student_name', '$phone', '$email', '$program_ID', '$course_ID')";


    if(mysqli_query($connection,$query)) {
        echo 'Student record added successfully!';
        header("Location: studentlist.php");
    } else {
        echo 'Error adding record: ' . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="addstudent.css?v=<?php echo time(); ?>">
    <title>Add Student</title>
</head>
<body>
    <h2>Add Student</h2>
    <form action="" method="post">
        <label for="student_name">Full Name:</label>
        <input type="text" id="student_name" name="student_name" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="program_ID">Program ID:</label>
        <input type="text" id="program_ID" name="program_ID" required>

        <label for="course_ID">Course ID:</label>
        <input type="text" id="course_ID" name="course_ID" required>

        <button type="submit" name="add">Add Student</button>
    </form>
</body>
</html>
