<?php
// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university'; // Change this to your database name
$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the announcement data from the form
    $title = $_POST["title"];
    $content = $_POST["content"];
    $publish_date = $_POST["publish_date"];

    // Prepare and execute the SQL query to insert the announcement into the database
    $sql = "INSERT INTO admin_announcement (title, content, publish_date) VALUES ('$title', '$content', '$publish_date')";

    if (mysqli_query($connection, $sql)) {
        // Redirect to the admin dashboard with a success message
        header("Location: admin_ann_dash.php?status=success");
        exit();
    } else {
        // Redirect back to the form with an error message
        header("Location: admin_announcement_form.php?status=error");
        exit();
    }
}

// Close the database connection
mysqli_close($connection);
?>




