<!-- Date & Time -->
<?php
session_start();

if(isset($_POST['btnContinue'])){
    // dateFormat: "Y-m-d H:i",
    $_SESSION['date-time']=$_POST['picker'];

    // uses the explode() function to split the value into two separate parts at the space character (represented by " ").
    // And assign the split value to the variables
    list($appointment_date, $appointment_time) = explode(" ",$_SESSION['date-time']);

    // Stores the value of $appointment_date and time to the session
    $_SESSION['date'] = $appointment_date;
    $_SESSION['time'] = $appointment_time;
    header("location:confirm.php");
}


if(isset($_POST['btnBack'])){
    header("location:appointment4.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date & Time</title>
    <link rel="stylesheet" href="appointment5.css?v=<?php echo time(); ?>.css">
    <link rel="shortcut icon" href="../logo.png" type="image/x-icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
<body>
    <div class="header">
        <img src="../logo.png" alt="logo">
    </div>

    <form action="" method="post" id="appointment_form">
        <div class="container">
            
            <!-- Content in left side - Title and Input -->
            <div class="content1">
                <h2>Please choose your desired date and time.</h2>
                <p>This will be used to schedule your appointment.</p>
                
                <div class="picker">
                    <input type="text" name="picker" id="appointment_date" placeholder="Select appointment date and time" required>
                </div>
            </div>
            
        </div>


        <div id="container2">

            <!-- A Back Button -->
            <div class="button">
                <button name="btnBack">Back</button>
            </div>

            <!-- A Continue Button -->
            <div class="button">
                <button name="btnContinue">Continue</button>
            </div>

        </div>
    </form>

    <script>

        // Using Event listener
        // Declare a constant variable and assigns it to the form element with an ID - This is used to access the form element later in the code.
        const appointmentForm = document.getElementById('appointment_form');

        // Access the input element
        const appointmentDate = document.getElementById('appointment_date');

        // Using flatpickr library to create a date and time picker widget
        // Declare a constant variable and initializes a new instance
        // The appointment date will be the target
        const flatpickrInstance = flatpickr("#appointment_date", {

            // enables the time picker component of the widget.
            enableTime: true,

            // sets the minimum selectable date to the current date.
            minDate: "today",

            // the format
            dateFormat: "Y-m-d H:i",
        });
        
        
        appointmentForm.addEventListener('submit', function(event) {
            //if has a length of zero
            if (!flatpickrInstance.selectedDates.length) {
                //  to prevent the form from being submitted,
                event.preventDefault();
                alert('Please select an appointment date and time.');
            }
        });
    </script>

</body>
</html>