<?php
session_start();
include '../assets/favicon/favicon.php'; // Include the favicon.php file



include '../database/db_connection.php';
$studentId = $_SESSION['student_ID'];
$profileQuery = "SELECT * FROM `student` WHERE `student_ID`='$studentId'";
$profileResult = mysqli_query($conn, $profileQuery);
$profileData = mysqli_fetch_assoc($profileResult);

$intake_ID = $profileData['intake_ID'];


// Retrieve intake and courseProgram_ID based on intake_ID
$intakeQuery = "SELECT * FROM `intake` WHERE `intake_ID`='$intake_ID'";
$intakeResult = mysqli_query($conn, $intakeQuery);
$intakeData = mysqli_fetch_assoc($intakeResult);

if ($intakeData) {
    $courseProgram_ID = $intakeData['courseProgram_ID'];

    // Retrieve course_name and program_name based on courseProgram_ID
    $courseProgramQuery = "SELECT * FROM `course_program` WHERE `courseProgram_ID`='$courseProgram_ID'";
    $courseProgramResult = mysqli_query($conn, $courseProgramQuery);
    $courseProgramData = mysqli_fetch_assoc($courseProgramResult);

    if ($courseProgramData) {
        $course_name = $courseProgramData['course_name'];
        $program_name = $courseProgramData['program_name'];
      }
}

$eventsQuery = "SELECT * FROM `event` WHERE `date` >= CURDATE() ORDER BY `date` ASC LIMIT 5";
$eventsResult = mysqli_query($conn, $eventsQuery);

  

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <link rel="stylesheet" href="../assets/css/dashboard.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/fontStudent.html'; ?> 

<!-- header -->
<div id="header"></div>


<div class="profile-section">
  <div class="profile-details">
    <img src="profilePicture.jpeg" alt="Profile Picture">
    <h2>
      <p style="color: #5c5adb;"><?php echo $profileData['student_name']; ?> (<?php echo $program_name; ?>)</p>
      <p><?php echo $intakeData['intake']; ?> | <?php echo $course_name; ?></p>
    </h2>

  </div>

  <!-- Add a logout button -->
  <div class="logout-button">
    <form action="../guest/index.php" method="post" onsubmit="return confirmLogout();">
        <button type="submit" name="btnLogout" class="btn btn-danger">
            Logout &nbsp
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                <path d="M377.9 105.9L500.7 228.7c7.2 7.2 11.3 17.1 11.3 27.3s-4.1 20.1-11.3 27.3L377.9 406.1c-6.4 6.4-15 9.9-24 9.9c-18.7 0-33.9-15.2-33.9-33.9l0-62.1-128 0c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l128 0 0-62.1c0-18.7 15.2-33.9 33.9-33.9c9 0 17.6 3.6 24 9.9zM160 96L96 96c-17.7 0-32 14.3-32 32l0 256c0 17.7 14.3 32 32 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l-64 0c-53 0-96-43-96-96L0 128C0 75 43 32 96 32l64 0c17.7 0 32 14.3 32 32s-14.3 32-32 32z"/>
            </svg>
        </button>
    </form>
  </div>

</div>

<script>
function confirmLogout() {
    return confirm("Are you sure you want to logout?");
}
</script>

<div class="dashboard-content">
  <div class="schedule-section">
          <h2>Schedule Today</h2>
          <ul class="schedule-list">
            <li>Event Name: Cultural Extravaganza <br>
                Date: 2023-09-30 <br>
                Time: 18:30:00 - 21:00:00 <br>
                Location: Cultural Center
            </li>
          </ul>

                  
    </div>

  <div class="events-section">
        <h2>Upcoming Events</h2>
        <ul class="events-list">
          <?php
            // Retrieve and display upcoming events
            // Modify the code below based on your database structure

            while ($event = mysqli_fetch_assoc($eventsResult)) {
              echo '<li>';
              echo '<strong>Event Name:</strong> ' . $event['name'] . '<br>';
              echo '<strong>Date:</strong> ' . $event['date'] . '<br>';
              echo '<strong>Time:</strong> ' . $event['start_time'] . ' - ' . $event['end_time'] . '<br>';
              echo '<strong>Location:</strong> ' . $event['location'] . '<br>';
              echo '</li>';
            }
          ?>
        </ul>
    </div>
  
</div>



<script>
        const container = document.getElementById('header');
        // Load header content
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            container.innerHTML = this.responseText;
        }
        };

        xhttp.open('GET', 'studentHeader.php', true);
        xhttp.send();
    </script>
</body>
</html>