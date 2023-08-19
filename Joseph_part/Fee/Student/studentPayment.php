<?php
session_start();
include '../../../database/db_connection.php'; 
include '../../../assets/favicon/favicon.php'; // Include the favicon.php file

$student_ID = $_SESSION['student_ID'];

$query_distinct_fees = "SELECT DISTINCT fee_ID FROM payment WHERE student_ID = $student_ID AND status = 'Unpaid'";
$result_distinct_fees = mysqli_query($conn, $query_distinct_fees);

$unpaid_payments = [];

if ($result_distinct_fees) {
    while ($row = mysqli_fetch_assoc($result_distinct_fees)) {
        $fee_ID = $row['fee_ID'];

        $query_unpaid_payment = "SELECT * FROM payment WHERE student_ID = $student_ID AND fee_ID = $fee_ID";
        $result_unpaid_payment = mysqli_query($conn, $query_unpaid_payment);

        if ($result_unpaid_payment) {
            while ($payment = mysqli_fetch_assoc($result_unpaid_payment)) {
                $unpaid_payments[] = $payment;
            }
        } else {
            echo "Error fetching unpaid payment data: " . mysqli_error($connection);
        }
    }
} else {
    echo "Error fetching distinct fee IDs: " . mysqli_error($conn);
}

function getOrdinalSuffix($number) {
    if ($number % 100 >= 11 && $number % 100 <= 13) {
        return $number . 'th';
    }
    switch ($number % 10) {
        case 1:
            return $number . 'st';
        case 2:
            return $number . 'nd';
        case 3:
            return $number . 'rd';
        default:
            return $number . 'th';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belanosima&family=Fjalla+One&family=PT+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="studentPayment.css?v=<?php echo time(); ?>">
    <link rel="icon" href="<?php echo $faviconPath; ?>" type="image/png">    
    <script src="../../../assets/js/config.js"></script> 
    <title id="documentTitle"></title>
    <script>
        document.getElementById("documentTitle").innerText = browserName;   //browserName declared in the config.js
    <title>Student Fee Payment Details</title>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('header');
            // Load header content using XMLHttpRequest
            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    container.innerHTML = this.responseText;
                }
            };

            xhttp.open('GET', '../../../student/studentHeader.php', true);
            xhttp.send();
        });
    </script>
</head>
<!-- header -->
<header class="button_header">
    <div class="button">
        <a href="../../../student/more.php" class="back-button">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l160 160c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L109.2 288 416 288c17.7 0 32-14.3 32-32s-14.3-32-32-32l-306.7 0L214.6 118.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-160 160z"/></svg>        </a>
        <h2>Lecturer Directory</h2>
    </div>
</header>

