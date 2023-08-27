<?php
session_start();
include '../../assets/favicon/favicon.php';
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

$assignmentID = $_GET['assignment_ID'];

// Fetch the existing assignment details
$selectQuery = "SELECT assignment_title, time_start, time_end FROM assignment_set WHERE assignment_ID = $assignmentID";
$result = mysqli_query($connection, $selectQuery);
$row = mysqli_fetch_assoc($result);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newTitle = $_POST['new_title'];
    $newTimeStart = $_POST['new_time_start'];
    $newTimeEnd = $_POST['new_time_end'];
    
    // Update the database with the new values
    $updateQuery = "UPDATE assignment_set SET assignment_title = '$newTitle', time_start = '$newTimeStart', time_end = '$newTimeEnd' WHERE assignment_ID = $assignmentID";
    // Execute the update query
    mysqli_query($connection, $updateQuery);
    header("Location: lecturer_setup.php"); // Redirect back to the history page after update
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Setup Form</title>
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
        <h2 class="setup_title">Update Submission Details</h2>
    </div>

    <hr id="header_line">
</header>
<form class="update-form" method="POST">
    <div class="input_changes">
        <label for="new_title">New Assignment Title:</label>
        <input type="text" id="new_title" name="new_title" value="<?php echo $row['assignment_title']; ?>" required>
        
        <label for="new_time_start">New Time Start:</label>
        <input type="datetime-local" id="new_time_start" name="new_time_start" value="<?php echo date('Y-m-d\TH:i', strtotime($row['time_start'])); ?>" required>
        
        <label for="new_time_end">New Time End:</label>
        <input type="datetime-local" id="new_time_end" name="new_time_end" value="<?php echo date('Y-m-d\TH:i', strtotime($row['time_end'])); ?>" required>
        
        <button type="submit">Update</button>
    </div>
</form>

<style>
    .update-form {
        background-color: #f7f7f7;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        width: 600px; /* Adjust the width to make the form larger */
        margin: 20px auto;
        animation: slide-up 0.7s ease-in-out;
        margin-top: 70px;
        background-color: #a387f2;
    }

    @keyframes slide-up {
        from {
            transform: translateY(100px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .update-form label {
        display: block;
        margin-bottom: 10px;
        font-weight: bold;
    }

    .update-form input[type="text"]{
        width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
             /* Slide-in animation */
            transform: translateX(-100%);
            animation: slide-in-left 0.6s ease-out forwards;
    }

    @keyframes slide-in-left {
            to {
                transform: translateX(0);
            }
        }


    .update-form input[type="datetime-local"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            transform: translateX(100%);
            animation: slide-in-right 0.5s ease-out forwards;
           
        }
        @keyframes slide-in-right {
        to {
            transform: translateX(0);
        }
    }
        
    .update-form button {
        background-color: #86d4f8;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 10px 20px;
        cursor: pointer;
        font-size: 16px;
        margin-left: 41%;
        transition: background-color 0.3s ease-in-out;
    }

    .update-form button:hover {
        background-color: #50c6fd;
        box-shadow: 5px 5px 5px grey;
    }

    .input_changes input:focus {
        outline: none;
        border-color: #D5FFE4;
    }

    .input_changes input:invalid {
        border-color: #6563d9;
    }

    .input_changes input:valid {
        border-color: #45CFDD;
        box-shadow: 5px 5px #45CFDD;
    }

</style>

