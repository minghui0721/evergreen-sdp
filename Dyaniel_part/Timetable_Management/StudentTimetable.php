<?php
include "../WeekDateRange.php";

list($FirstDay,$SecondtDay,$ThirdDay,$ForthDay,$FifthDay,$SixthDay, $LastDate) = Week4DateRange();
// echo "1 Date: $FirstDay\n\n";
// echo "2 Date: $SecondtDay\n\n";
// echo "3 Date: $ThirdDay\n\n";
// echo "4 Date: $ForthDay\n\n";
// echo "5 Date: $FifthDay\n\n";
// echo "6 Date: $SixthDay\n\n";
// echo "7 Date: $LastDate\n\n";
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
    <link rel="stylesheet" type="text/css" href="StudentTimtable_style.css?v=<?php echo time(); ?>">
    <title>Timetable</title>
    <!-- path -->
</head>
<body>
    <div class="TitleBar">
        <h1>Timetable</h1>
        <form action="#" method="post">
            <select name="week" id="week">
                <option value="week1">23 July - 29 July 2023</option>
                <option value="week2">2</option>
                <option value="week3">3</option>
                <option value="week4">4</option>
            </select>

            <input type="submit" name="search" id="search" value="search">
        </form>
    </div>

    <?php
        $z=0;
        while($z<5){
    ?>
    <div class="Timetable_container">
        <h2>Day <?php echo $z+1 ?></h2>
        <?php
            $i=0;
            while($i<3){
        ?>
        <div class="TimeSchedule">
            <div class="Details">
                <div class="Left">
                    <h3>JAVA</h3>
                    <P>8:30 a.m. - 10:30 a.m.</P>
                </div>
                <div class="Right">
                    <p class="Class">Class: Tech Lab 6-11</p>
                    <p class="Lecturer">Lecturer: Gan Ming Hui</p>
                </div>
            </div>
        </div>
        <?php
            $i++;
            }
        ?>
    </div>
    <?php
        $z++;
        }
    ?>
</body>
</html>