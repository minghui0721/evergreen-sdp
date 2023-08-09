<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

// Step 1 - Database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check database connection
if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment Setup Form</title>
    <link rel="stylesheet" href="../moodle/home.css">
    <link rel="stylesheet" href="setup.css">
</head>
<script>    
function goBack() {
    window.history.back();
}
</script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<header>
    <div class="header-content">
        <a href="#" onclick="goBack()"><button class="backbtn">Back</button></a>
        <a href="home.html"></a>
            <img src="../moodle/img/logo.png" height="80" weight="420" alt="Error" class="logo">
        </a>
        <h2 class="setup_title">Assignment</h2>
    </div>

    <hr id="header_line">
</header>
<body>
    <div class="container_setup">
        <h2 class="title_setup">Assignment Details Form</h2>
        <form action="insert_assignment_details.php" method="post" enctype="multipart/form-data">
            <div class="input-group">
                <div class="input">
                    <label for="subject_ID">Subject ID <ion-icon name="man-outline"></ion-icon><ion-icon name="woman-outline"></ion-icon></label>
                    <input type="number" name="subject_ID" id="subject_ID" required min="1">
                </div>
                <div class="input">
                    <label for="assignment_title">Assignment Title <ion-icon name="school-outline"></ion-icon></label>
                    <input type="text" name="assignment_title" id="assignment_title" required>
                </div>
            </div>
            <div class="input-group">
                <div class="input">
                    <label for="assignment_file">Assignment File <ion-icon name="calendar-outline"></ion-icon></label>
                    <label for="assignment_file" class="custom-file-upload">Choose File</label>
                    <input type="file" name="assignment_file" id="assignment_file" required multiple style="display: none;">
                </div>
                <input type="submit" class = "submitbtn" value="Submit Assignment Details">
            </div>
            
        </form>
        <div id="file_list"></div>
    </div>

    <script>
        const fileInput = document.getElementById('assignment_file');
        const fileListDiv = document.getElementById('file_list');
        const selectedFiles = [];

        // Function to create a container for each file name and its corresponding icon
        function displayFiles() {
            fileListDiv.innerHTML = ''; // Clear previous file list
            for (let i = 0; i < selectedFiles.length; i++) {
                const file = selectedFiles[i];
                const fileContainer = document.createElement('div'); // Create a container for the file
                fileContainer.classList.add('file-container');

                const fileIcon = document.createElement('ion-icon'); // Create the ion-icon element
                fileIcon.setAttribute('name', 'document-outline');

                const fileNameElement = document.createElement('p'); // Create a paragraph for the file name
                fileNameElement.textContent = file.name;

                // Append the icon and file name to the container element
                fileContainer.appendChild(fileIcon);
                fileContainer.appendChild(fileNameElement);

                fileListDiv.appendChild(fileContainer); // Append the container to the file list
            }
        }

        fileInput.addEventListener('change', function() {
            const files = fileInput.files;

            // Add each file to the selectedFiles array
            for (let i = 0; i < files.length; i++) {
                selectedFiles.push(files[i]);
            }

            // Display all selected file names in the fileListDiv
            displayFiles();
        });

        // Initial display of files (if needed, when the page loads with pre-selected files)
        displayFiles();
    </script>
    <br><br>
    <?php
// Fetch data from the database
$query = "SELECT assignmentDetails_ID, subject_id, assignment_title FROM assignment_details ORDER BY subject_id ASC";
$result = mysqli_query($connection, $query);
?>

<hr style="width: 95%; margin-left: 35px;">
<div class="container_grade">
    <h2 class="history_title">History</h2>
    <br>
    <table style="width:80%">
        <tr>
            <th>Subject ID</th>
            <th>Assignment Title</th>
            <th>Delete</th>
        </tr>
        <?php
        // Loop through each row of the result and display data in table rows
        while ($row = mysqli_fetch_assoc($result)) {
            $subjectId = $row['subject_id'];
            $assignmentTitle = $row['assignment_title'];
            $assignmentDetails_ID = $row['assignmentDetails_ID'];
        ?>
        <tr>
            <td><?php echo $subjectId; ?></td>
            <td><?php echo $assignmentTitle; ?></td>
            <td>
                <form method="post" action="delete_assignmentDetails.php" onsubmit="return confirm('Are you sure you want to remove this file?');">
                    <input type="hidden" name="assignmentDetails_ID" value="<?php echo $assignmentDetails_ID; ?>">
                    <button type="submit" name="delete_btn">Delete</button>
                </form>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</div>  
</body>


<style>
        /* CSS style for the "Choose File" button */
        .custom-file-upload {
            display: inline-block;
            padding: 8px 20px;
            cursor: pointer;
            background-color: #8CABFF;
            color: white;
            border: none;
            border-radius: 4px;
            transition: background-color 0.3s ease;
        }

        .custom-file-upload:hover {
            background-color: #4477CE;
        }

        /* Optional: Adding some spacing between the button and the file list */
        #file_list p {
            margin-bottom: 5px;
        }

        /* Additional CSS style for the file container */
        .file-container {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        /* Style for the ion-icon */
        ion-icon {
            margin-right: 5px;
            margin-top: -10px;
        }

        .submitbtn{
            text-align: center;
            margin-top: 45px;
            padding: 10px 20px;
            background-color: #86d4f8;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            height: 40px;
        }

        .submitbtn:hover {
            background-color: #50c6fd;
            box-shadow: 5px 5px 5px grey;
        }
    </style>
    </html>