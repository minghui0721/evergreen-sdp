<?php
include '../database/db_connection.php';
include '../assets/favicon/favicon.php'; // Include the favicon.php file

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['event_id'])) {
    // Retrieve the event_id from the form submission
    $eventId = $_POST['event_id'];
    $sql = "SELECT * FROM event WHERE event_ID = $eventId ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
        die("Error executing the query: " . mysqli_error($conn));
    }
    $row = mysqli_fetch_assoc($result);
    $id = $row['event_ID'];
    $name = $row['name'];
    $description = $row['description'];
    $date = $row['date'];
    $start = $row['start_time'];
    $end = $row['end_time'];
    $location = $row['location'];
}
$conn->close();
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
    <link rel="stylesheet" href="../assets/css/register_event.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/font.html'; ?>
<!-- header -->
<div id="header"></div>

<div class="register">
    <div class="register_form animation_fade">
        <form action="event_application.php" method="POST">
            <div class="register_header">
                <h2>Add Your Details</h2>
            </div>
            <div class="form_container">
                <div class="form_input">
                    <label for="firstname">First Name</label><br>
                    <input type="text" id="firstname" name="firstname" required>
                </div>
                <div class="form_input">
                    <label for="lastname">Last Name</label><br>
                    <input type="text" id="lastname" name="lastname" required>
                </div>
                <div class="form_email">
                    <label for="email">Email</label><br>
                    <input type="email" id="email" name="email" required data-valid="false">
                </div>
                <div class="form_button">
                    <input type="hidden" name="event_id" value="<?php echo $id; ?>">
                    <button class = "submit" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <div class="event_container">
        <div class="event_box animation_fade">
            <div class="event_name">
                <?php echo $name; ?>
            </div>
            <hr>
            <ul>
                <div class="event_date">            
                    <li><?php echo $date; ?></li>
                    <li><?php echo $start; ?> - <?php echo $end; ?></li>
                    
                </div>
                <div class="event_location"><li><?php echo $location; ?></li></div>
            </li>
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
    

<script src="../assets/js/animation.js"></script> 

</body>
</html>