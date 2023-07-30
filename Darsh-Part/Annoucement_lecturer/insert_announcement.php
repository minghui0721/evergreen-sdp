<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'sdp';
$connection = mysqli_connect($host, $user, $password, $database);

if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['create_announcement'])) {
    $announcement_ID = $_POST['announcement_ID'];
    $lecturer_ID = $_POST['lecturer_ID'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Escape single quotes in the content field
    $content = mysqli_real_escape_string($connection, $content);

    // Use the current timestamp as the publish date
    $publish_date = date('Y-m-d H:i:s');

    // Prepare and execute the SQL query to insert the announcement into the database
    $query = "INSERT INTO `announcement` (`announcement_ID`, `lecturer_ID`, `title`, `content`, `publish_date`)
              VALUES ('$announcement_ID', '$lecturer_ID', '$title', '$content', '$publish_date')";
    if (mysqli_query($connection, $query)) {
        // Announcement created successfully, redirect to the "Announcement Management" page
        header("Location: lecturer_ann_dash.php");
        exit; // Make sure to exit the script after the redirect
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($connection);
    }
}
?>





