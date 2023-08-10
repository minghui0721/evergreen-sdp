<?php
include 'assets/base_url/config.php';

include 'database/db_connection.php';

$sql = "SELECT address FROM school_info LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$address = $row['address'];

function breakAfterThreeWords($text) {
    $words = explode(' ', $text);
    $lines = array_chunk($words, 3);
    
    // Make sure we have more than one line and the last line doesn't already have 4 words
    while (count($lines) > 1 && count(end($lines)) < 4) {
        $lastLineWords = array_pop($lines);
        $secondLastLineWords = array_pop($lines);

        $movedWord = array_pop($secondLastLineWords);  // get the last word from the second-last line
        array_unshift($lastLineWords, $movedWord);     // add that word to the start of the last line
        
        // Add the modified lines back to the lines array
        $lines[] = $secondLastLineWords;
        $lines[] = $lastLineWords;
    }

    // Get all lines except the last one and add breaks between them
    $allButLast = array_slice($lines, 0, -1);
    $result = implode('<br>', array_map('implode', array_fill(0, count($allButLast), ' '), $allButLast));

    // Append the last line without adding a break after it
    $result .= implode(' ', end($lines));

    return $result;
}


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
                <img src="<?php echo BASE_URL ?>/assets/images/evergreen-white.png" alt="logo">
            </div>

                
           
            <div class="col-lg-3 col-12 navigation">
                <h3>QUICK NAVIGATION</h3>
                <div class="table_nav">
                    <table>
                        <tr>
                            <td><a href="<?php echo BASE_URL ?>/index.php">About</a></td>
                            <td><a href="<?php echo BASE_URL ?>/articles.php">Articles</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo BASE_URL ?>/academic.php">Academics</a></td>
                            <td><a href="<?php echo BASE_URL ?>/event.php">Events</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo BASE_URL ?>/enrollment/enrollment.php">Enrollment</a></td>
                            <td><a href="<?php echo BASE_URL ?>/admission.php">Admission</a></td>
                        </tr>
                        <tr>
                            <td><a href="<?php echo BASE_URL ?>/index.php">Home</a></td>
                            <td><a href="<?php echo BASE_URL ?>/contact_us.php">Contact</a></td>
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
                <p><?php echo breakAfterThreeWords($address); ?></p>
            </div>


        </div>

    </div>

    <div class="rules">
        <p>&copy; 2023 Evergreen Height University. All Rights Reserved.</p>
    </div>



       
</body>
</html>