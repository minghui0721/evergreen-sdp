<?php
include 'dbConn.php';

if(isset($_GET['lecturer_ID'])) {
    $student_ID = $_GET['lecturer_ID'];
    
    // Retrieve student record to be edited based on the ID
    $query = "SELECT * FROM lecturer WHERE lecturer_ID = '$lecturer_ID'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the student exists
    if(!$row) {
        die("Lecturer not found.");
    }
}

if(isset($_POST['submit'])) {
    // Retrieve form data
    $lecturer_ID = $_POST['lecturer_ID'];
    $lecturer_name = $_POST['lecturer_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];

    // Update student record in the database
    $update_query = "UPDATE lecturer SET lecturer_name = '$lecturer_name', phone = '$phone', email = '$email' WHERE lecturer_ID = '$lecturer_id'";
    $update_result = mysqli_query($connection, $update_query);

    if($update_result) {
        // Redirect to the student list page after successful update
        echo "Successful updating lecturer's record! ";
        header("Location: lecturerlist.php");
        exit();
    } else {
        echo "Error updating lecturer: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Lecturer</title>
    <link rel="stylesheet" href="editlecturer.css?v=<?php echo time(); ?>">
</head>
<body>
    <h2>Edit Lecturer</h2>
    <form action="" method="post">
        <label for="lecturer_ID">ID:</label>
        <input type="text" id="lecturer_ID" name="lecturer_ID" value="<?php echo $row['lecturer_ID']; ?>" required><br>

        <label for="lecturer_name">Full Name:</label>
        <input type="text" id="lecturer_name" name="lecturer_name" value="<?php echo $row['lecturer_name']; ?>" required><br>
        
        <label for="phone">Contact:</label>
        <input type="text" id="phone" name="phone" value="<?php echo $row['phone']; ?>" required><br>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required><br>
        
        <button type="submit" name="submit">Update</button>
    </form>
</body>
</html>
