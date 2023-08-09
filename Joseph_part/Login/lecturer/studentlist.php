<?php
include 'dbConn.php';

//Step 2 - Create the command - 
if(isset($_POST['search'])) {
    $search_keyword = $_POST['search'];
    $query = "SELECT * FROM student WHERE student_ID LIKE '%$search_keyword%' OR program_ID LIKE '%$search_keyword%' OR course_ID LIKE '%$search_keyword%' OR student_name LIKE '%$search_keyword%' OR student_password LIKE '%$search_keyword%' OR email LIKE '%$search_keyword%' OR phone LIKE '%$search_keyword%' ORDER BY student_ID ASC";
} else {
    $query = "SELECT * FROM student ORDER BY student_ID ASC";
}

//Execute your query
$results = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student List</title>
    <link rel="stylesheet" href="studentlist.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/d3e9e194a4.js" crossorigin="anonymous"></script>
</head>
<body>
    <h2>Student List</h2>
    <div class="search-bar">
        <form action="" method="post">
            <label for="search-input">Search:</label>
            <input type="text" id="search-input" name="search" placeholder="Enter what you are searching for">
            <button type="submit">Search</button>
            <a href="addStudent.php" name="add" class="add-button">Add Student</a>
        </form>
    </div>
    <div class="table-wrapper">
        <table border="0" class="animated">
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Program ID</th>
                <th>Course ID</th>
                <th>Action</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($results)) { ?>
                <tr>
                    <td><?php echo $row['student_ID']; ?> </td>
                    <td><?php echo $row['student_name']; ?> </td>
                    <td><?php echo $row['phone']; ?> </td>
                    <td><?php echo $row['email']; ?> </td>
                    <td><?php echo $row['program_ID']; ?> </td>
                    <td><?php echo $row['course_ID']; ?> </td>

                    <td>
                        <i class="fa-solid fa-pen-to-square"></i><a href="editstudent.php?student_ID=<?php echo $row['student_ID'];?>">Edit</a>
                        <i class="fa-solid fa-eraser"></i><a href="deletestudent.php?student_ID=<?php echo $row['student_ID'];?>" onclick="return confirmDelete();">Delete</a>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this student?");
    }
</script>
</body>
</html>
