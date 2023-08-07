<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the announcement_id parameter is set
    if (isset($_POST["announcement_id"])) {
        $announcement_id = $_POST["announcement_id"];
        $title = $_POST["title"];
        $content = $_POST["content"];
        $publish_date = $_POST["publish_date"];

        // Connect to the database
        $host = 'localhost';
        $user = 'root';
        $password = '';
        $database = 'evergreen_heights_university'; // Change this to your database name
        $connection = mysqli_connect($host, $user, $password, $database);

        // Check the database connection
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Prepare and execute the SQL query to update the announcement
        $update_sql = "UPDATE admin_announcement SET title = '$title', content = '$content', publish_date = '$publish_date' WHERE announcement_id = '$announcement_id'";
        $update_result = mysqli_query($connection, $update_sql);

        // Check for SQL query errors
        if (!$update_result) {
            die("Error in SQL query: " . mysqli_error($connection));
        }

        // Close the database connection
        mysqli_close($connection);

        // Redirect back to the edit/delete announcements page with a success message
        header("Location: edit_delete_announcements.php?status=updated");
        exit();
    } else {
        // If announcement_id parameter is not set, redirect back to the edit/delete announcements page with an error message
        header("Location: edit_delete_announcements.php?status=error");
        exit();
    }
}
?>
