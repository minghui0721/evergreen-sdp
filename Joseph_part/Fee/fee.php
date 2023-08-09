<?php
session_start();
include 'dbConn.php';

// Check if the student is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ../Login/login.php");
    exit();
}

// Fetch student details from the database based on the stored student_ID
$student_ID = $_SESSION['student_ID'];
$student_name = $_SESSION['student_name'];

// Query the student table to get the intake_ID related to the student_ID
$query_student = "SELECT intake_ID FROM student WHERE student_ID = '$student_ID'";
$result_student = mysqli_query($connection, $query_student);
$row_student = mysqli_fetch_assoc($result_student);
$intake_ID = $row_student['intake_ID'];

// Use the intake_ID to fetch the courseProgram_ID from the intake table
$query_intake = "SELECT courseProgram_ID FROM intake WHERE intake_ID = '$intake_ID'";
$result_intake = mysqli_query($connection, $query_intake);
$row_intake = mysqli_fetch_assoc($result_intake);
$courseProgram_ID = $row_intake['courseProgram_ID'];

// Fetch due date data from the fee table in the database based on the student's course_ID
$query_due = "SELECT due_date, total_amount FROM fee WHERE courseProgram_ID = '$courseProgram_ID'";
$result_due = mysqli_query($connection, $query_due);
$row_due = mysqli_fetch_assoc($result_due);
$dueDateFromDB = $row_due['due_date'];
$TotalAmount = $row_due['total_amount'];


// Function to calculate installment amount
function calculateInstallmentAmount($totalAmount, $numberOfMonths)
{
    return $totalAmount / $numberOfMonths;
}

// Initialize variables to prevent undefined variable warnings
$paymentOption = '';
$paymentDetails = '';

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize inputs here
    // ... (existing code)

    // Simulate receipt generation and data storage
    $_SESSION['paymentOption'] = $paymentOption;
    $_SESSION['numberOfMonths'] = ($paymentOption === 'installment') ? $_POST['numberOfMonths'] : '';

    // Save the payment details to a variable
    $paymentDetails .= "Course ID: $courseProgram_ID\n";
    $paymentDetails .= "Total Amount: RM " . number_format($TotalAmount, 2) . "\n";
    $paymentDetails .= "Due Date: $dueDateFromDB\n";
    if ($paymentOption === 'full') {
        $paymentDetails .= "Payment Option: Full Payment\n";
    } elseif ($paymentOption === 'installment') {
        $numberOfMonths = $_POST['numberOfMonths'];
        $paymentDetails .= "Payment Option: Installment ($numberOfMonths months)\n";
        $installmentAmount = calculateInstallmentAmount($TotalAmount, $numberOfMonths);
        $paymentDetails .= "Amount to pay per month: RM " . number_format($installmentAmount, 2) . "\n";
    } else {
        $paymentDetails .= "Please select a valid payment option.\n";
    }
}

echo "<script>const studentName = '" . $student_name . "';</script>";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="fee.css?v=<?php echo time(); ?>">
    <title>Fee Payment</title>
</head>
<body>
    <div class="center-container">
        <h1>Fee Payment</h1>
        <div class="container">
            <!-- Your form goes here -->
            <form action="" method="post" onsubmit="return showPaymentDetails()">
                <!-- Student information (read-only) -->
                <div class="form-row">
                    <div class="form-column">
                        <label for="student_ID">Student ID:</label>
                        <input type="text" name="student_ID" value="<?php echo $_SESSION['student_ID']; ?>" readonly>
                    </div>
                    <div class="form-column">
                        <label for="student_name">Student Name:</label>
                        <input type="text" name="student_name" value="<?php echo $_SESSION['student_name']; ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="courseID">Course ID:</label>
                        <input type="text" name="courseProgram_ID" value="<?php echo $courseProgram_ID; ?>" readonly>
                    </div>
                    <div class="form-column">
                        <label for="dueDate">Due Date:</label>
                        <input type="date" name="dueDate" value="<?php echo $dueDateFromDB; ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-column">
                        <label for="totalAmount">Total Amount:</label>
                        <input type="number" name="totalAmount" value="<?php echo $TotalAmount; ?>" readonly>
                    </div>
                    <div class="form-column">
                        <label for="paymentOption">Payment Option:</label>
                        <select name="paymentOption" id="paymentOption" required onchange="showInstallmentOptions()">
                            <option value="">Select Payment Option</option>
                            <option value="full">Full Payment</option>
                            <option value="installment">Installment</option>
                        </select>
                    </div>
                </div>

                <div id="installmentDiv" style="display: none;">
                    <label>Number of Months:</label>
                    <input type="button" class="installment-button" onclick="selectMonths(6);" value="6 months">
                    <input type="button" class="installment-button" onclick="selectMonths(12);" value="12 months">
                    <input type="hidden" id="numberOfMonths" name="numberOfMonths" value="6"> <!-- Add this line -->
                    <p id="installmentAmount"></p>
                </div>

                <div id="paymentMethodDiv" style="display: none;">
                    <label>Payment Method:</label>
                    <div class="payment-method-options">
                        <input type="radio" name="paymentMethod" value="Credit Card" id="creditCardPayment" checked>
                        <label for="creditCardPayment">Credit Card</label>
                        <input type="radio" name="paymentMethod" value="Bank Transfer" id="bankTransferPayment">
                        <label for="bankTransferPayment">Bank Transfer</label>
                        <input type="radio" name="paymentMethod" value="PayPal" id="paypalPayment">
                        <label for="paypalPayment">PayPal</label>
                    </div>
                </div>

                <div id="paymentModal" class="modal">
                    <div class="modal-content">
                        <span class="close" onclick="hideModal()">&times;</span>
                        <div class="payment-receipt">
                            <h2>Payment Receipt</h2>
                            <div id="paymentDetails"></div>
                            <button onclick="confirmPayment()">Confirm Payment</button>
                        </div>
                    </div>
                </div>

                <input type="submit" name="submit" value="Pay">
            </form>
        </div>
    </div>

    <script>
    let selectedButton = null; // Variable to keep track of the selected button

    // Function to select the number of months and update button styles
    function selectMonths(months) {
        const numberOfMonthsInput = document.getElementById('numberOfMonths');
        numberOfMonthsInput.value = months;
        calculateInstallmentAmount(months);

        // If there was a previously selected button, reset its style
        if (selectedButton) {
            selectedButton.style.backgroundColor = '#002349';
            selectedButton.style.color = 'white';
        }

        // Set the style of the clicked button
        selectedButton = event.target;
        selectedButton.style.backgroundColor = '#577ea8';
        selectedButton.style.color = 'white';
    }

    // Function to calculate installment amount
    function calculateInstallmentAmount(months) {
        const totalAmount = parseFloat(document.getElementsByName('totalAmount')[0].value);
        const installmentAmount = totalAmount / months;
        document.getElementById('installmentAmount').innerText = `Amount to pay per month: RM ${installmentAmount.toFixed(2)}`;
    }

 // Function to show/hide the installment options and payment method based on the selected payment option
 function showInstallmentOptions() {
    const paymentOptionSelect = document.getElementById('paymentOption');
    const installmentDiv = document.getElementById('installmentDiv');
    const paymentMethodDiv = document.getElementById('paymentMethodDiv');

    if (paymentOptionSelect.value === 'installment') {
        installmentDiv.style.display = 'block';
        paymentMethodDiv.style.display = 'block';
        const numberOfMonthsInput = document.getElementById('numberOfMonths');
        calculateInstallmentAmount(Number(numberOfMonthsInput.value));
    } else if (paymentOptionSelect.value === 'full') {
        installmentDiv.style.display = 'none';
        paymentMethodDiv.style.display = 'block';
    } else {
        installmentDiv.style.display = 'none';
        paymentMethodDiv.style.display = 'none';
    }
}




