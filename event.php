<?php


include 'database/db_connection.php';
$sql = "SELECT * FROM event";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Error executing the query: " . mysqli_error($conn));
}


$event = array();
while ($row = mysqli_fetch_assoc($result)){
    $id = $row['event_ID'];
    $name = $row['name'];
    $description = $row['description'];
    $date = $row['date'];
    $start = $row['start_time'];
    $end = $row['end_time'];
    $location = $row['location'];

    $event[] = array(
        'event_id' => $id,
        'event_name' => $name,
        'event_description' => $description,
        'event_date' => $date,
        'event_start' => $start,
        'event_end' => $end,
        'event_location' => $location
    );
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
    <script src="assets/js/config.js"></script> 
    <link rel="shortcut icon" href="assets/images/evergreen-background.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/event.css.?v=<?php echo time(); ?>">  
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include 'assets/fonts/font.html'; ?>
<!-- header -->
<div id="header"></div>


<!-- content -->
<div class="event">
    <h2>SCHOOLS EVENTS</h2>

    <div class="event_grid">
    <div class="event_background"></div>
            <?php foreach ($event as $e) { ?>
                <div class="event_card">
                <?php
                // Format the date
                $eventDate = date("j M Y", strtotime($e['event_date']));
                ?>                       
                    <div class="event_date">
                        <?php echo $eventDate; ?><br>
                        <?php echo $e['event_start']; ?> - <?php echo $e['event_end']; ?>
                    </div>
                    <div class="event_name">
                        <?php echo $e['event_name']; ?>
                    </div>


                    <div class="event_location"><?php echo $e['event_location']; ?></div>
                    <div class="event_description"><?php echo $e['event_description']; ?></div>


                    <div class="event_button">
                    <form action="register_event.php" method="post">
                            <input type="hidden" name="event_id" value="<?php echo $e['event_id']; ?>">
                            <button type="submit">RSVP</button>
                        </form>
                    </div>
                </div>
                <hr>
            <?php } ?>
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