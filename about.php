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
    <link rel="stylesheet" href="assets/css/about.css.?v=<?php echo time(); ?>">  
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
<div class="container_content">
    <!-- Our School -->
    <div class="our_title">
        <h2>OUR UNIVERSITY</h2>
        <p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. </p>
    </div>

    <!-- four box -->
    <div class="four_about">
        <div class="grid about1"></div>
        <div class="grid about2">
            <div class="about_content">
                <h2>Principal's Message</h2>
                <p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. </p>
                <p>This is a great space to write a long text about your company and your services. You can use this space to go into a little more detail about your own company.</p>
            </div>
        </div>
        <div class="grid about3">
            <div class="about_content">
                <h2>Vision & Values</h2>
                <ul>
                    <li>Be Kind</li>
                    <li>Be Respectful</li>
                    <li>Be Responsible</li>
                    <li>Work Hard</li>
                    <li>Have Fun</li>
                </ul>
            </div>
        </div>
        <div class="grid about4"></div>
    </div>

    <!-- uni video -->
    <div class="video">
        <h2>DISCOVER OUR JOURNEY</h2>
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
</body>
</html>