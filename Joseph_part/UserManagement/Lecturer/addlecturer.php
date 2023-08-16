<?php
include 'dbConn.php';

$query = "SELECT i.intake_ID, i.intake, cp.program_name, cp.course_name 
          FROM intake i 
          JOIN course_program cp ON i.courseProgram_ID = cp.courseProgram_ID";
$result = mysqli_query($connection, $query);

if (isset($_POST['add'])) {
    $lecturer_name = $_POST['lecturer_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $intake_IDs = $_POST['intake'];  // now an array

    // Insert the data into the lecturer table
    $query = "INSERT INTO lecturer (lecturer_name, phone, email, password) 
              VALUES ('$lecturer_name', '$phone', '$email', '$password')";

    if(mysqli_query($connection, $query)) {
        // get the ID of the last inserted record (the new lecturer)
        $lecturer_ID = mysqli_insert_id($connection);

        // insert the lecturer_ID and each courseProgram_ID into the lecturer_handle table
        foreach ($intake_IDs as $intake_ID) {
            $query = "INSERT INTO lecturer_handle (lecturer_ID, intake_ID) 
                      VALUES ('$lecturer_ID', '$intake_ID')";

            if(!mysqli_query($connection, $query)) {
                echo 'Error adding record to lecturer_handle: ' . mysqli_error($connection);
            }
        }

        echo 'Lecturer record added successfully!';
        header("Location: lecturerlist.php");
    } else {
        echo 'Error adding record to lecturer: ' . mysqli_error($connection);
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

    <script>
    function validateForm() {
        var checkboxes = document.querySelectorAll('input[name="intake[]"]');
        var checkedOne = Array.prototype.slice.call(checkboxes).some(x => x.checked);
        
        if (checkedOne) {
            return true;
        } else {
            alert('Please select at least one course program.');
            return false;
        }
    }
    </script>

</head>
<body>
    <div class="wrapper">
        <h2>Add Lecturer</h2>
        <form action="" method="post" onsubmit="return validateForm();">
            <label for="student_name">Full Name:</label>
            <input type="text" id="lecturer_name" name="lecturer_name" required>

            <label for="phone">Phone:</label>
            <input type="tel" id="phone" name="phone" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label class="course-program-label">Course Program:</label>
            <div class="checkbox-container">
                <?php while($row = mysqli_fetch_assoc($result)) { ?>
                    <div>
                        <input type="checkbox" id="intake_<?php echo $row['intake_ID']; ?>" name="intake[]" value="<?php echo $row['intake_ID']; ?>">
                        <label class="checkbox-label" for="intake_<?php echo $row['intake_ID']; ?>"><?php echo $row['intake'] . ', ' . $row['program_name'] . ', ' . $row['course_name']; ?></label>
                    </div>
                <?php } ?>
            </div>

            <button type="submit" name="add">Add Lecturer</button>
        </form>
    </div>
</body>
</html>
