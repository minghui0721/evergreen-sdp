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
    <h1>Welcome to Evergreen University Student Announcements!</h1>
  </header>
  <div class="welcome">
    <img src="Images/student_1.jpg" alt="Header Image">
    <p>This page is your one-stop destination for all the latest updates, news, and events happening at Evergreen University. Stay informed about important announcements, academic schedules, campus activities, and more. Our goal is to ensure that you are always up-to-date with everything happening within the university community. From academic reminders to exciting extracurricular opportunities, you'll find it all here. We encourage you to check this page regularly to stay connected with your academic journey and make the most of your time at Evergreen University. Feel free to use the search bar above to find specific announcements quickly.</p>
  </div>
  <main>
    <div class="search-bar">
      <form action="student.php" method="GET" id="searchForm">
        <input type="text" name="search_query" placeholder="Search announcements...">
        <button type="submit">Search</button>
      </form>
    </div>
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
      if (isset($_GET['search_query'])) {
        $search_query = $_GET['search_query'];
        $query = "SELECT * FROM `announcement` WHERE `title` LIKE '%$search_query%' ORDER BY `publish_date` DESC";
      } else {
        $query = "SELECT * FROM `announcement` ORDER BY `publish_date` DESC";
      }

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

      // Close the database connection
      mysqli_close($connection);
    ?>
  </ul>
</section>
</main>
  <script src="script.js"></script>
</body>
</html>









