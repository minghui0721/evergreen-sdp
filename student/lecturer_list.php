<?php
include '../assets/favicon/favicon.php'; // Include the favicon.php file
include '../database/db_connection.php';

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM lecturer";
$result = mysqli_query($conn, $sql);

$lecturers = array();

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $lecturers[] = $row;
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <link rel="stylesheet" href="../assets/css/lecturer_list.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
    <style>
            .more_list{
                color: #5c5adb;
            }

            .more_list:hover{
                opacity: 1;
            }
     </style>
</head>
<body>
<?php include '../assets/fonts/fontStudent.html'; ?> 

<!-- header -->
<header class="button_header">
    <div class="button">
        <a href="more.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>        </a>
        <h2>Lecturer Directory</h2>
    </div>
</header>

<div class="lecturer_content">
    <!-- Search Bar -->
    <div class="search-bar">
        <input type="text" class="search-input" id="searchInput" placeholder="Search by lecturer name">
    </div>

    <!-- Lecturer List -->
    <div class="lecturer-list">
            <ul>
            <?php
            foreach ($lecturers as $lecturer) {
                echo '<li class="lecturer-item">';
                echo '<a href="lecturer_details.php?id=' . $lecturer['lecturer_ID'] . '">'; // Add the anchor tag
                echo '<img class="lecturer-image" src="../assets/images/people.avif" alt="Lecturer Image">';
                // echo '<img class="lecturer-image" src="' . $lecturer['img'] . '" alt="Lecturer Image">';
                echo '<div class="lecturer-details">';
                echo '<p class="lecturer-name">' . $lecturer['lecturer_name'] . '</p>';
                echo '<p class="lecturer-email">' . $lecturer['email'] . '</p>';
                echo '</div>';
                echo '<span class="arrow-icon">></span>';
                echo '</a>';
                echo '</li>';
            }
            ?>
            </ul>
        </div>
</div>

<script>
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const lecturerList = document.querySelector('.lecturer-list ul'); // Corrected selector

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.trim().toLowerCase();
        const lecturerItems = lecturerList.querySelectorAll('.lecturer-item');

        lecturerItems.forEach(item => {
            const lecturerName = item.querySelector('.lecturer-name').textContent.toLowerCase();
            const lecturerEmail = item.querySelector('.lecturer-email').textContent.toLowerCase();

            if (lecturerName.includes(searchTerm) || lecturerEmail.includes(searchTerm)) {
                item.style.display = 'flex'; // Use 'block' to show the list item
            } else {
                item.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>