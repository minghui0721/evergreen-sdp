<?php
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../moodle/home.css">
    <link rel="stylesheet" href="lecturer_home.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <h2 class="setup_title">Materials</h2>
    </div>

    <hr id="header_line">
</header>

<div class="image-container">
    <div class="image-box">
        <img src="./images/test.jpg" alt="">
    </div>
    <div class="image-box">
        <img src="./images/test.jpg" alt="">
    </div>
    <div class="image-box">
        <img src="./images/test.jpg" alt="">
    </div>
    <div class="image-box">
        <img src="./images/test.jpg" alt="">
    </div>
    <div class="image-box">
        <img src="./images/test.jpg" alt="">
    </div>
</div>