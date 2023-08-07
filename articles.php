<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/config.js"></script> 
    <link rel="shortcut icon" href="assets/images/evergreen-background.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/articles.css?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
    <!-- font -->
    <?php include 'assets/fonts/font.html'; ?>
    
    <!-- header -->
    <div id="header"></div>

    <!-- content -->
    <div class="articles_container">
        <div class="articles_title">
            <h2>FEATURED ARTICLES</h2>
        </div>

        <div class="articles_content">
            <div class="articles">
                <div class="articles_image">
                    <img src="assets/images/learning.avif" alt="home learning">
                </div>
                <div class="articles_details">
                    <div class="details_admin">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
                        &nbsp&nbspAdmin &nbsp&nbsp&nbsp·&nbsp&nbsp&nbspApril 18&nbsp&nbsp&nbsp·&nbsp&nbsp&nbsp1 Min read
                    </div>
                    <div class="details_header">
                        <a href="learning.php" target="_blank"><h2>Learning at Home Effectively</h2></a>
                    </div>
                    <div class="details_content">
                        <p>As the world rapidly embraces remote learning, the importance of effective home study techniques becomes paramount. Learning from home can present both opportunities and challenges, requiring a disciplined approach and a conducive environment. In this article, we will explore some valuable tips to help you make the most out of your home-based learning experience.</p>
                    </div>
                </div>
            </div>
            <div class="articles">
                <div class="articles_image">
                    <img src="assets/images/teacher.avif" alt="teacher">
                </div>
                <div class="articles_details">
                    <div class="details_admin">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
                        &nbsp&nbspAdmin &nbsp&nbsp&nbsp·&nbsp&nbsp&nbspJuly 21&nbsp&nbsp&nbsp·&nbsp&nbsp&nbsp2 Min read
                    </div>
                    <div class="details_header">
                        <a href="teacher.php" target="_blank"><h2>Get to Know Your Teacher</h2></a>
                    </div>
                    <div class="details_content">
                        <p>As the new academic year commences, students embark on a journey of learning, growth, and discovery. One essential aspect of this journey is getting to know their teachers. The relationship between students and teachers goes beyond the boundaries of a traditional classroom. It forms the foundation for a strong educational bond that fosters a positive and engaging learning environment.
                        </p>
                    </div>
                </div>
            </div>
            <div class="articles">
                <div class="articles_image">
                    <img src="assets/images/mental.avif" alt="mental health">
                </div>
                <div class="articles_details">
                    <div class="details_admin">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
                        &nbsp&nbspAdmin &nbsp&nbsp&nbsp·&nbsp&nbsp&nbspOctober 23&nbsp&nbsp&nbsp·&nbsp&nbsp&nbsp2 Min read
                    </div>
                    <div class="details_header">
                        <a href="mental.php" target="_blank"><h2>Mental Health</h2></a>
                    </div>
                    <div class="details_content">
                        <p> It is crucial for educational institutions to prioritize mental health awareness and foster a supportive campus environment. In this article, we will explore the significance of mental health awareness, its impact on students' academic success and overall well-being, and the steps universities can take to promote mental wellness.</p>
                    </div>
                </div>
            </div>
            <div class="articles">
                <div class="articles_image">
                    <img src="assets/images/financial.jpg" alt="articles_image">
                </div>
                <div class="articles_details">
                    <div class="details_admin">
                        <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M406.5 399.6C387.4 352.9 341.5 320 288 320H224c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3h64c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
                        &nbsp&nbspAdmin &nbsp&nbsp&nbsp·&nbsp&nbsp&nbspApril 18&nbsp&nbsp&nbsp·&nbsp&nbsp&nbsp1 Min read
                    </div>
                    <div class="details_header">
                        <a href="financial.php"><h2>Financial Literacy for Students</h2></a>
                    </div>
                    <div class="details_content">
                        <p>As a student embarking on your academic journey, mastering the art of financial literacy is a crucial life skill that can pave the way for a secure and prosperous future. While focusing on your studies is essential, understanding how to manage your finances is equally important. In this article, we'll delve into the realm of financial literacy and explore practical tips to help you navigate the world of money management effectively.</p>
                    </div>
                </div>
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
