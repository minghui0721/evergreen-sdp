<?php
include '../../../assets/favicon/favicon.php'; // Include the favicon.php file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="main.css?v=<?php echo time(); ?>">
   <script src="../../../assets/js/config.js"></script>
   <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">
   <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName; 
    </script>
</head>
<body>
    <div class="login-container">
        <h2>Login As</h2>
        <div class="icon-container">
            <a href="../student/login.php">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="85px" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#f1f4f8}</style><path d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464H398.7c-8.9-63.3-63.3-112-129-112H178.3c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304h91.4C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7H29.7C13.3 512 0 498.7 0 482.3z"/></svg>            
                    <p>Student</p>
                </div>
            </a>
            <a href="../lecturer/LecturerLogin.php">
                <div class="icon-box">
                    <svg xmlns="http://www.w3.org/2000/svg" height="85px" viewBox="0 0 640 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><style>svg{fill:#e0e2e6}</style><path d="M160 64c0-35.3 28.7-64 64-64H576c35.3 0 64 28.7 64 64V352c0 35.3-28.7 64-64 64H336.8c-11.8-25.5-29.9-47.5-52.4-64H384V320c0-17.7 14.3-32 32-32h64c17.7 0 32 14.3 32 32v32h64V64L224 64v49.1C205.2 102.2 183.3 96 160 96V64zm0 64a96 96 0 1 1 0 192 96 96 0 1 1 0-192zM133.3 352h53.3C260.3 352 320 411.7 320 485.3c0 14.7-11.9 26.7-26.7 26.7H26.7C11.9 512 0 500.1 0 485.3C0 411.7 59.7 352 133.3 352z"/></svg>            
                    <p>Lecturer</p>
                </div>
            </a>
        </div>
    </div>
</body>
</html>

