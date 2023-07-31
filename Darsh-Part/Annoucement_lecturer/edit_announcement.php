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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the edited announcement data
    $announcementID = $_POST["announcement_ID"];
    $title = $_POST["title"];
    $content = $_POST["content"];
    
    // Update the announcement in the database
    $sql = "UPDATE announcement SET title='$title', content='$content' WHERE announcement_ID=$announcementID";
    if (mysqli_query($connection, $sql)) {
        header("Location: edit_delete_announcements.php"); // Redirect back to the list page after successful update
        exit();
    } else {
        echo "Error updating announcement: " . mysqli_error($connection);
    }
}

// Check if the 'id' key exists in the $_GET array
if (isset($_GET["id"])) {
    // Get the announcement ID from the URL parameter
    $announcementID = $_GET["id"];

    // Retrieve the announcement data from the database
    $sql = "SELECT * FROM announcement WHERE announcement_ID=$announcementID";
    $result = mysqli_query($connection, $sql);

    if (!$result) {
        echo "Error retrieving announcement: " . mysqli_error($connection);
        exit();
    }

    $announcement = mysqli_fetch_assoc($result);
} else {
    echo "Announcement ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Announcement</title>
  <link rel="stylesheet" href="edit_delete.css"> <!-- Add this line to link the common.css file -->
  <link rel="stylesheet" href="edit_announcement.css"> <!-- If any specific styles are needed for edit_announcement.php -->
</head>
<body>
  <div class="box">
    <div id="top">
      <h2>Edit Announcement</h2>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?id=" . $announcement["announcement_ID"]; ?>" method="post">
      <label for="title">Title:</label>
      <input type="text" id="title" name="title" value="<?php echo $announcement["title"]; ?>" required>

      <label for="content">Content:</label>
      <textarea id="content" name="content" rows="4" required><?php echo $announcement["content"]; ?></textarea>

      <input type="hidden" name="announcement_ID" value="<?php echo $announcement["announcement_ID"]; ?>">

      <button type="submit" name="update_announcement">Update Announcement</button>
    </form>
  </div>
</body>
</html>

<?php
mysqli_close($connection);
?>
