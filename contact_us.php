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
    <link rel="stylesheet" href="assets/css/contact_us.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include 'assets/fonts/font.html'; ?>
<!-- header -->
<div id="header"></div>


<div class="contact_us">
    <div class="contact_header">
        <h2>CONTACT US</h2>
        <p>Feel free to use the provided contact information to get in touch with us. You can give us a call, drop us an email, or simply visit us at our esteemed address. Additionally, the Google Maps section allows you to locate our campus easily.</p>
    </div>

    <div class="contact_container">
        <div class="container_block">
            <div class="contact_details">
                <h2>Visit the School</h2>
                <div class="school_info"><h3>ADDRESS</h3>
                <p>Jalan Teknologi 5 Taman Teknologi Malaysia 57000 Kuala Lumpur Wilayah Persekutuan Kuala Lumpur</p></div>
                <div class="school_info"><h3>INFORMATION</h3>
                <p>For information or questions:</p></div>
                <div class="school_info"><h3>E-MAIL US</h3>
                <p>evergreen@gmail.com</p></div>
                <div class="school_info"><h3>CALL OUR MAINLINE</h3>
                <p>123-456-7890</p></div>
                <div class="school_info office"><h3>OFFICE HOURS</h3>
                <p>While school is in session our staff offices are open from</p><h4>7:30 am - 4:00 pm</h4><p>During the summer our staff offices are open from</p><h4>8:30 am - 3:30 pm</h4></div>  
            </div>
            <div class="contact_background"></div>
            <div class="contact_map"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3984.1466076041243!2d101.6956958442855!3d3.0554110458276935!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31cc4abb795025d9%3A0x1c37182a714ba968!2sAsia%20Pacific%20University%20of%20Technology%20%26%20Innovation%20(APU)!5e0!3m2!1sen!2smy!4v1690267978920!5m2!1sen!2smy" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
            <div class="contact_form">
                <form action="contact_submit.php" method="POST">
                    <h2>You Can Also<br>Contact Us by Form</h2>

                    <div class="form_container">
                        <div class="form_input">
                            <label for="firstname">First Name</label><br>
                            <input type="text" id="firstname" name="firstname" required>
                        </div>
                        <div class="form_input">
                            <label for="lastname">Last Name</label><br>
                            <input type="text" id="lastname" name="lastname" required>
                        </div>
                        <div class="form_input">
                            <label for="email">Email</label><br>
                            <input type="email" id="email" name="email" required data-valid="false">
                        </div>
                        <div class="form_input">
                            <label for="phone">Phone</label><br>
                            <input type="tel" id="phone" name="phone" required>
                        </div>
                        <div class="form_textarea">
                            <label for="message">Message</label><br>
                            <textarea id="message" name="message" rows="4" required></textarea>
                        </div>
                        <div class="form_button"><button class = "submit" type="submit">Submit</button>
                    </div>
                    </div>
 
                </form>
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