<!DOCTYPE html>
<html>
<head>
  <title>Evergreen University - Student Feedback</title>
  <link rel="stylesheet" type="text/css" href="Feedbackstudent.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cooper+Black&display=swap">
</head>
<body>
  <header>
    <h1>Student Feedback Form</h1>
  </header>
  
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



