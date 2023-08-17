<?php
include '../../assets/favicon/favicon.php'; // Include the favicon.php file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Fresh_grads.css">
    <script src="../../assets/js/config.js"></script> 
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
    <header>
        <img src="Images/Job_1.jpg" alt="Welcome Image">
        <div class="welcome-content">
            <h2>Welcome to Our Job Portal for Fresh Graduates!</h2>
            <p>We are excited to offer you a variety of job opportunities to kick-start your career. Explore the listings below and find your dream job. If you are intrested in one of these jobs, please submit your resume to their respective emails and contact them for more information.</p>
        </div>
    </header>
    <main>
        <div class="search-bar">
            <input type="text" placeholder="Search for jobs..." id="searchInput">
            <button onclick="searchJobs()">Search</button>
        </div>
        <section class="job-listings">
            <div class="job-card">
                <h3>Junior Software Developer</h3>
                <p>Tech Solutions Inc.</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Assist in software development, code debugging, and testing. </li>
                        <li>Collaborate with senior developers to build and maintain software applications.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Bachelor's degree in Computer Science or related field. </li>
                        <li>Knowledge of programming languages like Java or Python.</li>
                    </ul>
                    <p>Contact Email: contact@techsolutions.com</p>
                    <p>Contact Phone: +1 (123) 456-7890</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Marketing Assistant</h3>
                <p>Digital Marketing Agency</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Support marketing campaigns, manage social media accounts, and analyze marketing data.</li>
                        <li>Assist in content creation and market research.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Assist in content creation and market research.</li>
                        <li>Strong communication and writing skills.</li>
                    </ul>
                    <p>Contact Email: contact@digitalmarketingage.com</p>
                    <p>Contact Phone: 03-66543223</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Financial Analyst</h3>
                <p>Finance Corporation</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Analyze financial data, prepare reports, and assist in budget planning. </li>
                        <li>Monitor financial performance and trends.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Bachelor's degree in Finance, Accounting, or Economics.</li>
                        <li>Proficiency in Microsoft Excel.</li>
                    </ul>
                    <p>Contact Email: contact@financecooperation.com</p>
                    <p>Contact Phone: 03-807096554</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Human Resources Coordinator</h3>
                <p>HR Solutions Ltd.</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Assist in recruitment processes, conduct interviews, and handle employee onboarding.</li>
                        <li>Manage HR documentation and policies.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Bachelor's degree in Human Resources or related field.</li>
                        <li>Strong interpersonal and organizational skills.</li>
                    </ul>
                    <p>Contact Email: contact@solutionshr.com</p>
                    <p>Contact Phone: 0123345678</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Sales Associate</h3>
                <p>Retail Store</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Assist customers, handle sales transactions, and maintain store inventory. </li>
                        <li>Provide excellent customer service.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>High school diploma or equivalent.</li>
                        <li>Good communication and customer service skills.</li>
                    </ul>
                    <p>Contact Email: contact@storeretail.com</p>
                    <p>Contact Phone: 0123345667</p>
                </div>
            </div>
            <div class="job-card">
                <h3>Content Writer</h3>
                <p>Media Publishing Company</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Create engaging and SEO-friendly content for websites, blogs, and social media platforms.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Bachelor's degree in English, Journalism, or a related field.</li>
                        <li>Excellent writing and editing skills.</li>
                    </ul>
                    <p>Contact Email: contact@publishmedia.com</p>
                    <p>Contact Phone: 03-80224567</p>
                </div>
            </div>
            <div class="job-card">
                <h3> Graphic Designer</h3>
                <p>Creative Agency</p>
                <button class="show-more-btn" onclick="toggleDetails(this)">Show More</button>
                <div class="hidden-details">
                    <h4>Responsibilities:</h4>
                    <ul>
                        <li>Design visual content for marketing materials, websites, and promotional campaigns.</li>
                        <li>Collaborate with the creative team.</li>
                    </ul>
                    <h4>Qualifications:</h4>
                    <ul>
                        <li>Bachelor's degree in Graphic Design or a related field.</li>
                        <li>Proficiency in Adobe Creative Suite.</li>
                    </ul>
                    <p>Contact Email: contact@creativeagent.com</p>
                    <p>Contact Phone: +1 (123) 889-7890</p>
                </div>
            </div>
        </section>
    </main>
    <script src="fresh.js"></script>
</body>
</html>

