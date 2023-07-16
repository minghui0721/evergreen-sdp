<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title id="documentTitle"></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/config.js"></script> 
    <link rel="stylesheet" href="assets/css/footer.css?v=<?php echo time(); ?>">

    <script>
        // document.getElementById() is used to retrieve an element by its unique 'id' attribute
        // innerText is used to represent the text content of an element.
        // exp: browserName = Testing
        // output: <title id="documentTitle">Testing</title>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>

</head>
<body>
    <?php include 'assets/fonts/font.html'; ?>

    <!-- Footer -->
    <div class="container_footer">

    
        <div class="row_footer flex-wrap">

            <div class="col-lg-3 col-12 footer_logo">
                <img src="assets/images/evergreen-white.png" alt="logo">
            </div>

                
           
            <div class="col-lg-3 col-12 navigation">
                <h3>QUICK NAVIGATION</h3>
                <div class="table_nav">
                    <table>
                        <tr>
                            <td>About</td>
                            <td>News</td>
                        </tr>
                        <tr>
                            <td>Academics</td>
                            <td>Events</td>
                        </tr>
                        <tr>
                            <td>Programs</td>
                            <td>Admission</td>
                        </tr>
                        <tr>
                            <td>Student</td>
                            <td>Contact</td>
                        </tr>
                    </table>
                </div>

                
            </div>
                
            
            <div class="col-lg-3 col-12 social">
                <h3>STAY CONNECTED</h3>

                <div class="media">
                    <a href="https://www.facebook.com/Ming Hui/" target="_blank">Facebook</a>            
                    
                    <a href="https://wa.me/601164163673" target="_blank">Twitter</a>

                    <a href="https://instagram.com/minghuiii_21?igshid=YmMyMTA2M2Y=" target="_blank">Instagram</a>

                    <a href="mailto:ganminghui0000@gmail.com">Email</a>
                </div>
            </div>

            
            <div class="col-lg-3 col-12 address">
                <h3>Address</h3>
                <p>Jalan Teknologi 5 <br>Taman Teknologi Malaysia<br>57000 Kuala Lumpur<br>Wilayah Persekutuan Kuala Lumpur</p>
            </div>

        </div>

    </div>

    <div class="rules">
        <p>&copy; 2023 Evergreen Height University. All Rights Reserved.</p>
    </div>


       
</body>
</html>