<?php
include '../../assets/favicon/favicon.php'; // Include the favicon.php file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="internship.css">
    <script src="../../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
    <header>
        <img src="Images/Job_4.jpg" alt="Welcome Image">
        <div class="welcome-content">
            <h2>Welcome to Our Internship Opportunities!</h2>
            <p>Explore the available internship positions below and kickstart your career with valuable real-world experience. If you wish to apply to any of this internship positions, please do email them your resume and contact them for more informations. </p>
        </div>
    </header>
    <main>
        <div class="search-bar">
            <input type="text" placeholder="Search for jobs..." id="searchInput">
            <button onclick="searchJobs()">Search</button>
        </div>
        <section class="job-listings">
            <div class="job-card">
                <h3>Digital Marketing Intern</h3>
                <p>ABC Tech Solutions</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Assist in creating and implementing digital marketing campaigns.</li>
                        <li>Manage social media accounts and engage with the audience.</li>
                        <li>Conduct market research and competitor analysis.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Pursuing or completed a degree in Marketing or related fields.</li>
                        <li>Strong written and verbal communication skills.</li>
                        <li>Basic knowledge of digital marketing tools and platforms.</li>
                    </ul>
                    <p>Contact Email: marketing-intern@abctech.com</p>
                    <p>Contact Phone: +1 (123) 456-7890</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Graphic Design Intern</h3>
                <p>Creative Minds Agency</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Assist in creating visual assets for marketing campaigns.</li>
                        <li>Design graphics for social media, websites, and print materials.</li>
                        <li>Work closely with the design team to execute projects.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Pursuing or completed a degree in Graphic Design or a related field.</li>
                        <li>Proficiency in Adobe Creative Suite (Illustrator, Photoshop, InDesign).</li>
                        <li>Creativity and an eye for detail.</li>
                    </ul>
                    <p>Contact Email: design-intern@creativeminds.com</p>
                    <p>Contact Phone: +1 (234) 567-8901</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Human Resources Intern</h3>
                <p>Global Corp</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Support the HR team in recruitment and onboarding processes.</li>
                        <li>Assist in maintaining employee records and databases.</li>
                        <li>Participate in HR-related projects and initiatives.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Pursuing or completed a degree in Human Resources or related fields.</li>
                        <li>Excellent interpersonal and communication skills.</li>
                        <li>Ability to handle sensitive and confidential information.</li>
                    </ul>
                    <p>Contact Email: hr-intern@globalcorp.com</p>
                    <p>Contact Phone: +1 (345) 678-9012</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Finance Intern</h3>
                <p>Financial Solutions Ltd.</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Help with financial data analysis and reporting.</li>
                        <li>Assist in preparing financial statements and budgeting.</li>
                        <li>Learn about investment analysis and risk assessment.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Pursuing a degree in Finance, Accounting, or a related discipline.</li>
                        <li>Basic understanding of financial concepts.</li>
                        <li>Proficiency in Microsoft Excel.</li>
                    </ul>
                    <p>Contact Email: finance-intern@financialsolutions.com</p>
                    <p>Contact Phone: +1 (456) 789-0123</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Software Development Intern</h3>
                <p>XYZ Software Inc.</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Collaborate with the development team to design and implement software solutions.</li>
                        <li>Write and maintain code using programming languages like Java or Python.</li>
                        <li>Test and debug software applications.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Studying Computer Science, Software Engineering, or a related field.</li>
                        <li>Familiarity with programming languages and software development concepts.</li>
                        <li>Problem-solving and analytical skills.</li>
                    </ul>
                    <p>Contact Email: software-intern@xyzsoftware.com</p>
                    <p>Contact Phone: +1 (567) 890-1234</p>
                </div>
            </div>
        </section>
    </main>
    <script src="internship.js"></script>
</body>
</html>




