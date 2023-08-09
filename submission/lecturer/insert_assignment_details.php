<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $subjectID = $_POST["subject_ID"];
    $assignmentTitle = $_POST["assignment_title"];
    
    // Database connection settings
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'evergreen_heights_university';
    
    // Step 1 - Database connection
    $connection = mysqli_connect($host, $user, $password, $database);
    
    // Check database connection
    if ($connection === false) {
        die('Connection failed: ' . mysqli_connect_error());
    }
    
    
    // Prepare the SQL statement to insert the assignment details into the table
    $sql = "INSERT INTO assignment_details (subject_ID, assignment_title, assignment_file) VALUES (?, ?, ?)";
    $stmt = $connection->prepare($sql);
    
    // Bind the parameters and execute the statement
    $stmt->bind_param("iss", $subjectID, $assignmentTitle, $assignmentFile);
    
    // Handle the assignment_file (longblob) data
    if ($_FILES["assignment_file"]["error"] == UPLOAD_ERR_OK) {
        $assignmentFile = file_get_contents($_FILES["assignment_file"]["tmp_name"]);
    } else {
        $assignmentFile = null;
    }
    
    // Execute the statement
    if ($stmt->execute()) {
        // Insertion successful
        echo '<script>
                alert("Assignment details inserted successfully.");
                setTimeout(function() {
                    window.location.href = "assignment_details.php";
                }, 3000); // Redirect after 3 seconds (adjust the time as needed).
             </script>';
        exit; // It's good practice to include an exit() after the header redirection.
    } else {
        // Insertion failed
        echo "Error: " . $sql . "<br>" . $connection->error;
    }
}
?>

