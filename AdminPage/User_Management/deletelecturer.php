<?php
include 'dbConn.php';

if(isset($_GET['lecturer_ID'])) {
    $lecturer_ID = $_GET['lecturer_ID'];

    // Create the DELETE query to remove the lecturer record
    $query = "DELETE FROM lecturer WHERE lecturer_ID = '$lecturer_ID'";

    // Execute the query
    if(mysqli_query($connection, $query)) {

        // Delete the corresponding lecturer_handle records
        $delete_handle_query = "DELETE FROM lecturer_handle WHERE lecturer_ID = '$lecturer_ID'";

        if(mysqli_query($connection, $delete_handle_query)) {
            echo "<script>alert('Lecturer record deleted successfully!');</script>";
            // Redirect back to the lecturer list if successful
            header("Location: lecturerlist.php");
            exit;
        } else {
            echo 'Error deleting record from lecturer_handle: ' . mysqli_error($connection);
        }
    } else {
        echo 'Error deleting record from lecturer: ' . mysqli_error($connection);
    }
}

mysqli_close($connection);
?>
