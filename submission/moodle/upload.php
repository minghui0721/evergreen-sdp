<?php
$host = 'localhost';
$user = 'root';
$password = '';
$database = 'evergreen_heights_university';

$connection = mysqli_connect($host, $user, $password, $database);

if ($connection === false) {
    die('Connection failed: ' . mysqli_connect_error());

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Submission Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
  </head>
<body>
  <div class="wrapper">
    <header>Assignment Uploader</header>
    <form action="#" id="submissionForm">
      <input class="file-input" type="file" name="file" hidden >
      <i class="fas fa-cloud-upload-alt"></i>
      <p>Browse File to Upload</p>
    </form>
    <section class="progress-area">
      <div id="progressMessage" style="display: none;"></div>
    </section>
    <section class="uploaded-area"></section>
    <button type="button" id="externalSubmitBtn">Submit Assignment</button>
  </div>

  <script>
      document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("submissionForm"),
      fileInput = document.querySelector(".file-input"),
      progressArea = document.querySelector(".progress-area"),
      uploadedArea = document.querySelector(".uploaded-area"),
      externalSubmitBtn = document.getElementById("externalSubmitBtn");

    let selectedFile;
    let selectedFileName;

    form.addEventListener("click", () => {
      fileInput.click();
    });

    fileInput.onchange = ({ target }) => {
      selectedFile = target.files[0];
      if (selectedFile) {
        selectedFileName = selectedFile.name;
        if (selectedFileName.length >= 12) {
          let splitName = selectedFileName.split('.');
          selectedFileName = splitName[0].substring(0, 13) + "... ." + splitName[1];
        }
      }
    };

    externalSubmitBtn.addEventListener("click", () => {
      if (selectedFile) {
        uploadFile(selectedFile, selectedFileName);
      } else {
        console.error("Please select a file before submitting.");
      }
    });

    function uploadFile(file, name) {
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "insert_submission.php?assignment_id=<?php echo $_GET['assignment_id'];?>&subject_id=<?php echo $_GET['subject_id'];?>");

      xhr.upload.addEventListener("progress", ({ loaded, total }) => {
        let fileLoaded = Math.floor((loaded / total) * 100);
        let progressMessage = document.getElementById("progressMessage");
        progressMessage.style.display = "block";
        progressMessage.innerText = `Uploading file... ${fileLoaded}%`;
      });

      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let fileLoaded = 100;
            let progressMessage = document.getElementById("progressMessage");
            progressMessage.innerText = `Uploading file... ${fileLoaded}%`;

            setTimeout(() => {
              progressMessage.style.display = "none";
              let fileSize;
              let fileTotal = Math.floor(file.size / 1000);
              (fileTotal < 1024) ? fileSize = fileTotal + " KB" : fileSize = (file.size / (1024 * 1024)).toFixed(2) + " MB";
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
              uploadedArea.insertAdjacentHTML("afterbegin", uploadedHTML);

              setTimeout(() => {
                window.history.back();
              }, 2000);
            }, 1000);
          } else {
            console.error("File upload failed.");
          }
        }
      };

      let data = new FormData();
      data.append('file', file);
      xhr.send(data);
    }
  });
  </script> 
</body>
</html>

</script>

<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}
body{
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100vh;
  background: #5CDB95 ;
}

::selection{
  color: #fff;
  background: #6990F2;
}
.wrapper{
  width: 430px;
  background: #EDF5E1;
  border-radius: 5px;
  padding: 30px;
  box-shadow: 7px 7px 12px rgba(0,0,0,0.05);
}
.wrapper header{
  color: #05386B ;
  font-size: 27px;
  font-weight: 600;
  text-align: center;
}
.wrapper form{
  height: 167px;
  display: flex;
  cursor: pointer;
  margin: 30px 0;
  align-items: center;
  justify-content: center;
  flex-direction: column;
  border-radius: 5px;
  border: 2px dashed #379683 ;
}
form :where(i, p){
  color: #8EE4AF ;
}
form i{
  font-size: 50px;
}
form p{
  margin-top: 15px;
  font-size: 16px;
}

section .row{
  margin-bottom: 10px;
  background: #5CDB95  ;
  list-style: none;
  padding: 15px 20px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
section .row i{
  color: #05386B ;
  font-size: 30px;
}
section .details span{
  font-size: 14px;
}
.progress-area .row .content{
  width: 100%;
  margin-left: 15px;
}
.progress-area .details{
  display: flex;
  align-items: center;
  margin-bottom: 7px;
  justify-content: space-between;
}
.progress-area .content .progress-bar{
  height: 6px;
  width: 100%;
  margin-bottom: 4px;
  background: #fff;
  border-radius: 30px;
}
.content .progress-bar .progress{
  height: 100%;
  width: 0%;
  background: #6990F2;
  border-radius: inherit;
}
.uploaded-area{
  max-height: 232px;
  overflow-y: scroll;
}
.uploaded-area.onprogress{
  max-height: 150px;
}
.uploaded-area::-webkit-scrollbar{
  width: 0px;
}
.uploaded-area .row .content{
  display: flex;
  align-items: center;
}
.uploaded-area .row .details{
  display: flex;
  margin-left: 15px;
  flex-direction: column;
}
.uploaded-area .row .details .size{
  color: #404040;
  font-size: 11px;
}
.uploaded-area i.fa-check{
  font-size: 16px;
}

#externalSubmitBtn{
  border-radius: 5px;
  padding: 5px 10px;
  outline: none;
  cursor: pointer;
  font-weight: 600;
  transition: 0.5s;
  margin-top: 20px;

}

#externalSubmitBtn:hover {
    background: #093e78;
    color: beige;
}
</style>