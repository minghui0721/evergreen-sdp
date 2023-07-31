<?php
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sdp'; // Change this to your database name
$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_GET["announcement_id"])) {
    $announcement_id = $_GET["announcement_id"];
    // Delete the announcement from the database
    $delete_sql = "DELETE FROM admin_announcement WHERE announcement_id = '$announcement_id'";
    $delete_result = mysqli_query($connection, $delete_sql);

    if ($delete_result) {
        // Deletion successful, redirect back to the edit/delete page with a status parameter
        header("Location: edit_delete_announcements.php?status=deleted");
        exit;
    } else {
        // Deletion failed, redirect back to the edit/delete page with an error status parameter
        header("Location: edit_delete_announcements.php?status=error");
        exit;
    }
} else {
    // If the announcement_id parameter is not set, redirect back to the edit/delete page
    header("Location: edit_delete_announcements.php");
    exit;
}
?>