<body>
    <div class="container">
        <h1>Student Fee Payment Details</h1>
        <div class="dashboard">
            <button class="tab-button active" data-tab="unpaid">Unpaid</button>
            <button class="tab-button" data-tab="paid">Paid</button>
        </div>

        <div class="tab-container">
            <div class="tab-content" id="unpaid" style="display: block;">
                <?php
                // Query to fetch unpaid payment data
                $query_unpaid_payments = "SELECT * FROM payment WHERE student_ID = $student_ID AND status = 'Unpaid'";
                $result_unpaid_payments = mysqli_query($conn, $query_unpaid_payments);

                if ($result_unpaid_payments) {
                    $unpaid_payments = [];
                    while ($payment = mysqli_fetch_assoc($result_unpaid_payments)) {
                        $unpaid_payments[] = $payment;
                    }

                    if (empty($unpaid_payments)) {
                        echo "<p>You have no payments to be paid.</p>";
                    } else {
                        foreach ($unpaid_payments as $payment) {
                            $fee_ID = $payment['fee_ID'];
                            $installment_ID = $payment['installment_ID'];

                            // Fetch the fee details
                            $query_fee = "SELECT total_amount, due_date FROM fee WHERE fee_ID = $fee_ID";
                            $result_fee = mysqli_query($conn, $query_fee);

                            if ($result_fee) {
                                $fee = mysqli_fetch_assoc($result_fee);
                            } else {
                                echo "Error fetching fee data: " . mysqli_error($connection);
                            }

                            // Fetch program and course details
                            $query_course_program = "SELECT program_name, course_name FROM course_program WHERE courseProgram_ID = (SELECT courseProgram_ID FROM intake WHERE intake_ID = (SELECT intake_ID FROM student WHERE student_ID = $student_ID))";
                            $result_course_program = mysqli_query($conn, $query_course_program);

                            if (!$result_course_program) {
                                echo "Error fetching course program data: " . mysqli_error($connection);
                                continue; // Skip this payment and move to the next
                            }

                            $course_program = mysqli_fetch_assoc($result_course_program);

                            // Fetch installment data for this payment
                            if ($installment_ID == 0) {
                                // Full payment block
                                ?>
                                <div class="payment-block">
                                    <div class="payment-title">
                                        <h3 class="payment-title-text">Full Payment for <?php echo $course_program['program_name']; ?> <?php echo $course_program['course_name']; ?></h3>
                                        <div class="title-underline"></div>
                                    </div>
                                    <div class="payment-details">
                                        <h4>Amount</h4>
                                        <p style="color: red;font-weight: bold;">RM <?php echo $fee['total_amount']; ?></p>                                        
                                        <h4>Due Date</h4>
                                        <p><?php echo $fee['due_date']; ?></p>
                                    </div>
                                    <div class="payment-link">
                                        <a href="proceedPayment.php?payment_id=<?php echo $payment['payment_ID']; ?>&installment_ID=0&amount=<?php echo $fee['total_amount']; ?>">Proceed to Payment</a>
                                    </div>
                                </div>
                                <?php
                            } else {
                                // Retrieve the installment for the specific payment
                                $query_installment = "SELECT * FROM installment WHERE fee_ID = $fee_ID AND installment_ID = $installment_ID";
                                $result_installment = mysqli_query($conn, $query_installment);
                            
                                if ($result_installment && mysqli_num_rows($result_installment) > 0) {
                                    $installment = mysqli_fetch_assoc($result_installment);
                                    
                                    // Display the payment and installment information
                                    ?>
                                    <div class="payment-block">
                                        <div class="payment-title">
                                            <h3 class="payment-title-text"><?php echo getOrdinalSuffix($installment['installment_count']); ?> Installment for <?php echo $course_program['program_name']; ?> <?php echo $course_program['course_name']; ?></h3>
                                            <div class="title-underline"></div>
                                        </div>
                                        <div class="payment-details">
                                            <!-- <h4>Payment ID</h4> -->
                                            <!-- <p><?php echo $payment['payment_ID']; ?></p> -->
                                            <h4>Amount</h4>
                                            <p style="color: red;font-weight: bold;">RM <?php echo $installment['amount']; ?></p>
                                            <h4>Due Date</h4>
                                            <p><?php echo $installment['due_date']; ?></p>
                                            <!-- <h4>Installment ID</h4>
                                            <p><?php echo $installment['installment_ID']; ?></p> Display the installment ID -->
                                        </div>
                                        <div class="payment-link">
                                            <a href="proceedPayment.php?payment_id=<?php echo $payment['payment_ID']; ?>&installment_ID=<?php echo $installment['installment_ID']; ?>&amount=<?php echo $installment['amount']; ?>">Proceed to Payment</a>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    echo "Error fetching installment data: " . mysqli_error($conn);
                                }
                            }                
                        }
                    }
                } else {
                    echo "Error fetching unpaid payment data: " . mysqli_error($conn);
                }
                ?>
            </div>

            <div class="tab-content" id="paid" style="display: none;">
                <?php
                // Query to fetch paid payment data
                $query_paid_payments = "SELECT * FROM payment WHERE student_ID = $student_ID AND status = 'Paid'";
                $result_paid_payments = mysqli_query($conn, $query_paid_payments);

                if ($result_paid_payments) {
                    if (mysqli_num_rows($result_paid_payments) === 0) {
                        echo "<p>You have no paid payments.</p>";
                    } else {
                        while ($payment = mysqli_fetch_assoc($result_paid_payments)) {
                            $fee_ID = $payment['fee_ID'];
                            $installment_ID = $payment['installment_ID'];
                            $payment_method = $payment['payment_method'];

                            if ($installment_ID == 0) {
                                // Fetch the fee details for the full payment
                                $query_fee = "SELECT total_amount FROM fee WHERE fee_ID = $fee_ID";
                                $result_fee = mysqli_query($conn, $query_fee);

                                // Fetch program and course details
                                $query_course_program = "SELECT program_name, course_name FROM course_program WHERE courseProgram_ID = (SELECT courseProgram_ID FROM intake WHERE intake_ID = (SELECT intake_ID FROM student WHERE student_ID = $student_ID))";
                                $result_course_program = mysqli_query($conn, $query_course_program);

                                if ($result_fee && $result_course_program) {
                                    $fee = mysqli_fetch_assoc($result_fee);
                                    $course_program = mysqli_fetch_assoc($result_course_program);
                                } else {
                                    echo "Error fetching fee or course program data: " . mysqli_error($conn);
                                    continue; // Skip this payment and move to the next
                                }

                                // Display payment details for each full paid payment
                                ?>
                                <div class="payment-block">
                                    <div class="payment-title">
                                        <h3 class="payment-title-text">Full Payment for <?php echo $course_program['program_name']; ?> <?php echo $course_program['course_name']; ?></h3>
                                        <div class="title-underline"></div>
                                    </div>
                                    <div class="payment-details">
                                        <h4>Paid Amount</h4>
                                        <p style="color: green;font-weight: bold;">RM <?php echo $fee['total_amount']; ?></p>
                                        <h4>Payment Date</h4>
                                        <p><?php echo $payment['payment_datetime']; ?></p>
                                        <h4>Payment Method</h4>
                                        <p><?php echo $payment_method; ?></p>
                                    </div>
                                </div>
                                <?php
                            } else {
                                // Retrieve the installment for the specific payment
                                $query_installment = "SELECT * FROM installment WHERE fee_ID = $fee_ID AND installment_ID = $installment_ID";
                                $result_installment = mysqli_query($conn, $query_installment);

                                if ($result_installment && mysqli_num_rows($result_installment) > 0) {
                                    $installment = mysqli_fetch_assoc($result_installment);
                                    // Fetch program and course details
                                    $query_course_program = "SELECT program_name, course_name FROM course_program WHERE courseProgram_ID = (SELECT courseProgram_ID FROM intake WHERE intake_ID = (SELECT intake_ID FROM student WHERE student_ID = $student_ID))";
                                    $result_course_program = mysqli_query($conn, $query_course_program);

                                    if ($result_course_program) {
                                        $course_program = mysqli_fetch_assoc($result_course_program);

                                        // Display the payment and installment information
                                        ?>
                                        <div class="payment-block">
                                            <div class="payment-title">
                                                <h3 class="payment-title-text"><?php echo getOrdinalSuffix($installment['installment_count']); ?> Installment for <?php echo $course_program['program_name']; ?> <?php echo $course_program['course_name']; ?></h3>
                                                <div class="title-underline"></div>
                                            </div>
                                            <div class="payment-details">
                                                <!-- <h4>Payment ID</h4> -->
                                                <!-- <p><?php echo $payment['payment_ID']; ?></p> -->
                                                <h4>Paid Amount</h4>
                                                <p style="color: green;font-weight: bold;">RM <?php echo $installment['amount']; ?></p>
                                                <h4>Payment Method</h4>
                                                <p><?php echo $payment_method; ?></p>
                                                <h4>Payment Date</h4>
                                                <p><?php echo $payment['payment_datetime']; ?></p>
                                                <!-- <h4>Installment ID</h4>
                                                <p><?php echo $installment['installment_ID']; ?></p> Display the installment ID -->
                                            </div>
                                        </div>
                                        <?php
                                    } else {
                                        echo "Error fetching course program data: " . mysqli_error($conn);
                                        continue; // Skip this payment and move to the next
                                    }
                                } else {
                                    echo "Error fetching installment data: " . mysqli_error($conn);
                                }
                            }
                        }
                    }
                } else {
                    echo "Error fetching paid payment data: " . mysqli_error($conn);
                }
                ?>
            </div>
        </div>
    </div>
    <script>
        function openTab(tabId) {
            var i, tabContent, tabButtons;

            // Get all elements with class="tab-content" and hide them
            tabContent = document.getElementsByClassName("tab-content");
            for (i = 0; i < tabContent.length; i++) {
                tabContent[i].style.display = "none";
            }

            // Get all elements with class="tab-button" and remove the class "active"
            tabButtons = document.getElementsByClassName("tab-button");
            for (i = 0; i < tabButtons.length; i++) {
                tabButtons[i].classList.remove("active");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabId).style.display = "block";
            var clickedTabButton = document.querySelector('[data-tab="' + tabId + '"]');
            clickedTabButton.classList.add("active");
        }

        // Add event listeners to tab buttons
        var tabButtons = document.getElementsByClassName("tab-button");
        for (var i = 0; i < tabButtons.length; i++) {
            tabButtons[i].addEventListener("click", function(event) {
                var tabId = event.target.getAttribute("data-tab");
                openTab(tabId);
            });
        }

        // Trigger the click event on the "Unpaid" tab button to set it as active by default
        document.querySelector('[data-tab="unpaid"]').click();
    
    </script>

</body>
</html>
