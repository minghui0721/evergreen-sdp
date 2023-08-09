<?php
// Check if the form is submitted and the assignmentDetails_ID is provided
if (isset($_POST['delete_btn']) && isset($_POST['assignmentDetails_ID'])) {
    // Get the assignmentDetails_ID from the POST data
    $assignmentDetails_ID = $_POST['assignmentDetails_ID'];

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'evergreen_heights_university';
    
    // Step 1 - Database connection
    $connection = mysqli_connect($host, $user, $password, $database);

    // Check if the connection to the database was successful
    if ($connection === false) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Validate the assignmentDetails_ID (you can perform additional validation if needed)
    if (!is_numeric($assignmentDetails_ID)) {
        die("Invalid assignmentDetails ID.");
    }

    // Perform the delete operation in the database
    $query = "DELETE FROM assignment_details WHERE assignmentDetails_ID = $assignmentDetails_ID";
    $result = mysqli_query($connection, $query);

    if ($result) {
        // Deletion was successful
        // Redirect back to the page where the assignments are listed
        header("Location: assignment_details.php");
        exit;
    } else {
        // Error occurred during deletion
        // You can handle the error accordingly (e.g., show an error message)
        echo "Error deleting assignment: " . mysqli_error($connection);
    }

    // Close the database connection
    mysqli_close($connection);
} else {
    // The form was not submitted or assignmentDetails_ID is missing
    // Handle this case if necessary
    echo "Invalid request.";
}


