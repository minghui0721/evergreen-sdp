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
<style>
body{
    background-color: #1d1d36;
    font-family: 'Belanosima', sans-serif;
    margin: 0;
    padding: 0;
}

.HeaderCol{
    background-color: white;
    width: 100%;
    height: 120px;
}

.leftside {
    display: inline-block; 
    vertical-align: middle; 
}

.leftside img {
    vertical-align: middle; 
    margin: 0 0 0 50px;
}

.leftside h1 {
    color: #002349;
    display: inline-block; 
    margin: 50px 0px;
}
.rightside{
    width: 130px;
    height: 50px;
    background-color: #002349;
    color: white;
    font-size: 25px;
    margin: 50px 130px 0 0;
    padding: -20px;
    border-radius: 25px;
    float: right;
}

.rightside p{
    margin: 10px 0;
    text-align: center;
    font-weight: bolder;
}

.dropdown{
    background-color:#5c5adb;
    width: 130px;
    display: none;
    border-radius: 10px;
    padding: 20px 0 ;
}

.dropdown a{
    color: white;
    text-decoration: none;
    font-size: 20px;

}

.rightside:hover .dropdown{
    text-align: center;
    display: block;
    position: absolute;
}

.rightside:hover .dropdown a:hover{
    color: rgb(197, 197, 197);
}

.SideHeader{
    width: 19%;
    height: 770px;
    background-color: white;
    margin: 0;
    padding: 0;
    float: left;
}

.menu{
    display: flex;
    justify-content: center;
    padding: 0;
    margin: 0 0 0 12px;
}

.SideHeader hr{
    color: #002349;
    border: 2px solid;
    margin: 0;
}

.MenuTitle{
    margin: 0 0 0 8px;
    padding: 0;
}

.SideHeader label{
    color: #002349;
    font-size: 30px;
    display: block;
    cursor: pointer;
}

.SideHeader ul li label:hover,
.SideHeader ul li a:hover{
    color: #5c5adb;
}

.SchoolManagement,
.SchoolManagement2{
    display: none;
}

[id^=btn]:checked + ul{
    display: block;
}

.SideHeader ul li a{
    color: #002349;
    text-decoration: none;
    display: block;
}

.SideHeader ul li{
    list-style: none;
    cursor: pointer;
}

.SideHeader ul{
    position: absolute;
}

.SideHeader ul ul{
    position: static;
}


.SideHeader li{
    font-size: 25px;
    margin-top: 5px;
}

.small input{
    display: none;
}
</style>
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
        <div class="small">
            <ul class="menu">
                <li>
                    <label for="btn" class="MenuTitle">School Management
                        <i class="fa-solid fa-caret-down"></i>
                    </label>
                    <input type="checkbox" id="btn">
                    <ul class="SchoolManagement">
                        <li><a href="#" class="ManageUser">Manage user</a></li>
                        <li><a href="../Classroom_Management/ClassList.php" class="ManageClass">Manage class</a></li>
                        <li><a href="#" class="ManageSubject">Manage subject</a></li>
                        <li><a href="../Timetable_Management/TimetableList.php" class="ManageTimetable">Manage timetable</a></li>
                    </ul>

                    <label for="btn-2" class="MenuTitle">School Management
                        <i class="fa-solid fa-caret-down"></i>
                    </label>
                    <input type="checkbox" id="btn-2">
                    <ul class="SchoolManagement2">
                        <li><a href="#">Manage user</a></li>
                        <li><a href="#">Manage class</a></li>
                        <li><a href="#">Manage subject</a></li>
                        <li><a href="#">Manage timetable</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>