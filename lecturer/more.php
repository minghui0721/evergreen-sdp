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
    <link rel="stylesheet" href="../assets/css/more.css.?v=<?php echo time(); ?>">  
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
<div id="header"></div>


<div class="background_div"></div>

<div class="functions">
    <a href="../Joseph_part/Fee/Student/studentPayment.php">
        <div class="grid function1">
            <h2>Fees</h2>
        </div>
    </a>
                
    <a href="../Dyaniel_part/Classroom_Management/Lecturer/ClassFinder.php">
        <div class="grid function2">
            <h2>Classroom Finder</h2>
        </div>
    </a>

    <a href="../Darsh-Part/Feedback/FeedbackLecturer.php">
        <div class="grid function3">
                <h2>Feedback</h2>
        </div>
    </a>    
    <a href="../submission/moodle/home_lecturer.php">
        <div class="grid function4">
                <h2>Course Material</h2>
        </div>
    </a>    
    <a href="../submission/lecturer/examGrading_main.php">
        <div class="grid function5">
                <h2>Exam Grading</h2>
        </div>
    </a>    
    <a href="#" onclick="goBack()">
        <div class="grid function6">
                <h2>Lecturer</h2>
        </div>
    </a>    
    <a href="../Darsh-Part/Career_hub/Job_main_page_lecturer.php">
        <div class="grid function7">
                <h2>Career Hub</h2>
        </div>
    </a>    
    <a href="../student/intake.php">
        <div class="grid function8">
                <h2>Intake Calendar</h2>
        </div>
    </a>    
    <a href="../appointment/appointment.php">
        <div class="grid function9">
                <h2>Manage Consultation</h2>
        </div>
    </a>    
</div>

<script>
    function goBack() {
        window.history.back();
    }
</script>




<script>
        const container = document.getElementById('header');
        // Load header content
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            container.innerHTML = this.responseText;
        }
        };

        xhttp.open('GET', 'lecturerHeader.php', true);
        xhttp.send();
    </script>
</body>
</html>