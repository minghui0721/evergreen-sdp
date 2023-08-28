<?php
include '../../assets/favicon/favicon.php'; // Include the favicon.php file

?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="Feedbackstudent.css?v=<?php echo time(); ?>">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cooper+Black&display=swap">
  <script src="../../assets/js/config.js"></script> 
    <title id="documentTitle"></title>
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>

</head>
<!-- header -->
<header class="button_header">
    <div class="button">
        <a href="../../student/more.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>        </a>
        <h2>Student Directory</h2>
    </div>
</header>

<body>
  <div class="container">
    <div class="welcome-note">
      <h2>Welcome to Evergreen University's Student Feedback Page!</h2>
      <p>Your feedback is essential to improving our university and enhancing the student experience. We value your input and encourage you to share your thoughts on various aspects of your journey at Evergreen. Your feedback is anonymous and confidential, ensuring your privacy. We appreciate your contribution in shaping a better future for all students at Evergreen University!</p>
    </div>


    <form action="submit_feedback.php" method="POST">
      <h2>Feedback Form</h2>
      

      <div class="input-group">
        <h3>Overall Rating</h3>
        <div class="rating-option">
          <input type="radio" id="excellent" name="rating" value="excellent" required>
          <label for="excellent">Excellent</label>
        </div>
        <div class="rating-option">
          <input type="radio" id="good" name="rating" value="good" required>
          <label for="good">Good</label>
        </div>
        <div class="rating-option">
          <input type="radio" id="average" name="rating" value="average" required>
          <label for="average">Average</label>
        </div>
        <div class="rating-option">
          <input type="radio" id="poor" name="rating" value="poor" required>
          <label for="poor">Poor</label>
        </div>
      </div>
      

      <h3>Issues to Address</h3>
      <div class="input-group">
        <label for="issues">Please list the issues you would like to address:</label>
        <input type="text" id="issues" name="issues" required>
      </div>
      

      <h3>Suggestions for Improvement</h3>
      <div class="input-group">
        <textarea id="suggestions" name="suggestions"></textarea>
      </div>
      

      <input type="submit" value="Submit">
    </form>
  </div>
</body>
</html>



