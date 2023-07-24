<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php"
?>
    <link rel="stylesheet" type="text/css" href="CreateClass_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Create Class</title>

    <style>
    .SchoolManagement{
        display: block;
    }

    .SchoolManagement .ManageClass{
        color: #5c5adb;
    }
</style>

</head>
<body>
    <div class="wrapper">
        <!-- Title -->
        <div class="TitleBar">
            <h1>Create Class</h1>
        </div>

        <div class="ClassDetails_container">
            <form action="" method="post">
                <div class="ClassName-and-RoomType">
                    <!-- Class Name -->
                    <div class="ClassName">
                        <p>Class Name:</p>
                        <input type="text" id="class-name" name="class-name" required>
                    </div>
                    <!-- Room Type -->
                    <div class="RoomType">
                        <p>Room Type:</p>
                        <select name="room-type" id="room-type">
                        <option value="Classroom">Classroom</option>
                        <option value="Lab" >Lab</option>
                        <option value="Auditorium">Auditorium</option>
                        </select>
                    </div>
                </div>

                <div class="OpenTime-and-CloseTime">
                    <!-- Open Time -->
                    <div class="OpenTime">
                        <p>Open Time:</p>
                        <input type="time" id="open-time" name="open-time" required>
                    </div>
                    <!-- Close Time -->
                    <div class="CloseTime">
                        <p>Close Time:</p>
                        <input type="time" id="close-time" name="close-time" required>
                    </div>
                </div>

                <!-- submit button -->
                <div class="submit-button">
                    <input type="submit" value="submit" name="submit">
                </div>
            </form>

            <!-- back button -->
            <a href="ClassList.php">
                <button class="back_button">
                    Back
                </button>
                <!-- path -->
            </a>
        </div>
    </div>
</body>
</html>

<?php
if (isset($_POST['submit'])){
    $ClassName=$_POST['class-name'];
    $RoomType=$_POST['room-type'];
    $OpenTime=$_POST['open-time'];
    $CloseTime=$_POST['close-time'];
    
    $class_query="INSERT INTO `class`(`class_name`, `room_type`) VALUES ('$ClassName','$RoomType')";
    if(mysqli_query($connection,$class_query)){
        $query="SELECT `class_ID` FROM `class` WHERE `class_name`='$ClassName'AND`room_type`='$RoomType'";
        $result=mysqli_query($connection,$query);
        $row=mysqli_fetch_assoc($result);
        $ClassID=$row['class_ID'];
    }



    $ClassAvailability_query="UPDATE `class_availability` SET `start_time`='$OpenTime',`end_time`='$CloseTime' 
    WHERE class_ID=$ClassID";
    mysqli_query($connection,$ClassAvailability_query);
?>
<script>
    alert("!Create Succesfully!")
    window.location.replace("ClassList.php");
</script>
<!-- path -->

<?php
}
?>