<!-- school name -->
<!-- address -->
    <!-- 1.city -->
    <!-- 2.state -->
    <!-- 3.country -->
<!-- phone -->
<!-- email -->

<?php

include 'db_connection.php';
include "../Admin_header/AdminHeader.php";


$sql = "SELECT * FROM school_info LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$schoolName = $row['school_name'];
$address = $row['address'];
$phone = $row['phone'];
$email = $row['email'];
$normalOpen = $row['normal_open'];
$normalClose = $row['normal_close'];
$summerOpen = $row['summer_open'];
$summerClose = $row['summer_close'];


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="school_info.css?v=<?php echo time(); ?>"> <!-- Include your CSS file -->
    <link rel="shortcut icon" href="../../assets/images/evergreen-background.jpeg" type="image/x-icon">
    <title id="documentTitle">Edit School Information</title>
    <script src="../assets/js/config.js"></script> 
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    </script>

<style>
    .InformationManagement{
        display: block;
    }

    .InformationManagement .EditSchoolInfo{
        color: #5c5adb;
    }
</style>

</head>
<body>
<?php include '../../assets/fonts/font.html'; ?>

<div class="wrapper">
    <form id="schoolInfoForm">
        <h1>Edit School General Information</h1>

        <label for="school_name">School Name:</label>
        <input type="text" id="school_name" name="school_name" pattern="^[a-zA-Z\s]+$" title="Please enter alphabets and spaces only." value="<?php echo htmlspecialchars($schoolName); ?>" data-original-value="<?php echo htmlspecialchars($schoolName); ?>" required>

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($address); ?>" data-original-value="<?php echo htmlspecialchars($address); ?>" required>

        <label for="phone">Phone:</label>
        <input type="text" id="phone" name="phone"pattern="^\+?(\d-?){10}$" title="Please enter a valid phone number." value="<?php echo htmlspecialchars($phone); ?>" data-original-value="<?php echo htmlspecialchars($phone); ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" data-original-value="<?php echo htmlspecialchars($email); ?>" required>

        <label for="normal_open">Normal Operation:</label>
        <input type="time" id="normal_open" name="normal_open" value="<?php echo htmlspecialchars($normalOpen); ?>" data-original-value="<?php echo htmlspecialchars($normalOpen); ?>" max="11:59" required> -
        <input type="time" id="normal_close" name="normal_close" value="<?php echo htmlspecialchars($normalClose); ?>" data-original-value="<?php echo htmlspecialchars($normalClose); ?>" min="12:00" required>

        <label for="summer_open">Summer Operation:</label>
        <input type="time" id="summer_open" name="summer_open" value="<?php echo htmlspecialchars($summerOpen); ?>" data-original-value="<?php echo htmlspecialchars($summerOpen); ?>" max="11:59" required> -
        <input type="time" id="summer_close" name="summer_close" value="<?php echo htmlspecialchars($summerClose); ?>" data-original-value="<?php echo htmlspecialchars($summerClose); ?>" min="12:00" required>


        <input type="submit" value="Save">
    </form>

    <script>

        // This script ensures only numbers can be edited in the time input fields
        const timeInputs = ['normal_open', 'normal_close', 'summer_open', 'summer_close'];

        timeInputs.forEach(id => {
            const input = document.getElementById(id);
            input.addEventListener('keydown', function(e) {
                const key = e.keyCode || e.which;
                const allowedKeys = [8, 37, 39, 46]; // backspace, left arrow, right arrow, delete
                const numberKeys = (key >= 48 && key <= 57) || (key >= 96 && key <= 105); // numbers

                if (!numberKeys && !allowedKeys.includes(key)) {
                    e.preventDefault();
                    return;
                }

                if (numberKeys) {
                    let selectionStart = this.selectionStart;
                    while ([2, 5, 8, 11, 14].includes(selectionStart)) {
                        selectionStart++;
                    }
                    if (selectionStart > 16) return;
                    this.setSelectionRange(selectionStart, selectionStart + 1);
                }
            });

            input.addEventListener('input', function() {
                if (!/^\d{2}:\d{2}:\d{2} - \d{2}:\d{2}:\d{2}$/.test(input.value)) {
                    input.value = input.value.replace(/[^0-9: -]/g, '');
                }
            });
        });

        const ids = ['school_name', 'address', 'phone', 'email'];

        ids.forEach(id => {
            document.getElementById(id).addEventListener('input', function() {
                if (this.value.startsWith(" ")) {
                    this.value = this.value.trimStart();
                } else if (id === 'phone' && this.value.startsWith("+ ")) {
                    this.value = "+" + this.value.slice(1).trimStart();
                }
            });
        });



        document.getElementById('schoolInfoForm').addEventListener('submit', function(e) {
        const schoolNameInput = document.getElementById('school_name');
        const addressInput = document.getElementById('address');
        const phoneInput = document.getElementById('phone');
        const emailInput = document.getElementById('email');
        const normalOpenInput = document.getElementById('normal_open');
        const normalCloseInput = document.getElementById('normal_close');
        const summerOpenInput = document.getElementById('summer_open');
        const summerCloseInput = document.getElementById('summer_close');

        if (
            schoolNameInput.value === schoolNameInput.getAttribute('data-original-value') &&
            addressInput.value === addressInput.getAttribute('data-original-value') &&
            phoneInput.value === phoneInput.getAttribute('data-original-value') &&
            emailInput.value === emailInput.getAttribute('data-original-value') &&
            normalOpenInput.value === normalOpenInput.getAttribute('data-original-value') &&
            normalCloseInput.value === normalCloseInput.getAttribute('data-original-value') &&
            summerOpenInput.value === summerOpenInput.getAttribute('data-original-value') &&
            summerCloseInput.value === summerCloseInput.getAttribute('data-original-value')
        ) {
            // If none of the values have changed, show alert and prevent submission
            alert('Nothing is Changed!');
            e.preventDefault();
            return;
        }

        // used e.preventDefault() within the form's submit event listener to prevent the default submission behavior
        e.preventDefault();

        // Fetch form data
        let formData = new FormData(e.target);

        // Send data to PHP via Fetch API
        fetch('update_school_info.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('School General Information updated successfully!');
                location.reload();
            } else {
                alert('Error updating information. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('There was a problem with the request. Please try again.');
        });
    });

    </script>
</div>
</body>
</html>
