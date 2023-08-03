<?php
include "../Admin_header/AdminHeader.php";
include "../WeekDateRange.php";
include "../dbConn.php";

$CurrentDate = date('Y-m-d');
list($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate)=CurrentWeekDateRange();

// Set a array of date with day
$DateWithDay = array($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate);
$DateWithDay[0]= date('d M Y', strtotime($FirstDay)).", Sun";
$DateWithDay[1]= date('d M Y', strtotime($SecondDay)).", Mon";
$DateWithDay[2]= date('d M Y', strtotime($ThirdDay)).", Tue";
$DateWithDay[3]= date('d M Y', strtotime($FourthDay)).", Wed";
$DateWithDay[4]= date('d M Y', strtotime($FifthDay)).", Thu";
$DateWithDay[5]= date('d M Y', strtotime($SixthDay)).", Fri";
$DateWithDay[6]= date('d M Y', strtotime($LastDate)).", Sat";


?>
    <link rel="stylesheet" type="text/css" href="AdminClassScheduleList_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Class Schedule</title>

<style>
    .SchoolManagement2{
        display: block;
    }

    .SchoolManagement2 .ViewClassSche{
        color: #5c5adb;
    }
</style>
    <div class="wrapper">
        <div class="TitleBar">
            <h1>Class Schedule</h1>
        </div>
        

        <div class="ClassroomList">
            <table
            border="0"
            cellpadding="20px">
                <tr>
                    <th>Class ID</th>
                    <th>Class Name</th>
                    <th>Room Type</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>

                <!-- Retrieve class list from database -->
                <?php
                $ClassList_query="SELECT class_ID, class_name, room_type, start_time, end_time
                FROM class
                ORDER BY class_name ASC";
                $ClassList_result=mysqli_query($connection,$ClassList_query);
                while($ClassList_row=mysqli_fetch_assoc($ClassList_result)){
                ?>

                <tr>
                    <form action="ClassSchedule.php" method="post"> <!-- path -->
                        <input type="hidden" name="classID" id="classID" value="<?php echo $ClassList_row["class_ID"];?>">
                        <input type="hidden" name="className" id="className" value="<?php echo $ClassList_row["class_name"];?>">
                        <input type="hidden" name="roomType" id="roomType" value="<?php echo $ClassList_row["room_type"];?>">
                        <td><?php echo $ClassList_row["class_ID"];?></td>
                        <td><?php echo $ClassList_row["class_name"];?></td>
                        <td><?php echo $ClassList_row["room_type"];?></td>
                        <td>
                            <select name="date" id="date" class="date">
                                <option value="<?php echo $FirstDay;?>"<?php if($FirstDay==$CurrentDate) echo "selected"?>>
                                <?php echo $DateWithDay[0]?>
                                </option>

                                <option value="<?php echo $SecondDay;?>"<?php if($SecondDay==$CurrentDate) echo "selected"?>>
                                <?php echo $DateWithDay[1]?>
                                </option>

                                <option value="<?php echo $ThirdDay;?>"<?php if($ThirdDay==$CurrentDate) echo "selected"?>>
                                <?php echo $DateWithDay[2]?>
                                </option>

                                <option value="<?php echo $FourthDay;?>"<?php if($FourthDay==$CurrentDate) echo "selected"?>>
                                <?php echo $DateWithDay[3]?>
                                </option>

                                <option value="<?php echo $FifthDay;?>"<?php if($FifthDay==$CurrentDate) echo "selected"?>>
                                <?php echo $DateWithDay[4]?>
                                </option>

                                <option value="<?php echo $SixthDay;?>"<?php if($SixthDay==$CurrentDate) echo "selected"?>>
                                <?php echo $DateWithDay[5]?>
                                </option>

                                <option value="<?php echo $LastDate;?>"<?php if($LastDate==$CurrentDate) echo "selected"?>>
                                <?php echo $DateWithDay[6]?>
                                </option>
                            </select>
                        </td>
                        <td>
                            <input type="submit" name="view" id="view" class="view" value="View">
                        </td>
                    </form>
                </tr>

                <?php
                    }
                ?>
            </table>
        </div>
    </div>

</body>
</html>