<!-- Medical Concerns 2 -->

<?php
session_start();

// Continue
if(isset($_POST['btnConcern'])){
    // Retrieve the value of the selected button (virtual / ophthalmology / orthopedics / urology)
    $_SESSION['concern']=$_POST['medical_concern'];
    header("location:appointment5.php");
}


// Back
if(isset($_POST['btnBack'])){
    // Retrieve the value of the selected button (virtual / ophthalmology / orthopedics / urology)
    header("location:appointment3.php");
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medical Concerns</title>
    <link rel="stylesheet" href="appointment4.css?v=<?php echo time(); ?>.css">
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
</head>
<body>
    <div class="header">
        <img src="../logo.png" alt="logo">
    </div>

    <div class="container">

        <!-- Content in left side - Title -->
        <div class="content1">
            <h2>Please tell us your primary medical concern.</h2>
            <p>This will help us learn about how we can help.</p>
        </div>

        <!-- A vertical Line -->
        <div class="divider"></div>

        <!-- Content in right side - Input -->
        <div class="content2">
            <form action="" method="POST">
                <textarea name="medical_concern" maxlength="300" placeholder="Desribe your medical concern in 300 characters or less." required></textarea>
        </div>
        
    </div>


    <div id="container2">

        <!-- A Back Button -->
        <div class="button">
            <button name="btnBack">Back</button>
        </div>

        <!-- A Continue Button -->
        <div class="button">
            <button name="btnConcern">Continue</button>
        </div>
            </form>

    </div>


</body>
</html>