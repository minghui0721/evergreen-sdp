<?php
include '../../assets/favicon/favicon.php'; // Include the favicon.php file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="main_page.css">
</head>
<body>
    <main>
        <section class="welcome-section">
            <div class="welcome-image">
                <img src="Images/Job_6.jpg" alt="Welcome Image">
            </div>
            <div class="welcome-content">
                <h2>Welcome to Evergreen University Career Hub!</h2>
                <p>At Evergreen University, we understand that navigating the transition from education to the professional world can be daunting. That's why our Career Services team is dedicated to providing comprehensive support. We partner with industry leaders and employers to create internships and job opportunities that align with our students' interests and ambitions.</p>
            </div>
        </section>
        <section class="career-tips-section">
            <h2>Career Tips</h2>
            <div class="career-tips">
                
                <div class="career-tip-box">
                    <i class="fas fa-users"></i>
                    <h3>Networking</h3>
                    <p>Build and maintain professional connections. Attend career fairs and industry events. Connect with alumni and professionals on LinkedIn.</p>
                </div>

                <div class="career-tip-box">
                    <i class="fas fa-briefcase"></i>
                    <h3>Professional Development</h3>
                    <p>Continuously improve your skills and knowledge. Seek out learning opportunities and workshops. Consider certifications or additional courses.</p>
                </div>

                <div class="career-tip-box">
                    <i class="fas fa-adjust"></i>
                    <h3>Adaptability</h3>
                    <p>Be open to new experiences and challenges. Embrace change and be flexible in your approach.</p>
                </div>

                <div class="career-tip-box">
                    <i class="fas fa-clock"></i>
                    <h3>Time Management</h3>
                    <p>Prioritize tasks and meet deadlines. Balance work and personal commitments efficiently.</p>
                </div>

                <div class="career-tip-box">
                    <i class="fas fa-comments"></i>
                    <h3>Communication Skills</h3>
                    <p>Practice clear and effective communication. Listen actively and ask questions when unsure.</p>
                </div>

                <div class="career-tip-box">
                    <i class="fas fa-bullseye"></i>
                    <h3>Take Initiative</h3>
                    <p>Volunteer for new projects and responsibilities. Show enthusiasm and proactivity in your work.</p>
                </div>
        </section>
        <section class="job-internship-section">
            <div class="job-internship-item">
                <img src="Images/Job_7.jpg" alt="Find Job">
                <a href="Fresh_grads.php">Fresh Graduates Openings</a>
            </div>
            <div class="job-internship-item">
                <img src="Images/Job_3.jpeg" alt="Internship">
                <a href="internship.php">Internship Opportunities</a>
            </div>
        </section>
    </main>
</body>
</html>
