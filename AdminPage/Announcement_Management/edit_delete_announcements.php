<?php
include "../Admin_header/AdminHeader.php";

// Connect to the database
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university'; // Change this to your database name
$connection = mysqli_connect($host, $user, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
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
    <link rel="stylesheet" href="edit_delete_announcements.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="edit_announcement_form.css?v=<?php echo time(); ?>">

<style>
    .InformationManagement{
        display: block;
    }

    .InformationManagement .ManageAnnouncements{
        color: #5c5adb;
    }
</style>

</head>
<body>
    <div class="wrapper">
        <div class="container">
            <h1>Edit/Delete Announcements</h1>
            <?php
            // Check for status messages from delete_announcement.php
            if (isset($_GET["status"])) {
                $status = $_GET["status"];
                if ($status === "deleted") {
                    echo "<p class='success-message'>Announcement deleted successfully!</p>";
                } elseif ($status === "error") {
                    echo "<p class='error-message'>Failed to perform action. Please try again.</p>";
                }
            }
            ?>
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
                        echo "<a href='edit_delete_announcements.php?edit_id=" . $row["announcement_id"] . "' class='edit-button'>Edit</a>";
                        echo "<a href='delete_announcement.php?announcement_id=" . $row["announcement_id"] . "' class='delete-button'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No announcements found.</p>";
                }
                ?>
        </div>


<?php
if (isset($_GET["edit_id"])) {
    $edit_id = $_GET["edit_id"];
    $edit_sql = "SELECT * FROM admin_announcement WHERE announcement_id = '$edit_id'";
    $edit_result = mysqli_query($connection, $edit_sql);

    // Check if the query was successful and if any rows were returned
    if ($edit_result && mysqli_num_rows($edit_result) > 0) {
        $edit_row = mysqli_fetch_assoc($edit_result);
?>
        <div class='edit-form'>
            <h2>Edit Announcement</h2>
            <form action='update_announcement.php' method='post'>
                <input type='hidden' name='announcement_id' value='<?php echo $edit_row["announcement_id"]; ?>'>
                <div class='form-row'>
                    <label for='title'>Title:</label>
                    <input type='text' id='title' name='title' value='<?php echo $edit_row["title"]; ?>' required>
                </div>
                <div class='form-row'>
                    <label for='content'>Content:</label>
                    <textarea id='content' name='content' rows='4' required><?php echo $edit_row["content"]; ?></textarea>
                </div>
                <div class='form-row'>
                    <label for='publish_date'>Publish Date:</label>
                    <input type='datetime-local' id='publish_date' name='publish_date' value='<?php echo date('Y-m-d\TH:i', strtotime($edit_row["publish_date"])); ?>' required>
                </div>
                <button type='submit'>Update Announcement</button>
            </form>
        </div>
    </div>
<?php
    } else {
        // The announcement with the provided edit_id does not exist or there was an error
        echo "<p>Error: Announcement not found.</p>";
    }
}
?>

