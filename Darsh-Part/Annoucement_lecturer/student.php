<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Evergreen University Student Announcements</title>
  <link rel="stylesheet" href="Student_ann.css">
</head>
<body>
  <header>
    <!-- Add your header content here, as in the previous response -->
  </header>

  <div class="welcome">
    <!-- Add your welcome section content here, as in the previous response -->
  </div>

  <main>
    <section class="announcements">
      <h2>Latest Announcements</h2>
      <ul id="announcementList">
        <?php
          // Connect to the database
          $host = 'localhost';
          $user = 'root';
          $password = '';
          $database = 'sdp';
          $connection = mysqli_connect($host, $user, $password, $database);

          if ($connection === false) {
              die('Connection failed: ' . mysqli_connect_error());
          }

          // Fetch announcements from the database
          $query = "SELECT * FROM `announcement` ORDER BY `publish_date` DESC";
          $result = mysqli_query($connection, $query);
          $announcements = mysqli_fetch_all($result, MYSQLI_ASSOC);

          foreach ($announcements as $announcement) {
            echo '<li class="announcement-item">';
            echo '<div class="announcement-info">';
            echo '<strong>' . $announcement['title'] . '</strong><br>';
            echo $announcement['content'] . '<br>';
            echo '<em>By ' . $announcement['lecturer_ID'] . ' on ' . $announcement['publish_date'] . '</em>';
            echo '</div>';
            echo '</li>';
          }
        ?>
      </ul>
    </section>

    <section class="safety-security">
      <!-- Add your safety and security updates here, as in the previous response -->
    </section>

    <section class="important-reminders">
      <!-- Add your important reminders here, as in the previous response -->
    </section>
  </main>

  <script src="student_ann.js"></script>
</body>
</html>





