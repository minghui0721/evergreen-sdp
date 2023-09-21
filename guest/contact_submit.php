<?php
include '../database/db_connection.php';

// POST Method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Use prepared statement to insert data
    $sql = "INSERT INTO contact_us (first_name, last_name, email, phone, message) VALUES (?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $message);

    if ($stmt->execute()) {
        // Submission successful
        echo '<script>alert("Form submitted successfully!"); window.location.href = "contact_us.php";</script>';
    } else {
        // Error occurred during submission
        echo '<script>alert("An error occurred. Please try again later.");</script>';
    }

    $stmt->close();
    $conn->close();
}
?>
