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
                    <a href="about.php"><button>Discover the school</button></a>
                </div>
                
            </div>
        </div>

        <!-- uni life -->
        <div class="uni_life">

            <div class="life_header">
                <h2>SAFETY MEASURES IN PLACE</h2>
                <p>We do everything to ensure the health, safety and well-being of our students and employees. Additional information can be found here</p>
                <a href="#"><button>Safety Measures</button></a>
            </div>


            <div class="four_grid">
                <div class="grid grid1"></div>
                <div class="grid grid2">
                    <div class="grid_content">
                        <h2>Student Life</h2>
                        <p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. </p>
                        <a href="studentinfo"><button>Student Information</button></a>
                    </div>
                </div>
                <div class="grid grid3">
                    <div class="grid_content">
                        <h2>Open Enrollment</h2>
                        <p>I'm a paragraph. Click here to add your own text and edit me. It’s easy. Just click “Edit Text” or double click me to add your own content and make changes to the font. </p>
                        <a href="enrollment"><button>Apply Today</button></a>
                    </div>
                </div>
                <div class="grid grid4"></div>
            </div>
        </div>

        <!-- latest news -->
        <div class="container-fluid new">
            <div class="latest_header">
                <h2>LATEST NEWS</h2>
            </div>

            <div class="background_div"></div>

            <div class="news">
                <a href="#">
                    <div class="grid new1">
                        <h3>Mar 22</h3>
                        <h2>Learning at Home Effectively</h2>
                    </div>
                </a>
                
                <a href="#">
                    <div class="grid new2">
                        <h3>Mar 22</h3>
                        <h2>Get to Know Your Teachers</h2>
                    </div>
                </a>

                <a href="#">
                    <div class="grid new3">
                        <h3>Mar 22</h3>
                        <h2>The News Safety Regulations</h2>
                    </div>
                </a>
                
            </div>

            <div class="news_button">
                <button>Read All News</button>
            </div>
        </div>


        <div class="life_culture">
            <div class="culture_header">
                <h2>LIFE & CULTURE</h2>
                <h3>Follow <span>#evergreenuniversity</span> on Instagram</h3>
            </div>

            <!-- album -->
            <div class="gallery">
                <div class="photo photo1"></div>
                <div class="photo photo2"></div>
                <div class="photo photo3"></div>
                <div class="photo photo4"></div>
                <div class="photo photo5"></div>
                <div class="photo photo6"></div>
                <div class="photo photo7"></div>
                <div class="photo photo8"></div>
                <div class="photo photo9"></div>
                    
            </div>

        </div>

        <!-- get in touch -->
        <!-- a form -->
        <!-- first name -->
        <!-- last name -->
        <!-- email -->
        <!-- phone -->
        <div class="get_intouch">
            <h2>GET IN TOUCH WITH US!</h2>
            <p>We will send you the latest news</p>
            <form action="get_intouch.php" method="POST">
                <div class="label">
                    <label for="email">Email:</label>
                </div>
                <div class="input_button">
                    <input type="email" id="email" name="email" require>
                    <button type="submit">Submit</button>
                </div>
            </form>
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
