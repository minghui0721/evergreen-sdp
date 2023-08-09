<?php
// Establish database connection
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';
$connection = mysqli_connect($host, $user, $password, $database);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $rating = $_POST["rating"];
    $issues = $_POST["issues"];
    $suggestions = $_POST["suggestions"];

    // Prepare and execute SQL query to insert data into the table
    $stmt = $connection->prepare("INSERT INTO feedback (rating, issues, suggestions) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $rating, $issues, $suggestions);
    $stmt->execute();

    // Close statement
    $stmt->close();

    // Redirect back to the feedback form page after submission
    header("Location: Feedbackstudent.php");
    exit();
}

// Close connection
$connection->close();
?>
