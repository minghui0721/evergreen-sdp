<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php";
include "Validation.php";
?>
    <link rel="stylesheet" type="text/css" href="EditClass_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Edit Class</title>

    <style>
    .AcademicManagement{
        display: block;
    }

    .AcademicManagement .ManageClassroom{
        color: #5c5adb;
    }
</style>

<?php
// Retrieve data from database
$ClassID=$_GET['classID'];
$ClassList_query="SELECT class_ID, class_name, room_type, start_time, end_time
FROM class a
WHERE class_ID=$ClassID";
$ClassList_result=mysqli_query($connection,$ClassList_query);
$ClassList_row=mysqli_fetch_assoc($ClassList_result);
$OriClassName = $ClassList_row['class_name'];
?>

</head>
<body>
    <div class="wrapper">
        <!-- Title -->
        <div class="TitleBar">
            <h1>Edit Class</h1>
        </div>

        <div class="ClassDetails_container">
            <div class="ClassID">
                <h3>ClassID: <?php echo $ClassList_row["class_ID"];?></h3>
            </div>
            <form action="#" method="post">
                <div class="ClassName-and-RoomType">
                    <!-- Class Name -->
                    <div class="ClassName">
                        <p>Class Name:</p>
                        <input type="text" id="class-name" name="class-name" 
                        value="<?php echo $ClassList_row["class_name"];?>" 
                        required>
                    </div>
                    <!-- Room Type -->
                    <div class="RoomType">
                        <p>Room Type:</p>
                        <select name="room-type" id="room-type">
                        <option value="Classroom" <?php if($ClassList_row["room_type"]=="Classroom") echo"selected"?>>Classroom</option>
                        <option value="Lab" <?php if($ClassList_row["room_type"]=="Lab") echo"selected"?>>Lab</option>
                        <option value="Auditorium" <?php if($ClassList_row["room_type"]=="Auditorium") echo"selected"?>>Auditorium</option>
                        </select>
                    </div>
                </div>

                <div class="OpenTime-and-CloseTime">
                    <!-- Open Time -->
                    <div class="OpenTime">
                        <p>Open Time:</p>
                        <input type="time" id="open-time" name="open-time"
                        value="<?php echo $ClassList_row["start_time"];?>"
                        required>
                    </div>
                    <!-- Close Time -->
                    <div class="CloseTime">
                        <p>Close Time:</p>
                        <input type="time" id="close-time" name="close-time"
                        value="<?php echo $ClassList_row["end_time"];?>"
                        required>
                    </div>
                </div>

                <!-- submit button -->
                <div class="submit-button">
                    <input type="submit" value="Edit" name="Edit">
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
if (isset($_POST['Edit'])){
    $ClassName=$_POST['class-name'];
    $RoomType=$_POST['room-type'];
    $OpenTime=$_POST['open-time'];
    $CloseTime=$_POST['close-time'];

    
    $Check="pass";
    if($ClassName != $OriClassName){
    //Class Name Validation
    $Check=ClassNameCheck($ClassName);
    }

    //Create New Classroom
    if($Check=="pass"){
    $class_query="UPDATE `class` SET `class_name`='$ClassName',`room_type`='$RoomType' ,`start_time`='$OpenTime',`end_time`='$CloseTime'
    WHERE class_ID=$ClassID";
    mysqli_query($connection,$class_query);
?>
<script>
    alert("!Update Succesfully!")
    window.location.replace("ClassList.php");
</script>
<!-- path -->

<?php
    }
    else if($Check=="Classroom Exist"){
?>
<script>
    alert("!This class name already exist!\nTry another")
    window.location.replace("#");
</script>
    <!-- path -->
<?php
    }
}
?>