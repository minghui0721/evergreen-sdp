<?php

include '../database/db_connection.php';


$query = "
SELECT 
    a.student_ID,
    s.student_name,
    cp.course_name,
    cp.program_name,
    i.intake,
    a.appointment_date,
    a.appointment_time
FROM
    appointment a
JOIN student s ON a.student_ID = s.student_ID
JOIN intake i ON s.intake_ID = i.intake_ID
JOIN course_program cp ON i.courseProgram_ID = cp.courseProgram_ID
WHERE
    a.lecturer_ID = 1 AND a.status = 'Pending'
";

$result = $conn->query($query);


$appointmentSql = "SELECT * FROM appointment_set WHERE lecturer_ID = 1";
$appointmentResult = mysqli_query($conn, $appointmentSql);
$appointmentRow = mysqli_fetch_assoc($appointmentResult);

$appointmentSet_ID = $appointmentRow['appointmentSet_ID'];
$lecturer_ID = $appointmentRow['lecturer_ID'];
$appointmentDate = $appointmentRow['appointment_date'];
$start = $appointmentRow['start_time'];
$end = $appointmentRow['end_time'];
$platform = $appointmentRow['platform'];

function generateTimeSlots($start, $end) {
    $startTime = new DateTime($start);
    $endTime = new DateTime($end);
    $interval = new DateInterval('PT30M'); // 30-minute interval

    $timeSlots = [];

    while ($startTime < $endTime) {
        $nextPeriod = clone $startTime;
        $nextPeriod->add($interval);
        $timeSlots[] = $startTime->format('H:i') . '-' . $nextPeriod->format('H:i');
        $startTime->add($interval);
    }

    return $timeSlots;
}

$slots = generateTimeSlots($start, $end);

$takenAppointments = [];
$appointmentDetails = [];
$appointmentCheckQuery = "
    SELECT a.appointment_time, a.student_ID, TIME_FORMAT(a.appointment_time, '%H:%i') as formatted_time
    FROM appointment a
    WHERE a.lecturer_ID = 1 
    AND a.appointment_date = '$appointmentDate' AND a.status = 'Approved'
";

$checkResult = $conn->query($appointmentCheckQuery);
if ($checkResult->num_rows > 0) {
    while ($checkRow = $checkResult->fetch_assoc()) {
        $takenAppointments[] = $checkRow['formatted_time'];
        $appointmentDetails[$checkRow['formatted_time']] = $checkRow['student_ID'];
    }
}

$appointmentDetailsArray = []; // Initialize the array

foreach ($takenAppointments as $appointmentTime) {
    $studentID = $appointmentDetails[$appointmentTime];

    // Fetch student details
    $studentQuery = "SELECT * FROM student WHERE student_ID = $studentID";
    $studentResult = $conn->query($studentQuery);
    $studentRow = $studentResult->fetch_assoc();

    $intakeID = $studentRow['intake_ID'];

    // Fetch intake details
    $intakeQuery = "SELECT * FROM intake WHERE intake_ID = $intakeID";
    $intakeResult = $conn->query($intakeQuery);
    $intakeRow = $intakeResult->fetch_assoc();

    $courseProgramID = $intakeRow['courseProgram_ID'];

    // Fetch course and program details
    $courseProgramQuery = "SELECT cp.course_name, cp.program_name FROM course_program cp WHERE cp.courseProgram_ID = $courseProgramID";
    $courseProgramResult = $conn->query($courseProgramQuery);
    $courseProgramRow = $courseProgramResult->fetch_assoc();

    $studentName = $studentRow['student_name'];
    $email = $studentRow['email'];
    $courseName = $courseProgramRow['course_name'];
    $programName = $courseProgramRow['program_name'];
    $intake = $intakeRow['intake'];

    // Store the details in the appointmentDetailsArray
    $appointmentDetailsArray[$appointmentTime] = [
        "studentName" => $studentName,
        "email" => $email,
        "courseName" => $courseName,
        "programName" => $programName,
        "intake" => $intake
    ];
}

$appointmentDetailsArrayJSON = json_encode($appointmentDetailsArray);
echo "<div id='appointment-details-array' data-array='$appointmentDetailsArrayJSON'></div>";

// retrieve current date
$currentDate = date("Y-m-d");
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../assets/js/config.js"></script>
    <link rel="shortcut icon" href="../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/appointment.css.?v=<?php echo time(); ?>">  
    <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/font.html'; ?>

