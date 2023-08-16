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
    <link rel="stylesheet" href="../assets/css/learning.css?v=<?php echo time(); ?>">  
    
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>

</head>
<body>

    <!-- header -->
    <div id="header"></div>


    <div class="article_container">
        <div class="article">
            <div class="admin">
                <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
                &nbsp&nbspAdmin &nbsp&nbsp&nbsp·&nbsp&nbsp&nbspOctober 23&nbsp&nbsp&nbsp·&nbsp&nbsp&nbsp2 Min read
            </div>
            <div class="article_header">
                <h1>Mental Health: The Importance of Mental Health Awareness</h1>
            </div>

            <div class="article_content">
                <p>In today's fast-paced and demanding academic environment, the mental health of university students has become a growing concern. Juggling academic responsibilities, social life, and personal challenges can take a toll on students' well-being. It is crucial for educational institutions to prioritize mental health awareness and foster a supportive campus environment. In this article, we will explore the significance of mental health awareness, its impact on students' academic success and overall well-being, and the steps universities can take to promote mental wellness.</p>

                <img src="../assets/images/mental.avif" alt="">

                <h2>1. Set Up a Dedicated Study Space</h2>
                <p>Create a dedicated study area where you can focus without distractions. A quiet corner or a well-lit room can become your sanctuary for learning. Organize your study materials, keep them readily accessible, and eliminate any disturbances to enhance concentration.</p>

                <h2>2. Establish a Routine</h2>
                <p>Consistency is key to successful learning at home. Set a daily schedule that includes study sessions, breaks, and leisure time. Following a routine will help you stay on track, maintain motivation, and create a healthy work-life balance.</p>

                <h2>3. Stay Organized</h2>
                <p>Keep track of assignments, deadlines, and class materials with a planner or digital tools. Staying organized will reduce stress and ensure you complete tasks on time. Additionally, it helps you manage multiple subjects efficiently.</p>

                <h2>4. Limit Distractions</h2>
                <p>The allure of home comforts can be tempting, but try to minimize distractions during study hours. Silence your phone, log out of social media, and communicate with family members about your study time. A focused approach will lead to better retention of information.</p>

                <h2>5. Utilize Online Resources</h2>
                <p>Make the most of digital learning tools and resources. Online libraries, educational videos, and interactive platforms can enrich your understanding of the subject matter. Engage with online forums and discussion groups to connect with peers and educators.</p>

                <br>
                <p>Learning at home can be a rewarding experience if approached with dedication and enthusiasm. By creating a conducive study environment, adhering to a routine, and leveraging online resources, you can excel in your academic journey. Remember, it's not just about completing coursework but also embracing the joy of learning in the comfort of your home.
                </p>
            </div>
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
</body>
</html>
