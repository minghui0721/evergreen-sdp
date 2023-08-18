<?php
include 'dbConn.php';

if(isset($_GET['lecturer_ID'])) {
    $lecturer_ID = $_GET['lecturer_ID'];
    
    // Retrieve lecturer record to be edited based on the ID
    $query = "SELECT * FROM lecturer WHERE lecturer_ID = '$lecturer_ID'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    // Check if the lecturer exists
    if(!$row) {
        die("Lecturer not found.");
    }

    // Retrieve the current intake IDs for the lecturer
    $intake_query = "SELECT intake_ID FROM lecturer_handle WHERE lecturer_ID = '$lecturer_ID'";
    $intake_result = mysqli_query($connection, $intake_query);
    $current_intake_IDs = array();
    while($intake_row = mysqli_fetch_assoc($intake_result)) {
        $current_intake_IDs[] = $intake_row['intake_ID'];
    }
}

// Retrieve all intakes and their associated course programs
$all_intakes_query = "SELECT i.intake_ID, i.intake, cp.program_name, cp.course_name 
                      FROM intake i 
                      JOIN course_program cp ON i.courseProgram_ID = cp.courseProgram_ID";
$all_intakes_result = mysqli_query($connection, $all_intakes_query);

if(isset($_POST['submit'])) {
    // Retrieve form data
    $lecturer_ID = $_POST['lecturer_ID'];
    $lecturer_name = $_POST['lecturer_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $intake_IDs = $_POST['intake'];  // now an array

    // Update lecturer record in the database
    $update_query = "UPDATE lecturer SET lecturer_name = '$lecturer_name', phone = '$phone', email = '$email' WHERE lecturer_ID = '$lecturer_ID'";
    $update_result = mysqli_query($connection, $update_query);

    if($update_result) {
        // Delete existing lecturer_handle records for this lecturer
        $delete_handle_query = "DELETE FROM lecturer_handle WHERE lecturer_ID = '$lecturer_ID'";
        $delete_handle_result = mysqli_query($connection, $delete_handle_query);

        // Insert new lecturer_handle records
        foreach ($intake_IDs as $intake_ID) {
            $insert_handle_query = "INSERT INTO lecturer_handle (lecturer_ID, intake_ID) 
                                    VALUES ('$lecturer_ID', '$intake_ID')";
            $insert_handle_result = mysqli_query($connection, $insert_handle_query);
        }

        // Redirect to the lecturer list page after successful update
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Fjalla+One&family=PT+Serif&display=swap" rel="stylesheet">
    <title>Edit Lecturer</title>
    <link rel="stylesheet" href="editlecturer.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="wrapper">
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
            
            <label for="intake">Course Program:</label><br>
            <?php while($intake_row = mysqli_fetch_assoc($all_intakes_result)) { ?>
                <input type="checkbox" id="intake_<?php echo $intake_row['intake_ID']; ?>" name="intake[]" value="<?php echo $intake_row['intake_ID']; ?>" <?php if(in_array($intake_row['intake_ID'], $current_intake_IDs)) echo 'checked'; ?>>
                <label class="checkbox-label" for="intake_<?php echo $intake_row['intake_ID']; ?>"><?php echo $intake_row['intake'] . ', ' . $intake_row['program_name'] . ', ' . $intake_row['course_name']; ?></label><br>
            <?php } ?>
            
            <button type="submit" name="submit">Update</button>
            <div class="cancel-container">
                <a class="cancel-link" href="lecturerlist.php">Cancel</a>
            </div>        
        </form>
    </div>
</body>
</html>

          