<div class="all">
    <div class="appointment_set">
            <div class="header">
                <h1>Appointment Slots</h1>
            </div>

            <div class="options">
                <button id="setButton" class="selected">SET</button>
                <button id="detailsButton">DETAILS</button>
            </div>

            <div id="setSection" class="set-section">
                <form id="appointment-form" action="save_appointment.php" method="post">
                    <label for="appointment-date">Appointment Date:</label>
                    <input type="date" id="appointment-date" name="appointment-date" min="<?php echo $currentDate; ?>" required value="<?php echo $appointmentDate; ?>">

                    <label for="start-time">Start Time:</label>
                    <input type="time" id="start-time" name="start-time" required value="<?php echo $start; ?>">
                    
                    <label for="end-time">End Time:</label>
                    <input type="time" id="end-time" name="end-time" required value="<?php echo $end; ?>">
                    
                    <label for="platform">Platform:</label>
                    <select id="platform" name="platform" required>
                        <option value="" selected disabled>Select a platform</option>
                        <option value="Online" <?php if ($platform == 'Online') echo 'selected'; ?>>Online</option>
                        <option value="Physical" <?php if ($platform == 'Physical') echo 'selected'; ?>>Physical</option>
                    </select>



                    <input type="hidden" id="appointmentSetID" name="appointmentSetID" value="<?php echo $appointmentSet_ID; ?>">
                    <button type="submit">Save Appointment Details</button>
                </form>
            </div>
            <div id="detailsSection" class="details-section" style="display: none;">
            <?php 
                $counter = 1;
                foreach ($slots as $slot) {
                    // Split slot into start and end times for comparison
                    // list() function is used to assign values to a list of variables in one operation. 
                    list($slotStart, $slotEnd) = explode('-', $slot);
                    $isTaken = in_array($slotStart, $takenAppointments); // Check if slot start time is in the taken appointments list

                    $color = $isTaken ? "red" : "#4CAF50"; // Color red if taken, otherwise green
                    if ($isTaken) {
                        echo "<div class='slot tooltip clickable-slot' style='background-color: red;' 
                                data-appointment-date='{$appointmentDate}' 
                                data-start-time='{$slotStart}' 
                                data-platform='{$platform}'>";

                        echo "<span class='tooltiptext'>Appointment is booked</span>";
                    } else {
                        echo "<div class='slot tooltip' style='background-color: #4CAF50;'>";
                    }
                    
                    echo "Slot {$counter} --> Date: {$appointmentDate} ({$slot}) on {$platform}</div>";
                    $counter++;
                }
            ?>
            </div>

            <div id="myModal" class="modal">
                <div class="modal-content">
                    <span class="close">&times;</span>
                    <p></p>
                </div>
            </div>


    </div>


    <div class="appointment_request">
        <h1>Appointment Requests</h1>
        <table border="1">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Student Name</th>
                    <th>Course Name</th>
                    <th>Program Name</th>
                    <th>Intake</th>
                    <th>Appointment Date</th>
                    <th>Appointment Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php 
            if ($result->num_rows === 0) {
                echo "<tr><td colspan='8' class='no-records'># No Appointment Request Now</td></tr>";
            } else {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no++ . "</td>";
                    echo "<td>" . $row['student_name'] . "</td>";
                    echo "<td>" . $row['course_name'] . "</td>";
                    echo "<td>" . $row['program_name'] . "</td>";
                    echo "<td>" . $row['intake'] . "</td>";
                    echo "<td>" . $row['appointment_date'] . "</td>";
                    echo "<td>" . $row['appointment_time'] . "</td>";
                    echo "<td>
                        <button class='approve-btn' data-id='" . $row['student_ID'] ."' data-appointment-time='" . $row['appointment_time'] . "'>Approve</button>

                        <button class='reject-btn' data-id='" . $row['student_ID'] . "'>Reject</button>

                        <div class='reason-input' style='display: none;'>
                            <input type='text' class='reason-text' placeholder='Enter reason'>
                            <button class='submit-reason-btn' data-appointment-time='" . $row['appointment_time'] ."' data-id='" . $row['student_ID'] . "'>Submit</button>
                        </div>
                    </td>";
                }
            }
            ?>
        </tbody>

        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let approveButtons = document.querySelectorAll('.approve-btn');
        
        approveButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                let studentId = button.getAttribute('data-id');
                let appointmentTime = button.getAttribute('data-appointment-time');

                
                // Use AJAX to send a request to the backend
                fetch('update_status.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ studentId: studentId, status: "Approved", action: "approve", startTime: appointmentTime }) // Send studentId, status, and startTime as JSON
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Status updated successfully!');
                        
                        // Refresh the page
                        location.reload();
                    } else {
                        alert('Error updating status.');
                    }
                });
            });
        });
    });


    document.addEventListener('DOMContentLoaded', function() {
    let rejectButtons = document.querySelectorAll('.reject-btn');
    
    rejectButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            let studentId = button.getAttribute('data-id');
            let reasonInput = button.nextElementSibling;

            reasonInput.style.display = 'block';
        });
    });

    let submitReasonButtons = document.querySelectorAll('.submit-reason-btn');
    
    submitReasonButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            let studentId = button.getAttribute('data-id');
            let appointmentTime = button.getAttribute('data-appointment-time');
            let reasonInput = button.previousElementSibling;
            let reason = reasonInput.value.trim();

            if (reason === '') {
                alert('Please enter a reason.');
                return;
            }

            // Use AJAX to send a request to the backend
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ studentId: studentId, status: "Rejected", reason: reason, action: "reject", startTime: appointmentTime }) // Send studentId, status, and reason as JSON
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    alert('Status updated successfully!');
                    
                    // Refresh the page
                    location.reload();
                } else {
                    alert('Error updating status: ' + (data.message || 'Unknown error.'));
                }
            })
            .catch(error => {
                alert('There was a problem with the fetch operation: ' + error.message);
            });
        });
    });
});


