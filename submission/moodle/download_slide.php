<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

// Step 1 - Database connection
$connection = mysqli_connect($host, $user, $password, $database);

// Check database connection
if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());
}

$ID = 0; // Default value in case 'subject_id' is not provided

if (isset($_GET['subject_id'])) {
    $ID = (int)$_GET['subject_id']; // Convert to an integer to prevent SQL injection
}

if ($ID > 0) {
    // Query the subject based on subject_ID
    $sql = "SELECT * FROM subject WHERE subject_ID = $ID";
    $result = mysqli_query($connection, $sql);

    if ($result->num_rows > 0) {
        // Output data of the first row
        $row = $result->fetch_assoc();
        $subjectName = $row["subject_name"];
    } else {
        $subjectName = "Default Course Name"; // Set a default course name if no record is found
    }
} else {
    $subjectName = "Default Course Name"; // Set a default course name if 'subject_id' is not provided or invalid
}

// Query the slides based on subject_ID
$sqlSlides = "SELECT * FROM lecturer_slides WHERE subject_ID = $ID";
$resultSlides = mysqli_query($connection, $sqlSlides);
$slidesData = array();

while ($rowSlides = mysqli_fetch_assoc($resultSlides)) {
    $slidesData[] = $rowSlides;
}

function downloadPPTXFile($binaryData, $filename) {
    // Send the appropriate headers to trigger the download
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Content-Length: ' . strlen($binaryData));
    header('Content-Transfer-Encoding: binary');
    
    // Output the binary data to the browser
    echo $binaryData;
    exit;
}

// Check if the user has requested to download a specific slide
if (isset($_GET['slide_id'])) {
    $requestedSlideID = (int)$_GET['slide_id'];

    // Query the specific slide based on the requested slide_id
    $sqlSlide = "SELECT * FROM lecturer_slides WHERE LecturerSlides_ID = $requestedSlideID";
    $resultSlide = mysqli_query($connection, $sqlSlide);

    if ($resultSlide && $resultSlide->num_rows > 0) {
        $slide = $resultSlide->fetch_assoc();
        
        // Use the slides_title as the filename
        $downloadFilename = $slide['slides_title'] . '.pptx';

        // Output the binary data as a .pptx file for download
        downloadPPTXFile($slide['lecturer_slides'], $downloadFilename);
    }
}
?>
