<?php
include '../database/db_connection.php';

$lecturerID = 1; 

$sql = "
    SELECT * 
    FROM appointment_set AS a_set 
    WHERE a_set.lecturer_ID = $lecturerID 
    AND a_set.appointment_date >= CURDATE()
";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/select_appointment.css.?v=<?php echo time(); ?>">  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title id="documentTitle"></title>
    <script src="../assets/js/config.js"></script> 
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/font.html'; ?>
<form action="book_appointment.php" method="post">
    
<h1>Make Appointment</h1>
<div class="slot-container">
    
<?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $startTime = new DateTime($row['start_time']);
            $endTime = new DateTime($row['end_time']);
            $interval = new DateInterval('PT30M');
            
            $slotAvailable = false;  // Flag to check if any slot is available for current appointment set

            while ($startTime < $endTime) {
                $potentialTime = $startTime->format('H:i:s');
                $endSlotTime = $startTime->add($interval)->format('H:i:s'); // This represents the end of the current 30-minute slot
                $uniqueID = $row['appointmentSet_ID'] . '-' . str_replace(':', '', $potentialTime);

                $checkSlotSql = "
                    SELECT COUNT(*) as count
                    FROM appointment
                    WHERE lecturer_ID = $lecturerID
                    AND appointment_date = '{$row['appointment_date']}'
                    AND appointment_time = '$potentialTime'
                ";
                $checkResult = $conn->query($checkSlotSql);
                $slotTakenCount = $checkResult->fetch_assoc()['count'];

                if ($slotTakenCount == 0) {
                    $slotAvailable = true;  // At least one slot is available
                    echo '<div class="slot">';
                    echo '<input type="radio" id="slot-' . $uniqueID . '" name="appointment_slot" value="' . $row['appointmentSet_ID'] . ',' . $potentialTime . '">';
                    echo '<label for="slot-' . $uniqueID . '">';
                    echo '<span>' . $row['appointment_date'] . '</span><br><br>';
                    echo '<span>' . $potentialTime . ' - ' . $endSlotTime . '</span><br><br>';
                    echo '<span>Platform: ' . $row['platform'] . '</span>';
                    echo '</label>';
                    echo '</div>';
                }   

            }
            break;

            if (!$slotAvailable) {
                echo '<div class="slot no-slot">No Available Slot</div>';
            }
        }
    } else {
        echo "No available appointments";
    }
    ?>

</div>




<input type="submit" value="Book Appointment" class="btn">  
</form>

<script>
    let previouslyChecked;

document.addEventListener("DOMContentLoaded", function() {
    const radioButtons = document.querySelectorAll('input[type="radio"]');

    radioButtons.forEach(radio => {
        radio.addEventListener('click', function() {
            if (previouslyChecked == this) {
                this.checked = false;
                previouslyChecked = null;
            } else {
                previouslyChecked = this;
            }
        });
    });
});

</script>
</body>
</html>