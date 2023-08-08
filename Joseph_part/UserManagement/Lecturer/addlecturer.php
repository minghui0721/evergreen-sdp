<?php
include 'dbConn.php';

$query = "SELECT cp.courseProgram_ID, i.intake, cp.program_name, cp.course_name 
          FROM course_program cp 
          JOIN intake i ON cp.courseProgram_ID = i.courseProgram_ID";
$programs_result = mysqli_query($connection, $query);

if (isset($_POST['add'])) {
    $lecturer_name = $_POST['lecturer_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];


    $query = "INSERT INTO lecturer (student_name, phone, email,password) 
                    VALUES ('$student_name', '$phone', '$email', '$password')";


    if(mysqli_query($connection,$query)) {
        echo 'Lecturer record added successfully!';
        header("Location: lecturerlist.php");
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
    <link rel="stylesheet" href="addlecturer.css?v=<?php echo time(); ?>">
    <title>Add Lecturer</title>
</head>
<body>
    <h2>Add Lecturer</h2>
    <form action="" method="post">
        <label for="student_name">Full Name:</label>
        <input type="text" id="lecturer_name" name="lecturer_name" required>

        <label for="phone">Phone:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="course_program">Course Program:</label>
        <select id="course_program" name="course_program">
            <?php while($row = mysqli_fetch_assoc($programs_result)) { ?>
                <option value="<?php echo $row['courseProgram_ID']; ?>">
                    <?php echo $row['courseProgram_ID'] . ' - ' . $row['intake'] . ', ' . $row['program_name'] . ', ' . $row['course_name']; ?>
                </option>
            <?php } ?>
        </select>

        <button type="submit" name="add">Add Lecturer</button>
    </form>
</body>
</html>
