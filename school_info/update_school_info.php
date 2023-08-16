<?php

include '../database/db_connection.php';

function convertTimeFormat($input) {
    $parts = explode('.', $input);
    $newFormat = implode(':', $parts) . ":00";
    return $newFormat;
}

$school_name = $_POST['school_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$email = $_POST['email'];

$normal_open = convertTimeFormat($_POST['normal_open']);
$normal_close = convertTimeFormat($_POST['normal_close']);
$summer_open = convertTimeFormat($_POST['summer_open']);
$summer_close = convertTimeFormat($_POST['summer_close']);

// This will update ALL records in the school_info table
$sql = "UPDATE school_info SET school_name=?, address=?, phone=?, email=?, normal_open=?, normal_close=?, summer_open=?, summer_close=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ssssssss', $school_name, $address, $phone, $email, $normal_open, $normal_close, $summer_open, $summer_close);

if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "error" => $stmt->error]);
}

$stmt->close();
$conn->close();

?>
