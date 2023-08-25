<?php
include "../../../database/db_connection.php";
include "WeekDateRange.php";
include '../../../assets/favicon/favicon.php'; // Include the favicon.php file

//<!-- path -->

//Default current datetime and time after 1 hour
date_default_timezone_set('Asia/Singapore');
$CurrentTime = date('H:i:s');
$CurrentTime_10minutesAfter = date('H:i:s', strtotime('+10 minutes'));
$CurrentDate = date('Y-m-d');
list($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate)=CurrentWeekDateRange();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/03e0369c68.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="ClassFinder_style.css?v=<?php echo time(); ?>">
    <script src="../../../assets/js/config.js"></script> 
    <title id="documentTitle"></title>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
    <!-- path -->

    
</head>

</head>
<!-- header -->
<header class="button_header">
    <div class="button">
        <a href="../../../student/more.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>        </a>
        <h2>Student Directory</h2>
    </div>
</header>

<body>
    <div class="wrapper">
        <div class="title">
            <h1>Class Finder</h1>

            <button class="FilterBox" onclick="displayWindow()">
            <!-- <div class="FilterBox"> -->
                <h3>Filter</h3>
            <!-- </div> -->
            </button>
        </div>

        <script>
            function displayWindow(){
                const filterWindow = document.querySelector('.FilterWindow');
                filterWindow.style.display = 'block';
                filterWindow.style.position = 'absolute';
            }
        </script>

        <div class="FilterWindow">
            <h2>Class Filter</h2>
            <form action="#" method="post" >
                <div class="col1">
                    <div class="Day">
                        <p>Day</p>
                        <select name="day" id="day">
                            <option value="<?php echo $FirstDay?>">
                            <?php echo date('d M Y, D', strtotime($FirstDay));?>
                            </option>

                            <option value="<?php echo $SecondDay?>">
                            <?php echo date('d M Y, D', strtotime($SecondDay));?>
                            </option>

                            <option value="<?php echo $ThirdDay?>">
                            <?php echo date('d M Y, D', strtotime($ThirdDay));?>
                            </option>

                            <option value="<?php echo $FourthDay?>">
                            <?php echo date('d M Y, D', strtotime($FourthDay));?>
                            </option>

                            <option value="<?php echo $FifthDay?>">
                            <?php echo date('d M Y, D', strtotime($FifthDay));?>
                            </option>

                            <option value="<?php echo $SixthDay?>">
                            <?php echo date('d M Y, D', strtotime($SixthDay));?>
                            </option>

                            <option value="<?php echo $LastDate?>">
                            <?php echo date('d M Y, D', strtotime($LastDate));?>
                            </option>
                        </select>
                    </div>

                    <div class="RoomType">
                        <p>Room type</p>
                        <select name="roomType" id="roomType">
                            <option value="Classroom">Classroom</option>
                            <option value="Auditorium">Auditorium</option>
                            <option value="Lab">Lab</option>
                        </select>
                    </div>
                </div>

                <div class="col2">
                    <div class="StartTime">
                        <p>Start time</p>
                        <input type="time" name="startTime" id="startTime" class="startTime">
                    </div>
                    <div class="EndTime">
                        <p>End time</p>
                        <input type="time" name="endTime" id="endTime" class="endTime">
                    </div>
                </div>

                <div class="FilterButton">
                    <input type="submit" name="filter" id="filter" value="Filter" class="filter">
                </div>
            </form>
        </div>

        <div class="FilteredResult">
            <?php
            if($_SERVER['REQUEST_METHOD']==='POST'){
                if(isset($_POST['filter'])){
                $FilterDate=$_POST['day'];
                $FilterRoomType=$_POST['roomType'];
                $FilterStartTime=$_POST['startTime'];
                $FilterEndTime=$_POST['endTime'];
                }
            }

            else{
                $FilterDate=$CurrentDate;
                $FilterRoomType="Classroom";
                $FilterStartTime=$CurrentTime;
                $FilterEndTime=$CurrentTime_10minutesAfter;
            }

            //Retrieve each classroom details
            $Classroom_query="SELECT * FROM `class` WHERE `room_type`='$FilterRoomType'";
            $Classroom_result=mysqli_query($conn,$Classroom_query);

            while($Classroom_row=mysqli_fetch_assoc($Classroom_result)){
                //save classroom details into variable
                $ClassID=$Classroom_row['class_ID'];
                $ClassName=$Classroom_row['class_name'];
                $RoomType=$Classroom_row['room_type'];
                $OpenTime=date('H:i', strtotime($Classroom_row['start_time']));
                $CloseTime=date('H:i', strtotime($Classroom_row['end_time']));

                // Check the classroom either open or not
                $Check=true;
                if($FilterStartTime<$OpenTime || $FilterEndTime>$CloseTime){
                    continue;
                }

                // Check either there is any class in progress between the filter time interval based on class
                $TimetableCheck_query="SELECT `start_time`, `end_time` FROM `timetable_details` WHERE `class_ID`='$ClassID' AND `date`='$FilterDate'";
                $TimetableCheck_result=mysqli_query($conn,$TimetableCheck_query);

                while($TimetableCheck_row=mysqli_fetch_assoc($TimetableCheck_result)){
                    $ClassStart=date('H:i', strtotime($TimetableCheck_row['start_time']));
                    $ClassEnd=date('H:i', strtotime($TimetableCheck_row['end_time']));



                    if(($FilterStartTime>$ClassStart && $FilterStartTime>=$ClassEnd) || ($FilterEndTime<=$ClassStart && $FilterEndTime<$ClassEnd)){
                    }
                    else{
                        $Check=false;
                        break;
                    }
                }
                if($Check==true){
            ?>
            <!-- path -->
            <a href="ClassSchedule.php?classID=<?php echo $ClassID?>&className=<?php echo $ClassName?>&roomType=<?php echo $RoomType?>&date=<?php echo $FilterDate?>">
                <div class="Result">
                    <p class="ClassName"><?php echo $ClassName;?><br></p>
                    <p class="RoomType"><?php echo $RoomType;?></p>
                </div>
            </a>
                
            <?php
                }
            }
            ?>
        </div>
    </div>
</body>
</html>