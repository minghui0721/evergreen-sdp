<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/03e0369c68.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
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
    position: relative;
    width: 19%;
    height: 685px;
    background-color: white;
    margin: 0;
    padding: 0;
    float: left;
}

.menu{
    display: flex; 
    flex-direction: column; 
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
    float: right;
}

.SideHeader label{
    color: #002349;
    font-size: 24px;
    display: block;
    cursor: pointer;
}

.SideHeader ul li label:hover,
.SideHeader ul li a:hover{
    color: #5c5adb;
}

.menu-container {
    display: inline-block; 
}

.AcademicManagement,
.FinancialManagement,
.UserManagement,
.InformationManagement{
    display: none;
}

[id^=btn]:checked + ul,
[id^=btn-2]:checked + ul,
[id^=btn-3]:checked + ul,
[id^=btn-4]:checked + ul{
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
    font-size: 20px;
    margin-top: 5px;
}

.small input{
    display: none;
}

.CopyRight{
    position: relative;
    top: 630px;
    left: 45px;
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
                <a href="../Login/adminLogin.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>Logout</a>
            </div>
        </div>
    </div>

    <div class="SideHeader">
        <hr>
        <div class="small">
            <ul class="menu">
                <li>
                    <div class="menu-container">
                        <label for="btn" class="MenuTitle">Academic Management
                            <i class="fa-solid fa-caret-down"></i>
                        </label>
                        <input type="checkbox" id="btn">
                        <ul class="AcademicManagement">

                            <li>
                                <a href="#" class="ManageEnrollment">
                                · Manage enrollment
                                </a>
                            </li>

                            <li>
                                <a href="#" class="ManageCourse">
                                · Manage course
                                </a>
                            </li>

                            <li>
                                <a href="../Timetable_Management/TimetableChooseIntake.php" class="ManageTimetable">
                                · Manage timetable
                                </a>
                            </li>

                            <li>
                                <a href="../Classroom_Management/ClassList.php" class="ManageClassroom">
                                · Manage classroom
                                </a>
                            </li>

                            <li>
                                <a href="../Classroom_Management/AdminClassScheduleList.php" class="ClassSchedule">
                                · View class schedule
                                </a>
                            </li>

                            <li>
                                <a href="#" class="StudentResult">
                                · View students' result
                                </a>
                            </li>

                            <li>
                                <a href="#" class="StudentGrade">
                                · View students' grade
                                </a>
                            </li>

                            <li>
                                <a href="../Attendance_Management/AdminAttendanceIntake.php" class="StudentAttendance">
                                · View students' attendance
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>
                
                <li>
                    <div class="menu-container">
                        <label for="btn-2" class="MenuTitle">Financial Management
                            <i class="fa-solid fa-caret-down" style="margin:0 0 0 8px"></i>
                        </label>
                        <input type="checkbox" id="btn-2">
                        <ul class="FinancialManagement">

                            <li>
                                <a href="../Fee&Payment_Management/createFee.php" class="CreateFees">
                                · Create fees
                                </a>
                            </li>

                            <li>
                                <a href="../Fee&Payment_Management/viewPayment.php" class="ViewPayments">
                                · View payments
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li>
                    <div class="menu-container">
                        <label for="btn-3" class="MenuTitle">User Management
                            <i class="fa-solid fa-caret-down" style="margin:0 0 0 55px"></i>
                        </label>
                        <input type="checkbox" id="btn-3">
                        <ul class="UserManagement">

                        <li>
                                <a href="../User_Management/lecturerlist.php" class="ManageLecturer">
                                    · Manage Lecturer
                                </a>
                        </li>

                        <li>
                                <a href="../User_Management/studentlist.php" class="ManageStudent">
                                    · Manage Student
                                </a>
                        </li>

                        </ul>
                    </div>
                </li>

                <li>
                    <div class="menu-container">
                        <label for="btn-4" class="MenuTitle" style="font-size: 22px;">Information Management
                            <i class="fa-solid fa-caret-down" style="margin:0 0 0 3px"></i>
                        </label>
                        <input type="checkbox" id="btn-4">
                        <ul class="InformationManagement">

                            <li>
                                <a href="#" class="ManageSchoolInfo">
                                · Manage school info
                                </a>
                            </li>

                            <li>
                                <a href="../Announcement_Management/admin_ann_dash.php" class="ManageAnnouncements">
                                · Manage announcements
                                </a>
                            </li>

                            <li>
                                <a href="../View_Feedback/admin_feedback.php" class="ViewFeedback">
                                · View feedback
                                </a>
                            </li>

                            <li>
                                <a href="#" class="GenerateReport">
                                · Generate Report
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

            </ul>
        </div>

        <div class="CopyRight">
            <p> &#169; 2023 Evergreen High School</p>
        </div>
    </div>