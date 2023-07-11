<?php
session_start();
include '../dbConn.php';

// I created another variable to store the session value 
// Before Editing
$concern = $_SESSION['concern'];
$date = $_SESSION['date'];
$time = $_SESSION['time'];
$virtual = $_SESSION['virtual'];
$id= $_SESSION['id'];


// After Editing and Click Submit - data Will be inserted into database
if(isset($_POST['btnSubmit'])){
    $service = $_POST['service'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $remarks = $_POST['concern'];


    // Query To Create Appointment
    $query = "INSERT INTO `appointment` (`patient_id`, `services`, `appointment_date`, `appointment_time`, `messages`, `appointment_status` ) VALUES ('$id','$service','$date','$time', '$remarks', 'Pending')";

    // Run
    if(mysqli_query($connection, $query)){
        echo "<script>alert('Appointment successfully created! We will contact you as soon as possible!'); setTimeout(function() {window.location.href='../home_user/home_login.php';}, 0);</script>";
    }

}

mysqli_close($connection);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Info</title>
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <link rel="stylesheet" href="confirm.css?v=<?php echo time(); ?>.css">
</head>
<body>
    <div id="container">

        <div id="header">
            <img src="../logo.png" alt="logo">
            <h2>Please review your request before submitting.</h2>
            <h3>Make sure all the info is correct</h3>
        </div>
        
        
        
        <!-- THE INFO -->
        <form method="post" id="confirm_form">
            <div id="info">
                <div id="appointment">
                    <h2>Appointment</h2>
                    <h3>Service</h3>
                    <label>
                        <input type="radio" name="service" value="Virtual Consultation" <?php if($virtual == "Virtual Consultation") echo "checked"; ?> required>Virtual Consultation
                    </label>
                    
                    <label>
                        <input type="radio" name="service" value="Ophthalmology" <?php if($virtual == "Ophthalmology") echo "checked"; ?> required>Ophthalmology
                    </label>
                    
                    <label>
                        <input type="radio" name="service" value="Orthopedics" <?php if($virtual == "Orthopedics") echo "checked"; ?> required>Orthopedics
                    </label>

                    <label>
                        <input type="radio" name="service" value="Urology" <?php if($virtual == "Urology") echo "checked"; ?> required>Urology
                    </label>
                    
                    <h3>Medical Concern</h3>
                    <input type="text" id="concern" name="concern" value="<?php echo $concern?>" require>
        
                    <h3>Appointment Date</h3>
                    <input type="date" name="date" id="confirm_date" value="<?php echo $date?>">

        
                    <h3>Appointment Time</h3>
                    <input type="time" name="time" id="confirm_time" value="<?php echo $time?>">
                </div>
            </div>
            <div id="info2">            
                    <!-- Check box -->
                    <div id="rules">
                        <input type="checkbox" name="confirm" id="confirm" required>
                        I' ve read and confirmed the informationas
                    </div>
                    <!-- Submit Button -->
                    <input type="submit" name="btnSubmit" value="Submit your request">
            </div>
        </form>

    </div>

</body>
</html>