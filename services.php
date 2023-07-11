<!-- PHP -->
<?php
// Starts the session
session_start();

// Connect to the database connection
include '../dbConn.php';

// If user clicked on the select button
if(isset($_POST['btnVirtual'])){
    // Retrieve the value of the selected button (virtual / ophthalmology / orthopedics / urology)
    $_SESSION['virtual']=$_POST['btnVirtual'];
    // Redirects the users to the appointment3.php page
    header("location:appointment3.php");
}

// If user clicked on the select button
if(isset($_POST['btnOphthalmology'])){
    // Retrieve the value of the selected button (virtual / ophthalmology / orthopedics / urology)
    $_SESSION['virtual']=$_POST['btnOphthalmology'];
    header("location:appointment3.php");
}

// If user clicked on the select button
if(isset($_POST['btnOrthopedics'])){
    // Retrieve the value of the selected button (virtual / ophthalmology / orthopedics / urology)
    $_SESSION['virtual']=$_POST['btnOrthopedics'];
    header("location:appointment3.php");
}

// If user clicked on the select button
if(isset($_POST['btnUrology'])){
    // Retrieve the value of the selected button (virtual / ophthalmology / orthopedics / urology)
    $_SESSION['virtual']=$_POST['btnUrology'];
    header("location:appointment3.php");
    mysqli_close($connection);
}

?>




<!-- Let the User to choose the service -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services</title>
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <link rel="stylesheet" href="services.css?v=<?php echo time(); ?>.css">
</head>
<body>
    <div id="container">
        <div id="title">
            <h2>Choose Your Service</h2>
        </div>

        <form action="#" method="post">
            <div id="wrapper">
                <div id="content1">
                    <!-- Image -->
                    <img src="virtual_consultation.png" alt="geriatric">
                    <!-- Header -->
                    <h2>Virtual Consultation</h2>
                    <!-- Select Button -->
                    <!-- The purpose of the "name" attribute is to identify the button on the server-side -->
                    <!-- The purpose of the "value" attribute is to specify the value that should be sent to the server when the button is clicked. -->
                    <button type="submit" name="btnVirtual" value="Virtual Consultation">Select</button>
                    
                </div>

                <div id="content2">
                    <img src="ophthalmology.jpg" alt="ophthalmology">
                    <h2>Ophthalmology</h2>
                    <button type="submit" name="btnOphthalmology" value="Ophthalmology">Select</button>
                </div>
        
                <div id="content3">
                    <img src="orthopedics.jpg" alt="orthopedics">
                    <h2>Orthopedics</h2>
                    <button type="submit" name="btnOrthopedics" value="Orthopedics">Select</button>
                </div>
        
                <div id="content4">
                    <img src="urology.jpg" alt="urology">
                    <h2>Urology</h2>
                    <button type="submit" name="btnUrology" value="Urology">Select</button>
                    
                </div>
            </div>
        </form>

        <div id="button">
            <a href="appointment2.php"><p id="back">Back</p></a>
        </div>
    </div>
</body>
</html>