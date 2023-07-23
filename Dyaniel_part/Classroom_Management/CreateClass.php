<?php
include "../Admin_header/AdminHeader.php";
?>
    <link rel="stylesheet" type="text/css" href="CreateClass_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Create Class</title>

    <style>
    .SchoolManagement{
        display: block;
    }

    .SchoolManagement .ManageClass{
        color: #5c5adb;
    }
</style>

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
            <a href="ClassList.php">
                <button class="back_button">
                    Back
                </button>
                <!-- path -->
            </a>
        </div>
    </div>
</body>
</html>