<?php
include '../assets/base_url/config.php';
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
    <link rel="shortcut icon" href="../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="<?php echo BASE_URL ?>/assets/css/studentHeader.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/fontStudent.html'; ?> 

<header class="fixed-top">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="logo d-flex align-items-center">
        <a href="dashboard.php"><img src="<?php echo BASE_URL ?>/assets/images/evergreen-white.png" alt="School Logo" class="mr-2"></a>
        <h1 class="m-0">Evergreen Heights System</h1>
      </div>
      <nav>
        <ul class="list-inline m-0">
          <li class="list-inline-item"><a href="<?php echo BASE_URL ?>/lecturer/dashboard.php" class=" dashboard_list">Dashboard</a></li>

          <li class="list-inline-item"><a href="<?php echo BASE_URL ?>/Dyaniel_part/Timetable_Management/lecturer/LecturerTimetable.php" class=" timetable_list">Timetable</a></li>

          <li class="list-inline-item "><a href="<?php echo BASE_URL ?>/Dyaniel_part/Attendance_Management/Lecturer/AttendanceList.php" 
          class="attendance_list">Attendance</a></li>

          <li class="list-inline-item"><a href="<?php echo BASE_URL ?>/Darsh-Part/Announcement_lecturer/lecturer_ann_dash.php" class="announcement_list">Announcement</a></li>

          <li class="list-inline-item"><a href="<?php echo BASE_URL ?>/lecturer/more.php" class="more_list">More</a></li>
        </ul>
      </nav>
    </div>
  </header>

</body>
</html>