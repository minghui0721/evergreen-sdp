<?php
session_start();
include '../../assets/favicon/favicon.php';
$lecturer_ID = $_SESSION['lecturer_ID'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lesson Resource</title>
    <link rel="stylesheet" href="../moodle/home.css">
    <link rel="stylesheet" href="setup.css">
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png"> 
</head>
<script>    
function goBack() {
    window.history.back();
}
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<header>
    <div class="header-content">
        <a href="#" onclick="goBack()"><button class="backbtn">Back</button></a>
        <a href="home.html"></a>
            <img src="../moodle/img/logo.png" height="80" weight="420" alt="Error" class="logo">
        </a>
        <h2 class="setup_title">Lesson Resource</h2>
    </div>

    <hr id="header_line">
</header>

<body>
    <div class="container_setup">
        <h2 class="title_setup"> Create Lesson Resource</h2>
        <form action="" method="post">
            <div class="input-group">
                <div class="input">
                    <label for="courseProgram_ID">Course Program ID <ion-icon name="school-outline"></ion-icon></label>
                    <input type="number" name="courseProgram_ID" id="courseProgram_ID" min="1" required>
                </div>
            </div>
            <div class="input-group">
                <div class="input">
                    <label for="subject_name">Subject Name <ion-icon name="book-outline"></ion-icon></label>
                    <input type="text" name="subject_name" id="subject_name" required>
                </div>
                <div class="input">
                    <label for="img">Image<ion-icon name="image-outline"></ion-icon></label>
                    <input type="text" name="img" id="img" placeholder="Please enter the image address" required>
                </div>
            </div>
            <div class="button_wrapper">
                <a href=""><button type="submit" name = "btnsubmit">Submit</button></a>
            </div>
        </form>
    </div>

<?php
// Check if the form is submitted
if (isset($_POST['btnsubmit'])) {
    // Get form data
    $courseProgramID = $_POST['courseProgram_ID'];
    $subjectName = $_POST['subject_name'];
    $img = $_POST['img'];
    $lecturerID = 1; 

    // Database connection parameters
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'evergreen_heights_university';
    
    // Step 1 - Database connection
    $connection = mysqli_connect($host, $user, $password, $database);
    
    
    // Check database connection
    if ($connection === false) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Prepare and execute SQL query to insert data
    $sql = "INSERT INTO subject (lecturer_ID, courseProgram_ID, subject_name, img)
            VALUES ('$lecturerID','$courseProgramID', '$subjectName', '$img')";

    if ($connection->query($sql) === TRUE) {
        echo '<script>alert("New record inserted successfully");</script>';
        header('Location: lesson_resource.php');
    } else {
        echo "Error: " . $sql . "<br>" . $connection->error;
    }

    // Close connection
    $connection->close();
}
?>

<br><br>
    <hr style = "width: 95%; margin-left: 35px;" >

    <div class="container_grade">
        <h2 class="history_title">History</h2>
        <br>
        <table style="width:80%">
            <tr>
                <th>Subject ID</th>
                <th>Course Program ID</th>
                <th>Subject Name</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            <?php
            $host = 'localhost';
            $user = 'root';
            $password = '';
            $database = 'evergreen_heights_university';
            
            // Step 1 - Database connection
            $connection = mysqli_connect($host, $user, $password, $database);
            $sql = "SELECT * FROM subject WHERE lecturer_ID = 1";
            $result = $connection->query($sql);
            // Output data from the query result
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["subject_ID"] . "</td>";
                echo "<td>" . $row["courseProgram_ID"] . "</td>";
                echo "<td>" . $row["subject_name"] . "</td>";
                echo "<td><img class='table-image' src='" . $row["img"] . "' alt='Image'></td>";
                echo "<td><a href='delete_subject.php?id=" . $row["subject_ID"] . "'>Delete</a></td>";
                echo "</tr>";
            }
            $connection->close();
            ?>
        </table>
    </div>
    
    <style>
        table {
            width: 80%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
        .table-image {
            max-width: 100px; 
            max-height: 100px; 
            display: block;
            margin: auto;
        }
    </style>


