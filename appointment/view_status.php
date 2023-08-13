<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <link rel="stylesheet" href="../assets/css/view_status.css.?v=<?php echo time(); ?>">  
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title id="documentTitle"></title>
    <script src="../assets/js/config.js"></script> 
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>
</head>
<body>
<?php include '../assets/fonts/font.html'; ?>
<div class="container fade-in">
            
            <h1>Student Appointments History</h1>

        <div class="center-container">
                <input type="text" id="searchInput" placeholder="Search by lecturer name or email...">
                <button id="filterAll">All</button>
                <button id="filterPending">Pending</button>
                <button id="filterApproved">Approved</button>
                <button id="filterRejected">Rejected</button>
        </div>


        <div id="filters">
        </div>


        <?php
        include '../database/db_connection.php';

        $studentID = 1;

        $query = "
        SELECT 
            a.appointment_date,
            a.appointment_time,
            a.status,
            IF(a.status = 'Rejected', a.reject_reason, '-') as reject_reason,
            a.lecturer_ID
        FROM
            appointment a
        WHERE
            a.student_ID = $studentID
        ";

        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            echo "<div class='tbl_header'>
        <table id='appointmentTable'>
            <tr>
                <th>Appointment Date</th>
                <th>Appointment Time</th>
                <th>Status</th>
                <th>Reject Reason</th>
                <th>Lecturer Name</th>
                <th>Lecturer Email</th>
            </tr>";

        while ($row = $result->fetch_assoc()) {
            $appointmentDate = $row['appointment_date'];
            $appointmentTime = $row['appointment_time'];
            $status = $row['status'];
            $rejectReason = $row['reject_reason'];
            $lecturerID = $row['lecturer_ID'];

            // Get lecturer details from the lecturer table
            $lecturerQuery = "SELECT lecturer_name, email FROM lecturer WHERE lecturer_ID = $lecturerID";
            $lecturerResult = $conn->query($lecturerQuery);
            $lecturerRow = $lecturerResult->fetch_assoc();

            $lecturerName = $lecturerRow['lecturer_name'];
            $lecturerEmail = $lecturerRow['email'];

            echo "<tr>";
            echo "<td>$appointmentDate</td>";
            echo "<td>$appointmentTime</td>";
            echo "<td>$status</td>";
            echo "<td>$rejectReason</td>";
            echo "<td>$lecturerName</td>";
            echo "<td>$lecturerEmail</td>";
            echo "</tr>";
        }

        echo "</table></div>";
   
        } else {
            echo "<table id='appointmentTable'>";
            echo "<tr>";
            echo "<td ># No appointments found for this student.</td>";
            echo "</tr>";
            echo "</table>";
        }

        $conn->close();
        ?>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const table = document.getElementById('appointmentTable');
        const rows = table.getElementsByTagName('tr');

        searchInput.addEventListener('input', function() {
            const searchTerm = searchInput.value.toLowerCase();

            for (let i = 1; i < rows.length; i++) { // Start from 1 to skip the header row
                const row = rows[i];
                const lecturerName = row.cells[4].textContent.toLowerCase();
                const lecturerEmail = row.cells[5].textContent.toLowerCase();

                if (lecturerName.includes(searchTerm) || lecturerEmail.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });

        // Get the filter buttons
        const filterAllButton = document.getElementById('filterAll');
        const filterPendingButton = document.getElementById('filterPending');
        const filterApprovedButton = document.getElementById('filterApproved');
        const filterRejectedButton = document.getElementById('filterRejected');

        // Get all table rows
        const tableRows = document.querySelectorAll('#appointmentTable tbody tr');

        // Add click event listeners to the filter buttons
        filterAllButton.addEventListener('click', function() {
            showAllRows();
        });

        filterPendingButton.addEventListener('click', function() {
            filterRowsByStatus('Pending');
        });

        filterApprovedButton.addEventListener('click', function() {
            filterRowsByStatus('Approved');
        });

        filterRejectedButton.addEventListener('click', function() {
            filterRowsByStatus('Rejected');
        });

        // Function to show all rows
        function showAllRows() {
            tableRows.forEach(row => {
                row.style.display = 'table-row';
            });
        }

        // Function to filter rows by status
        // Function to filter rows by status
        function filterRowsByStatus(status) {
            tableRows.forEach(row => {
                const cells = row.querySelectorAll('td');
                if (cells.length >= 3) { // Ensure there are at least 3 cells (including the status cell)
                    const rowStatus = cells[2].textContent;
                    if (rowStatus === status) {
                        row.style.display = 'table-row';
                    } else {
                        row.style.display = 'none';
                    }
                }
            });
        }


    });
</script>


</body>
</html>