// Function to display the payment details in the modal
function showPaymentDetails() {
    const paymentOptionSelect = document.getElementById('paymentOption');
    const paymentOption = paymentOptionSelect.value;
    const numberOfMonthsInput = document.getElementById('numberOfMonths');
    const numberOfMonths = Number(numberOfMonthsInput.value);
    const paymentMethodInput = document.querySelector('input[name="paymentMethod"]:checked');
    const paymentMethod = paymentMethodInput ? paymentMethodInput.value : '';

    // Check if payment option and number of months are selected
    if (paymentOption === '' || (paymentOption === 'installment' && numberOfMonths === 0)) {
        alert("Please select a valid payment option.");
        return false; // Prevent the form from being submitted
    }

    const totalAmount = parseFloat(document.getElementsByName('totalAmount')[0].value);
    const installmentAmount = totalAmount / numberOfMonths;
    
    // Get the current date
    const currentDate = new Date();
    const formattedCurrentDate = currentDate.toLocaleDateString('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });

    console.log(studentName);

    let paymentDetails =
        `Student Name: ${studentName}<br>
        Course ID: <?php echo $courseProgram_ID; ?><br>
        Payment Method: ${paymentMethod}<br>
        Date of Payment: ${formattedCurrentDate}<br>
        Payment Option: ${paymentOption === 'full' ? 'Full Payment' : `Installment (${numberOfMonths} months)`}<br>
        Total Amount: RM <?php echo number_format($TotalAmount, 2); ?>`;

    if (paymentOption === 'installment') {
        paymentDetails += `<br>Amount to pay per month: RM ${installmentAmount.toFixed(2)}`;
    }

    // Display the payment details in the modal
    const modal = document.getElementById('paymentModal');
    const paymentDetailsElement = modal.querySelector('#paymentDetails');
    paymentDetailsElement.innerHTML = paymentDetails;
    modal.style.display = 'block';

    return false; 
}


function confirmPayment() {
    const paymentMethodInput = document.querySelector('input[name="paymentMethod"]:checked');
    const paymentMethod = paymentMethodInput ? paymentMethodInput.value : '';

    // Check if payment method is selected
    if (!paymentMethod) {
        alert("Please select a payment method.");
        return;
    }

    // Set the payment method value in the hidden input field
    document.getElementById('paymentMethod').value = paymentMethod;

    // Set the student_ID and fee_ID values in the hidden input fields
    document.getElementById('studentID').value = "<?php echo $student_ID; ?>";
    document.getElementById('feeID').value = "<?php echo $courseProgram_ID; ?>";

    // Submit the form to update the data in the payment table
    document.getElementById('paymentForm').submit();
}

function showModal() {
    const modal = document.getElementById('paymentModal');
    modal.style.display = 'block';

    window.onclick = function (event) {
        if (event.target === modal) {
            hideModal();
        }
    };
}

function hideModal() {
    const modal = document.getElementById('paymentModal');
    modal.style.display = 'none';

    // Clear the form inputs when the modal is closed
    document.getElementById('paymentOption').selectedIndex = 0;
    document.getElementById('numberOfMonths').value = '6';
    document.getElementById('paymentMethodDiv').style.display = 'none';
    selectedButton = null; // Reset the selected button
}
    </script>
</body>
</html>