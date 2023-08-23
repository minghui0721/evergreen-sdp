<?php
include "../Admin_header/AdminHeader.php";
// <!-- path -->
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin - Student Feedback Responses</title>
  <link rel="stylesheet" type="text/css" href="admin_feedback.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cooper+Black&display=swap">

<style>
    .InformationManagement{
        display: block;
    }

    .InformationManagement .ViewFeedback{
        color: #5c5adb;
    }
</style>

</head>
<body>
  <div class = "wrapper">
    <div class="container">
      <table>
      <h1>Student Feedback Responses</h1>
        <tr>
          <th>Rating</th>
          <th>Issues</th>
          <th>Suggestions</th>
          <th>Action</th>
        </tr>
        <?php
          // Establish database connection
          $host = 'localhost';
          $user = 'root';
          $password = '';
          $database = 'evergreen_heights_university';
          $connection = mysqli_connect($host, $user, $password, $database);

          // Check connection
          if (!$connection) {
              die("Connection failed: " . mysqli_connect_error());
          }

          // Handle delete operation if "delete" parameter is passed in the URL
          if (isset($_GET['delete'])) {
            $delete_id = $_GET['delete'];
            $stmt = $connection->prepare("DELETE FROM feedback WHERE id = ?");
            $stmt->bind_param("i", $delete_id);
            $stmt->execute();
            $stmt->close();
          ?>

          <script>
              window.location.replace("#");
          </script>

          <?php
          }

          // Fetch feedback responses from the database
          $sql = "SELECT * FROM feedback";
          $result = $connection->query($sql);

          if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                  echo "<tr>";
                  echo "<td>" . $row["rating"] . "</td>";
                  echo "<td>" . $row["issues"] . "</td>";
                  echo "<td>" . $row["suggestions"] . "</td>";
                  echo "<td><a href='admin_feedback.php?delete=" . $row["id"] . "'>Delete</a></td>";
                  echo "</tr>";
              }
          } else {
              echo "<tr><td colspan='5'>No feedback responses yet.</td></tr>";
          }

          // Close connection
          $connection->close();
        ?>
      </table>
    </div>
  </div>
</body>
</html>


