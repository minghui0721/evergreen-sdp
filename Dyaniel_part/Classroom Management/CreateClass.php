<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/03e0369c68.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="CreateClass_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Create Class</title>
</head>
<body>
    <div class="wrapper">
        <!-- Title -->
        <div class="TitleBar">
            <h1>Create Class</h1>
        </div>

        <div class="ClassDetails_container">
            <form action="" method="post">
                <div class="ClassName-and-RoomType">
                    <!-- Class Name -->
                    <div class="ClassName">
                        <p>Class Name:</p>
                        <input type="text" id="class-name" name="class-name" required>
                    </div>
                    <!-- Room Type -->
                    <div class="RoomType">
                        <p>Room Type:</p>
                        <input type="text" id="room-type" name="room-type" required>
                    </div>
                </div>

                <div class="OpenTime-and-CloseTime">
                    <!-- Open Time -->
                    <div class="OpenTime">
                        <p>Open Time:</p>
                        <input type="time" id="open-time" name="open-time" required>
                    </div>
                    <!-- Close Time -->
                    <div class="CloseTime">
                        <p>Close Time:</p>
                        <input type="time" id="close-time" name="close-time" required>
                    </div>
                </div>

                <!-- submit button -->
                <div class="submit-button">
                    <input type="submit" value="submit" name="submit">
                </div>
            </form>

            <!-- back button -->
            <a href="#">
                <button class="back_button">
                    Back
                </button>
            </a>
        </div>
    </div>
</body>
</html>