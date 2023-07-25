<?php
// Check if the file is uploaded via POST request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["file"]) && $_FILES["file"]["error"] === 0) {
  // Configuration for database connection
  $host = "localhost";
  $username = "root";
  $password = "";
  $database = "	evergreen_heights_university";

  try {
    // Connect to the database using PDO
    $pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Process the uploaded file
    $file = $_FILES["file"];
    $fileName = $file["name"];
    $fileTmpName = $file["tmp_name"];
  
    // Add additional checks for file validation if required

    // Prepare and execute the SQL query to insert the file details into the database
    $sql = "INSERT INTO files (name, size, type, content) VALUES (:name, :size, :type, :content)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(":name", $fileName);
    $stmt->bindParam(":size", $fileSize);
    $stmt->bindParam(":type", $fileType);
    $stmt->bindParam(":content", file_get_contents($fileTmpName));
    $stmt->execute();

    echo "File uploaded and saved to the database successfully!";
  } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
  }
} else {
  echo "Error: File not uploaded or invalid request.";
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submission Page</title>
  <link rel="stylesheet" href="submission.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
<body>
  <div class="wrapper">
    <header>Assignment Uploader</header>
    <form action="#">
      <input class="file-input" type="file" name="file" hidden>
      <i class="fas fa-cloud-upload-alt"></i>
      <p>Browse File to Upload</p>
    </form>
    <section class="progress-area">
      <!-- Progress bar will be added dynamically here -->
    </section>
    <section class="uploaded-area"></section>
    <button type="button" id="submit-button" style="display: none;">Submit</button>
  </div>

  <!-- JavaScript code remains the same -->
</body>
</html>


<script>
    const form = document.querySelector("form"),
      fileInput = document.querySelector(".file-input"),
      progressArea = document.querySelector(".progress-area"),
      uploadedArea = document.querySelector(".uploaded-area"),
      submitButton = document.getElementById("submit-button");
  
    // Handle click event on the interface
    form.addEventListener("click", (event) => {
      if (event.target !== submitButton) {
        fileInput.click();
      }
    });
  
    fileInput.addEventListener("change", ({ target }) => {
      const file = target.files[0];
      if (file) {
        let fileName = file.name;
        if (fileName.length >= 12) {
          let splitName = fileName.split(".");
          fileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
        }
        uploadFile(fileName);
      } else {
        progressArea.innerHTML = ""; // Clear progress bar if no file selected
        submitButton.style.display = "none";
      }
    });
  
    function uploadFile(name) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "php/upload.php");
      xhr.upload.addEventListener("progress", ({ loaded, total }) => {
        let fileLoaded = Math.floor((loaded / total) * 100);
        let fileTotal = Math.floor(total / 1000);
        let fileSize;
        fileTotal < 1024
          ? (fileSize = fileTotal + " KB")
          : (fileSize = (loaded / (1024 * 1024)).toFixed(2) + " MB");
        let progressHTML = `<li class="row">
                            <i class="fas fa-file-alt"></i>
                            <div class="content">
                              <div class="details">
                                <span class="name">${name} • Uploading</span>
                                <span class="percent">${fileLoaded}%</span>
                              </div>
                              <div class="progress-bar">
                                <div class="progress" style="width: ${fileLoaded}%"></div>
                              </div>
                            </div>
                          </li>`;
        uploadedArea.classList.add("onprogress");
        progressArea.innerHTML = progressHTML;
        if (loaded == total) {
          let uploadedHTML = `<li class="row">
                              <div class="content upload">
                                <i class="fas fa-file-alt"></i>
                                <div class="details">
                                  <span class="name">${name} • Uploaded</span>
                                  <span class="size">${fileSize}</span>
                                </div>
                              </div>
                              <i class="fas fa-check"></i>
                            </li>`;
          uploadedArea.classList.remove("onprogress");
          uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);
          progressArea.innerHTML = ""; // Remove progress bar after upload
          fileInput.value = ""; // Clear file input value after upload
          submitButton.style.display = "block"; // Show the submit button
        }
      });
      let data = new FormData(form);
      xhr.send(data);
    }
  </script>
  
  

