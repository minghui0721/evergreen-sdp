<?php
include "../Admin_header/AdminHeader.php";
// <!-- path -->
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Announcement Form</title>
  <link rel="stylesheet" href="form_styles.css?v=<?php echo time(); ?>">

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
      <h1>Admin Announcement Form</h1>
      <form action="submit_announcement.php" method="post">
        <div class="form-row">
          <label for="announcement_id">Announcement ID:</label>
          <input type="text" id="announcement_id" name="announcement_id" required>
        </div>
        <div class="form-row">
          <label for="title">Title:</label>
          <input type="text" id="title" name="title" required>
        </div>
        <div class="form-row">
          <label for="content">Content:</label>
          <textarea id="content" name="content" rows="4" required></textarea>
        </div>
        <div class="form-row">
          <label for="publish_date">Publish Date:</label>
          <input type="datetime-local" id="publish_date" name="publish_date" required>
        </div>
        <button type="submit">Submit Announcement</button>
      </form>
    </div>
  </div>
</body>
</html>


