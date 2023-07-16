<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/config.js"></script> 
    <link rel="stylesheet" href="assets/css/index.css?v=<?php echo time(); ?>">  
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
        <!-- aboutus -->
        <div class="aboutus">
            <div class="aboutus_box">
                <div class="back">
                    <h2>Back to School</h2>
                </div>
                <div class="welcome">
                    <p>Welcome to all of our students</p>
                </div>
                <div class="about_button">
                    <button>Discover the school</button>
                </div>
                
            </div>
        </div>

        <!-- others -->
        <div class="uni_life">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio, dolore dicta? Mollitia magni at cum assumenda porro corporis, ea sequi, facere fugit unde ducimus animi rem! Accusamus mollitia excepturi quas!</p>
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