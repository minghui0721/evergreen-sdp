<?php
include "../dbConn.php";
$TimetableID=$_GET['TimetableID'];

$DeleteTimetable_query="DELETE FROM `timetable_details` WHERE `timetable_ID`='$TimetableID'";
mysqli_query($connection,$DeleteTimetable_query)
?>

<script>
    alert("!Delete Successfully!")
    window.location.replace("TimetableList.php")
</script>
<!-- path -->