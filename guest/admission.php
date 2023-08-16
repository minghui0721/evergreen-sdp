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
    <link rel="stylesheet" href="../assets/css/admission.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/font.html'; ?>
<!-- header -->
<div id="header"></div>


<!-- application process -->
<div class="admission">
    <div class="admission_title animation_bottom">
        <h2>ADMISSIONS</h2>
        <p>Welcome to Evergreen Heights University's Admission page! We are thrilled that you are considering joining our esteemed academic community. At Evergreen Height University, we believe in fostering a vibrant and inclusive learning environment that nurtures intellectual growth, personal development, and professional success.</p>
    </div>

    <div class="admission_block animation_fade">
        <div class="open_house">
            <div class="open_content">
                <h2>Open House</h2>
                <p class="open_description">Our Open House is designed to provide prospective students and their families with an immersive experience into life at Evergreen Heights University. This is the perfect opportunity to explore our state-of-the-art facilities, meet our passionate faculty, and learn more about the diverse academic programs we offer.</p>
                <p class="open_description">At Evergreen Heights University's Open House, we are delighted to showcase our strengths, distinctive programs, and the vibrant campus community. We aim to provide a comprehensive view of our institution, allowing potential students to see how our values, academic excellence, and supportive environment align with their educational and personal goals.</p>
                <p class="open_description">We encourage all aspiring students to join us at our upcoming Open House events. It's a chance to connect with our faculty, staff, and current students, gain insights into our various academic disciplines, and get a sense of what life at Evergreen Heights University truly feels like. We look forward to warmly welcoming you and assisting you on your path to success!</p>
            </div>
        </div>
        <div class="application">
            <div class="application_content">
                <h2>Application Guidelines</h2>
                <ol>
                    <li><span>Check Eligibility:</span> Before proceeding with the application, make sure you meet the eligibility criteria for the program or course you wish to apply to.</li>
                    <li><span>Prepare Required Documents:</span> Gather all the necessary documents needed for the application.</li>
                    <li><a class="custom" href="../enrollment/enrollment.php"><span>Online Application Form:</span></a> We have provided an online application form for your convenience. Please complete all the required fields in the form accurately and truthfully. Incomplete or inaccurate information may delay the processing of your application.</li>
                    <li><span>Application Deadlines:</span> Be mindful of the application deadlines for each program. Late applications may not be considered, so ensure you submit your application on or before the specified deadline.</li>
                    <li><span>Review and Edit:</span> Before submitting the application, carefully review all the information provided to avoid any errors or omissions. You may want to have a trusted individual proofread your application as well.</li>
                    <li><span>acknowledgment Email:</span> After submitting your application, you will receive an acknowledgment email or notification. </li>
                    <li><span>Acceptance and Enrollment:</span> If you receive an offer of admission, congratulations! You will be provided with instructions on how to accept the offer and complete the enrollment process.</li>
                </ol>
            </div>
        </div>
    </div>
    <div class="admission_picture">
        <div class="background"></div>
    </div>

</div>

<!-- footer -->
<div id="footer"></div>

<script>
        const container = document.getElementById('header');
        const footerContainer = document.getElementById('footer');

        // Load header content
        const xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
        if (this.readyState === 4 && this.status === 200) {
            container.innerHTML = this.responseText;
        }
        };

        xhttp.open('GET', 'header.php', true);
        xhttp.send();

         // Load footer content
        const footerXhttp = new XMLHttpRequest();
        footerXhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                footerContainer.innerHTML = this.responseText;
            }
        };
        footerXhttp.open('GET', 'footer.php', true);
        footerXhttp.send();
</script>

<script src="../assets/js/animation.js"></script> 
    
</body>
</html>