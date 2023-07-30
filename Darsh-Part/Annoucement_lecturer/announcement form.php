<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lecturer Page - Announcement Creator</title>
  <link rel="stylesheet" href="lecturer_ann.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cooper+Black&display=swap">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Dream+Outloud+Pro&display=swap">
</head>
<body>
  <div class="container">
    <h1>Announcement Creator Form</h1>
    <form action="insert_announcement.php" method="post" id="announcementForm">
      <div class="form-row">
        <label for="announcement_ID">Announcement ID:</label>
        <input type="text" id="announcement_ID" name="announcement_ID" required>
      </div>

      <div class="form-row">
        <label for="lecturer_ID">Lecturer ID:</label>
        <input type="text" id="lecturer_ID" name="lecturer_ID" required>
      </div>

      <label for="title">Title:</label>
      <input type="text" id="title" name="title" required>

      <label for="content">Content:</label>
      <textarea id="content" name="content" rows="4" required></textarea>

      <label for="dateTime">Date and Time:</label>
      <input type="datetime-local" id="dateTime" name="dateTime" required>

      <button type="submit" name="create_announcement">Create Announcement</button>
      
    </form>
  </div>
  <script src="script.js"></script>
</body>
</html>