// Create Appointment Slots
document.addEventListener('DOMContentLoaded', function() {
            const setButton = document.getElementById('setButton');
            const detailsButton = document.getElementById('detailsButton');
            const setSection = document.getElementById('setSection');
            const detailsSection = document.getElementById('detailsSection');

            setButton.addEventListener('click', function() {
                setSection.style.display = 'block';
                detailsSection.style.display = 'none';
                setButton.classList.add('selected');
                detailsButton.classList.remove('selected');
            });

            detailsButton.addEventListener('click', function() {
                detailsSection.style.display = 'block';
                setSection.style.display = 'none';
                detailsButton.classList.add('selected');
                setButton.classList.remove('selected');
            });

            const appointmentForm = document.getElementById('appointment-form');
            const appointmentSetIDField = document.getElementById('appointmentSetID');

            appointmentForm.addEventListener('submit', function(event) {
                event.preventDefault();

                const formData = new FormData(appointmentForm);

                if (appointmentSetIDField.value === '') {
                    // If no appointmentSet_ID, create a new record
                    fetch('save_appointment.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Appointment details saved successfully!');
                            // Refresh the page or update the UI as needed

                            location.reload();
                        } else {
                            alert('Error saving appointment details.');
                        }
                    })
                    .catch(error => {
                        alert('There was a problem with the fetch operation: ' + error.message);
                    });
                } else {
                    // If appointmentSet_ID exists, update the record
                    // Get the date and time values from the form
                    const appointmentDate = formData.get('appointment-date');
                    const startTime = formData.get('start-time');
                    const endTime = formData.get('end-time');
                    const platform = formData.get('platform');

                    // Construct the data object to send in the fetch request
                    const dataToSend = {
                        'appointment-date': appointmentDate,
                        'start-time': startTime,
                        'end-time': endTime,
                        'platform': platform
                    };


                    fetch('update_appointment.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(dataToSend)
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            alert('Appointment details updated successfully!');
                            location.reload();
                        } else {
                            alert('Error updating appointment details.');
                        }
                    })
                    .catch(error => {
                        alert('There was a problem with the fetch operation: ' + error.message);
                    });
                }
            });
    });


    document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('myModal');
    const close = document.querySelector('.close');
    const clickableSlots = document.querySelectorAll('.clickable-slot');

    const appointmentDetailsArrayJSON = document.getElementById('appointment-details-array').getAttribute('data-array');
    const appointmentDetailsArray = JSON.parse(appointmentDetailsArrayJSON);


    clickableSlots.forEach(function(slot) {
        slot.addEventListener("click", function() {
            const appointmentDate = this.getAttribute('data-appointment-date');
            const startTime = this.getAttribute('data-start-time');
            const [startHour, startMinute] = startTime.split(':').map(Number);

            let endHour = startHour;
            let endMinute = startMinute + 30;

            if (endMinute >= 60) {
                endHour += 1;
                endMinute -= 60;
            }

            const formattedEndTime = `${endHour.toString().padStart(2, '0')}:${endMinute.toString().padStart(2, '0')}`;

            const platform = this.getAttribute('data-platform');            
            
            // Retrieve student details from the appointmentDetailsArray using startTime
            const studentDetails = appointmentDetailsArray[startTime];
           
            if (studentDetails) {
            const studentName = studentDetails.studentName;
            const email = studentDetails.email;
            const courseName = studentDetails.courseName;
            const programName = studentDetails.programName;
            const intake = studentDetails.intake;

            const appointmentDetails = `
                <div class="appointment-details">
                    <h2>Appointment Details</h2>
                    <p><strong>Student:</strong> ${studentName}</p>
                    <p><strong>Email:</strong> ${email}</p>
                    <p><strong>Course:</strong> ${courseName}</p>
                    <p><strong>Program:</strong> ${programName}</p>
                    <p><strong>Intake:</strong> ${intake}</p>
                </div>
                <div class="appointment-datetime">  
                    <hr>
                    <p><strong>Date:</strong> ${appointmentDate}</p>
                    <p><strong>Time:</strong> ${startTime} - ${formattedEndTime}</p>
                    <p><strong>Platform:</strong> ${platform}</p>
                </div>
            `;

            modal.querySelector(".modal-content p").innerHTML = appointmentDetails;

            modal.style.display = "block";
        } else {
            console.log(`No student details found for startTime: ${startTime}`);
        }
        });
    });

    close.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
});


</script>
    
</body>
</html>