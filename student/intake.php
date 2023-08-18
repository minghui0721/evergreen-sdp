<?php
include '../assets/favicon/favicon.php'; // Include the favicon.php file
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
    <link rel="stylesheet" href="../assets/css/intake.css.?v=<?php echo time(); ?>">  
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
        <a href="#" class="back-button" onclick="goBack()">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>        </a>
        <h2>Intake Calendar</h2>
    </div>
</header>

<script>
    function goBack() {
        window.history.back();
    }
</script>

<?php
function calculateEndDates($startDate, $durations) {
    $endDates = array();
    foreach ($durations as $durationYears) {
        $endDate = date('M d, Y', strtotime($startDate . ' + ' . $durationYears . ' years'));
        $endDates[] = $endDate;
    }
    return $endDates;
}

function displayEndDates($endDates) {
    $labels = ['1st Year', '2nd Year', '3rd Year']; // Add labels for each end date
    for ($i = 0; $i < count($endDates); $i++) {
        echo '<li><strong>' . $labels[$i] . ':</strong> ' . $endDates[$i] . '</li>';
    }
}
?>




<div class="intake-container">
    <div class="intake" id="january">
        <h2>January Intake</h2>
        <p>Opening Date: January 16, 2023</p>
        <table>
            <tr>
                <th>Duration (Year)</th>
                <th>Program</th>
                <th>End Date</th>
            </tr>
            <?php
                $programs = ['Foundation', 'Diploma', 'Degree'];
                foreach (calculateEndDates('2023-01-16', [1, 2, 3]) as $i => $endDate) {
                    echo '<tr>';
                    echo '<td>' . ($i + 1) . '</td>';
                    echo '<td>' . $programs[$i] . '</td>';
                    echo '<td>' . $endDate . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>

    <div class="intake" id="july">
        <h2>July Intake</h2>
        <p>Opening Date: July 10, 2023</p>
        <table>
            <tr>
                <th>Duration (Year)</th>
                <th>Program</th>
                <th>End Date</th>
            </tr>
            <?php
                foreach (calculateEndDates('2023-07-10', [1, 2, 3]) as $i => $endDate) {
                    echo '<tr>';
                    echo '<td>' . ($i + 1) . '</td>';
                    echo '<td>' . $programs[$i] . '</td>';
                    echo '<td>' . $endDate . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>

    <div class="intake" id="november">
        <h2>November Intake</h2>
        <p>Opening Date: November 13, 2023</p>
        <table>
            <tr>
                <th>Duration (Year)</th>
                <th>Program</th>
                <th>End Date</th>
            </tr>
            <?php
                foreach (calculateEndDates('2023-11-13', [1, 2, 3]) as $i => $endDate) {
                    echo '<tr>';
                    echo '<td>' . ($i + 1) . '</td>';
                    echo '<td>' . $programs[$i] . '</td>';
                    echo '<td>' . $endDate . '</td>';
                    echo '</tr>';
                }
            ?>
        </table>
    </div>
</div>




<script>
        const container = document.getElementById('header');
        // Load header content
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            container.innerHTML = this.responseText;
        }
        };

        xhttp.open('GET', 'studentHeader.php', true);
        xhttp.send();
    </script>
</body>
</html>