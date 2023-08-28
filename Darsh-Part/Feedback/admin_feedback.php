<!DOCTYPE html>
<html>
<head>
  <title>Admin - Student Feedback Responses</title>
  <link rel="stylesheet" type="text/css" href="admin_feedback.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cooper+Black&display=swap">
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
        include '../../database/db_connection.php';

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Handle delete operation if "delete" parameter is passed in the URL
        if (isset($_GET['delete'])) {
          $delete_id = $_GET['delete'];
          $stmt = $conn->prepare("DELETE FROM feedback WHERE id = ?");
          $stmt->bind_param("i", $delete_id);
          $stmt->execute();
          $stmt->close();
          header("Location: admin_feedback.php");
          exit();
        }

        // Fetch feedback responses from the database
        $sql = "SELECT * FROM feedback";
        $result = $conn->query($sql);

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
        $conn->close();
      ?>
    </table>
  </div>
  </div>
</body>
</html>


