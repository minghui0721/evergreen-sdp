<?php
include "../Admin_header/AdminHeader.php";
?>
    <link rel="stylesheet" type="text/css" href="ClassList_style.css?v=<?php echo time(); ?>">
    <!-- path -->
    <title>Classroom List</title>

<style>
    .SchoolManagement{
        display: block;
    }

    .SchoolManagement .ManageClass{
        color: #5c5adb;
    }
</style>
    <div class="wrapper">
        <div class="TitleBar">
            <h1>Classroom List</h1>
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

                <tr>
                    <td>001</td>
                    <td>A-02-04</td>
                    <td>Classroom</td>
                    <td>8.00 p.m.</td>
                    <td>6.00 p.m.</td>
                    <td>
                        <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                        <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                    </td>
                </tr>

                <tr>
                    <td>002</td>
                    <td>Tech Lab 6-11</td>
                    <td>Lab</td>
                    <td>8.30 p.m.</td>
                    <td>6.00 p.m.</td>
                    <td>
                        <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                        <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                    </td>
                </tr>

                <tr>
                    <td>003</td>
                    <td>B-05-02</td>
                    <td>Classroom</td>
                    <td>8.00 p.m.</td>
                    <td>5.00 p.m.</td>
                    <td>
                        <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                        <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                    </td>
                </tr>

                <tr>
                    <td>004</td>
                    <td>Level 3 Auditorium 2</td>
                    <td>Auditorium</td>
                    <td>10.00 p.m.</td>
                    <td>6.00 p.m.</td>
                    <td>
                        <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                        <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                    </td>

                    <tr>
                        <td>003</td>
                        <td>B-05-02</td>
                        <td>Classroom</td>
                        <td>8.00 p.m.</td>
                        <td>5.00 p.m.</td>
                        <td>
                            <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                            <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>B-05-02</td>
                        <td>Classroom</td>
                        <td>8.00 p.m.</td>
                        <td>5.00 p.m.</td>
                        <td>
                            <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                            <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>B-05-02</td>
                        <td>Classroom</td>
                        <td>8.00 p.m.</td>
                        <td>5.00 p.m.</td>
                        <td>
                            <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                            <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>B-05-02</td>
                        <td>Classroom</td>
                        <td>8.00 p.m.</td>
                        <td>5.00 p.m.</td>
                        <td>
                            <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                            <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>003</td>
                        <td>B-05-02</td>
                        <td>Classroom</td>
                        <td>8.00 p.m.</td>
                        <td>5.00 p.m.</td>
                        <td>
                            <button class="edit_button"><i class="fa-solid fa-pen" style="color: #ffffff;"></i></button>
                            <button class="delete_button"><i class="fa-solid fa-trash" style="color: #ffffff;"></i></button>
                        </td>
                    </tr>
                </tr>
            </table>
        </div>
    </div>

</body>
</html>