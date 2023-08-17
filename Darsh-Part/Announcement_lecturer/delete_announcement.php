<?php
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sdp';
$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the announcement ID is provided in the URL parameter
if (isset($_GET['id'])) {
    $announcementID = $_GET['id'];

    // Delete the announcement from the database
    $sql = "DELETE FROM announcement WHERE announcement_ID = $announcementID";

    if (mysqli_query($connection, $sql)) {
        // Delete successful, redirect back to the announcement list page
        header("Location: edit_delete_announcements.php");
        exit();
    } else {
        echo "Error deleting announcement: " . mysqli_error($connection);
    }
}

// Close the database connection
mysqli_close($connection);
?>
