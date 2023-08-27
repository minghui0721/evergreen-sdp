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
    <link rel="stylesheet" href="../assets/css/index.css?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>



    <!-- font -->
    <?php include '../assets/fonts/font.html'; ?>
    
    <!-- header -->
    <div id="header" class="animation"></div>



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

            <div class="life_header animation_bottom">
                    <h2>EXPLORE OUR ACADEMIC PROGRAMS</h2>
                    <p>Embark on a journey of knowledge and growth with our diverse range of academic programs. </p>
                    <a href="academic.php"><button>Discover More</button></a>
            </div>


            <div class="four_grid">
                <div class="grid grid1"></div>
                <div class="grid grid2">
                    <div class="grid_content animation_bottom">
                        <h2>Student Life</h2>
                        <p>We believe that learning extends beyond the classroom, and that's why our university offers a vibrant array of events and activities that cater to diverse interests and passions.</p>
                        <a href="event.php"><button>Explore Campus Events</button></a>
                    </div>
                </div>
                <div class="grid grid3">
                    <div class="grid_content animation_bottom">
                        <h2>Open Enrollment</h2>
                        <p>Our university opens its doors to aspiring students like you, providing a nurturing environment that fosters growth, learning, and personal development.  </p>
                        <a href="../enrollment/enrollment.php"><button>Apply Today</button></a>
                    </div>
                </div>
                <div class="grid grid4"></div>
            </div>
        </div>

        <!-- latest news -->
        <div class="container-fluid new">
            <div class="latest_header animation_fade">
                <h2>FEATURED ARTICLES</h2>
            </div>

            <div class="background_div"></div>

            <div class="news">
                <a href="learning.php" target="_blank">
                    <div class="grid new1">
                        <h3>April 18</h3>
                        <h2>Learning at Home Effectively</h2>
                    </div>
                </a>
                
                <a href="teacher.php" target="_blank">
                    <div class="grid new2">
                        <h3>July 21</h3>
                        <h2>Get to Know Your Teachers</h2>
                    </div>
                </a>

                <a href="mental.php" target="_blank">
                    <div class="grid new3">
                        <h3>October 23</h3>
                        <h2>Mental Health Awareness</h2>
                    </div>
                </a>
                
            </div>

            <div class="news_button">
                <a href="articles.php">
                    <button>Read All Articles</button>
                </a>
            </div>
        </div>


        <div class="life_culture">
            <div class="culture_header animation_bottom">
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
            <h2 class="animation_fade">GET IN TOUCH WITH US!</h2>
            <p class="animation_fade">We will send you the latest news</p>
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


    <div id="botpress-container"></div>

    <script>
        // Initialize Botpress chatbot
        window.addEventListener('DOMContentLoaded', function () {
            WebChat.default.init({
                selector: '#botpress-container', // Specify the selector of your container
                baseUrl: 'https://mediafiles.botpress.cloud/823ae6e1-c24e-4c72-9235-2ec93b927a5c/webchat/bot.html', // Replace with your Botpress instance URL
            });
        });
    </script>

<script src="https://cdn.botpress.cloud/webchat/v1/inject.js"></script>
<script src="https://mediafiles.botpress.cloud/823ae6e1-c24e-4c72-9235-2ec93b927a5c/webchat/config.js" defer></script>
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

