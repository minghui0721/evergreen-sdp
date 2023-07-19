<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/03e0369c68.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="AdminHeader_style.css?v=<?php echo time(); ?>">
    <!-- path -->
</head>
<body>
    <div class="HeaderCol">
        <div class="leftside">
            <img src="../../assets/images/evergreen-logo.png" alt="evergreen-logo" width="80px">            
            <h1>Evergreen Admin System</h1>
        </div>
        <div class="rightside">
            <p>Admin</p>
            <div class="dropdown">
                <a href="#"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
            </div>
        </div>
    </div>

    <div class="SideHeader">
        <hr>
        <ul class="menu">
            <li>
                <label for="btn" class="SchoolManagement">School Management
                    <i class="fa-solid fa-caret-down"></i>
                </label>
                <input type="checkbox" id="btn">
                <ul>
                    <li><a href="#">Manage user</a></li>
                    <li><a href="#">Manage class</a></li>
                    <li><a href="#">Manage subject</a></li>
                    <li><a href="#">Manage timetable</a></li>
                </ul>
            </li>
        </ul>
    </div>
</body>
</html>