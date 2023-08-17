<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the search input from the form
    $searchInput = $_POST["searchInput"];

    // Mapping of search values to URLs
    $searchOptions = array(
        "About Evergreen" => "about.php",
        "Read Articles" => "articles.php",
        "Contact Us" => "contact_us.php",
        "School Event" => "event.php",
        "Academics" => "academic.php",
        "Enrollment" => "../enrollment.php"
    );

    // Check if the search input matches a value in the mapping
    if (isset($searchOptions[$searchInput])) {
        // Redirect to the specified page
        $targetPage = $searchOptions[$searchInput];
        header("Location: $targetPage");
        exit;
    } else {
        // No matching value found, handle as needed
        echo "<script>alert('No matching result found.'); window.history.back();</script>";
        exit;
    }
}
?>
