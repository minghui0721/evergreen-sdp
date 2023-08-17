<?php
include 'db_connection.php';

if (isset($_GET['courseProgram_ID'])) {
    $courseProgramID = $_GET['courseProgram_ID'];

    $query = "SELECT * FROM course_program WHERE courseProgram_ID = '$courseProgramID'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        $course = mysqli_fetch_assoc($result);

        // Convert the binary image data to Base64
        $imageData = base64_encode($course['img']);
        $course['img'] = $imageData;

        echo json_encode($course);
    } else {
        // Handle the case where the query fails
        http_response_code(500); // Internal Server Error
        echo json_encode(array("error" => "Failed to fetch course data"));
    }
} else {
    // Handle case where courseProgram_ID is not provided
    http_response_code(400); // Bad Request
    echo json_encode(array("error" => "courseProgram_ID not provided"));
}
?>
