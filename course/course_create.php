<?php
include '../database/db_connection.php';

// Retrieve enrollment requests from the database
$query = "SELECT * FROM enrollment_form WHERE status = 'Pending' ";

$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <script src="../assets/js/config.js"></script> 
    <link rel="stylesheet" href="../assets/css/course_create.css.?v=<?php echo time(); ?>">  
    <link rel="stylesheet" href="../assets/css/header.css.?v=<?php echo time(); ?>">  
    <link rel="stylesheet" href="../assets/css/footer.css.?v=<?php echo time(); ?>">  
    <link rel="shortcut icon" href="../assets/images/evergreen-background.jpeg" type="image/x-icon">

    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
    <?php include '../assets/fonts/font.html'; ?>

    <h1>Add Course Details</h1>
    
    <form action="add_course.php" method="post" enctype="multipart/form-data">
        <label for="course_name">Course Name:</label>
        <input type="text" id="course_name" name="course_name" required><br>
        

        
        <label for="program_name">Program Name:</label>
        <select id="program_name" name="program_name" required>
            <option value="" disabled selected>Select Program</option>
            <option value="Foundation">Foundation</option>
            <option value="Diploma">Diploma</option>
            <option value="Degree">Degree</option>
        </select><br>

  
        
        <label for="course_description">Course Description:</label>
        <textarea id="course_description" name="course_description" rows="4" cols="50" required></textarea><br>
        
        <label for="program_description">Program Description:</label>
        <textarea id="program_description" name="program_description" rows="4" cols="50" required></textarea><br>
        
        <label for="img" class="label_image">Upload Image:</label>
        <input type="file" id="img" name="img" accept="image/*" required><br>
        
        <input type="submit" value="Add Course">
    </form>
</body>
</html>