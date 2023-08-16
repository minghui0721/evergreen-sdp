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
                &nbsp&nbspAdmin &nbsp&nbsp&nbsp·&nbsp&nbsp&nbspApril 21&nbsp&nbsp&nbsp·&nbsp&nbsp&nbsp1 Min read
            </div>
            <div class="article_header">
                <h1>Financial Literacy for Students: Navigating the Path to Financial Empowerment</h1>
            </div>

            <div class="article_content">
                <p>As a student embarking on your academic journey, mastering the art of financial literacy is a crucial life skill that can pave the way for a secure and prosperous future. While focusing on your studies is essential, understanding how to manage your finances is equally important. In this article, we'll delve into the realm of financial literacy and explore practical tips to help you navigate the world of money management effectively.</p>

                <img src="../assets/images/financial.jpg" alt="financial">

                <h2>1. Budgeting Basics</h2>
                <p> Creating a budget is the foundation of financial success. Learn how to allocate your funds for essentials like tuition, books, and living expenses while setting aside money for savings and leisure activities. We'll guide you through the process of crafting a realistic budget tailored to your needs..</p>

                <h2>2. Saving Strategies</h2>
                <p>Discover the power of saving early and consistently. We'll discuss various savings methods, such as setting up an emergency fund, saving for short-term goals, and exploring investment options that can help your money grow over time.</p>

                <h2>3. Understanding Credit</h2>
                <p>Gain insights into the world of credit, including credit cards, loans, and credit scores. Learn how responsible credit usage can open doors to opportunities while avoiding pitfalls that can lead to debt and financial stress.</p>

                <h2>4. Smart Spending</h2>
                <p>Uncover strategies for making informed purchasing decisions. We'll share tips on differentiating between needs and wants, comparing prices, and taking advantage of student discounts to stretch your dollars further.</p>

                <p>By developing strong financial literacy skills today, you're setting yourself up for a future marked by financial confidence and independence. As you embark on this enlightening journey, remember that every step you take toward financial literacy is a step toward a brighter and more prosperous tomorrow. </p>
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
