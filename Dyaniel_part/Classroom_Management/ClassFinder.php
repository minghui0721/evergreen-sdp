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
    <title>Class Finder</title>
    <!-- path -->
</head>
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
                            <option value="">1</option>
                            <option value="">2</option>
                        </select>
                    </div>

                    <div class="RoomType">
                        <p>Room type</p>
                        <select name="roomType" id="roomType">
                            <option value="">1</option>
                            <option value="">2</option>
                        </select>
                    </div>
                </div>

                <div class="col2">
                    <div class="StartTime">
                        <p>Start time</p>
                        <select name="startTime" id="startTime">
                            <option value="">1</option>
                            <option value="">2</option>
                        </select>
                    </div>
                    <div class="EndTime">
                        <p>End time</p>
                        <select name="endTime" id="endTime">
                            <option value="">1</option>
                            <option value="">2</option>
                        </select>
                    </div>
                </div>

                <div class="FilterButton">
                    <input type="submit" name="filter" id="filter" value="Filter">
                </div>
            </form>
        </div>

        <div class="FilteredResult">
            <?php
            $i=0;
            while($i<15){
            ?>
            
            <a href="ClassSchedule.php">
                <div class="Result">
                    <p class="ClassName">A-02-04</p>
                    <p class="RoomType">Classroon</p>
                </div>
            </a>
                
            <?php
            $i++;
            }
            ?>
        </div>
    </div>
</body>
</html>