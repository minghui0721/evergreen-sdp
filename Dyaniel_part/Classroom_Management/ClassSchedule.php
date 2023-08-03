<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/03e0369c68.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="ClassSchedule_style.css?v=<?php echo time(); ?>">
    <title>A-02-04 Class Schedule</title>
    <!-- path -->
</head>
<body>
    <div class="Title">
        <h1>A-02-04</h1>
        <p class="roomType">Room type: Classroom</p>
        <p class="date">31 Jul 2023, Mon</p>
    </div>

    <div class="ClassScheContainer">
        <?php
        $i=0;
        while($i<4){
        ?>
        <div class="ClassScheBox">
            <div class="Time">
                <p>8.00 a.m. <br> 10.00a.m.</p>
            </div>

            <div class="ClassDetailsBox">
                <div class="FirstLine">
                    <p>WDT</p>
                </div>
                <div class="SecondLine">
                    <p class="intake">
                        <i class="fa-solid fa-people-group" style="color: #ffffff;"></i>January Diploma Software Engineering
                    </p>
                    <p class="lecturer">
                        <i class="fa-solid fa-user-tie" style="color: #ffffff;"></i> Gan Ming Hui
                    </p>
                </div>
            </div>
        </div>
        <?php
        $i++;
        }
        ?>
    </div>
</body>
</html>