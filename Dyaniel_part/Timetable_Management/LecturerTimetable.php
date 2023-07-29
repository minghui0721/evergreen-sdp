<?php
include "../dbConn.php";
include "../WeekDateRange.php";

$LecturerID=1;

// Calculate the Strt Date & End Date of 4 week
list($CurrentStart,$CurrentEnd)=CurrentStartEnd();
list($Week2Start,$Week2End)=Week2StartEnd();
list($Week3Start,$Week3End)=Week3StartEnd();
list($Week4Start,$Week4End)=Week4StartEnd();
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
    <link rel="stylesheet" type="text/css" href="LecturerTimetable_style.css?v=<?php echo time(); ?>">
    <title>Timetable</title>
    <!-- path -->
</head>
<body>
    <div class="TitleBar">
        <h1>Timetable</h1>
        <form action="#" method="post">
            <select name="week" id="week">
                <option value="week1" <?php if ($_SERVER['REQUEST_METHOD']==='POST' && $_POST['week'] === 'week1') echo 'selected'; ?>>
                    <?php echo date('d M Y', strtotime($CurrentStart))." - ".date('d M Y', strtotime($CurrentEnd))?>
                </option>
                <option value="week2"<?php if ($_SERVER['REQUEST_METHOD']==='POST' && $_POST['week'] === 'week2') echo 'selected'; ?>>
                    <?php echo date('d M Y', strtotime($Week2Start))." - ".date('d M Y', strtotime($Week2End))?>
                </option>
                <option value="week3" <?php if ($_SERVER['REQUEST_METHOD']==='POST' && $_POST['week'] === 'week3') echo 'selected'; ?>>
                    <?php echo date('d M Y', strtotime($Week3Start))." - ".date('d M Y', strtotime($Week3End))?>
                </option>
                <option value="week4" <?php if ($_SERVER['REQUEST_METHOD']==='POST' && $_POST['week'] === 'week4') echo 'selected'; ?>>
                    <?php echo date('d M Y', strtotime($Week4Start))." - ".date('d M Y', strtotime($Week4End))?>
                </option>
            </select>

            <input type="submit" name="search" id="search" value="search">
        </form>
    </div>

    <?php
        // Retrieve the date based on user choice
        if($_SERVER['REQUEST_METHOD']==='POST'){
            if($_POST['week']== 'week1'){
                list($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate)=CurrentWeekDateRange();
            }
            else if($_POST['week']== 'week2'){
                list($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate)=Week2DateRange();
            }
            else if($_POST['week']== 'week3'){
                list($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate)=Week3DateRange();
            }
            else if($_POST['week']== 'week4'){
                list($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate)=Week4DateRange();
            }
        }

        // set current week as default week
        else{
            list($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate)=CurrentWeekDateRange();
        }

        // Set a array of date with day
        $DateWithDay = array($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate);
        $DateWithDay[0]= date('d M Y', strtotime($FirstDay)).", Sun";
        $DateWithDay[1]= date('d M Y', strtotime($SecondDay)).", Mon";
        $DateWithDay[2]= date('d M Y', strtotime($ThirdDay)).", Tue";
        $DateWithDay[3]= date('d M Y', strtotime($FourthDay)).", Wed";
        $DateWithDay[4]= date('d M Y', strtotime($FifthDay)).", Thu";
        $DateWithDay[5]= date('d M Y', strtotime($SixthDay)).", Fri";
        $DateWithDay[6]= date('d M Y', strtotime($LastDate)).", Sat";

        // Set array for comparison
        $CompareDate = array($FirstDay,$SecondDay,$ThirdDay,$FourthDay,$FifthDay,$SixthDay, $LastDate);
        $RetrieveDataDate=array();
        $DisplayDates = array();

        $x=0;
        $DateCount=0;
        while($x<7){
            // Compare database date with the date retrieve
            $CompareDate_query="SELECT * FROM `timetable_details` WHERE `date`='$CompareDate[$x]' AND `lecturer_ID`='$LecturerID'";
            $CompareDate_result=mysqli_query($connection,$CompareDate_query);
            $CompareDate_count=mysqli_num_rows($CompareDate_result);

            if($CompareDate_count>0){
                $DateCount++;
                $DisplayDates[] = $DateWithDay[$x];
                $RetrieveDataDate[] = $CompareDate[$x];
            }
            else{}
            $x++;
        }

        if($DateCount==0){
        ?>

            <div class="NotificationContainer">
                <h2><i class="fa-solid fa-bell" style="color: #ffffff;">&nbsp;</i>You don't have any class in this week...</h2>
            </div>

        <?php
        }

        $z=0;
        while($z<$DateCount){
            $CurrentDate = $DisplayDates[$z];
            $DateForRetrieve=$RetrieveDataDate[$z];
    ?>
    <div class="Timetable_container">
        <h2><?php echo $CurrentDate; ?></h2>
        <?php
            $Timetable_query="SELECT b.class_name, c.subject_name, d.courseProgram_ID, d.intake, a.start_time, a.end_time
            FROM timetable_details a
            INNER JOIN class b
            ON a.class_ID = b.class_ID
            INNER JOIN subject c
            ON a.subject_ID = c.subject_ID
            INNER JOIN intake d
            ON a.intake_ID = d.intake_ID
            WHERE a.lecturer_ID='$LecturerID' AND a.date='$DateForRetrieve'";
            $Timetable_result=mysqli_query($connection,$Timetable_query);
            while($Timetable_row=mysqli_fetch_assoc($Timetable_result)){
                //retrieve the Course Name and Program Name based on courseProgram_ID
                $CoProID=$Timetable_row['courseProgram_ID'];
                $CoProName_query="SELECT `course_name`, `program_name`FROM `course_program` WHERE `courseProgram_ID`='$CoProID'";
                $CoProName_result=mysqli_query($connection,$CoProName_query);
                $CoProName_row=mysqli_fetch_assoc($CoProName_result);

                // save retrieved data into variable
                $Subject=$Timetable_row['subject_name'];
                $Time=date('h:i a', strtotime($Timetable_row['start_time']))." - ".date('h:i a', strtotime($Timetable_row['end_time']));
                $Class=$Timetable_row['class_name'];
                $Intake=$Timetable_row['intake']." ".$CoProName_row['program_name'].' '.$CoProName_row['course_name'];
        ?>
        <div class="TimeSchedule">
            <div class="Details">
                <div class="Left">
                    <h3><?php echo $Subject;?></h3>
                    <P class="Time"><?php echo $Time;?></P>
                    <p class="Class">Class: <?php echo $Class;?></p>
                </div>
                <div class="Right">
                    <p class="Intake">Intake: <?php echo $Intake;?></p>
                </div>
            </div>
        </div>
        <?php
            }
        ?>
    </div>
    <?php
        $z++;
        }
    ?>
</body>
</html>


