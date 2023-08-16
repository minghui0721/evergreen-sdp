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
    <link rel="stylesheet" href="../assets/css/about.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<!-- font -->
<?php include '../assets/fonts/font.html'; ?>

<!-- header -->
<div id="header"></div>



<!-- content -->
<div class="container_content">
    <!-- Our School -->
    <div class="our_title">
        <h2>OUR UNIVERSITY</h2>
        <p>Welcome to the "About Us" page of Evergreen Heights University. This page provides a message from our principal, giving you insight into our vission, values, and the video about our university.</p>
    </div>

    <!-- four box -->
    <div class="four_about animation_fade">
        <div class="grid about1"></div>
        <div class="grid about2">
            <div class="about_content animation_bottom">
                <h2>Principal's Message</h2>
                <p>I am honored to serve as the Principal of this esteemed institution, where we are committed to providing a transformative and holistic educational experience to our students. Our university is dedicated to nurturing bright minds and shaping future leaders who will positively impact society.</p>
                <p>I extend my warmest welcome to all aspiring students, parents, and faculty members to be a part of our vibrant academic community. Together, let us embark on a journey of knowledge, discovery, and growth.</p>
            </div>
        </div>
        <div class="grid about3">
            <div class="about_content animation_bottom">
                <h2>Vision & Values</h2>
                <p>At Evergreen Heights University, our vision is to be a global leader in providing world-class education, fostering innovation, and empowering students to become compassionate and responsible leaders who positively influence society.</p>
                <ul>
                    <li>Academic Excellence</li>
                    <li>Diversity and Inclusivity</li>
                    <li>Innovation and Research</li>
                    <li>Social Responsibility</li>
                </ul>
            </div>
        </div>
        <div class="grid about4"></div>
    </div>

    <!-- uni video -->
    <div class="video">
        <h2 class="animation_fade">DISCOVER OUR JOURNEY</h2>
        <iframe width="760" height="515" src="https://www.youtube.com/embed/LlCwHnp3kL4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
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