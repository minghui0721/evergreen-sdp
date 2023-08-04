<?php
include "../dbConn.php";
$TimetableID=$_GET['TimetableID'];
$IntakeID=$_GET['IntakeID'];

$DeleteTimetable_query="DELETE FROM `timetable_details` WHERE `timetable_ID`='$TimetableID'";
mysqli_query($connection,$DeleteTimetable_query)
?>

<script>
    alert("!Delete Successfully!")
    window.location.replace("TimetableList.php?intakeID=<?php echo $IntakeID;?>")
</script>
<!-- path -->