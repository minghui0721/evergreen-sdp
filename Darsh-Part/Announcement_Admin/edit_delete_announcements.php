<!-- edit_delete_announcements.php -->
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

// Check if the delete_id parameter is set for deleting an announcement
if (isset($_GET["delete_id"])) {
    $delete_id = $_GET["delete_id"];
    $delete_sql = "DELETE FROM admin_announcement WHERE announcement_id = '$delete_id'";
    $delete_result = mysqli_query($connection, $delete_sql);

    if ($delete_result) {
        // Redirect back to the edit/delete announcements page with a success message
        header("Location: edit_delete_announcements.php?status=deleted");
        exit();
    } else {
        // Redirect back to the edit/delete announcements page with an error message
        header("Location: edit_delete_announcements.php?status=error");
        exit();
    }
}

// Retrieve the announcements from the database
$sql = "SELECT announcement_id, title, content, publish_date FROM admin_announcement ORDER BY publish_date DESC";
$result = mysqli_query($connection, $sql);

// Check for SQL query errors
if (!$result) {
    die("Error in SQL query: " . mysqli_error($connection));
}

// Check if the announcement_id parameter is set for editing
if (isset($_GET["edit_id"])) {
    $edit_id = $_GET["edit_id"];
    $edit_sql = "SELECT * FROM admin_announcement WHERE announcement_id = '$edit_id'";
    $edit_result = mysqli_query($connection, $edit_sql);
    $edit_row = mysqli_fetch_assoc($edit_result);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit/Delete Announcements</title>
    <link rel="stylesheet" href="edit_delete_announcements.css">
    <link rel="stylesheet" href="edit_announcement_form.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <h1>Edit Announcements</h1>
            <div class="announcements">
                <?php
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>";
                    echo "<tr><th>Title</th><th>Content</th><th>Publish Date</th><th>Actions</th></tr>";
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row["title"] . "</td>";
                        echo "<td>" . $row["content"] . "</td>";
                        echo "<td>" . $row["publish_date"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_announcement.php?edit_id=" . $row["announcement_id"] . "' class='edit-button'>Edit</a>";
                        echo "<a href='edit_delete_announcements.php?delete_id=" . $row["announcement_id"] . "' class='delete-button'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No announcements found.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>


