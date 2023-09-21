<?php
include 'dbConn.php';
include "../Admin_header/AdminHeader.php";

// Query to fetch all payments
$query_all_payments = "SELECT * FROM payment";

if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search = $_POST['search'];
    // Modify the query to search for student name or payment status
    $query_all_payments = "SELECT * FROM payment 
                           JOIN student ON payment.student_ID = student.student_ID 
                           WHERE student.student_name LIKE '%$search%' OR payment.status LIKE '%$search%'";
}

$results = mysqli_query($connection, $query_all_payments);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payment</title>
    <link rel="stylesheet" href="ViewPayment.css?v=<?php echo time(); ?>">
    <script src="https://kit.fontawesome.com/d3e9e194a4.js" crossorigin="anonymous"></script>

<style>
    .FinancialManagement{
        display: block;
    }

    .FinancialManagement .ViewPayments{
        color: #5c5adb;
    }
</style>

</head>
<body>
    <div class="wrapper">
        <h2>View Payment List</h2>
        <div class="search-bar">
            <form action="" method="post">
                <label for="search-input" class="search-input">Search:</label>
                <input type="text" id="search-input" name="search" placeholder="Enter what you are searching for">
                <button type="submit">Search</button>
            </form>
        </div>
        <div class="table-wrapper">
            <div class="table-responsive">
                <table border="0" class="animated">
                    <tr>
                        <th>Student ID</th>
                        <th>Student Name</th>
                        <th>Payment</th>
                        <th>Amount</th>
                        <th>Due Date</th>
                        <th>Payment Date Time</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                    </tr>
                    <?php
                    $previous_student_ID = null;
                    $row_count = mysqli_num_rows($results);
                    if ($row_count === 0) {
                        echo "<tr><td colspan='8'>No results found.</td></tr>";
                    } else {
                        while ($row = mysqli_fetch_assoc($results)) {
                            if ($previous_student_ID !== $row['student_ID']) {
                                $previous_student_ID = $row['student_ID'];
                                echo "<tr>";
                                echo "<td rowspan='" . countInstallments($connection, $row['student_ID']) . "'>" . $row['student_ID'] . "</td>";
                                echo "<td rowspan='" . countInstallments($connection, $row['student_ID']) . "'>" . getStudentName($connection, $row['student_ID']) . "</td>";
                            }
                            echo "<td>" . ($row['installment_ID'] == 0 ? "Full Payment" : getInstallmentLabel($connection, $row['fee_ID'], $row['installment_ID'])) . "</td>";

                            echo "<td>RM " . (isset($row['total_amount'])
                            ? $row['total_amount']
                            : ($row['installment_ID'] != 0
                                ? getInstallmentAmount($connection, $row['fee_ID'], $row['installment_ID'])
                                : getFullPaymentAmount($connection, $row['fee_ID']))) . "</td>";

                                if ($row['installment_ID'] == 0) {
                                    // Fetch due_date from fee table using fee_ID
                                    $fee_query = "SELECT due_date FROM fee WHERE fee_ID = {$row['fee_ID']}";
                                    $fee_result = mysqli_query($connection, $fee_query);
                                    $fee_row = mysqli_fetch_assoc($fee_result);
                                    echo "<td>" . (isset($fee_row['due_date']) ? $fee_row['due_date'] : "") . "</td>";
                                } else {
                                    // Fetch installment_due_date from installment table using fee_ID and installment_ID
                                    $installment_query = "SELECT due_date FROM installment WHERE fee_ID = {$row['fee_ID']} AND installment_ID = {$row['installment_ID']}";
                                    $installment_result = mysqli_query($connection, $installment_query);
                                    $installment_row = mysqli_fetch_assoc($installment_result);
                                    echo "<td>" . (isset($installment_row['due_date']) ? $installment_row['due_date'] : "") . "</td>";
                                }

                            echo "<td>" . ($row['payment_datetime'] ? $row['payment_datetime'] : "None") . "</td>";
                            echo "<td>" . ($row['payment_method'] ? $row['payment_method'] : "None") . "</td>";
                            echo "<td><span class='" . strtolower($row['status']) . "'>" . $row['status'] . "</span></td>";
                            echo "</tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script>
    <?php
    function getStudentName($connection, $student_ID) {
        $student_query = "SELECT student_name FROM student WHERE student_ID = $student_ID";
        $student_result = mysqli_query($connection, $student_query);
        $student_row = mysqli_fetch_assoc($student_result);
        return isset($student_row['student_name']) ? $student_row['student_name'] : "";
    }

    function countInstallments($connection, $student_ID) {
        $installment_count_query = "SELECT COUNT(*) as count FROM payment WHERE student_ID = $student_ID AND installment_ID > 0";
        $installment_count_result = mysqli_query($connection, $installment_count_query);
        $installment_count_row = mysqli_fetch_assoc($installment_count_result);
        return $installment_count_row['count'] + 1; // Add 1 for full payment row
    }

    function getInstallmentNumber($connection, $fee_ID, $installment_ID) {
        $installment_number_query = "SELECT COUNT(*) as count FROM installment WHERE fee_ID = $fee_ID AND installment_ID <= $installment_ID";
        $installment_number_result = mysqli_query($connection, $installment_number_query);
        $installment_number_row = mysqli_fetch_assoc($installment_number_result);
        return $installment_number_row['count'];
    }

    function getInstallmentLabel($connection, $fee_ID, $installment_ID) {
        $installment_number_query = "SELECT COUNT(*) as count FROM installment WHERE fee_ID = $fee_ID AND installment_ID <= $installment_ID";
        $installment_number_result = mysqli_query($connection, $installment_number_query);
        $installment_number_row = mysqli_fetch_assoc($installment_number_result);
        $installment_number = $installment_number_row['count'];

        // Generate the installment label based on the number
        $label = $installment_number . ($installment_number == 1 ? "st" : ($installment_number == 2 ? "nd" : "th")) . " Installment";
        return $label;
    }

    function getInstallmentAmount($connection, $fee_ID, $installment_ID) {
        $installment_amount_query = "SELECT amount FROM installment WHERE fee_ID = $fee_ID AND installment_ID = $installment_ID";
        $installment_amount_result = mysqli_query($connection, $installment_amount_query);
        $installment_amount_row = mysqli_fetch_assoc($installment_amount_result);
        return isset($installment_amount_row['amount']) ? $installment_amount_row['amount'] : "";
    }
    
    function getFullPaymentAmount($connection, $fee_ID) {
        $full_payment_amount_query = "SELECT total_amount FROM fee WHERE fee_ID = $fee_ID";
        $full_payment_amount_result = mysqli_query($connection, $full_payment_amount_query);
        $full_payment_amount_row = mysqli_fetch_assoc($full_payment_amount_result);
        return isset($full_payment_amount_row['total_amount']) ? $full_payment_amount_row['total_amount'] : "";
    }

    ?>
    </script>    
</body>
</html>
