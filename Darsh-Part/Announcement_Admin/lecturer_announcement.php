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

// Retrieve the latest announcements from the database
$sql = "SELECT * FROM admin_announcement ORDER BY publish_date DESC LIMIT 10";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lecturer's Announcement Page</title>
  <link rel="stylesheet" href="lecturer_announcement.css">
</head>
<body>
  <div class="header">
    <div class="header-image">
      <img src="Images/lecturer_2.jpg" alt="Welcome Image" class="welcome-image">
    </div>
    <h1>Welcome to the Lecturer's Announcement Page</h1>
    <div class="search-bar">
      <input type="text" placeholder="Search Announcements">
      <button type="submit">Search</button>
    </div>
  </div>
  <div class="container">
    <h2>Latest Announcements</h2>
    <div class="announcements">
      <?php
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<div class='announcement'>";
              echo "<h3>" . $row["title"] . "</h3>";
              echo "<p>" . $row["content"] . "</p>";
              echo "<p class='publish-date'>Published on: " . $row["publish_date"] . "</p>";
              echo "</div>";
          }
      } else {
          echo "<p>No announcements found.</p>";
      }
      ?>
    </div>
  </div>
</body>
</html>

<?php
mysqli_close($connection);
?>


