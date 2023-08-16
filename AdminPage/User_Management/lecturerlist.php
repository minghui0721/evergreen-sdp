<?php
include "../Admin_header/AdminHeader.php";
include 'dbConn.php';

// Prepare the query based on whether a search keyword is provided
$search_keyword = '';
if(isset($_POST['search'])) {
    $search_keyword = $_POST['search'];
    $query = "
    SELECT 
        l.lecturer_ID, 
        l.lecturer_name, 
        l.email, 
        l.phone, 
        GROUP_CONCAT(CONCAT(intake.intake, ' ', course_program.program_name, ' in ', course_program.course_name) SEPARATOR '<br />') AS handle
    FROM 
        lecturer AS l
    JOIN 
        lecturer_handle ON l.lecturer_ID = lecturer_handle.lecturer_ID 
    JOIN 
        intake ON lecturer_handle.intake_ID = intake.intake_ID 
    JOIN 
        course_program ON intake.courseProgram_ID = course_program.courseProgram_ID
    WHERE 
        l.lecturer_ID IN (
            SELECT DISTINCT lecturer.lecturer_ID 
            FROM lecturer 
            JOIN lecturer_handle ON lecturer.lecturer_ID = lecturer_handle.lecturer_ID 
            JOIN intake ON lecturer_handle.intake_ID = intake.intake_ID 
            JOIN course_program ON intake.courseProgram_ID = course_program.courseProgram_ID
            WHERE 
                lecturer.lecturer_ID LIKE '%$search_keyword%' 
                OR lecturer.lecturer_name LIKE '%$search_keyword%' 
                OR email LIKE '%$search_keyword%' 
                OR phone LIKE '%$search_keyword%' 
                OR course_name LIKE '%$search_keyword%'
                OR program_name LIKE '%$search_keyword%'
        )
    GROUP BY 
        l.lecturer_ID, 
        l.lecturer_name, 
        l.email, 
        l.phone
    ORDER BY 
        l.lecturer_ID ASC";


} else {
    $query = "SELECT 
        lecturer.lecturer_ID, 
        lecturer.lecturer_name, 
        lecturer.email, 
        lecturer.phone, 
        GROUP_CONCAT(CONCAT(intake.intake, ' ', course_program.program_name, ' in ', course_program.course_name) SEPARATOR '<br />') AS handle
    FROM 
        lecturer 
    JOIN 
        lecturer_handle ON lecturer.lecturer_ID = lecturer_handle.lecturer_ID 
    JOIN 
        intake ON lecturer_handle.intake_ID = intake.intake_ID 
    JOIN 
        course_program ON intake.courseProgram_ID = course_program.courseProgram_ID
    GROUP BY 
        lecturer.lecturer_ID, 
        lecturer.lecturer_name, 
        lecturer.email, 
        lecturer.phone
    ORDER BY 
        lecturer.lecturer_ID ASC";
}

//Execute your query
$results = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer List</title>
    <link rel="stylesheet" href="lecturerlist.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/d3e9e194a4.js" crossorigin="anonymous"></script>

<style>
    .UserManagement{
        display: block;
    }

    .UserManagement .ManageLecturer{
        color: #5c5adb;
    }
</style>

</head>
<body>
    <div class="wrapper">
        <h2>Lecturer List</h2>
        <div class="search-bar">
            <form action="" method="post">
                <label for="search-input" class="search-input">Search:</label>
                <input type="text" id="search-input" name="search" placeholder="Enter what you are searching for">
                <button type="submit">Search</button>
                <a href="addlecturer.php" name="add" class="add-button">Add Lecturer</a>
            </form>
        </div>
        <div class="table-wrapper">
            <table border="0" class="animated">
                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Teach</th>
                    <th>Action</th>
                </tr>
                <?php while($row = mysqli_fetch_assoc($results)) { ?>
                    <tr>
                        <td><?php echo $row['lecturer_ID']; ?> </td>
                        <td><?php echo $row['lecturer_name']; ?> </td>
                        <td><?php echo $row['email']; ?> </td>
                        <td><?php echo $row['phone']; ?> </td>
                        <td>
                            <ul>
                            <?php 
                                // Create array of handles by splitting on line break
                                $handles = explode('<br />', htmlspecialchars_decode($row['handle']));
                                foreach ($handles as $handle) {
                                    echo "<li>$handle</li>";
                                }
                            ?>
                            </ul>
                        </td>
                        <td class="action-buttons">
                            <a href="editlecturer.php?lecturer_ID=<?php echo $row['lecturer_ID'];?>">
                                <i class="fa-solid fa-pen-to-square edit-icon"></i>
                                <span class="tooltip-text">Edit</span>
                            </a>
                            <a href="deletelecturer.php?lecturer_ID=<?php echo $row['lecturer_ID'];?>" onclick="return confirmDelete();">
                                <i class="fa-solid fa-eraser delete-icon"></i>
                                <span class="tooltip-text">Delete</span>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        </div>
    </div>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this Lecturer's record?");
    }
</script>
</body>
</html>
