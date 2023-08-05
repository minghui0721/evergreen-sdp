<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Announcement Dashboard</title>
  <link rel="stylesheet" href="admin_dash.css">
</head>
<body>
  <div class="container">
    <h1>Admin Announcement Dashboard</h1>
    <?php
    // Check if the URL has a status parameter
    if (isset($_GET["status"])) {
        $status = $_GET["status"];
        if ($status === "success") {
            echo "<p class='success-message'>Announcement submitted successfully!</p>";
        } elseif ($status === "error") {
            echo "<p class='error-message'>Failed to submit announcement. Please try again.</p>";
        }
    }
    ?>
    <div class="buttons">
      <a href="admin_announcement_form.php" class="create-button">Create an Announcement</a>
      <a href="lecturer_announcement.php" class="view-button">View Previous Announcements</a>
      <a href="edit_delete_announcements.php" class="view-button">Edit / Delete Announcements</a>
      
      <!-- Add other buttons/options as needed -->
    </div>
  </div>
</body>
</html>



