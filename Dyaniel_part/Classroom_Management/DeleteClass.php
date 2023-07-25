<?php
include "../dbConn.php";
$ClassID=$_GET['classID'];

$DeleteTimetable_query="DELETE FROM `class` WHERE `class_ID`='$ClassID'";
mysqli_query($connection,$DeleteTimetable_query)
?>

<script>
    alert("!Delete Successfully!")
    window.location.replace("ClassList.php")
</script>
<!-- path -->