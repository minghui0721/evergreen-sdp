<?php
include "../Admin_header/AdminHeader.php";
include "../dbConn.php"
?>
    <link rel="stylesheet" type="text/css" href="ClassList_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Manage Classroom</title>

<style>
    .AcademicManagement{
        display: block;
    }

    .AcademicManagement .ManageClassroom{
        color: #5c5adb;
    }
</style>
    <div class="wrapper">
        <div class="TitleBar">
            <h1>Manage Classroom</h1>
            <a href="CreateClass.php">
            <button><i class="fa-solid fa-circle-plus" style="color: #ffffff;"></i></i> &nbsp;Add New</button>
            </a>
            <!-- path -->
        </div>
        

        <div class="ClassroomList">
            <table
            border="0"
            cellpadding="20px">
                <tr>
                    <th>Class ID</th>
                    <th>Class Name</th>
                    <th>Room Type</th>
                    <th>Open Time</th>
                    <th>End Time</th>
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
                    <td><?php echo $ClassList_row["class_ID"];?></td>
                    <td><?php echo $ClassList_row["class_name"];?></td>
                    <td><?php echo $ClassList_row["room_type"];?></td>
                    <td><?php echo date('h:i a', strtotime($ClassList_row['start_time'])); ?></td>
                    <td><?php echo date('h:i a', strtotime($ClassList_row['end_time'])); ?></td>
                    <td>
                        <!-- Edit Button -->  <!-- path -->
                        <a href="EditClass.php?classID=<?php echo $ClassList_row["class_ID"];?>">
                        <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                        </a>
                        <!-- Delete Button -->
                        <a href="DeleteClass.php?classID=<?php echo $ClassList_row['class_ID']?>"
                        onclick ="return confirm('Are you sure want to delete this class?')">
                        <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                        </a>
                    </td>
                </tr>

                <?php
                    }
                ?>
            </table>
        </div>
    </div>

</body>
</html>