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

// Retrieve announcements from the database
$sql = "SELECT * FROM announcement";
$result = mysqli_query($connection, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit/Delete-Announcement List</title>
  <link rel="stylesheet" href="edit_delete.css?v=<?php echo time();?>">
</head>
<body>
  <div class="box">
    <div id="top">
      <h2>Announcement List</h2>
    </div>
    <table>
      <tr class="head">
        <th>Announcement ID</th>
        <th>Lecturer ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Publish Date</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
      <?php
      if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
              echo "<tr>";
              echo "<td>" . $row["announcement_ID"] . "</td>";
              echo "<td>" . $row["lecturer_ID"] . "</td>";
              echo "<td>" . $row["title"] . "</td>";
              echo "<td>" . $row["content"] . "</td>";
              echo "<td>" . $row["publish_date"] . "</td>";
              echo "<td><a href='edit_announcement.php?id=" . $row["announcement_ID"] . "' class='edit'>Edit</a></td>";
              echo "<td><a href='delete_announcement.php?id=" . $row["announcement_ID"] . "' class='edit1'>Delete</a></td>";
              echo "</tr>";
          }
      } else {
          echo "<tr><td colspan='7'>No announcements found.</td></tr>";
      }
      ?>
    </table>
  </div>
</body>
</html>

<?php
mysqli_close($connection);
?>

